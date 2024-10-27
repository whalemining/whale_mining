<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Earn More Coins - Whale</title>
    <!-- Font Awesome -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
    />
    <!-- MDB -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.0.0/mdb.min.css"
    rel="stylesheet"
    />
    
    <!-- Telegram Web App Script -->
    <script src="https://telegram.org/js/telegram-web-app.js"></script>
    
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background-color: #2e3b5b;
            background-size: cover;
            color: #ffffff;
            font-family: 'Arial', sans-serif;
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
        
        /* Top Bar Styling */
        .top-bar2 {
            background: linear-gradient(90deg, rgba(3, 107, 197, 0.7)  0%, #a5aa5b 100%);
            padding: 10px 20px;
            margin-top: 35px; 
            /*position: fixed;*/
            top: 0;
            /*width: 100%;*/
            z-index: 100;
            color: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            margin-bottom: 25%;
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
        
        .popup-message {
            color: #5e2121; /* Oxblood color */
            font-weight: bold;
            margin-bottom: 10px; /* Space between popup and button */
            display: none; /* Initially hidden */
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

        /* Avatar Section */
        .avatar-small {
            border-radius: 50%;
            width: 50px;
            height: 50px;
            border: 1px solid #a5aa5b;
            padding: 2px;
        }
        
        
        /*.main {*/
        /*    display: flex;*/
        /*    flex-direction: column;*/
        /*    justify-content: center;*/
        /*    align-items: center;*/
        /*    height: calc(100vh - 300px);*/
        /*    margin-top: 35%;*/
        /*    padding-bottom: 75%;*/
        /*    position: relative;*/
        /*}*/


        .days-left {
            font-weight: bold;
            color: #ff4c91;
            margin: 10px 0;
        }
        /* Bottom Navigation */
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
        
        .reward-section {
            /*background: #3d4c70;*/
        }

        .reward-section img {
            max-width: 40px;
        }
        .quest-item {
            background-color: #3d4c70;
            padding: 15px;
            border-radius: 10px;
            /* margin-bottom: 10px; */
            max-height: 80px;
            border: #2e3b5b solid;
        }

        /*.quest-item:hover {*/
        /*    background-color: rgb(10, 10, 10, 0.7);*/
        /*}*/
        .quest-item img {
            width: 60px;
            height: 50px;
            margin-right: 10px;
        }

        /* Centered Earn More Coins section */
        .earn-more-coins {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
            margin-top: 120px; /* Adjust as needed */
        }

        /* Ensure proper padding for mobile */
        .reward-section,
        .quest-item {
            padding: 15px;
        }
        /* Styling for the "Go Back" button */
        .go-back-btn {
            background: transparent;
            border: none;
            cursor: pointer;
            color: #fff; /* Ensures the color matches the theme */
            font-size: 1.5rem; /* Adjust size for better visibility */
            transition: color 0.3s ease;
            outline: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .go-back-btn:hover {
            color: #f39c12; /* Highlight color on hover for a stylish effect */
        }
        
        .go-back-btn i {
            font-size: 1.5rem;
            color: #ffffff; /* Icon color */
        }

  </style>
</head>
<body>

    <div class="top-bar d-flex justify-content-between align-items-center px-3">
        <div class="left-section d-flex align-items-center">
            <!-- Go Back Icon -->
            <button onclick="goBack()" class="go-back-btn">
                <i class="fas fa-arrow-left"></i>
            </button>
            <div class="profit-section ms-2 d-flex align-items-center">
                <i class="fas fa-gem"></i>
                <span class="profit-value ms-1">+3</span>
                <i class="fas fa-info-circle ms-1"></i>
            </div>
        </div>
    
        <div class="right-section d-flex align-items-center">
            <button class="memories-btn d-flex align-items-center">
                <i class="fas fa-coins"></i> 
                <span class="ms-1">1,000,000 = $10</span>
            </button>
        </div>
    </div>
    
    <div class="main">
        <!-- Earn More Coins Section -->
        <div class="earn-more-coins text-center">
            <h2>Earn More Coins</h2>
        </div>
    
        <!-- Daily Reward Section -->
        <div class="reward-section rounded-5 text-dark d-flex justify-content-between align-items-center mx-3 p-4" style="max-height: 100px; background: #a5aa5b;">
            <div>
                <p class="m-0 pt-4"><strong>Daily Reward</strong></p>
                <p>Hurry up and get it</p>
                <p class="mb-4"><strong id="countdown-timer">03:20:09</strong></p>
            </div>
            <button class="btn" id="incrementButton2">Claim</button>
        </div>
        
            <!-- Quests To Do Section -->
        <div class="mx-3">
            <h5 class="mt-5 mb-4">Todo List</h5>
        
            <!-- Join Telegram Channel Quest -->
            <div id="joinTelegramQuest" class="quest-item d-flex align-items-center" style="cursor:pointer;">
                <img class="rounded-3" src="./assets/telegram.png" alt="Telegram Channel">
                <div>
                    <p class="m-0">Join Our Telegram Channel</p>
                    <p class="m-0"><strong>+50,000</strong></p>
                </div>
                <button class="btn bg-info text-white" id="joinButton1">Join</button>
                <button class="btn bg-warning text-white" id="claimButton1" style="display:none;">Claim</button>
            </div>
        
            <!-- Watch YouTube Video Quest -->
            <div id="watchYoutubeQuest" class="quest-item d-flex align-items-center" style="cursor:pointer;">
                <img class="rounded-3" src="./assets/youtube.png" alt="YouTube Video">
                <div>
                    <p class="m-0">Watch YouTube Video</p>
                    <p class="m-0"><strong>+50,000</strong></p>
                </div>
                <button class="btn bg-info text-white" id="watchButton2">Watch</button>
                <button class="btn bg-warning text-white" id="claimButton2" style="display:none;">Claim</button>
            </div>
        
            <!-- Join Community and Retweet Quest -->
            <div id="joinCommunityQuest" class="quest-item d-flex align-items-center" style="cursor:pointer;">
                <img class="rounded-3" src="./assets/x-logo.png" alt="Community Retweet">
                <div>
                    <p class="m-0">Join our community and retweet</p>
                    <p class="m-0"><strong>+28,000</strong></p>
                </div>
                <button class="btn bg-info text-white" id="joinButton3">Join</button>
                <button class="btn bg-warning text-white" id="claimButton3" style="display:none;">Claim</button>
            </div>
        </div>


        <!-- Quests To Do Section -->
        <div class="mx-3">
            <h5 class="mt-5 mb-4">More Tasks</h5>
    
            <a href="./referal.php">
                <div class="quest-item text-white d-flex align-items-center">
                    <img class="rounded-3" src="./assets/refer.png" alt="TON Wallet">
                    <div>
                        <p class="m-0">Invite 3 friends</p>
                        <p class="m-0"><strong>+30,000</strong></p>
                    </div>
                    <i class="fas fa-chevron-right ms-auto"></i>
                </div>
            </a>
            <a href="./referal.php">
                <div class="quest-item text-white d-flex align-items-center">
                    <img class="rounded-3" src="./assets/refer.png" alt="TON Transaction">
                    <div>
                        <p class="m-0">Invite 6 friends</p>
                        <p class="m-0"><strong>+60,000</strong></p>
                    </div>
                    <i class="fas fa-chevron-right ms-auto"></i>
                </div>
            </a>
    
            <a href="./referal.php">
                <div class="quest-item text-white d-flex align-items-center">
                    <img class="rounded-3" src="./assets/refer.png" alt="Improve Profit per Tap">
                    <div>
                        <p class="m-0">Invite 9 friends</p>
                        <p class="m-0"><strong>+90,000</strong></p>
                    </div>
                    <i class="fas fa-chevron-right ms-auto"></i>
                </div>            
            </a>
            <!--<div class="quest-item d-flex align-items-center">-->
            <!--    <img class="rounded-3" src="./assets/sport.jpeg" alt="Improve Sport">-->
            <!--    <div>-->
            <!--        <p class="m-0">Improve Sport</p>-->
            <!--        <p class="m-0"><strong>+18,000</strong></p>-->
            <!--    </div>-->
            <!--    <i class="fas fa-chevron-right ms-auto"></i>-->
            <!--</div>-->
    
            <a href="./referal.php">
                <div class="quest-item text-white d-flex align-items-center">
                    <img class="rounded-3" src="./assets/refer.png" alt="Join TG Channel">
                    <div>
                        <p class="m-0">Invite 12 friends</p>
                        <p class="m-0"><strong>+120,000</strong></p>
                    </div>
                    <i class="fas fa-chevron-right ms-auto"></i>
                </div>
            </a>
        </div>
        
        <!--<div class="days-left text-center">Lunching soon...</div>-->
        
        <!--<a href="./claim-reward.html">-->
            <div class="top-bar2 mx-4 rounded-6 py-2 d-flex justify-content-center align-items-center px-1">
                <div class="left-section d-flex align-items-center">
                    <div class="profit-section2 py-3 d-flex align-items-center">
                        <span style="font-size: 1.2em; color: white;" class="profit-value text-center" id="incrementButton" onclick="handleClaimClick()">Claim total mined coins now</span>
                    </div>
                </div>
            </div>


        <!--</a>-->
        
            <!--<div class="right-section d-flex align-items-center">-->
            <!--    <button class="memories-btn d-flex align-items-center">-->
            <!--        <i class="fas fa-coins"></i>
            <!--        <span class="coin-number ms-1"></span>-->
            <!--    </button>-->
            <!--</div>-->
        </div>
    </div>

    <!-- Bottom Navigation -->
    <nav class="navbar navbar-dark fixed-bottom py-0">
        <ul class="nav justify-content-around w-100">
            <li class="nav-item text-center" style="flex: 1;">
                <a class="nav-link text-white" href="./boost.php"><i class="fas fa-bolt"></i><div>Boost</div></a>
            </li>
            <li class="nav-item text-center" style="flex: 1;">
                <a class="nav-link text-white" href="./city.php"><i class="fas fa-city"></i><div>City</div></a>
            </li>
            <li class="nav-item text-center" style="flex: 1; position: relative;">
                <a class="nav-link text-warning active" href="./index.php">
                    <img src="./assets/avatar2.jpeg" alt="Mining Avatar" class="nav-image rounded-circle" style="width: 70px; height: 70px;">
                    <i class="fas fa-pickaxe"></i><div>Mining</div>
                </a>
            </li>
            <li class="nav-item text-center" style="flex: 1;">
                <a class="nav-link text-white" href="./referal.php"><i class="fas fa-users"></i><div>Friends</div></a>
            </li>
            <li class="nav-item text-center" style="flex: 1;">
                <a class="nav-link text-white" href="./quest.php"><i class="fas fa-scroll"></i><div>Quests</div></a>
            </li>
        </ul>
    </nav>
    
    <!-- MDB -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.0.0/mdb.umd.min.js"></script>
    <script>


        function goBack() {
            window.history.back(); // Takes the user to the previous page
        }
        
       document.addEventListener("DOMContentLoaded", function() {
        const joinButton1 = document.getElementById("joinButton1");
        const watchButton2 = document.getElementById("watchButton2");
        const retweetButton3 = document.getElementById("retweetButton3");
        
        const claimButton1 = document.getElementById("claimButton1");
        const claimButton2 = document.getElementById("claimButton2");
        const claimButton3 = document.getElementById("claimButton3");
    
        checkTaskCompletion();
    
        joinButton1.addEventListener("click", function() {
            window.open("https://t.me/your_channel_link", "_blank");
            joinButton1.style.display = "none";
            setTimeout(() => {
                claimButton1.style.display = "inline-block";
            }, 2000);
        });
    
        watchButton2.addEventListener("click", function() {
            window.open("https://youtube.com/your_video_link", "_blank");
            watchButton2.style.display = "none";
            setTimeout(() => {
                claimButton2.style.display = "inline-block";
            }, 2000);
        });
    
        retweetButton3.addEventListener("click", function() {
            window.open("https://twitter.com/your_retweet_link", "_blank");
            retweetButton3.style.display = "none";
            setTimeout(() => {
                claimButton3.style.display = "inline-block";
            }, 2000);
        });
    
        claimButton1.addEventListener("click", function() {
            claimCoins("join_telegram", 50000, claimButton1, joinButton1);
        });
    
        claimButton2.addEventListener("click", function() {
            claimCoins("watch_youtube", 50000, claimButton2, watchButton2);
        });
    
        claimButton3.addEventListener("click", function() {
            claimCoins("retweet_community", 28000, claimButton3, retweetButton3);
        });
    
        function claimCoins(task_name, reward, button, joinWatchButton) {
            const telegram_id = "<?php echo $_SESSION['telegram_id']; ?>"; // Use actual Telegram ID
        
            fetch('update_coins.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    telegram_id: telegram_id,
                    task_name: task_name,
                    reward: reward
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    button.setAttribute("disabled", true);
                    joinWatchButton.style.display = "none";
                    alert("You have claimed your coins!");
                } else {
                    alert(data.message); // If the task was already completed, notify the user
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    
        function checkTaskCompletion() {
            const telegram_id = "<?php echo $_SESSION['telegram_id']; ?>";
    
            fetch('check_completion.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ telegram_id: telegram_id })
            })
            .then(response => response.json())
            .then(data => {
                if (data.telegramTaskCompleted) {
                    joinButton1.style.display = "none";
                    claimButton1.style.display = "inline-block";
                    claimButton1.setAttribute("disabled", true);
                }
                if (data.youtubeTaskCompleted) {
                    watchButton2.style.display = "none";
                    claimButton2.style.display = "inline-block";
                    claimButton2.setAttribute("disabled", true);
                }
                if (data.communityTaskCompleted) {
                    retweetButton3.style.display = "none";
                    claimButton3.style.display = "inline-block";
                    claimButton3.setAttribute("disabled", true);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    });
    
    function handleClaimClick() {
        // Change the button text to "Launching soon..." with an emoji
        const button = document.getElementById('incrementButton');
        button.innerHTML = "🚀 Launching soon..."; // Add an emoji or icon here
    
        // Disable the button
        button.disabled = true;
    }

    </script>
    <script src="./assets/js/coin-home.js"></script>
    
</body>
</html>
