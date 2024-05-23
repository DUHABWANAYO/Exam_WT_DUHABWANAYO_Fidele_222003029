<?php
// Connection details
include('Database_connection.php');

// Check if TradeID is set and not empty
if(isset($_REQUEST['TradeID']) && !empty($_REQUEST['TradeID'])) {
    $TradeID = $_REQUEST['TradeID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM trades WHERE TradeID=?");
    $stmt->bind_param("i", $TradeID); // Assuming TradeID is an integer
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Trades</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="TradeID" value="<?php echo $TradeID; ?>">
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
    echo "TradeID is not set or empty.";
}

$connection->close();
?>
