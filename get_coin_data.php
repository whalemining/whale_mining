<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

// Database connection details (update with your own settings)
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

// Fetch the user's coin balance
$sql = "SELECT coins FROM users WHERE telegram_id = '$telegram_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo json_encode(['status' => 'success', 'coins' => intval($user['coins'])]);  // Return as integer
} else {
    echo json_encode(['status' => 'error', 'message' => 'User not found']);
}

// Close the connection
$conn->close();
?>