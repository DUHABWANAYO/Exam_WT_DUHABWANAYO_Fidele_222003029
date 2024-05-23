<?php
// Connection details
include('Database_connection.php');

// Check if TradeID is set
if (isset($_REQUEST['TradeID'])) {
    $TradeID = $_REQUEST['TradeID'];
    
    // Prepare and execute SELECT statement
    $stmt = $connection->prepare("SELECT * FROM trades WHERE TradeID=?");
    $stmt->bind_param("i", $TradeID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Fetch trades details
        $row = $result->fetch_assoc();
        $tradeID = $row['TradeID'];
        $userID = $row['UserID'];
        $cryptocurrencyID = $row['CryptocurrencyID'];
        $tradeType = $row['TradeType'];
        $amount = $row['Amount'];
        $price = $row['Price'];
        $tradeDate = $row['TradeDate'];
    } else {
        echo "Trade not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Trades</title>
    <!-- JavaScript validation and content load for update or modify data -->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
<center>
    <h2><u>Update Form of Trades</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="TradeID">TradeID:</label>
        <input type="number" name="TradeID" value="<?php echo isset($tradeID) ? $tradeID : ''; ?>" readonly>
        <br><br>

        <label for="UserID">UserID:</label>
        <input type="text" name="UserID" value="<?php echo isset($userID) ? $userID : ''; ?>">
        <br><br>

        <label for="CryptocurrencyID">CryptocurrencyID:</label>
        <input type="text" name="CryptocurrencyID" value="<?php echo isset($cryptocurrencyID) ? $cryptocurrencyID : ''; ?>">
        <br><br>

        <label for="TradeType">TradeType:</label>
        <select name="TradeType">
            <option value="buy" <?php if(isset($tradeType) && $tradeType == 'buy') echo 'selected'; ?>>Buy</option>
            <option value="sell" <?php if(isset($tradeType) && $tradeType == 'sell') echo 'selected'; ?>>Sell</option>
        </select>
        <br><br>

        <label for="Amount">Amount:</label>
        <input type="text" name="Amount" value="<?php echo isset($amount) ? $amount : ''; ?>">
        <br><br>

        <label for="Price">Price:</label>
        <input type="text" name="Price" value="<?php echo isset($price) ? $price : ''; ?>">
        <br><br>

        <label for="TradeDate">TradeDate:</label>
        <input type="date" name="TradeDate" value="<?php echo isset($tradeDate) ? $tradeDate : ''; ?>">
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
    $TradeID = $_POST['TradeID'];
    $UserID = $_POST['UserID'];
    $CryptocurrencyID = $_POST['CryptocurrencyID'];
    $TradeType = $_POST['TradeType'];
    $Amount = $_POST['Amount'];
    $Price = $_POST['Price'];
    $TradeDate = $_POST['TradeDate'];

    // Update the trades in the database
    $stmt = $connection->prepare("UPDATE trades SET UserID=?, CryptocurrencyID=?, TradeType=?, Amount=?, Price=?, TradeDate=? WHERE TradeID=?");
    $stmt->bind_param("iissdsi", $UserID, $CryptocurrencyID, $TradeType, $Amount, $Price, $TradeDate, $TradeID);
    $stmt->execute();

    // Redirect to trades.php
    header('Location: trades.php');
    exit();
}
?>
