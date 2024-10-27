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

// Get the JSON data from the request
$data = json_decode(file_get_contents("php://input"), true);

// Validate that data was received
if (!isset($data['telegram_id']) || !isset($data['task_name']) || !isset($data['reward'])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
    exit();
}

$telegram_id = $conn->real_escape_string($data['telegram_id']);
$task_name = $conn->real_escape_string($data['task_name']);
$reward = intval($data['reward']);

// Check if the user already completed the task
$checkTaskQuery = "SELECT * FROM completed_tasks WHERE telegram_id = '$telegram_id' AND task_name = '$task_name'";
$taskResult = $conn->query($checkTaskQuery);

if ($taskResult->num_rows > 0) {
    // Task already completed, no need to add coins again
    echo json_encode(['status' => 'error', 'message' => 'Task already completed']);
} else {
    // Add task completion to the completed_tasks table
    $insertTaskQuery = "INSERT INTO completed_tasks (telegram_id, task_name) VALUES ('$telegram_id', '$task_name')";
    $conn->query($insertTaskQuery);

    // Update user's total coins
    $updateCoinsQuery = "UPDATE users SET coins = coins + $reward WHERE telegram_id = '$telegram_id'";
    $conn->query($updateCoinsQuery);

    echo json_encode(['status' => 'success', 'message' => 'Coins added successfully']);
}

$conn->close();
?>
