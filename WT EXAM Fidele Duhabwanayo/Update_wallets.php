<?php
// Connection details
include('Database_connection.php');

// Check if WalletID is set
if (isset($_REQUEST['WalletID'])) {
    $WalletID = $_REQUEST['WalletID'];

    // Prepare and execute SELECT statement
    $stmt = $connection->prepare("SELECT * FROM wallets WHERE WalletID = ?");
    $stmt->bind_param("i", $WalletID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch wallets details
        $row = $result->fetch_assoc();
        $walletID = $row['WalletID'];
        $userID = $row['UserID'];
        $cryptocurrencyID = $row['CryptocurrencyID'];
        $balance = $row['Balance'];
    } else {
        echo "Wallet not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Wallets</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
<center>
    <h2><u>Update Form of Wallets</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="WalletID">WalletID:</label>
        <input type="number" name="WalletID" value="<?php echo isset($walletID) ? $walletID : ''; ?>" readonly>
        <br><br>

        <label for="UserID">UserID:</label>
        <input type="text" name="UserID" value="<?php echo isset($userID) ? $userID : ''; ?>">
        <br><br>

        <label for="CryptocurrencyID">CryptocurrencyID:</label>
        <input type="text" name="CryptocurrencyID" value="<?php echo isset($cryptocurrencyID) ? $cryptocurrencyID : ''; ?>">
        <br><br>

        <label for="Balance">Balance:</label>
        <input type="text" name="Balance" value="<?php echo isset($balance) ? $balance : ''; ?>">
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
    $WalletID = $_POST['WalletID'];
    $UserID = $_POST['UserID'];
    $CryptocurrencyID = $_POST['CryptocurrencyID'];
    $Balance = $_POST['Balance'];

    // Update the wallets table in the database
    $stmt = $connection->prepare("UPDATE wallets SET UserID = ?, CryptocurrencyID = ?, Balance = ? WHERE WalletID = ?");
    $stmt->bind_param("ssdi", $UserID, $CryptocurrencyID, $Balance, $WalletID);
    $stmt->execute();

    // Redirect to wallets.php
    header('Location: wallets.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
