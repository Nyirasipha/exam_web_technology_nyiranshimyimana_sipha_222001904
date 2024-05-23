 <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>virtual fitness class platform</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        table {
            width: 100%;
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

        footer {
            height: 50px;
            text-align: center;
            padding: 25px;
            color: white;
            background-color: blue;
        }
    </style>
</head>
<body>

    <form class="d-flex" role="search" action="search.php">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
    <button class="btn btn-outline-success search-button" type="submit">Search</button>
</form>
    <div class="container">
        <h2 style="text-align: center; font-family: century; font-weight: bold;">virtual fitness class platform</h2>
        <h4 style="text-align: center; font-family: century; font-weight: bold;">LIST OF  ITEM IN OUR inventory</h4>
        <a href="equipment_inventory.html" class="btn btn-primary" style="margin-top: 0px;">New equipment_inventory</a>
        <a href="home.html" class="btn btn-secondary" style="margin-left: 100px;">Back Home</a>
        <table class="table table-bordered">
            <thead class="bg-warning">
                <tr>
                    <th>InventoryID</th>
                    <th>EquipmentID</th>
                    <th>Quantity</th>
                    <th>Delete</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Connection details
                $host = "localhost";
                $user = "root";
                $pass = "";
                $database = "virtualfitnessclassplatform";

                // Creating connection
                $connection = new mysqli($host, $user, $pass, $database);

                // Check connection
                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }

                // SQL query to fetch data from the payment table
                $sql = "SELECT * FROM equipment_inventory";
                $result = $connection->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['InventoryID'] . "</td>
                                <td>" . $row['EquipmentID'] . "</td>
                                <td>" . $row['Quantity'] . "</td>
                                <td><a href='deleteequipment_inventory.php?InventoryID=" . $row['InventoryID'] . "'>Delete</a></td>
                                <td><a href='updateequipment_inventory.php?InventoryID=" . $row['InventoryID'] . "'>UPDATE</a></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No data found</td></tr>";
                }
                // Close the database connection
                $connection->close();
                ?>
            </tbody>
        </table>
    </div>
    <footer><!-- Footer section -->
        <p>&copy; &reg; 2024 UR CBE BIT YEAR 2 @ nyirasipha</p><!-- Copyright and trademark notice -->
    </footer><!-- Footer section -->
</body>
</html>
