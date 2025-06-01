<?php
    
    // mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    include 'connection-db.php';
    $result = $conn->query('SELECT * FROM stagiaires');


    if($_SERVER['REQUEST_METHOD']==="POST"){
        $code = $_POST['code'] ?? "";
        if(!empty($code)){

            $conn->query("DELETE FROM stagiaires WHERE code = $code");
            header('Location: '.$_SERVER['PHP_SELF']);
            

        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <div class="container">
        <?php
            if($result->num_rows > 0){

                $result = $result->fetch_all(MYSQLI_ASSOC);
                foreach($result as $row){
                    echo "
                        <div>
                            <p><b>code : </b>".$row['code']."</p>
                            <p><b>code : </b>".$row['nom']."</p>
                            <p><b>code : </b>".$row['prenom']."</p>
                            <p><b>code : </b>".$row['sexe']."</p>
                            <p><b>code : </b>".$row['filiere']."</p>
                            <form method='post'>
                            <input type='hidden'name='code' value=".$row['code'].">
                            <button >supprimer</button>
                            </from>
                        </div>
                    ";
                }

            }
        
        ?>
    </div>
    
</body>
</html>