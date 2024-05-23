 <?php
    // Connection details
 
    $host = "localhost";
    $user = "root";
    $pass = "";
    $database = "cryptocurrency_exchange_platform";

    // Creating connection
    $connection = new mysqli($host, "root", "", "cryptocurrency_exchange_platform");

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
