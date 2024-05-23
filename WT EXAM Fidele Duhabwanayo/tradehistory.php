<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trade History</title>
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
            margin-left: 15px; 
            margin-top: 4px;
        }
        /* Extend margin left for search button */
        input.form-control {
            margin-left: 1300px;
            padding: 8px;
        }
        section {
            padding: 10px;
        }
        header {
            background-color: yellow;
            padding: 50px;
        }
        section {
            padding: 82px;
            border-bottom: 1px solid #ddd;
        }
        footer {
            text-align: center;
            padding: 20px;
            background-color: yellow;
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
                </li>
            </ul>
        </nav>
    </header>

    <section>
        <h1>Trade History Form</h1>
        <form method="post" action="tradehistory.php">
            <label for="HistoryID">HistoryID</label>
            <input type="number" id="HistoryID" name="HistoryID" required><br><br>

            <label for="TradeID">TradeID</label>
            <input type="text" id="TradeID" name="TradeID" required><br><br>

            <label for="UserID">UserID</label>
            <input type="text" id="UserID" name="UserID" required><br><br>

            <label for="CryptocurrencyID">CryptocurrencyID</label>
            <input type="text" id="CryptocurrencyID" name="CryptocurrencyID" required><br><br>

            <label for="TradeType">TradeType</label>
            <input type="text" id="TradeType" name="TradeType" required><br><br>

            <label for="Amount">Amount</label>
            <input type="text" id="Amount" name="Amount"><br><br>

            <label for="Price">Price</label>
            <input type="text" id="Price" name="Price" required><br><br>

            <label for="TradeDate">TradeDate</label>
            <input type="date" id="TradeDate" name="TradeDate" required><br><br>

            <input type="submit" name="add" value="Insert">
            <input type="submit" name="update" value="Update"><br><br><br><br>
        </form>

        <?php
        include('Database_connection.php');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['add'])) {
                // Prepare and bind the parameters for insert
                $stmt = $connection->prepare("INSERT INTO tradehistory (HistoryID, TradeID, UserID, CryptocurrencyID, TradeType, Amount, Price, TradeDate) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("isssssss", $HistoryID, $TradeID, $UserID, $CryptocurrencyID, $TradeType, $Amount, $Price, $TradeDate);

                // Set parameters and execute
                $HistoryID = $_POST['HistoryID'];
                $TradeID = $_POST['TradeID'];
                $UserID = $_POST['UserID'];
                $CryptocurrencyID = $_POST['CryptocurrencyID'];
                $TradeType = $_POST['TradeType'];
                $Amount = $_POST['Amount'];
                $Price = $_POST['Price'];
                $TradeDate = $_POST['TradeDate'];

                if ($stmt->execute()) {
                    echo "New record has been added successfully";
                } else {
                    echo "Error: " . $stmt->error;
                }
                $stmt->close();
            } elseif (isset($_POST['update'])) {
                // Prepare and bind the parameters for update
                $stmt = $connection->prepare("UPDATE tradehistory SET TradeID = ?, UserID = ?, CryptocurrencyID = ?, TradeType = ?, Amount = ?, Price = ?, TradeDate = ? WHERE HistoryID = ?");
                $stmt->bind_param("sssssssi", $TradeID, $UserID, $CryptocurrencyID, $TradeType, $Amount, $Price, $TradeDate, $HistoryID);

                // Set parameters and execute
                $HistoryID = $_POST['HistoryID'];
                $TradeID = $_POST['TradeID'];
                $UserID = $_POST['UserID'];
                $CryptocurrencyID = $_POST['CryptocurrencyID'];
                $TradeType = $_POST['TradeType'];
                $Amount = $_POST['Amount'];
                $Price = $_POST['Price'];
                $TradeDate = $_POST['TradeDate'];

                if ($stmt->execute()) {
                    echo "Record has been updated successfully";
                } else {
                    echo "Error: " . $stmt->error;
                }
                $stmt->close();
            }
        }
        ?>

        <?php
        // Connection details
        include('Database_connection.php');

        // Creating connection
        $connection = new mysqli($host, $user, $pass, $database);

        // Check connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        // SQL query to fetch data from the tradehistory table
        $sql = "SELECT * FROM tradehistory";
        $result = $connection->query($sql);
        ?>

        <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Detail information of tradehistory</title>
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
        <body>
            <center>
                <h1><u>Trade History Table</u></h1>
                <table border="2">
                    <tr>
                        <th>HistoryID</th>
                        <th>TradeID</th>
                        <th>UserID</th>
                        <th>CryptocurrencyID</th>
                        <th>TradeType</th>
                        <th>Amount</th>
                        <th>Price</th>
                        <th>TradeDate</th>
                        <th>Delete</th>
                        <th>Update</th>
                    </tr>
                    <?php
                    // Check if there are any records
                    if ($result->num_rows > 0) {
                        // Output data for each row
                        while ($row = $result->fetch_assoc()) {
                            $HistoryID = $row['HistoryID'];
                            echo "<tr>
                                <td>" . $row['HistoryID'] . "</td>
                                <td>" . $row['TradeID'] . "</td>
                                <td>" . $row['UserID'] . "</td>
                                <td>" . $row['CryptocurrencyID'] . "</td>
                                <td>" . $row['TradeType'] . "</td>
                                <td>" . $row['Amount'] . "</td>
                                <td>" . $row['Price'] . "</td>
                                <td>" . $row['TradeDate'] . "</td>

                                <td><a style='padding:4px' href='Delete_tradehistory.php?HistoryID=$HistoryID'>Delete</a></td> 
                                <td><a style='padding:4px' href='Update_tradehistory.php?HistoryID=$HistoryID'>Update</a></td> 
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10'>No data found</td></tr>";
                    }

                    // Close the database connection
                    $connection->close();
                    ?>
                </table>
                <br><br><br>
                <a href="./home.html">Go Back to Home</a>
            </center>
        </body>
        </html>

    </section>

    <footer>
        <center> 
            <b><h2><marquee><i>UR CBE BIT &copy, 2024 &reg, Designed by: @Fidele DUHABWANAYO 222003029</i></marquee></h2></b>
        </center>
    </footer>
</body>
</html>
