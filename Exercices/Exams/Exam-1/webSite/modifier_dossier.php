<?php
// modifier_dossier.php - Form to edit an existing dossier
session_start();

// Check if user is logged in
if (!isset($_SESSION['matricule'])) {
    header("Location: index.php");
    exit();
}

// Get user information
$matricule = $_SESSION['matricule'];

// Check if dossier ID is provided
if (!isset($_GET['id'])) {
    header("Location: miseajour_dossier.php");
    exit();
}

$dossier_id = $_GET['id'];

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

// Get dossier data
$sql = "SELECT * FROM Dossier WHERE numdossier = '$dossier_id' AND matricule = '$matricule'";
$result = mysqli_query($conn, $sql);

// Check if dossier exists and belongs to the logged-in user
if (mysqli_num_rows($result) != 1) {
    header("Location: miseajour_dossier.php");
    exit();
}

$dossier = mysqli_fetch_assoc($result);

$success_message = "";
$error_message = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $datedepot = $_POST['datedepot'];
    $montant_remboursement = $_POST['montant_remboursement'];
    $num_maladie = $_POST['num_maladie'];
    
    // Validate form data
    $valid = true;
    
    // Check if all required fields are filled
    if (empty($datedepot) || empty($montant_remboursement) || empty($num_maladie)) {
        $error_message = "Tous les champs sont obligatoires";
        $valid = false;
    }
    
    if ($valid) {
        // Update dossier
        $sql = "UPDATE Dossier 
                SET datedepot = '$datedepot', 
                    montant_remboursement = '$montant_remboursement', 
                    num_maladie = '$num_maladie', 
                    total_dossier = '$montant_remboursement'
                WHERE numdossier = '$dossier_id' AND matricule = '$matricule'";
        
        if (mysqli_query($conn, $sql)) {
            $success_message = "Dossier modifié avec succès";
            
            // Refresh dossier data
            $sql = "SELECT * FROM Dossier WHERE numdossier = '$dossier_id' AND matricule = '$matricule'";
            $result = mysqli_query($conn, $sql);
            $dossier = mysqli_fetch_assoc($result);
        } else {
            $error_message = "Erreur lors de la modification du dossier: " . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier Dossier - Système d'Information Assurance</title>
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
            margin-right: 10px;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .btn-back {
            background-color: #f44336;
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
        <a href="ajouter_dossier.php">Ajouter Dossier</a>
        <a class="active" href="miseajour_dossier.php">Gérer Dossiers</a>
        <a href="logout.php" class="logout">Déconnexion</a>
    </div>
    
    <div class="container">
        <h2>Modifier le dossier N° <?php echo $dossier_id; ?></h2>
        
        <?php if (!empty($success_message)): ?>
            <div class="success"><?php echo $success_message; ?></div>
        <?php endif; ?>
        
        <?php if (!empty($error_message)): ?>
            <div class="error"><?php echo $error_message; ?></div>
        <?php endif; ?>
        
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $dossier_id; ?>">
            <div class="form-group">
                <label for="datedepot">Date de dépôt (obligatoire):</label>
                <input type="date" id="datedepot" name="datedepot" required value="<?php echo $dossier['datedepot']; ?>">
            </div>
            
            <div class="form-group">
                <label for="montant_remboursement">Montant de remboursement (obligatoire):</label>
                <input type="number" step="0.01" id="montant_remboursement" name="montant_remboursement" required value="<?php echo $dossier['montant_remboursement']; ?>">
            </div>
            
            <div class="form-group">
                <label for="num_maladie">Maladie (obligatoire):</label>
                <select id="num_maladie" name="num_maladie" required>
                    <option value="">-- Sélectionner une maladie --</option>
                    <?php 
                    // Reset pointer to beginning of result set
                    mysqli_data_seek($maladies_result, 0);
                    while ($row = mysqli_fetch_assoc($maladies_result)): 
                    ?>
                        <option value="<?php echo $row['num_maladie']; ?>" <?php echo ($dossier['num_maladie'] == $row['num_maladie']) ? 'selected' : ''; ?>>
                            <?php echo $row['designation_maladie']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn">Enregistrer les modifications</button>
                <a href="miseajour_dossier.php" class="btn btn-back">Retour</a>
            </div>
        </form>
    </div>
</body>
</html>