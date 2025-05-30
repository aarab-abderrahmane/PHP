<?php

    try{

        $conn = new PDO('mysql:host=localhost','root','');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $conn->exec("CREATE DATABASE IF NOT EXISTS ISTA");
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


        



    }catch (PDOException $e){
        die('database connection failed ');
    }



?>