<?php
include('dbconnection.php');

// Check if ScheduleID is set
if (isset($_REQUEST['ScheduleID'])) {
  $pid = $_REQUEST['ScheduleID'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $conn->prepare("SELECT * FROM class_shedule WHERE ScheduleID=?");
  $stmt->bind_param("i", $ScheduleID);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $x = $row['ScheduleID'];
    $y = $row['ClassID'];
    $z = $row['InstructorID'];
    $z = $row['StartTime'];
    $z = $row['EndTime'];

  } else {
    echo "class_shedule not found.";
  }
}

$stmt->close(); // Close the statement after use

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update class_shedule</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update products form -->
    <h2><u>Update Form of class_shedule</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

    <label for="StartTime">StartTime:</label>
    <input type="date" name="name" value="<?php echo isset($z) ? $z : ''; ?>">
    <br><br>

    <label for="EndTime">EndTime:</label>
    <input type="date" name="tsk" value="<?php echo isset($t) ? $t : ''; ?>">
    <br><br>

    <input type="submit" name="up" value="Update">

  </form>
   <a href="class_shedule table.php" class="btn btn-primary" style="margin-top: 0px;">back to class_shedule</a>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $ScheduleID = $_POST['ScheduleID'];
  $ClassID = $_POST['ClassID'];
  $InstructorID = $_POST['InstructorID'];
  $StartTime = $_POST['StartTime'];
  $EndTime = $_POST['EndTime'];



  // Update the class_shedule in the database (prepared statement again for security)
  $stmt = $conn->prepare("UPDATE class_shedule SET StartTime=?, EndTime=? WHERE ScheduleID=?");
  $stmt->bind_param("ssi",  $StartTime, $EndTime,$ScheduleID);
  $stmt->execute();

  // Redirect to class_shedule.php
  header('Location: class_shedule table.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($conn);
?>