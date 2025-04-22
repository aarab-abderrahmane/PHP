<?php 

    $host = "localhost";
    $user  = "root";
    $password   = "";
    $database = "todolist";

    $connection = mysqli_connect($host,$user,$password,$database);

    if(!$connection){
        dir('<h1 style="color=red">Connection Failed : '.mysqli_connect_error().'</h1>');    
    }


?>

