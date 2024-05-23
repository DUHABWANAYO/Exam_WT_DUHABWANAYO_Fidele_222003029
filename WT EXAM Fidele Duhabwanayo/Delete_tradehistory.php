<?php
// Connection details
include('Database_connection.php');

// Check if HistoryID is set and not empty
if(isset($_REQUEST['HistoryID']) && !empty($_REQUEST['HistoryID'])) {
    $HistoryID = $_REQUEST['HistoryID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM tradehistory  WHERE HistoryID=?");
    $stmt->bind_param("i", $HistoryID); // Assuming HistoryID is an integer
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Notifications</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="HistoryID" value="<?php echo $HistoryID; ?>">
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
    echo "HistoryID is not set or empty.";
}

$connection->close();
?>
