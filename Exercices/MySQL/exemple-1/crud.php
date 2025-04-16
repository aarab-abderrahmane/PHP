<?php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $age = $_POST['age'];


    //!more secure
    // Use prepared statement to prevent SQL injection
    // $sql = "INSERT INTO users (username, email, age) VALUES (?, ?, ?)";
    // $stmt = mysqli_prepare($conn, $sql);
    // mysqli_stmt_bind_param($stmt, "ssi", $username, $email, $age);
    // $result = mysqli_stmt_execute($stmt);
    // mysqli_stmt_close($stmt);


    //!not secure
    $sql = "INSERT INTO users (username,email,age) VALUES ('$username','$email','$age')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header('Location: index.php');
        exit();
    } else {
        echo 'Failed: ' . mysqli_error($conn);
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Add New User</h2>

        <form  method="POST" class="p-4 bg-white shadow rounded">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="github" class="form-label">Lien GitHub:</label>
                <input type="url" id="github" name="github" pattern="http://.{2,}" class="form-control">
                <!--
                *pattern 
                * the . means any character 
                * the * means 0 or more times
                * the + means 1 or more times 
                -->
                
           
            </div>

            <div class="mb-3">
                <label for="age" class="form-label">Age:</label>
                <input type="number" id="age" name="age" class="form-control" required>
            </div>

            <button type="submit" name="submit" class="btn btn-primary w-100">Add User</button>
        </form>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>