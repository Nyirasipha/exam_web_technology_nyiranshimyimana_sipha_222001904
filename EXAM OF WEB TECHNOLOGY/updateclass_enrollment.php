<?php
include('dbconnection.php');

// Check if EnrollmentID is set
if (isset($_REQUEST['EnrollmentID'])) {
  $EnrollmentID = $_REQUEST['EnrollmentID'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $conn->prepare("SELECT * FROM class_enrollment WHERE EnrollmentID=?");
  $stmt->bind_param("i", $EnrollmentID);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $x = $row['EnrollmentID'];
    $y = $row['UserID '];
    $z = $row['ClassID'];
    $z = $row['EnrollmentDate'];
    
  } else {
    echo "class_enrollment not found.";
  }
}

$stmt->close(); // Close the statement after use

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update class_enrollment</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update class_enrollment form -->
    <h2><u>Update Form of class_enrollment</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
    <label for="EnrollmentDate">EnrollmentDate:</label>
    <input type="date" name="name" value="<?php echo isset($y) ? $y : ''; ?>">
    <br><br>


    <input type="submit" name="up" value="Update">

  </form>
   <a href="class_enrollment table.php" class="btn btn-primary" style="margin-top: 0px;">back to class_enrollment</a>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $EnrollmentDate= $_POST['EnrollmentDate'];
 
  // Update the class_enrollment in the database (prepared statement again for security)
  $stmt = $conn->prepare("UPDATE class_enrollment SET EnrollmentDate=? WHERE EnrollmentID=?");
  $stmt->bind_param("idsi", $EnrollmentDate,  $EnrollmentID);
  $stmt->execute();

  // Redirect to class_enrollment.php
  header('Location: class_enrollment table.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($conn);
?>