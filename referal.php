<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Referral Page</title>
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
    <script src="https://telegram.org/js/telegram-web-app.js"></script>  <style>
    body {
        margin: 0;
        padding: 0;
        height: 100vh;
        background-color: #2e3b5b; /* Dark blue background */
        background-size: cover;
        color: #ffffff; /* White text color */
        font-family: 'Arial', sans-serif;
        display: flex;
        flex-direction: column;
    }


    .container {
      padding: 20px;
    }

    .header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px;
    }

    .header h1 {
      font-size: 18px;
      margin-left: 10px;
    }

    .header i {
      font-size: 18px;
    }/* Top Bar Styling */
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
    

    /* Main Content */
    .content {
      text-align: center;
      margin-top: 75px;
    }

    .content h2 {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .content p {
      font-size: 14px;
      color: #bbb;
      margin-bottom: 30px;
    }

    /* Referral Options */
    .referral-options {
      background-color: #161b22;
      border-radius: 10px;
      /*padding: 20px;*/
      margin-bottom: 20px;
    }

    .referral-options img {
        float: left;
        margin-right: 10px;
        width: 75px;
        height: auto;
        object-fit: cover; /* Ensure the image fits within the div without distortion */
        border-radius: 5px;
    }

    .referral-options h3 {
      font-size: 16px;
      margin: 0;
    }

    .referral-options p {
      color: #6c6c6c;
      margin: 5px 0;
    }

    .referral-options .bonus {
      color: #42b983;
      font-weight: bold;
    }

    .already-referred {
      text-align: center;
      font-size: 10px;
      margin-top: 20px;
    }

    .already-referred a {
      color: #42b983;
      font-weight: bold;
    }
    
    .already-referred span {
      color: yellow;
      font-weight: bold;
    }

    /* Friends List */
    .friends-list {
      margin-top: 20px;
      text-align: center;
      font-size: 16px;
    }

    .friends-list .empty-state {
      margin-top: 20px;
      color: #444;
      font-size: 14px;
    }

    /* Invite Button */
    .invite-button {
      display: block;
      background-color: rgba(3, 107, 197, 0.7);
      color: #fff;
      font-size: 18px;
      font-weight: bold;
      text-align: center;
      padding: 15px;
      border-radius: 8px;
      margin: 20px 20px 0 20px;
      text-decoration: none;
    }

    .invite-button i {
      margin-left: 10px;
    }
    
    /* Align invite button and copy button side by side */
    .button-group {
        margin-top: 20px; /* Adjust margin for spacing */
    }
    
    .invite-button {
        flex: 1;
        text-align: center;
    }
    
    /* Remove padding-right from success message */
    #copySuccess {
        position: fixed;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        z-index: 2000; /* Ensures it's above other elements */
        max-width: 300px; /* Adjust width as needed */
        padding-right: 0;
        display: none; /* Initially hidden */
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
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
    
      <!-- Main Content -->
      <div class="container">
        <div class="content">
          <h2>Invite Friends!</h2>
          <p>You and your friend will receive bonuses</p>
        </div>
    
        <!-- Referral Options -->
        <div class="referral-options">
          <img class="img-fluid m-2" src="./assets/refer.png" alt="Gift icon">
          <div class="p-3">
            <h3>Invite a friend</h3>
            <p><span class="bonus">+500</span> coins for you and your friend</p>
          </div>
        </div>
        
        <!-- Referral Option 2 -->
        <div class="referral-options">
          <img class="img-fluid m-2" src="./assets/refer.png" alt="Gift icon">
          <div class="p-3">
            <h3>Invite a friend with Telegram Premium</h3>
            <p><span class="bonus">+1,000</span> coins for you and your friend</p>
          </div>
        </div>
    
        <!-- Display referral link after registration -->
        <div class="already-referred text-center my-3">
          <p id="referralLinkMessage" style="display:none;">Share your referral link: <a id="referralLink" href="#"></a></p>
        </div>
    
        <!-- Friends List -->
        <div class="friends-list">
          <h3>List of your friends</h3>
          <p class="empty-state">You haven't invited anyone yet</p>
        </div>
        
         <!-- Success Message (hidden by default, now at the top of the page) -->
        <div id="copySuccess" class="alert alert-success mt-3 p-2 text-center" role="alert" style="display: none; background-color: #002a00; color: #00c851; border-radius: 5px; padding-right: 0;">
            <i class="fas fa-check-circle me-2" style="color: #00c851;"></i> Copied
        </div>
    
        <!-- Invite Button -->
       <div class="button-group d-flex justify-content-center">
  <a href="#" class="invite-button mx-0" id="inviteButton">Invite a friend</a>
  <a href="#" class="invite-button ms-1 mx-0 w-50" id="copyButton"><i class="fas fa-copy"></i></a>
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
    
    <!-- Custom JS -->

       <script>
        function goBack() {
            window.history.back(); // Takes the user to the previous page
        }
        document.addEventListener("DOMContentLoaded", () => {
                const telegram = window.Telegram.WebApp;
                const user = telegram.initDataUnsafe?.user;
            
                // Ensure user is authenticated
                if (!user) {
                    document.body.innerHTML = '<h1>Unable to authenticate user. Please log in with Telegram.</h1>';
                    return;
                }
            
                // Wait for the DOM elements to load
                const inviteButton = document.getElementById("inviteButton");
                const copyButton = document.getElementById("copyButton");
                const copySuccess = document.getElementById("copySuccess");
            
                // Ensure buttons exist before proceeding
                if (!inviteButton || !copyButton) {
                    console.error("Buttons are not available in the DOM");
                    return;
                }
            
                let referralLink = ''; // This will store the referral link from the backend
                const referrerId = window.referrerId || null; // Replace with actual referrer ID logic
            
                // Authenticate user and get referral link from backend
                fetch('https://gope360.com/whale/telegram_auth.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        telegram_id: user.id,
                        username: user.username || 'Anonymous',
                        first_name: user.first_name || '',
                        last_name: user.last_name || '',
                        referrer_id: referrerId
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.status === 'success') {
                        referralLink = data.referral_link;
            
                        // Check if referralLink is correctly assigned
                        if (!referralLink) {
                            console.error('Referral link is missing or invalid.');
                            return;
                        }
            
                        // Invite Button Functionality
                        inviteButton.addEventListener("click", (event) => {
                            event.preventDefault();
                            const forwardLink = `https://t.me/share/url?url=${encodeURIComponent(referralLink)}&text=${encodeURIComponent("Join using my referral!")}`;
                            telegram.openTelegramLink(forwardLink); // Open Telegram link with referral
                            console.log("Invite button clicked! Referral link opened in Telegram.");
                        });
            
                        // Copy Button Functionality
                        copyButton.addEventListener("click", (event) => {
                            event.preventDefault();
                            copyToClipboard(referralLink);
                        });
            
                    } else {
                        console.error('Error fetching referral link:', data.message);
                    }
                })
                .catch(error => {
                    console.error('Error fetching data from backend:', error);
                });
            });
            
            // Copy to Clipboard Function
            function copyToClipboard(text) {
                if (navigator.clipboard) {
                    navigator.clipboard.writeText(text)
                        .then(() => {
                            console.log('Referral link copied to clipboard:', text);
                            showCopySuccess();
                        })
                        .catch(err => {
                            console.error('Failed to copy: ', err);
                        });
                } else {
                    // Fallback for browsers that don't support navigator.clipboard
                    const tempInput = document.createElement("input");
                    tempInput.value = text;
                    document.body.appendChild(tempInput);
                    tempInput.select();
                    document.execCommand("copy");
                    document.body.removeChild(tempInput);
                    showCopySuccess();
                }
            }
            
            // Show copy success message
            function showCopySuccess() {
                const copySuccess = document.getElementById("copySuccess");
                if (copySuccess) {
                    copySuccess.style.display = "block";
                    setTimeout(() => {
                        copySuccess.style.display = "none";
                    }, 2000); // Hide success message after 2 seconds
                }
            }

        </script>

    <script src="./assets/js/referal..js"></script>
    <script src="./assets/js/coin-home.js"></script>

</body>
</html>
