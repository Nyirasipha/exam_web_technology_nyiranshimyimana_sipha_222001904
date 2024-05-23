<?php
include('dbconnection.php');

// Initialize variables to avoid undefined index notice
$y = $z = $w = $s = $t = '';

// Check if PaymentID is set
if (isset($_REQUEST['PaymentID'])) {
    $PaymentID = $_REQUEST['PaymentID'];

    // Prepare statement with parameterized query to prevent SQL injection (security improvement)
    $stmt = $conn->prepare("SELECT * FROM Payment WHERE PaymentID=?");
    $stmt->bind_param("i", $PaymentID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['UserID'];
        $z = $row['Amount'];
        $w = $row['PaymentDate'];
    
    } else {
        echo "Payment not found.";
    }

    $stmt->close(); // Close the statement after use
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update payment</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record from payment?');
        }
    </script>
</head>
<body><center>
    <!-- Update payment form -->
    <h2><u>Update Form of payment</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

    <label for="userID">userID:</label>
        <input type="number" name="userID" value="<?php echo $s; ?>">
        <br><br>

        <label for="Amount">Amount:</label>
        <input type="text" name="Amount" value="<?php echo $w; ?>">
        <br><br>

        <label for="PaymentDate">PaymentDate:</label>
        <input type="date" name="PaymentDate" value="<?php echo $y; ?>">
        <br><br>


        <input type="hidden" name="PaymentID" value="<?php echo $payment_id; ?>">
        <input type="submit" name="up" value="Update">
    </form>
    <a href="Payment table.php" class="btn btn-primary" style="margin-top: 0px;">Back to Payment</a>
</body>
</html>

<?php
if (isset($_POST['up'])) {
    // Retrieve updated values from form
    $PaymentID = $_POST['PaymentID'];
    $userID = $_POST['userID'];
    $Amount = $_POST['Amount'];
    $PaymentDate = $_POST['PaymentDate'];

    // Update the Payment in the database (prepared statement again for security)
    $stmt = $conn->prepare("UPDATE Payment SET puserID=?, Amount=?, PaymentDate=? WHERE PaymentID=?");
    $stmt->bind_param("ssiii", $userID, $Amount, $PaymentDate, $PaymentID);
    $stmt->execute();

    // Redirect to payment_table.php
    header('Location: payment table.php');
    exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($conn);
?>
