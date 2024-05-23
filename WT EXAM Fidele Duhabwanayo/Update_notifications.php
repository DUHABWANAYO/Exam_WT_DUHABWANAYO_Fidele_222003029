<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Notification</title>
</head>
<body>
    <h2>Update Notification</h2>

    <?php
    include('Database_connection.php');

    if (isset($_GET['NotificationsID'])) {
        $NotificationsID = $_GET['NotificationsID'];

        // Fetch the existing record
        $stmt = $connection->prepare("SELECT * FROM notifications WHERE NotificationsID = ?");
        $stmt->bind_param("i", $NotificationsID);
        $stmt->execute();
        $result = $stmt->get_result();
        $notification = $result->fetch_assoc();
        $stmt->close();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $NotificationsID = $_POST['NotificationsID'];
        $UserID = $_POST['UserID'];
        $Message = $_POST['Message'];
        $IsRead = $_POST['IsRead'];
        $NotificationDate = $_POST['NotificationDate'];

        // Prepare and execute UPDATE statement
        $stmt = $connection->prepare("UPDATE notifications SET UserID = ?, Message = ?, IsRead = ?, NotificationDate = ? WHERE NotificationsID = ?");
        $stmt->bind_param("ssssi", $UserID, $Message, $IsRead, $NotificationDate, $NotificationsID);

        if ($stmt->execute()) {
            echo "Record updated successfully";
            header('Location: notifications.php');
            exit();
        } else {
            echo "Error updating record: " . $stmt->error;
        }

        $stmt->close();
        $connection->close();
    }
    ?>

    <form method="post" action="update_notifications.php?NotificationsID=<?php echo $notification['NotificationsID']; ?>">
        <label for="NotificationsID">NotificationsID</label>
        <input type="number" id="NotificationsID" name="NotificationsID" value="<?php echo $notification['NotificationsID']; ?>" readonly><br><br>

        <label for="UserID">UserID</label>
        <input type="text" id="UserID" name="UserID" value="<?php echo $notification['UserID']; ?>" required><br><br>

        <label for="Message">Message</label>
        <input type="text" id="Message" name="Message" value="<?php echo $notification['Message']; ?>" required><br><br>

        <label for="IsRead">IsRead</label>
        <input type="text" id="IsRead" name="IsRead" value="<?php echo $notification['IsRead']; ?>" required><br><br>

        <label for="NotificationDate">NotificationDate</label>
        <input type="date" id="NotificationDate" name="NotificationDate" value="<?php echo $notification['NotificationDate']; ?>" required><br><br>

        <input type="submit" value="Update">
    </form>
</body>
</html>
