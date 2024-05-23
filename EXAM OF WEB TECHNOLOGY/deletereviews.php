<?php
include('dbconnection.php');

// Check if ReviewID  is set
if(isset($_REQUEST['ReviewID '])) {
    $ReviewID  = $_REQUEST['ReviewID '];
    
    // Prepare and execute the DELETE statement
    $stmt = $conn->prepare("DELETE FROM reviews WHERE ReviewID =?");
    $stmt->bind_param("i", $ReviewID );
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
    echo "<p>Deleting record with ReviewID  : $ReviewID </p>";
    ?>

    <form method="post" onsubmit="return confirmDelete();">
        <input type="hidden" name="ReviewID " value="<?php echo $ReviewID ; ?>">
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
    <a href="reviews.php" class="btn btn-primary" style="margin-top: 0px;">back to reviews</a>
</body>
</html>
<?php
    // Close the prepared statement
    $stmt->close();
} else {
    echo "ReviewID  is not set.";
}

// Close the database connection
$conn->close();
?>