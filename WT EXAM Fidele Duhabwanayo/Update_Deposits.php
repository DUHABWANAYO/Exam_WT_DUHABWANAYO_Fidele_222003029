<?php
// Connection details
include('Database_connection.php');

// Check if DepositID is set
if (isset($_REQUEST['DepositID'])) {
    $DepositID = $_REQUEST['DepositID']; // Correct variable name
    
    // Prepare and execute SELECT statement
    $stmt = $connection->prepare("SELECT * FROM deposits WHERE DepositID=?");
    $stmt->bind_param("i", $DepositID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Fetch deposit details
        $row = $result->fetch_assoc();
        $y = $row['DepositID'];
        $z = $row['UserID'];
        $w = $row['Amount'];
        $x1 = $row['DepositDate']; // Correct variable name
    } else {
        echo "Deposit not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Deposits</title>
    <!-- JavaScript validation and content load for update or modify data -->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
<center>
    <h2><u>Update Form of Deposits</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="DepositID">DepositID:</label>
        <input type="number" name="DepositID" value="<?php echo isset($y) ? $y : ''; ?>" readonly>
        <br><br>

        <label for="UserID">UserID:</label>
        <input type="text" name="UserID" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="Amount">Amount:</label>
        <input type="text" name="Amount" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="DepositDate">DepositDate:</label>
        <input type="date" name="DepositDate" value="<?php echo isset($x1) ? $x1 : ''; ?>">
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
    $DepositID = $_POST['DepositID'];
    $UserID = $_POST['UserID'];
    $Amount = $_POST['Amount'];
    $DepositDate = $_POST['DepositDate'];
    
    // Update the deposits in the database
    $stmt = $connection->prepare("UPDATE deposits SET UserID=?, Amount=?, DepositDate=? WHERE DepositID=?");
    $stmt->bind_param("sdsi", $UserID, $Amount, $DepositDate, $DepositID); // Corrected data types and variable names
    $stmt->execute();
    
    // Redirect to deposits.php
    header('Location: deposits.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
