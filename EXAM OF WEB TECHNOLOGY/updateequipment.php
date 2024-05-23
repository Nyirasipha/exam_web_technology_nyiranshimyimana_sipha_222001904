<?php
include('dbconnection.php');

// Check if EquipmentID is set
if (isset($_REQUEST['EquipmentID '])) {
  $pid = $_REQUEST['EquipmentID '];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $conn->prepare("SELECT * FROM equipment WHERE EquipmentID =?");
  $stmt->bind_param("i", $EquipmentID );
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $x = $row['EquipmentID '];
    $y = $row['EquipmentName'];
    $z = $row['Description'];

  } else {
    echo "equipment not found.";
  }
}

$stmt->close(); // Close the statement after use

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update equipment</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update products form -->
    <h2><u>Update Form of equipment</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

    <label for="Description">Description:</label>
    <input type="text" name="name" value="<?php echo isset($z) ? $z : ''; ?>">
    <br><br>

    <input type="submit" name="up" value="Update">

  </form>
   <a href="equipment table.php" class="btn btn-primary" style="margin-top: 0px;">back to equipment</a>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $EquipmentID = $_POST['EquipmentID'];
  $EquipmentName = $_POST['EquipmentName'];
  $Description = $_POST['Description'];



  // Update the equipment in the database (prepared statement again for security)
  $stmt = $conn->prepare("UPDATE equipment SET Description=? WHERE EquipmentID=?");
  $stmt->bind_param("si",  $Description ,$EquipmentID);
  $stmt->execute();

  // Redirect to equipment.php
  header('Location: equipment table.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($conn);
?>