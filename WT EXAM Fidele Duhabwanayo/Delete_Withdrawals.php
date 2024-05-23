<?php
// Connection details
include('Database_connection.php');

// Check if WithdrawalID is set and not empty
if(isset($_REQUEST['WithdrawalID']) && !empty($_REQUEST['WithdrawalID'])) {
    $WithdrawalID = $_REQUEST['WithdrawalID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM withdrawals WHERE WithdrawalID=?");
    $stmt->bind_param("i", $WithdrawalID); // Assuming WithdrawalID is an integer
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Withdrawals</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="WithdrawalID" value="<?php echo $WithdrawalID; ?>">
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
    echo "WithdrawalID is not set or empty.";
}

$connection->close();
?>
