<?php
include 'dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT  email FROM register WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Fetch the ID from the query result
        $row = $result->fetch_assoc();
        $UserID = $row['UserID'];

        // Store both username and ID in the session
        $_SESSION['UserID'] = $UserID;
        $_SESSION['username'] = $username;

        // Redirect to home.html
        header("Location: home.html");
        exit();
    } else {
        echo "Invalid username or password";
        exit;
    }
}

$conn->close();
?>
