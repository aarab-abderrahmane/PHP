<?php

    if (isset($_COOKIE['user_email'])){
        setcookie('user_email', '', time() - 3600, '/');
        unset($_COOKIE['user_email']);

    }

    header('Location: login.php'); 
    exit();
?>
