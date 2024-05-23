<?php
include('dbconnection.php');

// Check if ScheduleID  is set
if(isset($_REQUEST['ScheduleID'])) {
    $ScheduleID = $_REQUEST['ScheduleID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $conn->prepare("DELETE FROM class_shedule WHERE ScheduleID=?");
    $stmt->bind_param("i", $ScheduleID);
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
    echo "<p>Deleting record with ScheduleID : $ScheduleID</p>";
    ?>

    <form method="post" onsubmit="return confirmDelete();">
        <input type="hidden" name="ScheduleID" value="<?php echo $ScheduleID; ?>">
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
    <a href="class_shedule.php" class="btn btn-primary" style="margin-top: 0px;">back to class_shedule</a>
</body>
</html>
<?php
    // Close the prepared statement
    $stmt->close();
} else {
    echo "ScheduleID is not set.";
}

// Close the database connection
$conn->close();
?>
