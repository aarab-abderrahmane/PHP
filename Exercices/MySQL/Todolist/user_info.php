<?php

        if(!isset($_COOKIE['user_email'])){
            header('Location: login.php');
            exit;
        }
        
        $email_user = $_COOKIE['user_email'];

        $user_query  = "SELECT * FROM userss WHERE email ='$email_user'";

        $result = mysqli_query($connection,$user_query);

        if($result && $row=mysqli_fetch_assoc($result)){
            $id_user = (int)$row['idUser'];
            $fname = ucfirst((string)$row['fname']);
            $lname = ucfirst((string)$row['lname']);
            $image_user = $row['imageUser'];
            $password = $row['password'];



        }else{
            unset($_COOKIE['user_email']);
            header('Location: login.php');
            exit;
        }


        


?>