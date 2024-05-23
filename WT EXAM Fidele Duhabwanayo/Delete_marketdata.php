<?php
// Connection details
include('Database_connection.php');

// Check if MarketDataID is set and not empty
if(isset($_REQUEST['MarketDataID']) && !empty($_REQUEST['MarketDataID'])) {
    $MarketDataID = $_REQUEST['MarketDataID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM marketdata  WHERE MarketDataID=?");
    $stmt->bind_param("i", $MarketDataID); // Assuming MarketDataID is an integer
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete MarketData</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="MarketDataID" value="<?php echo $MarketDataID; ?>">
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
    echo "MarketDataID is not set or empty.";
}

$connection->close();
?>
