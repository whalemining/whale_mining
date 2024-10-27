document.addEventListener("DOMContentLoaded", () => {
    let coins = 0;
    let energyValue = 500; // Initial energy value
    const coinsNumberElement = document.querySelector('.coin-number');
    const avatarImage = document.querySelector('.avatar-img');
    const tapMessage = document.getElementById('tap-message');
    const energyDisplay = document.getElementById('energy-value'); // Energy display element
    let tapIncrement = 3; // Default tap increment

    // Telegram Web App is ready
    Telegram.WebApp.ready();

    // Fetch user data from Telegram Web App
    const user = Telegram.WebApp.initDataUnsafe.user;

    if (user) {
        const telegramID = user.id;
        const username = user.username || 'Anonymous';
        const firstName = user.first_name || '';
        const lastName = user.last_name || '';

        // Extract the referral ID from the URL (via the "start" parameter)
        const urlParams = new URLSearchParams(window.location.search);
        const referrerId = urlParams.get('start') ? urlParams.get('start').replace('referrer_', '') : null;

        // Fetch initial coin data
        getCoinData(telegramID).then(fetchedCoins => {
            coins = fetchedCoins;
            coinsNumberElement.textContent = coins;
        });

        // Authenticate the user with the backend and check for referral
        fetch('https://gope360.com/whale/telegram_auth.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                telegram_id: user.id,
                username: user.username || 'Anonymous',
                first_name: user.first_name || '',
                last_name: user.last_name || '',
                referrer_id: referrerId // Ensure this variable is defined and contains the correct referrer ID
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Apply the boost to the coins
                coins += data.boost; // Assuming 'boost' is returned from the server
                coinsNumberElement.textContent = coins;

                // Check if the user is new and if a referrer ID exists
                if (data.is_new_user && referrerId) {
                    // Optionally: You can handle the referral confirmation here if needed
                }
            } else {
                console.error('Error authenticating:', data.message);
            }
        })
        .catch(error => console.error('Error:', error));

        // Function to update coin count
        function incrementCoins() {
            // Instead of a fixed increment, we apply the current tap increment
            if (energyValue > 0) {
                coins += tapIncrement; // Add the current tap increment
                coinsNumberElement.textContent = coins; // Update displayed coin count

                // Update backend with new coin value
                fetch('https://gope360.com/whale/update_coin_data.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        telegram_id: telegramID,
                        coins: coins // Send the updated coin value to the backend
                    })
                })
                .then(response => response.json())
                .then(data => console.log('Coins updated on server:', data))
                .catch(error => console.error('Error updating coins:', error));
            } else {
                console.log("Energy is depleted, no coins can be incremented.");
            }
        }

        // Function to show the coin increment animation
        function showCoinIncrement(x, y, increment) {
            for (let i = 0; i < increment / 3; i++) {
                const incrementDiv = document.createElement('div');
                incrementDiv.textContent = `+${increment / 3}`;
                incrementDiv.style.position = 'absolute';
                incrementDiv.style.left = `${x}px`;
                incrementDiv.style.top = `${y}px`;
                incrementDiv.style.color = 'white';
                incrementDiv.style.fontSize = '24px';
                incrementDiv.style.fontWeight = 'bold';
                document.body.appendChild(incrementDiv);

                const coinRect = coinsNumberElement.getBoundingClientRect();
                const targetX = coinRect.left + coinRect.width / 2;
                const targetY = coinRect.top + coinRect.height / 2;

                incrementDiv.animate([
                    { transform: 'translate(0, 0)', opacity: 1 },
                    { transform: `translate(${targetX - x}px, ${targetY - y}px)`, opacity: 0 }
                ], {
                    duration: 1000,
                    fill: 'forwards'
                });

                setTimeout(() => incrementDiv.remove(), 1000);
            }
        }

        // Event listener for tap on avatar
        avatarImage.addEventListener('touchstart', function(event) {
            const touchPoints = event.touches.length;
            if (touchPoints >= 1) {
                event.preventDefault();
                const x = event.touches[0].clientX;
                const y = event.touches[0].clientY;

                if (tapMessage.style.display !== 'none') {
                    tapMessage.style.display = 'none';
                }

                avatarImage.classList.add('zoom-avatar');
                incrementCoins(); // Call incrementCoins without parameters
                showCoinIncrement(x, y, tapIncrement); // Pass the current tap increment to the function

                setTimeout(() => avatarImage.classList.remove('zoom-avatar'), 300);
            }
        });

        // Boost button functionality
        const boostButtons = document.querySelectorAll('.skill-card'); // Select all boost buttons
        boostButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Get the boost value and coin cost from the button's contents
                const boostAmount = parseInt(button.querySelector('.text-warning').textContent.replace('+', '').replace(' Boost', '').replace(',', ''), 10);
                const coinCost = parseInt(button.querySelector('.text-info').textContent.replace(' Coins', '').replace(',', ''), 10);

                // Check if user has enough coins to apply the boost
                if (coins >= coinCost) {
                    tapIncrement = boostAmount; // Set the tap increment to the boost amount
                    coins -= coinCost; // Deduct the cost
                    coinsNumberElement.textContent = coins; // Update displayed coin count

                    // Update backend with new coin value
                    fetch('https://gope360.com/whale/update_coin_data.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            telegram_id: telegramID,
                            coins: coins // Send the updated coin value to the backend
                        })
                    })
                    .then(response => response.json())
                    .then(data => console.log('Coins updated after boost:', data))
                    .catch(error => console.error('Error updating coins after boost:', error));
                } else {
                    alert("Not enough coins for this boost!"); // Notify the user
                }
            });
        });

        // Free boost button functionality
        const freeBoostButton = document.getElementById('boost-btn');
        freeBoostButton.addEventListener('click', () => {
            console.log("Free boost button clicked"); // Log click event
            const freeBoostValue = Math.floor(tapIncrement * 0.05); // Calculate 5% of current increment
            console.log(`Calculated free boost value: ${freeBoostValue}`); // Log calculated value
        
            if (freeBoostValue > 0) {
                tapIncrement += freeBoostValue; // Increase tap increment
                alert(`Free boost applied! New tap increment: +${tapIncrement}`); // Notify user
            } else {
                alert("No boost to apply!");
            }
        });

        // Fetch initial coin data from the backend
        function getCoinData(telegramID) {
            return fetch('https://gope360.com/whale/get_coin_data.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ telegram_id: telegramID })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    return parseInt(data.coins, 10);  // Ensure coins is treated as a number
                } else {
                    console.error('Error fetching coin data:', data.message);
                    return 0;
                }
            })
            .catch(error => {
                console.error('Error fetching coin data:', error);
                return 0;
            });
        }

    } else {
        console.error('User not authenticated. Please authenticate via Telegram.');
    }
});
