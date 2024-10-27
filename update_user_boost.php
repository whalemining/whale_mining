<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

// Database connection details
$servername = "localhost";
$username = "u132187744_whale";
$password = "Mustbeadmin@1";
$dbname = "u132187744_whale";

// Connect to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Database connection failed']));
}

// Get the JSON data from the request
$data = json_decode(file_get_contents("php://input"), true);

// Validate input
if (!isset($data['telegram_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
    exit();
}

$telegram_id = $conn->real_escape_string($data['telegram_id']);

// Check last boost time
$sql = "SELECT last_boost_time FROM users WHERE telegram_id = '$telegram_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $last_boost_time = $user['last_boost_time'];
    
    // Check if the user can boost again (cooldown of 12 hours)
    if ($last_boost_time) {
        $cooldown_period = 12 * 60 * 60; // 12 hours in seconds
        $current_time = time();
        $last_boost_timestamp = strtotime($last_boost_time);

        if (($current_time - $last_boost_timestamp) < $cooldown_period) {
            echo json_encode(['status' => 'error', 'message' => 'Boost is on cooldown.']);
            exit();
        }
    }

    // Update the user's boost count and last boost time
    $new_boosts_count = $user['boosts'] + 1; // Increment boosts
    $update_sql = "UPDATE users SET boosts = '$new_boosts_count', last_boost_time = NOW() WHERE telegram_id = '$telegram_id'";
    
    if ($conn->query($update_sql) === TRUE) {
        echo json_encode(['status' => 'success', 'message' => 'Boost activated']);
        
        // Optional: Insert a new record in the boosts table
        $boost_sql = "INSERT INTO boosts (telegram_id, boost_amount) VALUES ('$telegram_id', 1)";
        $conn->query($boost_sql);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error updating boosts']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'User not found']);
}

// Close the connection
$conn->close();
?>
