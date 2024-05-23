<?php
// Connection details
include('Database_connection.php');

// Check if MarketDataID is set
if (isset($_REQUEST['MarketDataID'])) {
    $MarketDataID = $_REQUEST['MarketDataID'];
    
    // Prepare and execute SELECT statement
    $stmt = $connection->prepare("SELECT * FROM marketdata WHERE MarketDataID=?");
    $stmt->bind_param("i", $MarketDataID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Fetch marketdata details
        $row = $result->fetch_assoc();
        $y = $row['MarketDataID'];
        $z = $row['CryptocurrencyID'];
        $w = $row['Price'];
        $x1 = $row['Volume'];
        $x2 = $row['MarketCap'];
        $x3 = $row['LastUpdated'];
    } else {
        echo "marketdata not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Market Data</title>
    <!-- JavaScript validation and content load for update or modify data -->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
<center>
    <h2><u>Update Form of Market Data</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="MarketDataID">MarketDataID:</label>
        <input type="number" name="MarketDataID" value="<?php echo isset($y) ? $y : ''; ?>" readonly>
        <br><br>

        <label for="CryptocurrencyID">CryptocurrencyID:</label>
        <input type="text" name="CryptocurrencyID" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="Price">Price:</label>
        <input type="text" name="Price" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="Volume">Volume:</label>
        <input type="text" name="Volume" value="<?php echo isset($x1) ? $x1 : ''; ?>">
        <br><br>

        <label for="MarketCap">MarketCap:</label>
        <input type="text" name="MarketCap" value="<?php echo isset($x2) ? $x2 : ''; ?>">
        <br><br>

        <label for="LastUpdated">LastUpdated:</label>
        <input type="date" name="LastUpdated" value="<?php echo isset($x3) ? $x3 : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</center>
</body>
</html>

<?php
include('Database_connection.php');

if (isset($_POST['up'])) {
    // Retrieve updated values from form
    $MarketDataID = $_POST['MarketDataID'];
    $CryptocurrencyID = $_POST['CryptocurrencyID'];
    $Price = $_POST['Price'];
    $Volume = $_POST['Volume'];
    $MarketCap = $_POST['MarketCap'];
    $LastUpdated = $_POST['LastUpdated'];

    // Update the marketdata in the database
    $stmt = $connection->prepare("UPDATE marketdata SET CryptocurrencyID=?, Price=?, Volume=?, MarketCap=?, LastUpdated=? WHERE MarketDataID=?");
    $stmt->bind_param("issdsi", $CryptocurrencyID, $Price, $Volume, $MarketCap, $LastUpdated, $MarketDataID);
    $stmt->execute();

    // Redirect to marketdata.php
    header('Location: marketdata.php');
    exit();
}
?>
