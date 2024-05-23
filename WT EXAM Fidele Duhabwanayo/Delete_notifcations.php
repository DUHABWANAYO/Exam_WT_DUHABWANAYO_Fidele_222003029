<?php
include('Database_connection.php');

if (isset($_GET['NotificationsID'])) {
    $NotificationsID = $_GET['NotificationsID'];

    // Prepare and execute DELETE statement
    $stmt = $connection->prepare("DELETE FROM notifications WHERE NotificationsID = ?");
    $stmt->bind_param("i", $NotificationsID);

    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();

    // Redirect back to the notifications page
    header('Location: notifications.php');
    exit();
} else {
    echo "NotificationsID not set";
}
?>
