<?php


        include "connection-db.php";
        include "user_info.php";




        if(isset($_COOKIE['user_email'])){



            // Delete related rows in todouser first
            $query1 = "DELETE FROM todouser WHERE idUser = $id_user ";
            $result1 = mysqli_query($connection, $query1);

            // Then delete the user
            $query2 = "DELETE FROM userss WHERE idUser = $id_user AND email = '$email_user' ";
            $result2 = mysqli_query($connection, $query2);

            if ($result1 && $result2){
                include "logout.php";
            }
        }

        



?>