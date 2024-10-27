<?php

session_start(); // Start the session

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_connection.php'; // Include the database connection class

// Establish database connection
$database = new Database();
$conn = $database->connect(); // Establish the database connection

// Extract the referrer ID from the URL parameter "start"
$referrer_id = null;
if (isset($_GET['start'])) {
    $startParam = $_GET['start'];
    $referrer_id = str_replace('referrer_', '', $startParam); // Extract the referrer ID

    // Set the referral cookie to last for 5 years (5 years in seconds)
    setcookie('referral', $referrer_id, time() + (5 * 365 * 24 * 60 * 60));
}


// Function to authenticate a user
function authenticateUser($data, $conn) {
    $validationResult = validateData($data);
    if ($validationResult !== true) {
        return json_encode($validationResult);
    }

    $telegram_id = $data['telegram_id'];
    $first_name = $data['first_name'];
    $username = isset($data['username']) ? $data['username'] : 'Anonymous';
    $last_name = isset($data['last_name']) ? $data['last_name'] : null;

    // Check if user exists
    $user = getUserByTelegramId($telegram_id, $conn);

    if ($user) {
        // User exists, return coins and referral info
        $coins = $user['coins'];
        $referral_link = generateReferralLink($user['telegram_id']);
        return json_encode(['status' => 'success', 'message' => 'User authenticated', 'coins' => $coins, 'referral_link' => $referral_link]);
    } else {
        // Retrieve referrer ID from the cookie, if it exists
        $referrer_id = isset($_COOKIE['referral']) ? $_COOKIE['referral'] : null;

        // New user, insert them into the database with 1,000 initial coins
        return createUser($telegram_id, $username, $first_name, $last_name, $referrer_id, $conn);
    }
}


// Function to validate the received data
function validateData($data) {
    if (!isset($data['telegram_id'], $data['first_name'])) {
        return ['status' => 'error', 'message' => 'Invalid data'];
    }
    return true;
}

// Function to fetch a user by Telegram ID
function getUserByTelegramId($telegram_id, $conn) {
    $sql = "SELECT * FROM users WHERE telegram_id = :telegram_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':telegram_id', $telegram_id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Function to create a new user
function createUser($telegram_id, $username, $first_name, $last_name, $referrer_id, $conn) {
    $sql = "INSERT INTO users (telegram_id, username, first_name, last_name, coins, referrer_id, active_boost, boost_activation_time, is_boost_active) 
            VALUES (:telegram_id, :username, :first_name, :last_name, 1000, :referrer_id, NULL, NULL, 0)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':telegram_id', $telegram_id);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name, PDO::PARAM_NULL);  // Nullable
    $stmt->bindParam(':referrer_id', $referrer_id, PDO::PARAM_NULL);  // Nullable field for referrer ID

    if ($stmt->execute()) {
        $user_id = $conn->lastInsertId(); // Get the new user ID

        if ($referrer_id) {
            $referrer = getUserByTelegramId($referrer_id, $conn);
            if ($referrer) {
                linkReferral($referrer_id, $user_id, $conn);
                grantReferrerCoins($referrer_id, 200, $conn); // Reward referrer
            }
        }
        $referral_link = generateReferralLink($telegram_id);
        return json_encode(['status' => 'success', 'message' => 'User created and gifted 1,000 coins', 'coins' => 1000, 'referral_link' => $referral_link]);
    } else {
        return json_encode(['status' => 'error', 'message' => 'Error creating user']);
    }
}


// Link the referral relationship
function linkReferral($referrer_id, $user_id, $conn) {
    $sql = "INSERT INTO referrals (referrer_id, referee_id) VALUES (:referrer_id, :referee_id)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':referrer_id', $referrer_id);
    $stmt->bindParam(':referee_id', $user_id);
    $stmt->execute();
}

// Grant coins to referrer
function grantReferrerCoins($referrer_id, $coins, $conn) {
    $sql = "UPDATE users SET coins = coins + :coins WHERE telegram_id = :referrer_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':coins', $coins);
    $stmt->bindParam(':referrer_id', $referrer_id);
    $stmt->execute();
}

// Generate a referral link
function generateReferralLink($telegram_id) {
    $bot_username = "whalemining_bot"; // Replace with your bot's Telegram username
    return "https://t.me/$bot_username?start=referrer_" . $telegram_id;
}

// Boost activation function
function activateBoost($telegram_id, $boost_type, $coin_cost, $conn) {
    deductCoins($telegram_id, $coin_cost, $conn);
    $sql = "UPDATE users SET active_boost = :boost_type, boost_activation_time = NOW() WHERE telegram_id = :telegram_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':boost_type', $boost_type);
    $stmt->bindParam(':telegram_id', $telegram_id);
    $stmt->execute();
    return json_encode(['status' => 'success', 'message' => ucfirst($boost_type) . ' boost activated']);
}

// Deduct coins from the user
function deductCoins($telegram_id, $amount, $conn) {
    $sql = "UPDATE users SET coins = coins - :amount WHERE telegram_id = :telegram_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':amount', $amount);
    $stmt->bindParam(':telegram_id', $telegram_id);
    $stmt->execute();
}

// Handle the POST request
$data = json_decode(file_get_contents("php://input"), true);
echo authenticateUser($data, $conn);

?>
