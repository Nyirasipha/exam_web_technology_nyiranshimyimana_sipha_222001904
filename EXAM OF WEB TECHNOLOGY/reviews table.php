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
        <h4 style="text-align: center; font-family: century; font-weight: bold;">LIST OF reviews IN OUR SYSTEM</h4>
        <a href="reviews form.php" class="btn btn-primary" style="margin-top: 10px;">New review</a>
        <a href="home.html" class="btn btn-secondary" style="margin-left: 10px;">Back Home</a>
        <table class="table table-bordered">
            <thead class="bg-warning">
                <tr>
                    <th>ReviewID</th>
                    <th>UserID</th>
                    <th>ClassID</th>
                    <th>InstructorID</th>
                    <th>Rating</th>
                    <th>Comment</th>
                    <th>ReviewDate</th>
                    <th>Delete</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Connection details
                include "dbconnection.php";

                // Establish connection
                $connection = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }

                // SQL query to fetch data from the review table
                $sql = "SELECT * FROM reviews";
                $result = $connection->query($sql);

                // Check if there are any reviews
                if ($result->num_rows > 0) {
                    // Output data for each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . $row['ReviewID'] . "</td>
                            <td>" . $row['UserID'] . "</td>
                            <td>" . $row['ClassID'] . "</td>
                            <td>" . $row['InstructorID'] . "</td>
                            <td>" . $row['Rating'] . "</td>
                            <td>" . $row['Comment'] . "</td>
                            <td>" . $row['ReviewDate'] . "</td>
                            <td><a style='padding:4px' href='deleteureviews.php?ReviewID={$row['ReviewID']}'>Delete</a></td>
                            <td><a style='padding:4px' href='updatereviewsr.php?ReviewID={$row['ReviewID']}'>Edit</a></td> 
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No data found</td></tr>";
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