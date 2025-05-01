<?php
// ajouter_dossier.php - Form to add a new dossier
session_start();

// Check if user is logged in
if (!isset($_SESSION['matricule'])) {
    header("Location: index.php");
    exit();
}

// Get user information
$matricule = $_SESSION['matricule'];

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

// Get list of maladies for dropdown
$sql = "SELECT * FROM Maladie";
$maladies_result = mysqli_query($conn, $sql);

$success_message = "";
$error_message = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $numdossier = $_POST['numdossier'];
    $datedepot = $_POST['datedepot'];
    $montant_remboursement = $_POST['montant_remboursement'];
    $num_maladie = $_POST['num_maladie'];
    
    // Validate form data
    $valid = true;
    
    // Check if numdossier is integer
    if (!filter_var($numdossier, FILTER_VALIDATE_INT)) {
        $error_message = "Le numéro du dossier doit être un entier";
        $valid = false;
    }
    
    // Check if all required fields are filled
    if (empty($numdossier) || empty($datedepot) || empty($montant_remboursement) || empty($num_maladie)) {
        $error_message = "Tous les champs sont obligatoires";
        $valid = false;
    }
    
    // Check if dossier number already exists
    $check_sql = "SELECT * FROM Dossier WHERE numdossier = '$numdossier'";
    $check_result = mysqli_query($conn, $check_sql);
    if (mysqli_num_rows($check_result) > 0) {
        $error_message = "Ce numéro de dossier existe déjà";
        $valid = false;
    }
    
    if ($valid) {
        // Insert new dossier
        $sql = "INSERT INTO Dossier (numdossier, datedepot, montant_remboursement, lien_maladie, matricule, num_maladie, total_dossier) 
                VALUES ('$numdossier', '$datedepot', '$montant_remboursement', NULL, '$matricule', '$num_maladie', '$montant_remboursement')";
        
        if (mysqli_query($conn, $sql)) {
            $success_message = "Dossier ajouté avec succès";
            // Reset form
            $_POST = array();
        } else {
            $error_message = "Erreur lors de l'ajout du dossier: " . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter Dossier - Système d'Information Assurance</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .header {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            text-align: center;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .menu {
            background-color: #333;
            overflow: hidden;
        }
        .menu a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        .menu a:hover {
            background-color: #ddd;
            color: black;
        }
        .menu a.active {
            background-color: #4CAF50;
            color: white;
        }
        .menu a.logout {
            float: right;
            background-color: #f44336;
        }
        h2 {
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
        input[type="text"], input[type="date"], input[type="number"], select {
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
        }
        .btn:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
        .success {
            color: green;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Système d'Information Assurance</h1>
    </div>
    
    <div class="menu">
        <a href="accueil.php">Accueil</a>
        <a class="active" href="ajouter_dossier.php">Ajouter Dossier</a>
        <a href="miseajour_dossier.php">Gérer Dossiers</a>
        <a href="logout.php" class="logout">Déconnexion</a>
    </div>
    
    <div class="container">
        <h2>Ajouter un nouveau dossier</h2>
        
        <?php if (!empty($success_message)): ?>
            <div class="success"><?php echo $success_message; ?></div>
        <?php endif; ?>
        
        <?php if (!empty($error_message)): ?>
            <div class="error"><?php echo $error_message; ?></div>
        <?php endif; ?>
        
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="numdossier">Numéro du dossier (entier):</label>
                <input type="number" id="numdossier" name="numdossier" required value="<?php echo isset($_POST['numdossier']) ? $_POST['numdossier'] : ''; ?>">
            </div>
            
            <div class="form-group">
                <label for="datedepot">Date de dépôt:</label>
                <input type="date" id="datedepot" name="datedepot" required value="<?php echo isset($_POST['datedepot']) ? $_POST['datedepot'] : date('Y-m-d'); ?>">
            </div>
            
            <div class="form-group">
                <label for="montant_remboursement">Montant de remboursement:</label>
                <input type="number" step="0.01" id="montant_remboursement" name="montant_remboursement" required value="<?php echo isset($_POST['montant_remboursement']) ? $_POST['montant_remboursement'] : ''; ?>">
            </div>
            
            <div class="form-group">
                <label for="num_maladie">Maladie:</label>
                <select id="num_maladie" name="num_maladie" required>
                    <option value="">-- Sélectionner une maladie --</option>
                    <?php while ($row = mysqli_fetch_assoc($maladies_result)): ?>
                        <option value="<?php echo $row['num_maladie']; ?>" <?php echo (isset($_POST['num_maladie']) && $_POST['num_maladie'] == $row['num_maladie']) ? 'selected' : ''; ?>>
                            <?php echo $row['designation_maladie']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn">Ajouter Dossier</button>
            </div>
        </form>
    </div>
</body>
</html>