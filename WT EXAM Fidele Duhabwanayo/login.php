<?php
/*
    
 <!-- Fidele Duhabwanayo        REG_NO:  222003029   -->
 <!-- cryptocurrency_exchange_platform-->


*/
// Include database connection file
require_once "database_connection.php";

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Retrieve form data
$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $connection->prepare("SELECT UserID FROM user WHERE email=? AND password=?");
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows > 0) {
    // User found, redirect to user home page
    session_start();
    $_SESSION['email'] = $email;
    header("Location: home.html");
    exit();
} else {
    // User not found, display error message
    echo "<script>alert('Wrong Email or Password, Please Verify Credentials');</script>";
    echo "<script>window.location.href = 'login.html';</script>";
}


$stmt->close();
$connection->close();
?>
