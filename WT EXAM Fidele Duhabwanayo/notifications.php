<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications Page</title>
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
      color: white;
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
      font-family: "Times New Roman";
      font-size: 26px;
    }

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
    <header>
        <nav>
            <ul>
                <li><a href="home.html">Home</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="services.html">Our Services</a></li>
                <li><a href="contact.html">Contact Us</a></li>
                <li class="dropdown">
                    <a href="forms_and_tables.html">Forms & Table</a>
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
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section>
        <h1>Notifications Form</h1>
        <form method="post" action="notifications.php">
            <label for="NotificationsID">NotificationsID</label>
            <input type="number" id="NotificationsID" name="NotificationsID" required><br><br>

            <label for="UserID">UserID</label>
            <input type="text" id="UserID" name="UserID" required><br><br>

            <label for="Message">Message</label>
            <input type="text" id="Message" name="Message" required><br><br>

            <label for="IsRead">IsRead</label>
            <input type="text" id="IsRead" name="IsRead" required><br><br>

            <label for="NotificationDate">NotificationDate</label>
            <input type="date" id="NotificationDate" name="NotificationDate" required><br><br>

            <input type="submit" name="add" value="Insert"><br><br><br><br>
        </form>

        <?php
        include('Database_connection.php');

        if (isset($_POST['add'])) {
            // Prepare and bind the parameters
            $stmt = $connection->prepare("INSERT INTO notifications (NotificationsID, UserID, Message, IsRead, NotificationDate) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("iissd", $NotificationsID, $UserID, $Message, $IsRead, $NotificationDate);

            // Set parameters and execute
            $NotificationsID = $_POST['NotificationsID'];
            $UserID = $_POST['UserID'];
            $Message = $_POST['Message'];
            $IsRead = $_POST['IsRead'];
            $NotificationDate = $_POST['NotificationDate'];

            if ($stmt->execute()) {
                echo "New record has been added successfully";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        }
        ?>

        <?php
        // SQL query to fetch data from the notifications
        $sql = "SELECT * FROM notifications";
        $result = $connection->query($sql);
        ?>

        <h1><u>Notifications Table</u></h1>
        <table border="2">
            <tr>
                <th>NotificationID</th>
                <th>UserID</th>
                <th>Message</th>
                <th>IsRead</th>
                <th>NotificationDate</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
            <?php
            // Check if connection was successful
            if ($result === false) {
                echo "Error: " . $connection->error;
            } else {
                // Check if there are any notifications
                if ($result->num_rows > 0) {
                    // Output data for each row
                    while ($row = $result->fetch_assoc()) {
                        $NotificationsID = $row['NotificationsID'];
                        echo "<tr>
                            <td>" . $row['NotificationsID'] . "</td>
                            <td>" . $row['UserID'] . "</td>
                            <td>" . $row['Message'] . "</td>
                            <td>" . $row['IsRead'] . "</td>
                            <td>" . $row['NotificationDate'] . "</td>
                            <td><a style='padding:4px' href='delete_notifications.php?NotificationsID=$NotificationsID'>Delete</a></td>
                            <td><a style='padding:4px' href='update_notifications.php?NotificationsID=$NotificationsID'>Update</a></td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No data found</td></tr>";
                }
            }
            // Close the database connection
            $connection->close();
            ?>
        </table><br><br><br>
        <a href="home.html">Go Back to Home</a><br>
    </section>

    <footer>
        <b><h2><marquee><i>UR CBE BIT &copy, 2024 &reg, Designed by: @Fidele DUHABWANAYO 222003029</i></marquee></h2></b>
    </footer>
</body>
</html>
