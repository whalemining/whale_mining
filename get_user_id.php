<?php
session_start(); // Assuming you're using sessions for user authentication
include 'db_connection.php';

$user_id = $_SESSION['user_id'] ?? null; // Adjust according to your session logic

if ($user_id) {
    echo json_encode(['user_id' => $user_id]);
} else {
    echo json_encode(['user_id' => null]);
}
?>
