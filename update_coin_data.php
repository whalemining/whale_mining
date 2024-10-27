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
if (!isset($data['telegram_id']) || !isset($data['coins'])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
    exit();
}

$telegram_id = $conn->real_escape_string($data['telegram_id']);
$coins = intval($conn->real_escape_string($data['coins']));  // Ensure coins is treated as integer

// Update the user's coin count
$sql = "UPDATE users SET coins = '$coins' WHERE telegram_id = '$telegram_id'";
if ($conn->query($sql) === TRUE) {
    echo json_encode(['status' => 'success', 'message' => 'Coins updated']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error updating coins']);
}

// Close the connection
$conn->close();
?>