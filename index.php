<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Whale</title>
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.0.0/mdb.min.css" rel="stylesheet"/>
    
    <!-- Telegram Web App Script -->
    <script src="https://telegram.org/js/telegram-web-app.js"></script>
    
    <!-- Custom CSS -->
    <style>
        body {
            height: 100vh;
            background: url('./assets/download.png') no-repeat center center fixed;
            background-size: cover;
            color: #ffffff;
            display: flex;
            flex-direction: column;
        }
        
        /* Top Bar Styling */
        .top-bar {
            background: linear-gradient(90deg, #a5aa5b 0%, rgba(3, 107, 197, 0.7) 100%);
            padding: 10px 20px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 100;
            color: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        }
        
        .binance-icon {
            width: 40px;
            height: 40px;
        }
        
        .profit-section {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 5px 15px;
            border-radius: 30px;
            display: flex;
            align-items: center;
        }
        
        .profit-value {
            font-size: 0.8rem;
            margin-left: 8px;
            color: #b8d1ff; /* Light blue text */
        }
        
        .fas.fa-gem {
            color: #b8d1ff; /* Diamond color to match the screenshot */
        }
        
        .fas.fa-info-circle {
            color: #aaa; /* Gray color for info icon */
        }
        
        .right-section {
            display: flex;
            align-items: center;
        }
        
        .fas.fa-cog {
            color: #aaa;
            font-size: 0.8rem;
        }
        
        .memories-btn {
            background-color: rgba(98, 0, 121, 0.6); /* Purple gradient background */
            border: none;
            padding: 10px 15px;
            border-radius: 30px;
            color: white;
            font-size: 1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease;
        }
        
        .memories-btn:hover {
            background-color: rgba(98, 0, 121, 0.8);
        }
        
        .memories-btn i {
            font-size: 0.8rem;
            color: #ff4c91; /* Pink color for the heart icon */
        }
        
        /* Responsive Layout */
        @media only screen and (max-width: 768px) {
            .profit-section {
                font-size: 0.9rem;
                padding: 5px 10px;
            }
        
            .binance-icon {
                width: 30px;
                height: 30px;
            }
        
            .memories-btn {
                font-size: 0.8rem;
                padding: 8px 12px;
            }
        
            .memories-btn i {
                font-size: 0.8rem;
            }
        }
        
        /* Coin Counter Box Styling */
        .coin-box {
            background-color: rgba(255, 255, 255, 0.1); /* Transparent white */
            padding: 8px 12px;
            border-radius: 30px;
            color: white;
            font-size: 1rem;
            cursor: default;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
            position: absolute;
            top: 10px;
            right: 50%;
            transform: translateX(50%);
            transition: background-color 0.3s ease;
        }
        
        .coin-box i {
            font-size: 0.8rem;
            color: #ffcc00; /* Gold color for the coin icon */
        }
        
        @media only screen and (max-width: 768px) {
            .coin-box {
                font-size: 0.8rem;
                padding: 6px 10px;
            }
        }

        .avatar-small {
            border-radius: 50%;
            width: 50px;
            height: 50px;
            border: 1px solid #a5aa5b;
            padding: 2px;
        }

        .avatar-section {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 300px);
            margin-top: 35%;
            position: relative;
        }

        .avatar-img {
            width: 270px; /* Maintain original width */
            height: auto; /* Maintain original height based on width */
            margin-top: 50px;
            cursor: pointer; /* Make avatar clickable */
            display: block; /* Ensure no extra space below the image */
        }

        .tap-message {
            position: absolute;
            top: 55%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 50px;
            color: white;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            pointer-events: none; /* Ensure it doesn't interfere with clicking */
        }

        .coins-counter {
            font-size: 34px;
            font-weight: bold;
            display: flex;
            align-items: center;
        }
        
        .top-section {
            display: flex;
            justify-content: space-between;
            padding: 10px 15px;
            align-items: center;
            background-color: transparent; /* Ensures no background color */
        }
        
        .energy {
            display: flex;
            align-items: center;
            font-size: 18px;
            font-weight: bold;
            color: #fff; /* White to match the image */
        }
        
        .icon-lightning {
            width: 18px;
            height: 18px;
            background-image: url('path-to-your-lightning-icon.png'); /* Add your lightning icon here */
            background-size: contain;
            background-repeat: no-repeat;
            margin-right: 8px;
        }
        
        .actions {
            display: flex;
            align-items: center;
        }
        
        .boost-modal {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 10px 15px;
            border-radius: 15px;
            color: white;
            font-size: 1rem;
            margin: 20px auto;
            width: fit-content;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .boost-content {
            display: flex;
            align-items: center;
        }

        .fixed-bottom {
            background-color: rgba(3, 107, 197, 0.7);
            color: white;
            border-top: 2px solid #a5aa5b; /* Top border */
            box-shadow: 0px -2px 10px rgba(0, 0, 0, 0.5); /* Shadow for the bottom nav bar */
        }

        .nav-item {
            text-align: center;
            position: relative;
            transition: background-color 0.3s ease;
        }

        .nav-item:hover {
            background-color: #a5aa5b;
        }

        .nav-item .active {
            color: white !important;
            background: #a5aa5b;
        }

        .nav-item .nav-image {
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #a5aa5b;
        }

        .zoom-avatar {
            transform: scale(1.05);
            transition: transform 0.3s ease-in-out;
        }

        /* Floating +3 Animation */
        .floating-plus {
            position: absolute;
            font-size: 24px;
            color: white;
            animation: floatUp 1s ease-in-out forwards;
        }

        @keyframes floatUp {
            0% {
                opacity: 1;
                transform: translateY(0);
            }
            100% {
                opacity: 0;
                transform: translateY(-50px);
            }
        }
    </style>
</head>
<body>

    <div class="top-bar d-flex justify-content-between align-items-center px-3">
        <div class="left-section d-flex align-items-center">
            <img src="./assets/binance-icon.png" alt="Binance Icon" class="binance-icon">
            <div class="profit-section ms-2 d-flex align-items-center">
                <i class="fas fa-gem"></i>
                <span class="profit-value ms-1">+3</span>
                <i class="fas fa-info-circle ms-1"></i>
            </div>
        </div>
        
        <!-- Coin Counter Box -->
        <div class="coin-box d-flex align-items-center justify-content-center shadow">
            <i class="fas fa-coins" style="color: rgb(255, 215, 0);"></i>
            <span class="coin-number ms-1">0</span>
        </div>
    
        <div class="right-section d-flex align-items-center">
            <button class="memories-btn d-flex align-items-center">
                <i class="fas fa-coins"></i> <!-- Replace with an appropriate coin icon -->
                <span class="ms-1">1,000,000 = $10</span>
            </button>
        </div>
    </div>


    <!-- Avatar Section -->
    <div class="avatar-section text-center">
        <div class="tap-message" id="tap-message">Tap Me</div>
        <img src="./assets/avatar.png" alt="Avatar" class="avatar-img img-fluid" id="avatar-img"> <!-- Added img-fluid class -->
    </div>
    
    <div class="top-section">
        <div class="energy d-flex align-items-center">
            <i class="fas fa-bolt me-2" style="color: #FFD700;"></i> <!-- Gold-colored lightning icon -->
            <span id="energy-value">500/500</span>
        </div>
        <div class="actions">
            <div class="boost-modal">
                <div class="boost-content d-flex align-items-center">
                    <i class="fas fa-rocket text-info me-2"></i> <!-- Gold-colored lightning icon -->
                    <button id="boost-btn" class="btn btn-primary" disabled>
                        Boost: +5%
                    </button>
                    <i class="fas fa-info-circle ms-1"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Navigation -->
    <nav class="navbar navbar-dark fixed-bottom py-0">
        <ul class="nav justify-content-around w-100">
            <li class="nav-item text-center" style="flex: 1;">
                <a class="nav-link text-white" href="boost.php"><i class="fas fa-bolt"></i><div>Boost</div></a>
            </li>
            <li class="nav-item text-center" style="flex: 1;">
                <a class="nav-link text-white" href="city.php"><i class="fas fa-city"></i><div>City</div></a>
            </li>
            <li class="nav-item text-center" style="flex: 1; position: relative;">
                <a class="nav-link text-warning active" href="index.php">
                    <img src="./assets/avatar2.jpeg" alt="Mining Avatar" class="nav-image rounded-circle" style="width: 70px; height: 70px;">
                    <i class="fas fa-pickaxe"></i><div>Mining</div>
                </a>
            </li>
            <li class="nav-item text-center" style="flex: 1;">
                <a class="nav-link text-white" href="referal.php"><i class="fas fa-users"></i><div>Friends</div></a>
            </li>
            <li class="nav-item text-center" style="flex: 1;">
                <a class="nav-link text-white" href="quest.php"><i class="fas fa-scroll"></i><div>Quests</div></a>
            </li>
        </ul>
    </nav>
    
    <!-- MDB -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.0.0/mdb.umd.min.js"></script>
    
    <!-- Custom JS -->
    
  <script>
document.addEventListener("DOMContentLoaded", () => {
    let coins = 0;
    let energyValue = 500; // Initial energy value
    let isBoostActive = false; // Track if the boost is active
    const boostDuration = 5 * 60 * 1000; // 5 minutes in milliseconds
    const boostCooldown = 12 * 60 * 60 * 1000; // 12 hours in milliseconds
    const coinsNumberElement = document.querySelector('.coin-number');
    const avatarImage = document.querySelector('.avatar-img');
    const boostButton = document.getElementById('boost-btn');
    const tapMessage = document.getElementById('tap-message');
    const energyDisplay = document.getElementById('energy-value'); // Energy display element

    // Ensure boost button is enabled on page load
    boostButton.disabled = false;

    // Telegram Web App is ready
    Telegram.WebApp.ready();

    // Fetch user data from Telegram Web App
    const user = Telegram.WebApp.initDataUnsafe.user;
    
    if (user) {
        const telegramID = user.id;
        const username = user.username || 'Anonymous';
        const firstName = user.first_name || '';
        const lastName = user.last_name || '';
    
        // Get the entire query string for debugging
        const queryString = window.location.search;
        // alert("Query String: " + queryString);
        
        // Extract the referral ID from the URL (via the "start" parameter)
        const urlParams = new URLSearchParams(queryString);
        const referrerId = urlParams.get('start') ? urlParams.get('start').replace('referrer_', '') : null;
    
        // Fetch initial coin data
        getCoinData(telegramID).then(fetchedCoins => {
            coins = fetchedCoins;
            coinsNumberElement.textContent = coins;
        });
        
        fetch('https://gope360.com/whale/telegram_auth.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                telegram_id: telegramID,
                username: username,
                first_name: firstName,
                last_name: lastName,
                referrer_id: referrerId // Ensure this variable is defined and contains the correct referrer ID
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                coins = data.coins;
                coinsNumberElement.textContent = coins;
    
                // Check if the user is new and if a referrer ID exists
                if (data.is_new_user && referrerId) {
                    // Handle referral confirmation logic (if any)
                    console.log('Referral registered for referrer ID:', referrerId);
                }
            } else {
                console.error('Error authenticating:', data.message);
            }
        })
        .catch(error => console.error('Error:', error));
        
         // Energy regeneration every half second
        setInterval(() => {
            if (energyValue < 500) {
                energyValue += 1; // Regenerate 1 point every half second
                if (energyValue > 500) energyValue = 500; // Cap at 500
                energyDisplay.textContent = `${energyValue}/500`;
            }
        }, 500); // Half-second interval

        // Function to update coin count
        function incrementCoins(touchPoints) {
            let increment = touchPoints * (isBoostActive ? 5 : 3); // Use 5 if boost is active, otherwise 3
            
            if (energyValue > 0) {
                coins = parseInt(coins, 10); // Convert coins to an integer
                coins += increment;
                energyValue -= increment;
                if (energyValue < 0) energyValue = 0;
                coinsNumberElement.textContent = coins;
                energyDisplay.textContent = `${energyValue}/500`;

                // Update backend with new coin value
                updateCoinsOnServer(telegramID, coins);
            } else {
                console.log("Energy is depleted, no coins can be incremented.");
            }
        }

        // Function to handle the boost button click
        boostButton.addEventListener('click', () => {
            console.log('Boost button clicked'); // Debug log

            if (!boostButton.disabled) {
                activateBoost();
            }
        });

        // Function to activate the boost
        function activateBoost() {
            console.log('Boost activated'); // Debug log

            isBoostActive = true;
            boostButton.disabled = true;
            boostButton.textContent = 'Boost Active: +5';

            // Update the boost data on the server
            updateBoostOnServer(telegramID, boostDuration);

            // Set a timer to disable the boost after 5 minutes
            setTimeout(() => {
                isBoostActive = false;
                boostButton.textContent = 'Boost: +5';
                console.log("Boost expired.");
            }, boostDuration);

            // Set cooldown timer for 12 hours to re-enable the button
            setTimeout(() => {
                boostButton.disabled = false;
                console.log("Boost available again.");
            }, boostCooldown);
        }

        // Function to show the coin increment animation
        function showCoinIncrement(x, y, touchPoints) {
            if (energyValue <= 0) {
                return;
            }

            const incrementValue = isBoostActive ? '+5' : '+3';

            for (let i = 0; i < touchPoints; i++) {
                const incrementDiv = document.createElement('div');
                incrementDiv.textContent = incrementValue;
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
                incrementCoins(touchPoints);
                showCoinIncrement(x, y, touchPoints);

                setTimeout(() => avatarImage.classList.remove('zoom-avatar'), 300);
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

        // Fetch boost data from the backend
        function getBoostData(telegramID) {
            return fetch('https://gope360.com/whale/get_boost_data.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ telegram_id: telegramID })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    isBoostActive = data.is_boost_active; // Set boost active status
                    if (isBoostActive) {
                        boostButton.disabled = true;
                        boostButton.textContent = 'Boost Active: +5'; // Update button text
                    }
                } else {
                    console.error('Error fetching boost data:', data.message);
                }
            })
            .catch(error => {
                console.error('Error fetching boost data:', error);
            });
        }

        // Update coin data on the server
        function updateCoinsOnServer(telegramID, coins) {
            fetch('https://gope360.com/whale/update_coin_data.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    telegram_id: telegramID,
                    coins: coins
                })
            })
            .then(response => response.json())
            .then(data => console.log('Coins updated on server:', data))
            .catch(error => console.error('Error updating coins:', error));
        }

        // Function to update boost data on the server
        function updateBoostOnServer(telegramID, boostDuration) {
            fetch('https://gope360.com/whale/update_boost_data.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    telegram_id: telegramID,
                    boost_time: new Date().toISOString(), // Send current time as boost activation time
                    boost_duration: boostDuration
                })
            })
            .then(response => response.json())
            .then(data => console.log('Boost updated on server:', data))
            .catch(error => console.error('Error updating boost:', error));
        }

        // Initialize boost and coin data
        getBoostData(telegramID);
    } else {
        console.error('No user data available from Telegram Web App.');
    }
});

</script>

  
    <script src="./assets/js/coin-home..js"></script>

    
</body>
</html>