<?php
include('dbconnection.php');

// Check if InstructorID is set
if (isset($_REQUEST['InstructorID'])) {
  $InstructorID = $_REQUEST['InstructorID'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $conn->prepare("SELECT * FROM instructors WHERE InstructorID=?");
  $stmt->bind_param("i", $InstructorID);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $x = $row['InstructorID'];
    $y = $row['InstructorName '];
    $z = $row['Specialization'];
    
  } else {
    echo "instructors not found.";
  }
}

$stmt->close(); // Close the statement after use

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update instructors</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update instructors form -->
    <h2><u>Update Form of instructors</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
    <label for="InstructorName">InstructorName:</label>
    <input type="text" name="name" value="<?php echo isset($y) ? $y : ''; ?>">
    <br><br>

    <label for="Specialization">Specialization:</label>
    <input type="text" name="name" value="<?php echo isset($z) ? $z : ''; ?>">
    <br><br>

    

    <input type="submit" name="up" value="Update">

  </form>
   <a href="instructors table.php" class="btn btn-primary" style="margin-top: 0px;">back to instructors</a>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $InstructorName= $_POST['InstructorName'];
  $Specialization= $_POST['Specialization'];

 
  // Update the instructors in the database (prepared statement again for security)
  $stmt = $conn->prepare("UPDATE instructors SET InstructorName=?, Specialization=?, WHERE InstructorID=?");
  $stmt->bind_param("idsi", $InstructorName, $Specialization, $InstructorID);
  $stmt->execute();

  // Redirect to instructorst.php
  header('Location: instructors table.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($conn);
?>