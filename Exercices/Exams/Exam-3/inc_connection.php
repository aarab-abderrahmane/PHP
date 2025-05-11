<?php

    include 'inc_config.php';
    $db_name = db_name;

    try{

        $conn = new PDO("mysql:host=".db_host,db_user,db_pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $conn->exec('CREATE DATABASE IF NOT EXISTS '.$db_name);
        $conn->exec("USE " . db_name);

        $query = "CREATE TABLE IF NOT EXISTS Fournisseurs(
                    idFourn INT PRIMARY KEY ,
                    nomFourn VARCHAR(50) NOT NULL ,
                    prenomFourn VARCHAR(100) NOT NULL,
                    adrFourn TEXT NOT NULL ,
                    emailForun VARCHAR(200) NOT NULL,
                    telForun INT NOT NULL 
                );
        ";

        $conn->exec($query);

        $conn = new PDO("mysql:host=".db_host.";dbname=".db_name,db_user,db_pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        


    }catch(PDOException $e){
        echo "Error : ".$e->getMessage();
    }

?>