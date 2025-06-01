<?php

    // try{

    //     $conn = new PDO('mysql:host=localhost','root','');
    //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //     $conn->exec("CREATE DATABASE IF NOT EXISTS ISTA");
    //     $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


        



    // }catch (PDOException $e){
    //     die('database connection failed ');
    // }


    
        // mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        // try{

        //     $conn = new mysqli('localhost','root',"",'Ecole');
        //     $result = $conn->query("SELECT * FROM etudiant");


    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    try{

        $conn = new mysqli("localhost","root","","");
        $conn->query("CREATE DATABASE IF NOT EXISTS site_inscription");
        $conn->select_db("site_inscription");


        $sql = "CREATE TABLE IF NOT EXISTS stagiaires(
                code INT PRIMARY KEY AUTO_INCREMENT , 
                nom VARCHAR(100) NOT NULL ,
                prenom VARCHAR(100) NOT NULL ,
                sexe VARCHAR(20) NOT NULL ,
                filiere VARCHAR(30) NOT NULL 
        )";

        $conn->query($sql);



    }catch(mysqli_sql_exception $e){
        echo $e->getMessage();
    }



?>