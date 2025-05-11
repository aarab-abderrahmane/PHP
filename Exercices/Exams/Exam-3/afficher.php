<?php

    include 'inc_connection.php';

    $query='SELECT * FROM Fournisseurs';
    $result = $conn->query($query);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        table{
            border-collapse: collapse;
            width: 100%;
            
        }
        table , th , td{
            border: 1px solid;
            padding: 10px;
        }
    </style>
</head>
<body>

        <table>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Email</th>
                <th>Tel</th>
                <th>Actions</th>
            </tr>
            
            <?php 
                $rows = $result->fetchAll(MYSQLI_NUM);

                if($result && count($rows)>0){
                    foreach ($rows as $row){

                        echo "
                            <tr>
                                <td>",$row['idFourn'],"</td>
                                <td>",$row['nomForun'],"</td>
                                <td>",$row['prenomFourn'],"</td>
                                <td>",$row['adrFourn'],"</td>
                                <td>",$row['emailFourn'],"</td>
                                <td>",$row['telFourn'],"</td>
                                <td>
                                    <a href='deleteFourn?",$row['idFourn'],"' >delete</a>
                                    <a href='editFourn?",$row['idFourn'],"' >delete</a>
                                </td>

                            </tr>
                        ";

                    }
                }else{
                        echo '<tr><td colspan=6 style="text-align:center">No data found!</td></tr>';
                }
            ?>
        </table>
        

</body>
</html>