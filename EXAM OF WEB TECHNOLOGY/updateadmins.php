<?php
include('dbconnection.php');

// Check if AdminID is set
if (isset($_REQUEST['AdminID'])) {
  $AdminID = $_REQUEST['AdminID'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $conn->prepare("SELECT * FROM admins WHERE AdminID=?");
  $stmt->bind_param("i", $AdminID);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $x = $row['AdminID'];
    $y = $row['AdminName '];
    $z = $row['Email'];
    $z = $row['Password'];
    
  } else {
    echo "admins not found.";
  }
}

$stmt->close(); // Close the statement after use

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update admins</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update admins form -->
    <h2><u>Update Form of admins</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
    <label for="AdminName">AdminName:</label>
    <input type="text" name="name" value="<?php echo isset($y) ? $y : ''; ?>">
    <br><br>

    <label for="Email">Email:</label>
    <input type="text" name="name" value="<?php echo isset($z) ? $z : ''; ?>">
    <br><br>

    <label for="Password">Password:</label>
    <input type="text" name="name" value="<?php echo isset($z) ? $z : ''; ?>">
    <br><br>

    

    <input type="submit" name="up" value="Update">

  </form>
   <a href="admins table.php" class="btn btn-primary" style="margin-top: 0px;">back to admins</a>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $AdminName= $_POST['AdminName'];
  $Email= $_POST['Email'];
  $Password= $_POST['Password'];

 
  // Update the admins in the database (prepared statement again for security)
  $stmt = $conn->prepare("UPDATE admins SET AdminName=?, Email=?, Password=? WHERE AdminID=?");
  $stmt->bind_param("idsii", $AdminName, $Email, $password, $AdminID);
  $stmt->execute();

  // Redirect to admins.php
  header('Location: admins table.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($conn);
?>