<?php
// miseajour_dossier.php - Page to list, delete, and select dossiers
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

$success_message = "";
$error_message = "";

// Handle Delete action
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Confirm with JavaScript before deleting
    echo "<script>
        if (confirm('Êtes-vous sûr de vouloir supprimer ce dossier?')) {
            window.location.href = 'miseajour_dossier.php?confirm_delete=1&id=" . $id . "';
        } else {
            window.location.href = 'miseajour_dossier.php';
        }
    </script>";
}

// Confirm Delete
if (isset($_GET['confirm_delete']) && $_GET['confirm_delete'] == '1' && isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Delete the dossier
    $sql = "DELETE FROM Dossier WHERE numdossier = '$id' AND matricule = '$matricule'";
    
    if (mysqli_query($conn, $sql)) {
        $success_message = "Dossier supprimé avec succès";
    } else {
        $error_message = "Erreur lors de la suppression du dossier: " . mysqli_error($conn);
    }
}

// Get all dossiers for this user
$sql = "SELECT d.*, m.designation_maladie 
        FROM Dossier d 
        JOIN Maladie m ON d.num_maladie = m.num_maladie 
        WHERE d.matricule = '$matricule'";
$result = mysqli_query($conn, $sql);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gérer Dossiers - Système d'Information Assurance</title>
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
        .success {
            color: green;
            margin-bottom: 15px;
        }
        .error {
            color: red;
            margin-bottom: 15px;
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
        .action-buttons a {
            display: inline-block;
            padding: 5px 10px;
            margin: 2px;
            border-radius: 3px;
            text-decoration: none;
            color: white;
        }
        .edit-btn {
            background-color: #2196F3;
        }
        .delete-btn {
            background-color: #f44336;
        }
        .view-btn {
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
        <h2>Liste des Dossiers</h2>
        
        <?php if (!empty($success_message)): ?>
            <div class="success"><?php echo $success_message; ?></div>
        <?php endif; ?>
        
        <?php if (!empty($error_message)): ?>
            <div class="error"><?php echo $error_message; ?></div>
        <?php endif; ?>
        
        <?php if (mysqli_num_rows($result) > 0): ?>
            <table>
                <tr>
                    <th>N° Dossier</th>
                    <th>Date de dépôt</th>
                    <th>Maladie</th>
                    <th>Montant</th>
                    <th>Date de traitement</th>
                    <th>Actions</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['numdossier']; ?></td>
                        <td><?php echo $row['datedepot']; ?></td>
                        <td><?php echo $row['designation_maladie']; ?></td>
                        <td><?php echo $row['montant_remboursement']; ?> DH</td>
                        <td><?php echo $row['date_traitement'] ? $row['date_traitement'] : 'En attente'; ?></td>
                        <td class="action-buttons">
                            <a href="modifier_dossier.php?id=<?php echo $row['numdossier']; ?>" class="edit-btn">Modifier</a>
                            <a href="miseajour_dossier.php?action=delete&id=<?php echo $row['numdossier']; ?>" class="delete-btn">Supprimer</a>
                            <a href="afficher_dossier.php?id=<?php echo $row['numdossier']; ?>" class="view-btn">Sélectionner</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>Aucun dossier trouvé.</p>
        <?php endif; ?>
    </div>
</body>
</html>