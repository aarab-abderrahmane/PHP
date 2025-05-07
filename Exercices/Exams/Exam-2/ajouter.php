

<?php

    $Srvr = "localhost";
    $dbname = "Ecole";
    $login = "root";
    $PW= "";
    
    try{
        $cnx = new PDO("mysql:host=$Srvr",$login,$PW);
        $cnx->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $cnx->exec("CREATE DATABASE IF NOT EXISTS $dbname");

        $cnx = new PDO("mysql:host=$Srvr;dbname=$dbname",$login,$PW);
        $cnx->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        $sql = "CREATE TABLE IF NOT EXISTS Etudiant(
                code_Etudiant int(11) PRIMARY KEY,
                nom varchar(30) NOT NULL,
                prenom varchar(30) NOT NULL ,
                age int(11) NOT NULL ,
                moyenne_bac float NOT NULL 
        )
        ";

        $cnx->exec($sql);


        
        $code = isset($_POST['code']) ? $_POST['code']: '';
        $nom = isset($_POST['nom']) ? $_POST['nom']: '';
        $prenom = isset($_POST['prenom']) ? $_POST['prenom']: '';
        $age = isset($_POST['age']) ? $_POST['age']: '';
        $moy_bac = isset($_POST['moy_bac']) ? $_POST['moy_bac']: '';


        if (!empty($code) && !empty($nom) && !empty($prenom) && !empty($age) && !empty($moy_bac)){

            if (is_numeric($age)  && is_numeric($moy_bac)){

                $stmt = $cnx->prepare("INSERT INTO Etudiant (code_Etudiant,nom,prenom,age,moyenne_bac) VALUES (?,?,?,?,?)");
                $stmt->execute([$code,$nom,$prenom,$age,$moy_bac]);

            }else{
                echo'<h1>Please enter a correct number!</h1>';
            }
        }
    }catch(PDOException $e){
        echo "Error : ".$e->getMessage();
    }


?>