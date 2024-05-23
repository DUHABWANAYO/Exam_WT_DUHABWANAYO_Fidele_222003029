<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cryptocurrencies Page</title>
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
        <h1>Cryptocurrencies Form</h1>
        <form method="post" action="cryptocurrencies.php">
            <label for="CryptocurrencyID">CryptocurrencyID</label>
            <input type="number" id="CryptocurrencyID" name="CryptocurrencyID"><br><br>

            <label for="Name">Name</label>
            <input type="text" id="Name" name="Name" required><br><br>

            <label for="Symbol">Symbol</label>
            <input type="text" id="Symbol" name="Symbol" required><br><br>

            <label for="Description">Description</label>
            <input type="text" id="Description" name="Description" required><br><br>

            <input type="submit" name="add" value="Insert"><br><br><br><br>
        </form>

        <?php
        include('Database_connection.php');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Prepare and bind the parameters
            $stmt = $connection->prepare("INSERT INTO cryptocurrencies(CryptocurrencyID, Name, Symbol, Description) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isss", $CryptocurrencyID, $Name, $Symbol, $Description);

            // Set parameters and execute
            $CryptocurrencyID = $_POST['CryptocurrencyID'];
            $Name = $_POST['Name'];
            $Symbol = $_POST['Symbol'];
            $Description = $_POST['Description'];
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
        // SQL query to fetch data from the cryptocurrencies
        $sql = "SELECT * FROM cryptocurrencies";
        $result = $connection->query($sql);
        ?>

        <h1><u>Cryptocurrencies Table</u></h1>
        <table border="2">
            <tr>
                <th>CryptocurrencyID</th>
                <th>Name</th>
                <th>Symbol</th>
                <th>Description</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
            <?php
            // Check if connection was successful
            if ($result === false) {
                echo "Error: " . $connection->error;
            } else {
                // Check if there are any records
                if ($result->num_rows > 0) {
                    // Output data for each row
                    while ($row = $result->fetch_assoc()) {
                        $CryptocurrencyID = $row['CryptocurrencyID'];
                        echo "<tr>
                            <td>" . $row['CryptocurrencyID'] . "</td>
                            <td>" . $row['Name'] . "</td>
                            <td>" . $row['Symbol'] . "</td>
                            <td>" . $row['Description'] . "</td>
                            <td><a style='padding:4px' href='Delete_Cryptocurrencies.php?CryptocurrencyID=$CryptocurrencyID'>Delete</a></td> 
                            <td><a style='padding:4px' href='Update_cryptocurrencies.php?CryptocurrencyID=$CryptocurrencyID'>Update</a></td> 
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No data found</td></tr>";
                }
            }
            // Close the database connection
            $connection->close();
            ?>
        </table>
        <br><br><br>
        <a href="./home.html">Go Back to Home</a><br>
    </section>

    <footer>
        <b><h2><marquee><i>UR CBE BIT &copy, 2024 &reg, Designed by: @Fidele DUHABWANAYO 222003029</i></marquee></h2></b>
    </footer>
</body>
</html>
