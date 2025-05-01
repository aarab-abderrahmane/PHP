<?php

        include "connection-db.php";
        include "user_info.php";

        $query = "DELETE FROM userss WHERE email = '$email_user' AND idUser=$id_user"; 
        $res = mysqli_query($connection,$query);
        if ($res){
            include "logout.php";
        }

?>