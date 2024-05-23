<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <link rel="stylesheet" type="text/css" href="./styles.css" title="style1" media="screen,tv,print,handheld"/>
    <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color: blue;
      text-decoration: none;
      margin-right: 55px;
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
      margin-left: 15px; 
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1300px; 

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
 .search-button {
    background-color: yellow;
}
  </style>
  <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
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
  <h1>User Form</h1>
  <form method="post" action="user.php">
    <label for="UserID">UserID</label>
    <input type="number" id="UserID" name="UserID"><br><br>

    <label for="firstname">Firstname</label>
    <input type="text" id="firstname" name="firstname" required><br><br>

    <label for="lastname">Last Name</label>
    <input type="text" id="lastname" name="lastname" required><br><br>

    <label for="username">Username</label>
    <input type="text" id="username" name="username" required><br><br>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="telephone">Telephone</label>
    <input type="text" id="telephone" name="telephone"><br><br>

    <label for="password">Password</label>
    <input type="password" id="password" name="password" required><br><br>

    <label for="creationdate">Creation Date</label>
    <input type="date" id="creationdate" name="creationdate" required><br><br>

    <label for="activation_code">Activation Code</label>
    <input type="text" id="activation_code" name="activation_code" required><br><br>

    <label for="Is_activated">Is Activated</label>
    <input type="text" id="Is_activated" name="Is_activated" required><br><br>

    <input type="submit" name="add" value="Insert"><br><br><br><br>
  </form>



<?php
include('Database_connection.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO user(UserID, firstname, lastname, username, email, telephone, password, creationdate, activation_code, is_activated) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssisssss", $UserID, $firstname, $lastname, $username, $email, $telephone, $password, $creationdate, $activation_code, $is_activated);

    // Set parameters and execute
    $UserID = $_POST['UserID'];
    $Firstname = $_POST['firstname'];
    $Lastname = $_POST['lastname'];
    $Username = $_POST['username'];
    $Email = $_POST['email'];
    $Telephone = $_POST['telephone'];
    $Password = $_POST['password'];
    $Creationdate = $_POST['creationdate'];
    $Activation_code = $_POST['activation_code'];
    $Is_activated = $_POST['Is_activated'];
  
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
// SQL query to fetch data from the Students
$sql = "SELECT * FROM user";
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail user</title>
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
    <center><h1><u>User Table</u></h1></center>
        <table border="1">
            <tr>
                <th>UserID</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Username</th>
                <th>Email</th>
                <th>Telephone</th>
                <th>Password</th>
                <th>Creationdate</th>
                <th>Activation_code</th>
                <th>Is_activated</th>
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
                $UserID = $row['UserID']; // Fetch the UserID
                echo "<tr>
                    <td>" . $row['UserID'] . "</td>
                    <td>" . $row['firstname'] . "</td>
                    <td>" . $row['lastname'] . "</td>
                    <td>" . $row['username'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td>" . $row['telephone'] . "</td>
                    <td>" . $row['password'] . "</td>
                    <td>" . $row['creationdate'] . "</td>
                    <td>" . $row['activation_code'] . "</td>
                    <td>" . $row['is_activated'] . "</td>
                    <td><a style='padding:4px' href='Delete_User.php?UserID=$UserID'>Delete</a></td> 
                    <td><a style='padding:4px' href='Update_User.php?UserID=$UserID'>Update</a></td> 
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
    <b><h2><marquee><i>UR CBE BIT &copy 2024 &reg Designed by: @Fidele DUHABWANAYO 222003029</i></marquee></h2></b>
  </center>
</footer>
</body>
</html>
