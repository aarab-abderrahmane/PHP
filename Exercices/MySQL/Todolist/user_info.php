<?php


        $email_user = $_COOKIE['user_email'];

        $id_user_query  = "SELECT idUser FROM userss WHERE email ='$email_user'";

        $id_result = mysqli_query($connection,$id_user_query);

        if($id_result && $row=mysqli_fetch_assoc($id_result)){
            $id_user = (int)$row['idUser'];

        }



?>