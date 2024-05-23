<?php
include('dbconnection.php');

// Check if UserID is set
if (isset($_REQUEST['UserID'])) {
  $pid = $_REQUEST['UserID'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $conn->prepare("SELECT * FROM users WHERE UserID=?");
  $stmt->bind_param("i", $UserID);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $x = $row['UserID'];
    $y = $row['UserName'];
    $z = $row['Email'];
    $w = $row['Password'];
    $s = $row['Age'];
    $s = $row['Gender'];
  } else {
    echo "user not found.";
  }
}

$stmt->close(); // Close the statement after use

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update user</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update users form -->
    <h2><u>Update Form of user</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
    <label for="UserName">UserName:</label>
    <input type="text" name="UserName" value="<?php echo isset($y) ? $y : ''; ?>">
    <br><br>

    <label for="Email">Email:</label>
    <input type="text" name="Email" value="<?php echo isset($z) ? $z : ''; ?>">
    <br><br>

    <label for="Password">Passwordrole:</label>
    <input type="text" name="Password" value="<?php echo isset($w) ? $w : ''; ?>">
    <br><br>

    <label for="Age">Age:</label>
    <input type="number" name="Age" value="<?php echo isset($s) ? $s : ''; ?>">
    <br><br>
    <label for="Gender">Gender:</label>
    <input type="number" name="Gender" value="<?php echo isset($s) ? $s : ''; ?>">
    <br><br>

    <input type="submit" name="up" value="Update">

  </form>
   <a href="userstable.php" class="btn btn-primary" style="margin-top: 0px;">back to register</a>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $UserName = $_POST['UserName'];
  $Email = $_POST['Email'];
  $Password = $_POST['Password'];
  $Age = $_POST['Age'];
  $Gender = $_POST['Gender'];



  // Update the users in the database (prepared statement again for security)
  $stmt = $conn->prepare("UPDATE users SET UserName=?, Email=?, Password=?,Age=? ,Gender=? WHERE UserID=?");
  $stmt->bind_param("sssiii",$UserName, $Email, $Password, $Age,$Gender, $UserID);
  $stmt->execute();

  // Redirect to users.php
  header('Location: userstable.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($conn);
?>