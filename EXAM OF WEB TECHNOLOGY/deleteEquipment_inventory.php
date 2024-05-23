<?php
include('dbconnection.php');

// Check if InventoyID is set
if(isset($_REQUEST['InventoyID'])) {
    $InventoyID = $_REQUEST['InventoyID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $conn->prepare("DELETE FROM equipment_inventoy WHERE InventoyID=?");
    $stmt->bind_param("i", $InventoyID);
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
    echo "<p>Deleting record with InventoyID : $InventoyID</p>";
    ?>

    <form method="post" onsubmit="return confirmDelete();">
        <input type="hidden" name="InventoyID" value="<?php echo $InventoyID; ?>">
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
    <a href="equipment_inventoy.php" class="btn btn-primary" style="margin-top: 0px;">back to equipment_inventoy</a>
</body>
</html>
<?php
    // Close the prepared statement
    $stmt->close();
} else {
    echo "InventoyID is not set.";
}

// Close the database connection
$conn->close();
?>
