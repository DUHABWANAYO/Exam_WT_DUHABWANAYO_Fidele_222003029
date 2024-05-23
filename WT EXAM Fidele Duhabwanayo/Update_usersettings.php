<?php
// Connection details
include('Database_connection.php');

if (isset($_REQUEST['SettingID'])) {
    $SettingID = $_REQUEST['SettingID'];

    // Prepare and execute SELECT statement
    $stmt = $connection->prepare("SELECT * FROM usersettings WHERE SettingID = ?");
    if ($stmt === false) {
        die("Error preparing statement: " . $connection->error);
    }

    $stmt->bind_param("i", $SettingID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch usersettings details
        $row = $result->fetch_assoc();
        $y = $row['SettingID'];
        $z = $row['UserID'];
        $w = $row['SettingName'];
        $x1 = $row['SettingValue'];
    } else {
        echo "Usersettings not found.";
    }

    $stmt->close();
}
?>

<html>
<head>
    <title>Update Usersettings</title>
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <h2><u>Update Form of User Table</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="SettingID">SettingID:</label>
            <input type="number" name="SettingID" value="<?php echo isset($y) ? $y : ''; ?>" readonly>
            <br><br>

            <label for="UserID">UserID:</label>
            <input type="text" name="UserID" value="<?php echo isset($z) ? $z : ''; ?>">
            <br><br>

            <label for="SettingName">SettingName:</label>
            <input type="text" name="SettingName" value="<?php echo isset($w) ? $w : ''; ?>">
            <br><br>

            <label for="SettingValue">SettingValue:</label>
            <input type="text" name="SettingValue" value="<?php echo isset($x1) ? $x1 : ''; ?>">
            <br><br>

            <input type="submit" name="up" value="Update">
        </form>
    </center>
</body>
</html>

<?php
if (isset($_POST['up'])) {
    // Retrieve updated values from form
    $SettingID = $_POST['SettingID'];
    $UserID = $_POST['UserID'];
    $SettingName = $_POST['SettingName'];
    $SettingValue = $_POST['SettingValue'];

    // Prepare and execute UPDATE statement
    $stmt = $connection->prepare("UPDATE usersettings SET UserID = ?, SettingName = ?, SettingValue = ? WHERE SettingID = ?");
    if ($stmt === false) {
        die("Error preparing statement: " . $connection->error);
    }

    $stmt->bind_param("sssi", $UserID, $SettingName, $SettingValue, $SettingID);
    $stmt->execute();

    $stmt->close();

    // Redirect to usersettings.php
    header('Location: usersettings.php');
    exit();
}

$connection->close();
?>
