<?php
// Connection details
include('Database_connection.php');
// Check if HistoryID is set
if(isset($_REQUEST['HistoryID'])) {
    $HistoryID = $_REQUEST['HistoryID']; // Correct variable name
    
    // Prepare and execute SELECT statement
    $stmt = $connection->prepare("SELECT * FROM tradehistory WHERE HistoryID=?");
    $stmt->bind_param("i", $HistoryID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        // Fetch marketdata details
        $row = $result->fetch_assoc();
        $y = $row['HistoryID'];
        $z = $row['TradeID'];
        $w = $row['UserID'];
        $x1 = $row['CryptocurrencyID'];
        $w = $row['TradeType'];
        $y = $row['Amount'];
        $z = $row['Price'];
        $w = $row['TradeDate'];
    } else {
        echo "tradehistory not found.";
    }
}
?>

<html>
<head>
    <title>Update tradehistory</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update tradehistory form -->
    <h2><u>Update Form of tradehistory</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="HistoryID">HistoryID:</label>
        <input type="number" name="HistoryID" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="TradeID">TradeID:</label>
        <input type="text" name="TradeID" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="UserID">UserID:</label>
        <input type="text" name="UserID" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

         <label for="CryptocurrencyID">CryptocurrencyID:</label>
        <input type="text" name="CryptocurrencyID" value="<?php echo isset($x2) ? $x2 : ''; ?>">
        <br><br>

        <label for="TradeType">TradeType:</label>
        <input type="text" name="TradeType" value="<?php echo isset($x2) ? $x2 : ''; ?>">
        <br><br>

        <label for="Amount">Amount:</label>
        <input type="text" name="Amount" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

         <label for="Price">Price:</label>
        <input type="text" name="Price" value="<?php echo isset($x2) ? $x2 : ''; ?>">
        <br><br>

        <label for="TradeDate">TradeDate:</label>
        <input type="Date" name="TradeDate" value="<?php echo isset($x2) ? $x2 : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
include('Database_connection.php');
if(isset($_POST['up'])) {
    // Retrieved updated values from form
    $HistoryID = $_POST['HistoryID'];
    $TradeID = $_POST['TradeID'];
    $UserID = $_POST['UserID'];
    $CryptocurrencyID = $_POST['CryptocurrencyID'];
    $TradeType = $_POST['TradeType'];
    $Amount = $_POST['Amount'];
    $Price = $_POST['Price'];
    $TradeDate = $_POST['TradeDate'];
    
    // Update the tradehistory in the database
    $stmt = $connection->prepare("UPDATE tradehistory SET TradeID=?, UserID=?, CryptocurrencyID=?, TradeType=?, Amount=?, Price=?, TradeDate=? WHERE  HistoryID=?");
    $stmt->bind_param("sssssssi", $HistoryID, $TradeID, $UserID, $CryptocurrencyID, $TradeType, $Amount, $Price, $TradeDate);
    $stmt->execute();
    
    // Redirect to tradehistory.php
    header('Location: tradehistory.php');
    exit();
}
?>
