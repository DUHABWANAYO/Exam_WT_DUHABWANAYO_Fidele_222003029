<?php
// Connection details
include('Database_connection.php');

// Check if CryptocurrencyID is set and not empty
if(isset($_REQUEST['CryptocurrencyID']) && !empty($_REQUEST['CryptocurrencyID'])) {
    $CryptocurrencyID = $_REQUEST['CryptocurrencyID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM cryptocurrencies  WHERE CryptocurrencyID=?");
    $stmt->bind_param("i", $CryptocurrencyID); // Assuming CryptocurrencyID is an integer
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Cryptocurrencies</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="CryptocurrencyID" value="<?php echo $CryptocurrencyID; ?>">
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
    echo "CryptocurrencyID is not set or empty.";
}

$connection->close();
?>
