<?php
include('dbconnection.php');

// Check if ClassID  is set
if(isset($_REQUEST['ClassID'])) {
    $ClassID = $_REQUEST['ClassID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $conn->prepare("DELETE FROM class WHERE ClassID=?");
    $stmt->bind_param("i", $ClassID);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Record</title>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>
</head>
<body>
    <?php
    // Display a message indicating which record will be deleted
    echo "<p>Deleting record with ClassID : $ClassID</p>";
    ?>

    <form method="post" onsubmit="return confirmDelete();">
        <input type="hidden" name="ClassID" value="<?php echo $ClassID; ?>">
        <input type="submit" value="Delete">
    </form>

    <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Execute the DELETE statement
        if ($stmt->execute()) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting data: " . $stmt->error;
        }
    }
    ?>
    <a href="class.php" class="btn btn-primary" style="margin-top: 0px;">back to class</a>
</body>
</html>
<?php
    // Close the prepared statement
    $stmt->close();
} else {
    echo "ClassID is not set.";
}

// Close the database connection
$conn->close();
?>