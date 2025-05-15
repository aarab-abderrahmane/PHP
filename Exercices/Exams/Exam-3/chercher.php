<?php

    include 'inc_connection.php';

    if($_SERVER['REQUEST_METHOD']==="POST"){
            $input = isset($_POST['search']) ? htmlspecialchars($_POST['search']) : '';
            $column_name = $_POST['filter'];
            $result = '';
            if(!empty($input)){

                $query = "SELECT * FROM Fournisseurs 
                        WHERE $column_name LIKE '%$input%'";
                $stmt = $conn->query($query);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>

        *{
            font-family: monospace;

        }
        body{
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        form{
            display: flex;
            border: 1px solid gray;
            border-radius: 10px;

            
        }
        form > * {
            padding: 15px;
            border: 1px solid gray;
            outline: none;
            
        }
        form > input:first-of-type {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
            width: 20vw;
            
        }

        form>button:last-of-type{
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
            transition: background-color 1s ease;
        }

        button[type='submit']:hover{
            background-color: green;
        }

        table{
            border-collapse: collapse;
            width: 60vw;
        }
        th,td{
            border-left: 1px solid black;
            padding: 5px;
            text-align: center;
        }

        .last-column{
            border-right: 1px solid black;
        }

        .container{
            display: flex;
            flex-direction: column;
            align-items: center;gap:40px        }

    </style>
</head>
<body>

        <div class="container">
            <form method="post">
                <input type="text" name="search" placeholder="search">
                <select name="filter">
                    <option value="idFourn">id</option>
                    <option value="nomFourn">name</option>
                    <option value="prenomFourn">prenom</option>
                    <option value="emailFourn">email</option>
                    <option value="adrFourn">adresse</option>
                </select>
                <button type="submit">search</button>
            </form>

            <div>

                <?php
                
                    if(!empty($result)){
                        echo "
                        
                            <table>

                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>adresse</th>
                                    <th>Email</th>
                                    <th class='last-column'>Tel</th>
                                </tr>

                                
                        ";
                        foreach($result as $row){
                            echo "
                                <tr>
                                    <td>".$row['idFourn']."</td>
                                    <td>".$row['nomFourn']."</td>
                                    <td>".$row['prenomFourn']."</td>
                                    <td>".$row['adrFourn']."</td>
                                    <td>".$row['emailFourn']."</td>
                                    <td class='last-column'>".$row['telFourn']."</td>
                                <tr>
                                    
                            ";
                        }

                        echo "</table>";
                        
                    }
                ?>

            </div>
        </div>

</body>
</html>