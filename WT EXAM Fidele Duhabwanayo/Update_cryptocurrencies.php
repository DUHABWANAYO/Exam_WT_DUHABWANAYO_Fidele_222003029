<?php
// Connection details
include('Database_connection.php');
// Check if CryptocurrencyID is set
if(isset($_REQUEST['CryptocurrencyID'])) {
    $CryptocurrencyID = $_REQUEST['CryptocurrencyID']; // Correct variable name
    
    // Prepare and execute SELECT statement
    $stmt = $connection->prepare("SELECT * FROM cryptocurrencies WHERE CryptocurrencyID=?");
    $stmt->bind_param("i", $CryptocurrencyID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        // Fetch Cryptocurrency details
        $row = $result->fetch_assoc();
        $y = $row['CryptocurrencyID'];
        $z = $row['Name'];
        $w = $row['Symbol'];
        $x1 = $row['Description']; // Correct variable name
    } else {
        echo "cryptocurrencies not found.";
    }
}
?>

<html>
<head>
    <title>Update Cryptocurrencies</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Cryptocurrencies form -->
    <h2><u>Update Form of Cryptocurrencies</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="CryptocurrencyID">CryptocurrencyID:</label>
        <input type="number" name="CryptocurrencyID" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="Name">Name:</label>
        <input type="text" name="Name" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="Symbol">course_id:</label>
        <input type="text" name="Symbol" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

         <label for="Description">Description:</label>
        <input type="text" name="Description" value="<?php echo isset($x2) ? $x2 : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
include('Database_connection.php');
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $CryptocurrencyID = $_POST['CryptocurrencyID'];
    $Name = $_POST['Name'];
    $Symbol = $_POST['Symbol'];
    $Description = $_POST['Description'];
    
    // Update the cryptocurrencies in the database
    $stmt = $connection->prepare("UPDATE cryptocurrencies SET Name=?, Symbol=?, Description=? WHERE  CryptocurrencyID=?");
    $stmt->bind_param("sssi", $Name, $Symbol, $Description, $CryptocurrencyID); // Corrected "ssdsi" to "ssssi"
    $stmt->execute();
    
    // Redirect to cryptocurrencies.php
    header('Location: cryptocurrencies.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
