<?php
// Connection details
include('Database_connection.php');

// Check if WithdrawalID is set
if (isset($_REQUEST['WithdrawalID'])) {
    $WithdrawalID = $_REQUEST['WithdrawalID'];
    
    // Prepare and execute SELECT statement
    $stmt = $connection->prepare("SELECT * FROM withdrawals WHERE WithdrawalID=?");
    $stmt->bind_param("i", $WithdrawalID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Fetch withdrawal details
        $row = $result->fetch_assoc();
        $y = $row['WithdrawalID'];
        $z = $row['UserID'];
        $w = $row['Amount'];
        $x1 = $row['WithdrawalDate'];
    } else {
        echo "Withdrawal not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Withdrawals</title>
    <!-- JavaScript validation and content load for update or modify data -->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
<center>
    <h2><u>Update Form of Withdrawals Table</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="WithdrawalID">WithdrawalID:</label>
        <input type="number" name="WithdrawalID" value="<?php echo isset($y) ? $y : ''; ?>" readonly>
        <br><br>

        <label for="UserID">UserID:</label>
        <input type="text" name="UserID" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="Amount">Amount:</label>
        <input type="text" name="Amount" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="WithdrawalDate">WithdrawalDate:</label>
        <input type="date" name="WithdrawalDate" value="<?php echo isset($x1) ? $x1 : ''; ?>">
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
    $WithdrawalID = $_POST['WithdrawalID'];
    $UserID = $_POST['UserID'];
    $Amount = $_POST['Amount'];
    $WithdrawalDate = $_POST['WithdrawalDate'];
    
    // Update the withdrawals table in the database
    $stmt = $connection->prepare("UPDATE withdrawals SET UserID=?, Amount=?, WithdrawalDate=? WHERE WithdrawalID=?");
    $stmt->bind_param("sssi", $UserID, $Amount, $WithdrawalDate, $WithdrawalID);
    $stmt->execute();
    
    // Redirect to withdrawals.php
    header('Location: withdrawals.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
