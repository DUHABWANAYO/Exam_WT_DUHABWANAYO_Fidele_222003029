<?php
// Connection details
include('Database_connection.php');

// Check if WalletID is set and not empty
if(isset($_REQUEST['WalletID']) && !empty($_REQUEST['WalletID'])) {
    $WalletID = $_REQUEST['WalletID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM wallets  WHERE WalletID=?");
    $stmt->bind_param("i", $WalletID); // Assuming WalletID is an integer
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Wallets</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="WalletID" value="<?php echo $WalletID; ?>">
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
    echo "WalletID is not set or empty.";
}

$connection->close();
?>
