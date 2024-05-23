<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "virtualfitnessclassplatform";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
if(isset($_GET['query'])) {
    // Sanitize input to prevent SQL injection
    $searchTerm = $conn->real_escape_string($_GET['query']);

    // Queries for different tables
    $queries = [
        'classes' => "SELECT classID FROM classes WHERE classID LIKE '%$searchTerm%'",
        'payments' => "SELECT paymentID FROM payments WHERE paymentID LIKE '%$searchTerm%'",
        'register' => "SELECT username FROM register WHERE username LIKE '%$searchTerm%'",
        'instructors' => "SELECT instructorID FROM instructors WHERE instructorID LIKE '%$searchTerm%'",
        'user' => "SELECT userID FROM user WHERE userID LIKE '%$searchTerm%'",
        'classshedule' => "SELECT classsheduleID FROM classshedule WHERE classsheduleID LIKE '%$searchTerm%'",
        'Reviews' => "SELECT ReviewID FROM Reviews WHERE ReviewID LIKE '%$searchTerm%'",
        'Equipments' => "SELECT EquipmentID FROM Equipments WHERE EquipmentID LIKE '%$searchTerm%'",
        'Equipment_inventory' => "SELECT inventoryID FROM Equipment_inventory WHERE inventoryID LIKE '%$searchTerm%'",
        'Admins' => "SELECT AdminID FROM Admins WHERE AdminID LIKE '%$searchTerm%'",
       
    ];

    // Output search results
    echo "<style>
                h2 {
                    color: blue;
                    text-decoration: underline;
                }
                h3 {
                    color: green;
                }
                p {
                    color: black;
                }
          </style>";
    echo "<h2>Search Results:</h2>";

    foreach ($queries as $table => $sql) {
        $result = $conn->query($sql);
        echo "<h3>Table of $table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>"; // Dynamic field extraction from result
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    // Close the connection
    $conn->close();
} else {
    echo "<p>No search term was provided.</p>";
}
}
?>


