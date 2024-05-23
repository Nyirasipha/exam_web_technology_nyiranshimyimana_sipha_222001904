<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center"><u>users Form</u></h1>
        <form action="usertable.php" method="POST">
            <div class="form-group">
                <label for="UserID">UserID</label>
                <input type="number" class="form-control" name="UserID" uid="UserID">
            </div>
            <div class="form-group">
                <label for="UserName">UserName</label>
                <input type="text" class="form-control" name="UserName" id="UserName">
            </div>
            <div class="form-group">
                <label for="Email">Email</label>
                <input type="text" class="form-control" name="Email" id="Email">
            </div>
            <div class="form-group">
                <label for="Password">Password</label>
                <input type="text" class="form-control" name="Password" id="Password">
            </div>
            <div class="form-group">
                <label for="Age">Age</label>
                <input type="text" class="form-control" name="Age" id="Age">
            </div>
            <div class="form-group">
                <label for="Gender">Gender</label>
                <input type="text" class="form-control" name="Gender" id="Gender">
            </div>
            
            <button type="submit" class="btn btn-primary">INSERT</button>
        </form>
        <form action="home.html">
            <button type="submit" class="btn btn-secondary">BACK TO HOME</button>
        </form>
    </div>
    <footer class="text-center mt-5"><!-- Footer section -->
        <p>&copy; &reg; 2024 UR CBE BIT YEAR 2 @ nyirasipha</p><!-- Copyright and trademark notice -->
    </footer><!-- Footer section -->

    <!-- Bootstrap JS dependencies -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>