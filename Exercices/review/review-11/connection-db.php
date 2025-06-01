<?php

    include "config.php";
    mysqli_report(MYSQLI_REPORT_ERROR  | MYSQLI_REPORT_STRICT);
    try{

        $conn= new mysqli(DB_HOST,DB_USER,DB_PW,DB_NAME);
        $conn->select_db(DB_NAME);
        $sql = "CREATE TABLE IF NOT EXISTS images (
                id INT PRIMARY KEY AUTO_INCREMENT ,
                img BLOB NOT NULL 
                )";
        $conn->query($sql);


    }catch(mysqli_sql_exception $e){

        echo $e->getMessage();

    }



?> 