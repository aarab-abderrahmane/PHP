<?php

    include "database_connection.php";

    $sql = "SELECT hotel.*  ,typehotel.nombre_etoile
            FROM hotel
            JOIN typehotel ON hotel.id_type = typehotel.id_type";
    
    $result = mysqli_query($connection,$sql);


?>


<!DOCTYPE html>
<html>
<head>
    <title>Liste des Hôtels</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Liste des Hôtels</h1>
    <a href="ajouterH.php">Ajouter un nouvel hôtel</a>
    <br><br>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Adresse</th>
            <th>Prix par nuit</th>
            <th>Nombre d'étoiles</th>
            <th>Nombre de places</th>
            <th>Action</th>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["id_hotel"] . "</td>";
                echo "<td>" . $row["titre"] . "</td>";
                echo "<td>" . $row["adresse"] . "</td>";
                echo "<td>" . $row["prix_par_nuit"] . "</td>";
                echo "<td>" . $row["nombre_etoile"] . "</td>";
                echo "<td>" . $row["nombre_de_places"] . "</td>";
                echo "<td><a href='supprimerH.php?id=" . $row["id_hotel"] . "' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cet hôtel?\")'>Supprimer</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Aucun hôtel trouvé</td></tr>";
        }
        ?>
        
        
    </table>
</body>
</html>

<?php
mysqli_close($connection);
?>