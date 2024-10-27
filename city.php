<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Interface</title>
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.0.0/mdb.min.css" rel="stylesheet"/>
    
    <!-- Custom CSS -->
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background: url('./assets/background.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Arial', sans-serif;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
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
        

        .menu-icon i {
            color: white;
            font-size: 24px;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            position: relative;
            /* margin-top: 100px; Adjust for top bar */
        }

        /* Add background images for all circle buttons */
        .circle-button {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2px solid white;
            position: absolute;
            text-align: center;
            background-size: cover; /* Ensures the background image covers the button */
            background-position: center; /* Centers the background image */
        }
        

        /* Set individual background images for each button */
        .circle-button:nth-child(1) {
            top: 20%;
            left: 10%;
            background-image: url('invest.jpg');
        }

        .circle-button:nth-child(2) {
            top: 40%;
            left: 70%;
            background-image: url('store.jpg');
        }

        .circle-button:nth-child(3) {
            top: 60%;
            left: 20%;
            background-image: url('nft.jpeg');
        }

        .circle-button:nth-child(4) {
            top: 30%;
            left: 50%;
            background-image: url('hyper.jpg');
        }

        .circle-button:nth-child(5) {
            top: 80%;
            left: 60%;
            background-image: url('box.jpeg');
        }

        .circle-button:nth-child(6) {
            top: 50%;
            left: 80%;
            background-image: url('community.jpeg');
        }

        .circle-button p {
            margin: 0;
            font-size: 0.61em;
            color: #ffffff;
            border-radius: 1px solid black;
        }

        .circle-button i {
            font-size: 1.2em;
        }

        .padlock-icon {
            position: absolute;
            font-size: 40px;
            color: white;
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


    <!-- Main Content (Buttons Section) -->
    <div class="main-content">
        <div class="circle-button">
            <p>Investments<br>(Lv.3)</p>
            <i class="fas fa-lock padlock-icon"></i> <!-- Padlock icon -->
        </div>
        <div class="circle-button">
            <p>Premium Store<br>(Lv.3)</p>
            <!-- No padlock icon here -->
        </div>
        <div class="circle-button">
            <p>Trade NFT<br>(Lv.5)</p>
            <i class="fas fa-lock padlock-icon"></i> <!-- Padlock icon -->
        </div>
        
        <div class="circle-button">
            <p>Hype Zone<br>(Lv.3)</p>
            <i class="fas fa-lock padlock-icon"></i> <!-- Padlock icon -->
        </div>
        <div class="circle-button">
            <p>Lucky Box<br>(Lv.3)</p>
            <i class="fas fa-lock padlock-icon"></i> <!-- Padlock icon -->
        </div>
        <div class="circle-button">
            <p>Communities<br>(Lv.3)</p>
            <i class="fas fa-lock padlock-icon"></i> <!-- Padlock icon -->
        </div>
    </div>

    <!-- Bottom Navigation -->
    <nav class="navbar navbar-dark fixed-bottom py-0">
        <ul class="nav justify-content-around w-100">
            <li class="nav-item text-center" style="flex: 1;">
                <a class="nav-link text-white" href="./boost.php">
                    <i class="fas fa-bolt"></i>
                    <div>Boost</div>
                </a>
            </li>
            <li class="nav-item text-center" style="flex: 1;">
                <a class="nav-link text-white" href="./city.php">
                    <i class="fas fa-city"></i>
                    <div>City</div>
                </a>
            </li>
            <li class="nav-item text-center" style="flex: 1; position: relative;">
                <a class="nav-link text-warning active" href="./index.php">
                    <img src="./assets/avatar2.jpeg" alt="Mining Avatar" class="nav-image rounded-circle" style="width: 70px; height: 70px;">
                    <i class="fas fa-pickaxe"></i>
                    <div>Mining</div>
                </a>
            </li>
            <li class="nav-item text-center" style="flex: 1;">
                <a class="nav-link text-white" href="./quest.php">
                    <i class="fas fa-users"></i>
                    <div>Friends</div>
                </a>
            </li>
            <li class="nav-item text-center" style="flex: 1;">
                <a class="nav-link text-white" href="quest.php">
                    <i class="fas fa-scroll"></i>
                    <div>Quests</div>
                </a>
            </li>
        </ul>
    </nav>

    <!-- MDB -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.0.0/mdb.umd.min.js"></script>
    
    <script>
        function goBack() {
            window.history.back(); // Takes the user to the previous page
        }
        
    </script>
</body>
</html>
