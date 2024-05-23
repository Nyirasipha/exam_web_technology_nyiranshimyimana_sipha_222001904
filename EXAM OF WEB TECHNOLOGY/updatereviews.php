<?php
include('dbconnection.php');

// Check if ReviewID is set
if (isset($_REQUEST['ReviewID'])) {
  $pid = $_REQUEST['ReviewID'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $conn->prepare("SELECT * FROM reviews WHERE ReviewID=?");
  $stmt->bind_param("i", $ReviewID);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $x = $row['ReviewID'];
    $y = $row['UserID'];
    $z = $row['InstructorID'];
    $z = $row['Rating'];
    $z = $row['Comment'];
    $z = $row['ReviewDate'];

  } else {
    echo "reviews not found.";
  }
}

$stmt->close(); // Close the statement after use

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update reviews</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update products form -->
    <h2><u>Update Form of reviews</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

    <label for="Rating">Rating:</label>
    <input type="text" name="name" value="<?php echo isset($z) ? $z : ''; ?>">
    <br><br>

    <label for="Comment">Comment:</label>
    <input type="text" name="tsk" value="<?php echo isset($t) ? $t : ''; ?>">
    <br><br>


    <input type="submit" name="up" value="Update">

  </form>
   <a href="reviews table.php" class="btn btn-primary" style="margin-top: 0px;">back to reviews</a>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $ReviewID = $_POST['ReviewID'];
  $UserID = $_POST['UserID'];
  $InstructorID = $_POST['InstructorID'];
  $Rating = $_POST['Rating'];
  $Comment = $_POST['Comment'];
  $ReviewDate = $_POST['ReviewDate'];



  // Update the reviews in the database (prepared statement again for security)
  $stmt = $conn->prepare("UPDATE reviews SET Rating=?, Comment=? WHERE ReviewID=?");
  $stmt->bind_param("ssi",  $Rating, $Comment,  $ReviewID );
  $stmt->execute();

  // Redirect to reviews.php
  header('Location: reviews table.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($conn);
?>