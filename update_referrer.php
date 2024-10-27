<?php
// Include your database connection
require 'db_connection.php'; // Make sure you have a connection file

// Set the response header to JSON
header('Content-Type: application/json');

// Read the POST data
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Validate incoming data
if (!isset($data['telegram_id']) || !isset($data['referrer_id'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Telegram ID and Referrer ID are required'
    ]);
    exit;
}

$telegramID = $data['telegram_id'];
$referrerID = $data['referrer_id'];

try {
    // Check if the user already has a referrer set to prevent duplicate referrals
    $checkReferrerStmt = $conn->prepare("SELECT referrer_id FROM users WHERE telegram_id = ?");
    $checkReferrerStmt->bind_param('s', $telegramID);
    $checkReferrerStmt->execute();
    $checkReferrerStmt->store_result();

    if ($checkReferrerStmt->num_rows > 0) {
        $checkReferrerStmt->bind_result($existingReferrer);
        $checkReferrerStmt->fetch();

        if ($existingReferrer) {
            echo json_encode([
                'status' => 'error',
                'message' => 'User already has a referrer set'
            ]);
            exit;
        }
    }

    // Update the user's referrer in the database
    $updateStmt = $conn->prepare("UPDATE users SET referrer_id = ? WHERE telegram_id = ?");
    $updateStmt->bind_param('ss', $referrerID, $telegramID);
    $updateStmt->execute();

    if ($updateStmt->affected_rows > 0) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Referrer ID updated successfully'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Unable to update referrer ID'
        ]);
    }

    $updateStmt->close();
    $checkReferrerStmt->close();
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}

// Close the database connection
$conn->close();
?>
