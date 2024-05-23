<?php
include('dbconnection.php');

// Check if IventoryID is set
if (isset($_REQUEST['IventoryID'])) {
  $pid = $_REQUEST['IventoryID'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $conn->prepare("SELECT * FROM equipment_inventory WHERE IventoryID=?");
  $stmt->bind_param("i", $IventoryID);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $x = $row['IventoryID'];
    $y = $row['EquipmentID'];
    $z = $row['Quantity'];

  } else {
    echo "equipment_inventory not found.";
  }
}

$stmt->close(); // Close the statement after use

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update equipment_inventory</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update products form -->
    <h2><u>Update Form of equipment_inventory</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

    <label for="Quantity">Quantity:</label>
    <input type="text" name="name" value="<?php echo isset($z) ? $z : ''; ?>">
    <br><br>

    <label for="EquipmentID">EquipmentID:</label>
    <input type="number" name="tsk" value="<?php echo isset($t) ? $t : ''; ?>">
    <br><br>

    <input type="submit" name="up" value="Update">

  </form>
   <a href="equipment_inventory table.php" class="btn btn-primary" style="margin-top: 0px;">back to equipment_inventory</a>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $InventoryID = $_POST['InventoryID'];
  $EquipmentID = $_POST['EquipmentID'];
  $Quantity = $_POST['Quantity'];



  // Update the equipment_inventory in the database (prepared statement again for security)
  $stmt = $conn->prepare("UPDATE equipment_inventory SET EquipmentID=?, Quantity=? WHERE InventoryID=?");
  $stmt->bind_param("ssi",  $EquipmentID, $Quantity,$InventoryID);
  $stmt->execute();

  // Redirect to equipment_inventory.php
  header('Location: equipment_inventory table.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($conn);
?>