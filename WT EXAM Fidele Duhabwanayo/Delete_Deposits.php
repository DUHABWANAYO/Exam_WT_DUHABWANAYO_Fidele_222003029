<?php
// Connection details
include('Database_connection.php');

// Check if DepositID is set and not empty
if(isset($_REQUEST['DepositID']) && !empty($_REQUEST['DepositID'])) {
    $DepositID = $_REQUEST['DepositID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM deposits  WHERE DepositID=?");
    $stmt->bind_param("i", $DepositID); // Assuming DepositID is an integer
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Deposits</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="DepositID" value="<?php echo $DepositID; ?>">
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
    echo "DepositID is not set or empty.";
}

$connection->close();
?>
