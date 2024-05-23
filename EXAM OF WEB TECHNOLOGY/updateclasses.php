<?php
include('dbconnection.php');

// Check if ClassID is set
if (isset($_REQUEST['ClassID'])) {
  $pid = $_REQUEST['ClassID'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $conn->prepare("SELECT * FROM class WHERE ClassID=?");
  $stmt->bind_param("i", $ClassID);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $x = $row['ClassID'];
    $y = $row['ClassName'];
    $z = $row['Discription'];
    $z = $row['Duration'];
    $z = $row['Difficulty'];

  } else {
    echo "class not found.";
  }
}

$stmt->close(); // Close the statement after use

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update class</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update products form -->
    <h2><u>Update Form of class</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

    <label for="ClassName">ClassName:</label>
    <input type="text" name="name" value="<?php echo isset($z) ? $z : ''; ?>">
    <br><br>

    <label for="Discription">Discription:</label>
    <input type="text" name="tsk" value="<?php echo isset($t) ? $t : ''; ?>">
    <br><br>

    <label for="Duration">Duration:</label>
    <input type="date" name="tsk" value="<?php echo isset($t) ? $t : ''; ?>">
    <br><br>

    <label for="Difficulty">Difficulty:</label>
    <input type="text" name="tsk" value="<?php echo isset($t) ? $t : ''; ?>">
    <br><br>


    <input type="submit" name="up" value="Update">

  </form>
   <a href="class table.php" class="btn btn-primary" style="margin-top: 0px;">back to class</a>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $ClassID = $_POST['ClassID'];
  $ClassName = $_POST['ClassName'];
  $Discription = $_POST['Discription'];
  $Duration = $_POST['Duration'];
  $Difficulty = $_POST['Difficulty'];



  // Update the class_shedule in the database (prepared statement again for security)
  $stmt = $conn->prepare("UPDATE class SET ClassName=?, Discription=?,Duration=?,Difficulty=?  WHERE ClassID=?");
  $stmt->bind_param("ssiii",  $ClassName, $Discription, $Duration, $Difficulty, $ClassID );
  $stmt->execute();

  // Redirect to class.php
  header('Location: class table.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($conn);
?>