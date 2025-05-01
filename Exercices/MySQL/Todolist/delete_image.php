<?php

        include "connection-db.php";
        include "user_info.php";


        $query = "UPDATE userss SET imageUser = '' WHERE email = '$email_user' AND idUser = $id_user";
        if (mysqli_query($connection,$query)){
            header('Location: account.php');
            exit;
        };

?>