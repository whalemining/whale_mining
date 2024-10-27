<?php
include 'db_connection.php';

// Get the user ID from the request
$user_id = $_GET['user_id']; // Assuming you're passing this in the URL

// Set coins based on the platform
$platform = $_GET['platform'];
$coins_to_claim = 0;

// Set coins based on the platform
switch ($platform) {
    case 'telegram':
        $coins_to_claim = 50000;
        break;
    case 'youtube':
        $coins_to_claim = 50000;
        break;
    case 'x':
        $coins_to_claim = 28000;
        break;
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid platform.']);
        exit();
}

// Update user's coins in the database
$query = "UPDATE users SET coins = coins + ? WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('ii', $coins_to_claim, $user_id);

$success = $stmt->execute();

// Return success status
if ($success) {
    echo json_encode(['success' => true, 'coins_claimed' => $coins_to_claim]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update coins.']);
}

// Close the database connection
$conn->close();
?>
