<?php
include('dbconnection.php');

// Check if InstructorID is set
if(isset($_REQUEST['InstructorID'])) {
    $InstructorID = $_REQUEST['InstructorID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $conn->prepare("DELETE FROM instructors WHERE InstructorID=?");
    $stmt->bind_param("i", $InstructorID);
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
    echo "<p>Deleting record with InstructorID: $InstructorID</p>";
    ?>

    <form method="post" onsubmit="return confirmDelete();">
        <input type="hidden" name="InstructorID" value="<?php echo $InstructorID; ?>">
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
    <a href="instructors table.php" class="btn btn-primary" style="margin-top: 0px;">back to instructors</a>
</body>
</html>
<?php
    // Close the prepared statement
    $stmt->close();
} else {
    echo "InstructorID is not set.";
}

// Close the database connection
$conn->close();
?>
