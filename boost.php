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
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background-color: #2e3b5b;
            background-size: cover;
            color: rgb(206, 201, 201);
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
        
        /* Top Menu Tabs */
        .tabs {
            display: flex;
            justify-content: space-around;
            margin-top: 100px;
            background-color: #3d4c70;
            /* padding: 10px 0; */
        }

        .tab {
            background-color: #3d4c70;
            padding: 10px 33px;
            border-radius: 5px;
            cursor: pointer;
            color: rgb(206, 201, 201);
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .tab.active {
            background-color: #a5aa5b;
        }

        /* Bottom Navigation */
        .fixed-bottom {
            background-color: rgba(29, 75, 114, 0.55);
            color: rgb(206, 201, 201);
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
            color: rgb(206, 201, 201) !important;
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
        
        .main {
            padding-top: 75px;
        }

        /* Skill Cards */
        .skill-card {
            background-color: #3d4c70;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 10px;
            display: flex;
            /* justify-content: space-between; */
            /* align-items: center; */
            max-height: 70px; transition: background-color 0.3s ease; /* Smooth transition */
        }

        .skill-card:hover {
            background-color: #818fbe; /* Change this to any hover color */
        }
        .skill-card img {
            width: 75px;
            height: 65px;
            object-fit: cover; /* Ensure the image fits within the div without distortion */
            margin-right: 10px;
            border-radius: 5px; /* Optional: if you want the images to have slightly rounded corners */
        }


        .skill-card p {
            margin: 0;
        }
        

        /* Main content */
        .main-content {
            margin-top: 30px; /* Adjusted to account for the new tabs */
            padding: 0 15px;
        }

        /* Hide sections initially */
        .tab-content {
            display: none;
        }

        /* Show active section */
        .tab-content.active {
            display: block;
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
    
    <div class="px-3 main">
        <!-- Tabs Section -->
        <div class="tabs">
            <div class="tab active" id="personal-tab">Personal</div>
            <div class="tab" id="office-tab">Office</div>
            <div class="tab" id="mining-tab">Mining</div>
        </div>
    
        <!-- Main Content -->
        <div class="main-content">
            <!-- Personal Tab Content -->
            <div class="tab-content active" id="personal-content">
                <h4>Personal</h4>
                <!-- Skill Card: Sport -->
                <div class="skill-card mx-0 px-0 d-flex align-items-center">
                    <img class="img-fluid" src="./assets/sport.jpg" alt="Sport Icon"> <!-- Replace with actual sport icon -->
                    <div>
                        <p>Sport</p>
                        <p><i class="fa text-warning fa-bolt pe-2"></i><small>+100 Boost</small></p>
                    </div>
                    <div class="mx-4">
                        <p><i class="fa text-info fa-coins pe-2"></i>500 Coins</p>
                    </div>
                </div>
    
                <!-- Skill Card: Nutrition -->
                <div class="skill-card d-flex align-items-center mx-0 px-0">
                    <img class="img-fluid" src="./assets/nutrition.jpeg" alt="Nutrition Icon"> <!-- Replace with actual nutrition icon -->
                    <div class="p1">
                        <p>Nutrition</p>
                        <p><small><i class="fa text-warning fa-bolt pe-2"></i>+125 Boost</small></p>
                    </div>
                    <div class="mx-4">
                        <p><i class="fa text-info fa-coins pe-2"></i>800 Coins</p>
                    </div>
                </div>
    
                <!-- Skill Card: Sleep -->
                <div class="skill-card d-flex align-items-center mx-0 px-0">
                    <img class="img-fluid" src="./assets/sleep.jpeg" alt="Sleep Icon"> <!-- Replace with actual sleep icon -->
                    <div>
                        <p>Sleep</p>
                        <p><small><i class="fa text-warning fa-bolt pe-2"></i>+650 Boost</small></p>
                    </div>
                    <div class="mx-4">
                        <p><i class="fa text-info fa-coins pe-2"></i>4,000 Coins</p>
                    </div>
                </div>
    
                <!-- Skill Card: Brain -->
                <div class="skill-card d-flex align-items-center mx-0 px-0">
                    <img class="img-fluid" src="./assets/brain.jpeg" alt="Brain Icon"> <!-- Replace with actual brain icon -->
                    <div>
                        <p>Brain</p>
                        <p><small><i class="fa text-warning fa-bolt pe-2"></i>+2,500 Boost</small></p>
                    </div>
                    <div class="mx-4">
                        <p><i class="fa text-info fa-coins pe-2"></i>15,000 Coins</p>
                    </div>
                </div>
            </div>
    
            <!-- Office Tab Content -->
            <div class="tab-content" id="office-content">
                <h4>Office</h4>
                <!-- Office Content Goes Here -->
                <!-- Skill Card: Sport -->
                <div class="skill-card mx-0 px-0 d-flex align-items-center">
                    <img class="img-fluid" src="./assets/sport.jpg" alt="Sport Icon"> <!-- Replace with actual sport icon -->
                    <div class="p1">
                        <p>Sport</p>
                        <p><small><i class="fa text-warning fa-bolt pe-2"></i>+100 Boost</small></p>
                    </div>
                    <div class="mx-4">
                        <p><i class="fa text-info fa-coins pe-2"></i>500 Coins</p>
                    </div>
                </div>
    
                <!-- Skill Card: Sleep -->
                <div class="skill-card d-flex align-items-center mx-0 px-0">
                    <img class="img-fluid" src="./assets/sleep.jpeg" alt="Sleep Icon"> <!-- Replace with actual sleep icon -->
                    <div>
                        <p>Sleep</p>
                        <p><small><i class="fa text-warning fa-bolt pe-2"></i>+650 Boost</small></p>
                    </div>
                    <div class="mx-4">
                        <p><i class="fa text-info fa-coins pe-2"></i>4,000 Coins</p>
                    </div>
                </div>
    
                <!-- Skill Card: Nutrition -->
                <div class="skill-card d-flex align-items-center mx-0 px-0">
                    <img class="img-fluid" src="./assets/nutrition.jpeg" alt="Nutrition Icon"> <!-- Replace with actual nutrition icon -->
                    <div>
                        <p>Nutrition</p>
                        <p><small><i class="fa text-warning fa-bolt pe-2"></i>+125 Boost</small></p>
                    </div>
                    <div class="mx-4">
                        <p><i class="fa text-info fa-coins pe-2"></i>800 Coins</p>
                    </div>
                </div>
    
                <!-- Skill Card: Brain -->
                <div class="skill-card d-flex align-items-center mx-0 px-0">
                    <img class="img-fluid" src="./assets/brain.jpeg" alt="Brain Icon"> <!-- Replace with actual brain icon -->
                    <div>
                        <p>Brain</p>
                        <p><small><i class="fa text-warning fa-bolt pe-2"></i>+2,500 Boost</small></p>
                    </div>
                    <div class="mx-4">
                        <p><i class="fa text-info fa-coins pe-2"></i>15,000 Coins</p>
                    </div>
                </div>
            </div>
    
            <!-- Mining Tab Content -->
            <div class="tab-content" id="mining-content">
                <h4>Mining</h4>
                <!-- Mining Content Goes Here -->
                <!-- Skill Card: Sport -->
                <div class="skill-card mx-0 px-0 d-flex align-items-center">
                    <img class="img-fluid" src="./assets/sport.jpg" alt="Sport Icon"> <!-- Replace with actual sport icon -->
                    <div class="p1">
                        <p>Sport</p>
                        <p><small><i class="fa text-warning fa-bolt pe-2"></i>+100 Boost</small></p>
                    </div>
                    <div class="mx-4">
                        <p><i class="fa text-info fa-coins pe-2"></i>500 Coins</p>
                    </div>
                </div>
    
                <!-- Skill Card: Nutrition -->
                <div class="skill-card d-flex align-items-center mx-0 px-0">
                    <img class="img-fluid" src="./assets/nutrition.jpeg" alt="Nutrition Icon"> <!-- Replace with actual nutrition icon -->
                    <div>
                        <p>Nutrition</p>
                        <p><small><i class="fa text-warning fa-bolt pe-2"></i>+125 Boost</small></p>
                    </div>
                    <div class="mx-4">
                        <p><i class="fa text-info fa-coins pe-2"></i>800 Coins</p>
                    </div>
                </div>
    
                <!-- Skill Card: Brain -->
                <div class="skill-card d-flex align-items-center mx-0 px-0">
                    <img class="img-fluid" src="./assets/brain.jpeg" alt="Brain Icon"> <!-- Replace with actual brain icon -->
                    <div>
                        <p>Brain</p>
                        <p><small><i class="fa text-warning fa-bolt pe-2"></i>+2,500 Boost</small></p>
                    </div>
                    <div class="mx-4">
                        <p><i class="fa text-info fa-coins pe-2"></i>15,000 Coins</p>
                    </div>
                </div>
    
                <!-- Skill Card: Sleep -->
                <div class="skill-card d-flex align-items-center mx-0 px-0">
                    <img class="img-fluid" src="./assets/sleep.jpeg" alt="Sleep Icon"> <!-- Replace with actual sleep icon -->
                    <div>
                        <p>Sleep</p>
                        <p><small><i class="fa text-warning fa-bolt pe-2"></i>+650 Boost</small></p>
                    </div>
                    <div class="mx-4">
                        <p><i class="fa text-info fa-coins pe-2"></i>4,000 Coins</p>
                    </div>
                </div>
            </div>
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

    <!-- JavaScript for Tab Functionality -->
    <script>
        function goBack() {
            window.history.back(); // Takes the user to the previous page
        }
        
        // Get all tab buttons and content
        const tabs = document.querySelectorAll('.tab');
        const contents = document.querySelectorAll('.tab-content');

        // Loop through each tab and add click event listener
        tabs.forEach((tab, index) => {
            tab.addEventListener('click', () => {
                // Remove active class from all tabs and content
                tabs.forEach(t => t.classList.remove('active'));
                contents.forEach(c => c.classList.remove('active'));

                // Add active class to the clicked tab and corresponding content
                tab.classList.add('active');
                contents[index].classList.add('active');
            });
        });
    </script>
</body>
</html>
