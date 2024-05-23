<?php
include('dbconnection.php');

// Check if PaymentID is set
if(isset($_REQUEST['PaymentID'])) {
    $PaymentID = $_REQUEST['PaymentID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $conn->prepare("DELETE FROM Payment WHERE PaymentID=?");
    $stmt->bind_param("i", $PaymentID);
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
    echo "<p>Deleting record with PaymentID: $PaymentID</p>";
    ?>

    <form method="post" onsubmit="return confirmDelete();">
        <input type="hidden" name="PaymentID" value="<?php echo $PaymentID; ?>">
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
    <a href="payment table.php" class="btn btn-primary" style="margin-top: 0px;">back to payment</a>
</body>
</html>
<?php
    // Close the prepared statement
    $stmt->close();
} else {
    echo "PaymentID is not set.";
}

// Close the database connection
$conn->close();
?>
