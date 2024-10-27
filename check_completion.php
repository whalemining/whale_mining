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
    die(json_encode(['status' => 'error', 'message' => 'Database connection failed: ' . $conn->connect_error]));
}

// Get the JSON data from the request
$data = json_decode(file_get_contents("php://input"), true);

// Validate that data was received
if (!isset($data['telegram_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data: telegram_id is required']);
    exit();
}

$telegram_id = $conn->real_escape_string($data['telegram_id']);

// Queries to check if the specific user has completed the tasks
$taskChecks = [
    'join_telegram' => "SELECT * FROM completed_tasks WHERE telegram_id = '$telegram_id' AND task_name = 'join_telegram'",
    'watch_youtube' => "SELECT * FROM completed_tasks WHERE telegram_id = '$telegram_id' AND task_name = 'watch_youtube'",
    'retweet_community' => "SELECT * FROM completed_tasks WHERE telegram_id = '$telegram_id' AND task_name = 'retweet_community'"
];

// Task completion statuses
$taskStatuses = [
    'join_telegram' => false,
    'watch_youtube' => false,
    'retweet_community' => false
];

// Loop through each task check and update task statuses
foreach ($taskChecks as $task => $query) {
    $result = $conn->query($query);
    if (!$result) {
        echo json_encode(['status' => 'error', 'message' => 'Query failed: ' . $conn->error]);
        exit();
    }
    $taskStatuses[$task] = $result->num_rows > 0;
}

// Return the task completion status for the specific user
echo json_encode([
    'status' => 'success',
    'tasks' => $taskStatuses
]);

$conn->close();
?>
