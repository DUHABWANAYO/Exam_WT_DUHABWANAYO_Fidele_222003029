<?php
// Connection details
include('Database_connection.php');

// Check if UserID is set and not empty
if(isset($_REQUEST['UserID']) && !empty($_REQUEST['UserID'])) {
    $UserID = $_REQUEST['UserID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM User WHERE UserID=?");
    
    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die("Error preparing statement: " . $connection->error);
    }
    
    // Bind parameters
    $stmt->bind_param("i", $UserID); // Assuming UserID is an integer
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "UserID is not set or empty.";
}

// Close the connection
$connection->close();
?>
