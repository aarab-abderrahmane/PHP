 <?php

    try{

            $conn = new PDO('mysql:host=localhost;dbname=Ecole',"root","");
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $result = $conn->query("SELECT * FROM etudiant");


    }catch(PDOException $e){
        echo $e->getMessage();
    }



?> 


<?php
    
        // mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        // try{

        //     $conn = new mysqli('localhost','root',"",'Ecole');
        //     $result = $conn->query("SELECT * FROM etudiant");


        // }catch(mysqli_sql_exception $e){
        //     die($e->getMessage());
        // }
    
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>

        table{

            border: 1px solid black;
            border-spacing: 0;
            border-radius: 10px;
            overflow: hidden;
        }

        td,th{
            border: 1px solid black;
            padding: 10px;
        }
    </style>

</head>
<body>

    <h1>Liste de présence</h1>
    <table>
        <thead>
            <tr>
                <th>Code</th>
                <th>nom</th>
                <th>prenom</th>
                <th>age</th>
                <th>moyenne bac</th>
            </tr>
        </thead>
        <tbody>
            <?php

                if(!empty($result)){

                    foreach($result->fetchAll(PDO::FETCH_ASSOC) as $row){

                        echo "
                        
                            <tr>
                                <td>".$row['code_Etudiant']."</td>
                                <td>".$row['nom']."</td>
                                <td>".$row["prenom"]."</td>
                                <td>".$row['age']."</td>
                                <td>".$row['moyenne_bac']."</td>
                            </tr>
                        ";
                    }

                }


                // if($result->num_rows > 0){

                //     foreach($result->fetch_all(MYSQLI_ASSOC) as $row){

                //         echo "
                        
                //             <tr>
                //                 <td>".$row['code_Etudiant']."</td>
                //                 <td>".$row['nom']."</td>
                //                 <td>".$row["prenom"]."</td>
                //                 <td>".$row['age']."</td>
                //                 <td>".$row['moyenne_bac']."</td>
                //             </tr>
                //         ";
                //     }

                // }
            
            ?>
        </tbody>
    </table>

    
</body>
</html>