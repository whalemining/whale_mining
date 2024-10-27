<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");

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

// Get data from POST request
$data = json_decode(file_get_contents('php://input'), true);
$telegram_id = $data['telegram_id'];

// Set the cooldown period of 12 hours
$cooldownEndTime = date('Y-m-d H:i:s', strtotime('+12 hours'));

$sql = "UPDATE users SET boost_active = 0, last_boost_used = NOW(), cooldown_end_time = ? WHERE telegram_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $cooldownEndTime, $telegram_id);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Boost deactivated and cooldown set', 'cooldown_end_time' => $cooldownEndTime]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to deactivate boost']);
}

$conn->close();

?>
