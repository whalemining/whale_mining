<?php

// Start the session
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

// Check if the user is already in the boost state
$sql = "SELECT boost_active, boost_end_time FROM users WHERE telegram_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $telegram_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && $user['boost_active']) {
    die(json_encode(['status' => 'error', 'message' => 'Boost is already active']));
}

// Activate the boost for 5 minutes
$boostEndTime = date('Y-m-d H:i:s', strtotime('+5 minutes'));

$sql = "UPDATE users SET boost_active = 1, boost_start_time = NOW(), boost_end_time = ? WHERE telegram_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $boostEndTime, $telegram_id);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Boost activated successfully', 'boost_end_time' => $boostEndTime]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to activate boost']);
}

$conn->close();

?>
