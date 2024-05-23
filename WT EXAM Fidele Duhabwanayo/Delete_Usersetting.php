<?php
// Connection details
include('Database_connection.php');

// Check if SettingID is set and not empty
if(isset($_REQUEST['SettingID']) && !empty($_REQUEST['SettingID'])) {
    $SettingID = $_REQUEST['SettingID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM usersettings  WHERE SettingID=?");
    $stmt->bind_param("i", $SettingID); // Assuming SettingID is an integer
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete User Settings Data</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="SettingID" value="<?php echo $SettingID; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }
    }
?>
</body>
</html>
<?php

    $stmt->close();
} else {
    echo "SettingID is not set or empty.";
}

$connection->close();
?>
