<?php
// Connection details
include('Database_connection.php');

// Check if UserID is set
if (isset($_REQUEST['UserID'])) {
    $UserID = $_REQUEST['UserID'];

    // Prepare and execute SELECT statement
    $stmt = $connection->prepare("SELECT * FROM user WHERE UserID=?");
    $stmt->bind_param("i", $UserID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch user details
        $row = $result->fetch_assoc();
        $userID = $row['UserID'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $username = $row['username'];
        $email = $row['email'];
        $telephone = $row['telephone'];
        $password = $row['password'];
        $creationdate = $row['creationdate'];
        $activation_code = $row['activation_code'];
        $Is_activated = $row['Is_activated'];
    } else {
        echo "User not found.";
    }
}
?>

<html>
<head>
    <title>Update User Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
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
        <label for="UserID">UserID:</label>
        <input type="number" name="UserID" value="<?php echo isset($userID) ? $userID : ''; ?>" readonly>
        <br><br>

        <label for="firstname">Firstname:</label>
        <input type="text" name="firstname" value="<?php echo isset($firstname) ? $firstname : ''; ?>">
        <br><br>

        <label for="lastname">Lastname:</label>
        <input type="text" name="lastname" value="<?php echo isset($lastname) ? $lastname : ''; ?>">
        <br><br>

        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo isset($username) ? $username : ''; ?>">
        <br><br>

        <label for="email">Email:</label>
        <input type="text" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
        <br><br>

        <label for="telephone">Telephone:</label>
        <input type="text" name="telephone" value="<?php echo isset($telephone) ? $telephone : ''; ?>">
        <br><br>

        <label for="password">Password:</label>
        <input type="text" name="password" value="<?php echo isset($password) ? $password : ''; ?>">
        <br><br>

        <label for="creationdate">Creation Date:</label>
        <input type="date" name="creationdate" value="<?php echo isset($creationdate) ? $creationdate : ''; ?>">
        <br><br>

        <label for="activation_code">Activation Code:</label>
        <input type="text" name="activation_code" value="<?php echo isset($activation_code) ? $activation_code : ''; ?>">
        <br><br>

        <label for="Is_activated">Is Activated:</label>
        <input type="text" name="Is_activated" value="<?php echo isset($Is_activated) ? $Is_activated : ''; ?>">
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
    $UserID = $_POST['UserID'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $password = $_POST['password'];
    $creationdate = $_POST['creationdate'];
    $activation_code = $_POST['activation_code'];
    $Is_activated = $_POST['Is_activated'];

    // Update the User Table in the database
    $stmt = $connection->prepare("UPDATE user SET firstname=?, lastname=?, username=?, email=?, telephone=?, password=?, creationdate=?, activation_code=?, Is_activated=? WHERE UserID=?");
    $stmt->bind_param("sssssssssi", $firstname, $lastname, $username, $email, $telephone, $password, $creationdate, $activation_code, $Is_activated, $UserID);
    $stmt->execute();

    // Redirect to User.php
    header('Location: User.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
