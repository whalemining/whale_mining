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

// Check the boost status for the user
$sql = "SELECT boost_active, boost_end_time, cooldown_end_time FROM users WHERE telegram_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $telegram_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user) {
    $currentTime = date('Y-m-d H:i:s');
    
    if ($user['boost_active'] && $user['boost_end_time'] > $currentTime) {
        echo json_encode(['status' => 'success', 'boost_active' => true, 'boost_end_time' => $user['boost_end_time']]);
    } elseif ($user['cooldown_end_time'] > $currentTime) {
        echo json_encode(['status' => 'cooldown', 'cooldown_end_time' => $user['cooldown_end_time']]);
    } else {
        echo json_encode(['status' => 'inactive']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'User not found']);
}

$conn->close();

?>