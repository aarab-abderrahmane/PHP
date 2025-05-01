<?php
session_start();

// Check if user is already logged in
if (isset($_SESSION['matricule'])) {
    header("Location: accueil.php");
    exit();
}

// Database connection
$host = "localhost";
$username = "root";
$password = "";
$dbname = "insurance_db";

$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_error($conn));
}

$error_message = "";

// Process login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matricule = $_POST['matricule'];
    $mot_depasse = $_POST['mot_depasse'];
    
    // Validate user credentials
    $sql = "SELECT * FROM Assure WHERE matricule = '$matricule' AND mot_depasse = '$mot_depasse'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) == 1) {
        // Login successful
        $row = mysqli_fetch_assoc($result);
        $_SESSION['matricule'] = $row['matricule'];
        $_SESSION['nom'] = $row['nom_ass'];
        $_SESSION['prenom'] = $row['prenom_ass'];
        
        // Redirect to home page
        header("Location: accueil.php");
        exit();
    } else {
        $error_message = "Matricule ou mot de passe incorrect";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Système d'Information - Authentification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 400px;
            margin: 100px auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Authentification Assuré</h2>
        
        <?php if (!empty($error_message)): ?>
            <div class="error"><?php echo $error_message; ?></div>
        <?php endif; ?>
        
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="matricule">Matricule:</label>
                <input type="text" id="matricule" name="matricule" required>
            </div>
            
            <div class="form-group">
                <label for="mot_depasse">Mot de passe:</label>
                <input type="password" id="mot_depasse" name="mot_depasse" required>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn">Se connecter</button>
            </div>
        </form>
    </div>
</body>
</html>