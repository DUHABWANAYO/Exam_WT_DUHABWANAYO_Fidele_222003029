<?php
// Connection details
include('Database_connection.php');

// Handling POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieving form data
    $UserID = $_POST['UserID'];
    $Firstname = $_POST['firstname'];
    $Lastname = $_POST['lastname'];
    $Username = $_POST['username'];
    $Email = $_POST['email'];
    $Telephone = $_POST['telephone'];
    $Password =$_POST['password'];
    $Creationdate = $_POST['creationdate'];
    $Activation_code = $_POST['activation_code'];
    $Is_activated = $_POST['Is_activated'];

    // Preparing SQL query
    $stmt = $connection->prepare("INSERT INTO user (UserID, firstname, lastname, username, email, telephone, password, creationdate, activation_code, Is_activated) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die("Error preparing statement: " . $connection->error);
    }

    // Bind parameters
    $stmt->bind_param("issssssssi", $UserID, $Firstname, $Lastname, $Username, $Email, $Telephone, $Password, $Creationdate, $Activation_code, $Is_activated);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirecting to login page on successful registration
        header("Location: login.html");
        exit();
    } else {
        // Displaying error message if query execution fails
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Closing database connection
$connection->close();
?>
