<?php
// accueil.php - Home page after login
session_start();

// Check if user is logged in
if (!isset($_SESSION['matricule'])) {
    header("Location: index.php");
    exit();
}

// Get user information
$matricule = $_SESSION['matricule'];
$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];

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

// Get user's data
$sql = "SELECT * FROM Assure WHERE matricule = '$matricule'";
$result = mysqli_query($conn, $sql);
$user_data = mysqli_fetch_assoc($result);

// Get user's dossiers
$sql = "SELECT * FROM Dossier WHERE matricule = '$matricule'";
$dossiers_result = mysqli_query($conn, $sql);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Accueil - Système d'Information Assurance</title>
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
    </style>
</head>
<body>
    <div class="header">
        <h1>Système d'Information Assurance</h1>
    </div>
    
    <div class="menu">
        <a class="active" href="accueil.php">Accueil</a>
        <a href="ajouter_dossier.php">Ajouter Dossier</a>
        <a href="miseajour_dossier.php">Gérer Dossiers</a>
        <a href="logout.php" class="logout">Déconnexion</a>
    </div>
    
    <div class="container">
        <h2>Bienvenue, <?php echo $prenom . ' ' . $nom; ?></h2>
        
        <div class="info-section">
            <h3>Vos informations personnelles</h3>
            <p><strong>Matricule:</strong> <?php echo $user_data['matricule']; ?></p>
            <p><strong>Nom:</strong> <?php echo $user_data['nom_ass']; ?></p>
            <p><strong>Prénom:</strong> <?php echo $user_data['prenom_ass']; ?></p>
            <p><strong>Date de naissance:</strong> <?php echo $user_data['date_naissance']; ?></p>
            <p><strong>Situation familiale:</strong> <?php echo $user_data['situation_familiale']; ?></p>
            <p><strong>Nombre d'enfants:</strong> <?php echo $user_data['nb_enfant']; ?></p>
            <p><strong>Total remboursement:</strong> <?php echo $user_data['total_remb']; ?> DH</p>
        </div>
        
        <div class="info-section">
            <h3>Vos dossiers</h3>
            <?php if (mysqli_num_rows($dossiers_result) > 0): ?>
                <table>
                    <tr>
                        <th>N° Dossier</th>
                        <th>Date de dépôt</th>
                        <th>Montant</th>
                        <th>Date de traitement</th>
                        <th>Statut</th>
                    </tr>
                    <?php while ($row = mysqli_fetch_assoc($dossiers_result)): ?>
                        <tr>
                            <td><?php echo $row['numdossier']; ?></td>
                            <td><?php echo $row['datedepot']; ?></td>
                            <td><?php echo $row['montant_remboursement']; ?> DH</td>
                            <td><?php echo $row['date_traitement'] ? $row['date_traitement'] : 'En attente'; ?></td>
                            <td>
                                <?php 
                                    if ($row['date_traitement']) {
                                        echo 'Traité';
                                    } else {
                                        echo 'En cours de traitement';
                                    }
                                ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <p>Vous n'avez pas encore de dossiers.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>