<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deposit Page</title>
    <link rel="stylesheet" type="text/css" href="./styles.css" title="style1" media="screen,tv,print,handheld"/>
    <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color: blue;
      text-decoration: none;
      margin-right: 25px;
    }

    /* Visited link */
    a:visited {
      color: white;
    }
    /* Unvisited link */
    a:link {
      color: white; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: red;
    }

    /* Active link */
    a:active {
      background-color: white;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1300px; /* Adjust this value as needed */

      padding: 8px;
     
    }
    section{
    padding:10px;
    }
    header{
  background-color:yellow;
  padding: 50px;
}
    section{
    padding:82px;
    border-bottom: 1px solid #ddd;
}
footer{
    text-align: center;
    padding: 20px;
    background-color:yellow;
}
.search-button {
    background-color: yellow;
}

        body {
            background-color: yellowgreen;
            color: blue;
            font-family: Times New Roman;
            font-size: 26px;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <!-- Navigation links -->
                <li><a href="home.html">Home</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="services.html">Our Services</a></li>
                <li><a href="contact.html">Contact Us</a></li>
                <li class="dropdown"><!-- Dropdown menu -->
                    <a href="forms and tables.html">Forms & Table</a>
                    <div class="dropdown-content">
                        <a href="cryptocurrencies.php">Cryptocurrencies Table</a>
                        <a href="wallets.php">Wallets Table</a>
                        <a href="Trades.php">Trades Table</a>
                        <a href="marketdata.php">Market Data Table</a>
                        <a href="Deposits.php">Deposits Table</a>
                        <a href="withdrawals.php">Withdrawals Table</a>
                        <a href="tradehistory.php">TradeHistory Table</a>
                        <a href="notifications.php">Notifications Table</a>
                        <a href="login.html">User Form</a>                      
                        <a href="usersettings.php">UserSettings Table</a>
                    </div>
                </li>
                <li class="dropdown"><!-- Dropdown menu -->
                        <a href="logout.php">Logout</a>    
                    </div>
                </li>
            </ul>
        </nav>
    </header>


    

<section> 
  <h1>Deposit Form</h1>
  <form method="post" action="deposits.php">
    <label for="DepositID">DepositID</label>
    <input type="number" id="DepositID" name="DepositID"><br><br>

    <label for="UserID">UserID</label>
    <input type="number" id="UserID" name="UserID" required><br><br>

    <label for="Amount">Amount</label>
    <input type="text" id="Amount" name="Amount" required><br><br>

    <label for="DepositDate">DepositDate</label>
    <input type="Date" id="DepositDate" name="DepositDate" required><br><br>
    <input type="submit" name="add" value="Insert"><br><br><br><br>
  </form>



<?php
include('Database_connection.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO deposits(DepositID, UserID, Amount, DepositDate) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $DepositID, $UserID, $Amount, $DepositDate);

    // Set parameters and execute
    $DepositID = $_POST['DepositID'];
    $UserID = $_POST['UserID'];
    $Amount = $_POST['Amount'];
    $DepositDate = $_POST['DepositDate'];
    if ($stmt->execute()) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $connection->close();
}
?>


<?php
// Connection details
$host = "localhost";
$user = "root";
$pass = "";
$database = "cryptocurrency_exchange_platform";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
// SQL query to fetch data from the deposits
$sql = "SELECT * FROM deposits";
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information of deposits</title>
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body><center>
    <center><h1><u>Deposits Table</u></h1></center>
    <table border="2">
        <tr>
            <th>DepositID</th>
            <th>UserID</th>
            <th>Amount</th>
            <th>DepositDate</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Check if connection was successful
        if ($result === false) {
            echo "Error: " . $connection->error;
        } else {
            // Check if there are any user
            if ($result->num_rows > 0) {
                // Output data for each row
                while ($row = $result->fetch_assoc()) {
                    $DepositID = $row['DepositID']; // Fetch the DepositID
                    echo "<tr>
                        <td>" . $row['DepositID'] . "</td>
                        <td>" . $row['UserID'] . "</td>
                        <td>" . $row['Amount'] . "</td>
                        <td>" . $row['DepositDate'] . "</td>
                        
                        <td><a style='padding:4px' href='Delete_Deposits.php?DepositID=$DepositID'>Delete</a></td> 
                        <td><a style='padding:4px' href='Update_Deposits.php?DepositID=$DepositID'>Update</a></td> 
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No data found</td></tr>";
            }
        }
        // Close the database connection
        $connection->close();
        ?>
    </table><br><br><br>
    <a href="./home.html">Go Back to Home</a><br></center>
</body>
</section>

<footer>
  <center> 
    <b><h2><marquee><i>UR CBE BIT &copy, 2024 &reg, Designed by: @Fidele DUHABWANAYO 222003029</i></marquee></h2></b>
  </center>
</footer>
</body>
</html>
