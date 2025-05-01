<?php
// afficher_dossier.php - Display detailed information about a selected dossier
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

// Get dossier data with maladie information
$sql = "SELECT d.*, m.designation_maladie 
        FROM Dossier d 
        JOIN Maladie m ON d.num_maladie = m.num_maladie
        WHERE d.numdossier = '$dossier_id' AND d.matricule = '$matricule'";
$result = mysqli_query($conn, $sql);

// Check if dossier exists and belongs to the logged-in user
if (mysqli_num_rows($result) != 1) {
    header("Location: miseajour_dossier.php");
    exit();
}

$dossier = mysqli_fetch_assoc($result);

// Get rubriques for this dossier
$sql = "SELECT * FROM Rubrique WHERE numdossier = '$dossier_id'";
$rubriques_result = mysqli_query($conn, $sql);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Détails Dossier - Système d'Information Assurance</title>
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
        .info-section {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        .label {
            font-weight: bold;
            width: 200px;
            display: inline-block;
        }
        .info-item {
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .status {
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 3px;
            color: white;
            display: inline-block;
        }
        .status-pending {
            background-color: #ff9800;
        }
        .status-complete {
            background-color: #4CAF50;
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
        <h2>Détails du Dossier N° <?php echo $dossier_id; ?></h2>
        
        <div class="info-section">
            <h3>Informations générales</h3>
            <div class="info-item">
                <span class="label">Statut:</span>
                <?php if ($dossier['date_traitement']): ?>
                    <span class="status status-complete">Traité</span>
                <?php else: ?>
                    <span class="status status-pending">En cours de traitement</span>
                <?php endif; ?>
            </div>
            <div class="info-item">
                <span class="label">Numéro du dossier:</span> <?php echo $dossier['numdossier']; ?>
            </div>
            <div class="info-item">
                <span class="label">Date de dépôt:</span> <?php echo $dossier['datedepot']; ?>
            </div>
            <div class="info-item">
                <span class="label">Montant de remboursement:</span> <?php echo $dossier['montant_remboursement']; ?> DH
            </div>
            <div class="info-item">
                <span class="label">Date de traitement:</span> 
                <?php echo $dossier['date_traitement'] ? $dossier['date_traitement'] : 'En attente'; ?>
            </div>
        </div>
        
        <div class="info-section">
            <h3>Information sur la maladie</h3>
            <div class="info-item">
                <span class="label">Code maladie:</span> <?php echo $dossier['num_maladie']; ?>
            </div>
            <div class="info-item">
                <span class="label">Désignation:</span> <?php echo $dossier['designation_maladie']; ?>
            </div>
        </div>
        
        <div class="info-section">
            <h3>Rubriques associées</h3>
            <?php if (mysqli_num_rows($rubriques_result) > 0): ?>
                <table>
                    <tr>
                        <th>Code Rubrique</th>
                        <th>Nom Rubrique</th>
                        <th>Montant</th>
                    </tr>
                    <?php while ($row = mysqli_fetch_assoc($rubriques_result)): ?>
                        <tr>
                            <td><?php echo $row['numrubrique']; ?></td>
                            <td><?php echo $row['nom_rubrique']; ?></td>
                            <td><?php echo $row['montant_rubrique']; ?> DH</td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <p>Aucune rubrique associée à ce dossier.</p>
            <?php endif; ?>
        </div>
        
        <a href="miseajour_dossier.php" class="btn">Retour à la liste</a>
    </div>
</body>
</html>