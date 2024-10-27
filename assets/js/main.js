let coins = 0;
    const coinsNumberElement = document.querySelector('.coin-number');
    const avatarImage = document.querySelector('.avatar-img');
    const tapMessage = document.getElementById('tap-message');

    // Function to update coin count in the UI
    function updateCoins(newCoins) {
        coins = newCoins;
        coinsNumberElement.textContent = coins;
    }

    // Function to animate +3 from the touch position towards the coin number
    function showCoinIncrement(x, y, touchPoints) {
        for (let i = 0; i < touchPoints; i++) {
            const incrementDiv = document.createElement('div');
            incrementDiv.textContent = `+3`;
            incrementDiv.style.position = 'absolute';
            incrementDiv.style.left = `${x}px`;
            incrementDiv.style.top = `${y}px`;
            incrementDiv.style.color = 'white';
            incrementDiv.style.fontSize = '24px';
            incrementDiv.style.fontWeight = 'bold';
            incrementDiv.style.zIndex = 1000;
            incrementDiv.style.transition = 'all 1s ease-in-out';
            document.body.appendChild(incrementDiv);

            // Calculate the position of the coin counter to move the +3 towards it
            const coinRect = coinsNumberElement.getBoundingClientRect();
            const targetX = coinRect.left + coinRect.width / 2;
            const targetY = coinRect.top + coinRect.height / 2;

            // Animate the increment
            incrementDiv.animate([
                { transform: `translate(0, 0)`, opacity: 1 },
                { transform: `translate(${targetX - x}px, ${targetY - y}px)`, opacity: 0 }
            ], {
                duration: 1000,
                fill: 'forwards',
                easing: 'ease-in-out'
            });

            // Remove the element after the animation
            setTimeout(() => incrementDiv.remove(), 1000);
        }
    }

    // Event listener for tap/click on the avatar
    avatarImage.addEventListener('touchstart', function(event) {
        const touchPoints = event.touches.length; // Get the number of touch points

        // Check if it's a valid multi-finger tap
        if (touchPoints >= 1) {
            event.preventDefault(); // Prevent default behavior (like zooming)

            const x = event.touches[0].clientX; // Get the X position of the first touch
            const y = event.touches[0].clientY; // Get the Y position of the first touch

            // Remove the "Tap Me" message on the first tap
            if (tapMessage.style.display !== 'none') {
                tapMessage.style.display = 'none';
            }

            // Add zoom effect on avatar
            avatarImage.classList.add('zoom-avatar');

            // Make AJAX request to backend to increment coins
            fetch('/tap-coin/', { // Assuming your URL for the tap_coin view
                method: 'POST',
                headers: {
                    'X-CSRFToken': '{{ csrf_token }}', // Django CSRF token for security
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.coins !== undefined) {
                    // Update the UI with the new coin balance
                    updateCoins(data.coins);

                    // Show the +3 animation
                    showCoinIncrement(x, y, touchPoints);
                } else if (data.error) {
                    alert(data.error); // Show error if the user is not authenticated
                }
            })
            .catch(error => console.error('Error:', error));

            // Remove zoom effect after animation ends
            setTimeout(() => avatarImage.classList.remove('zoom-avatar'), 300);
        }
    });