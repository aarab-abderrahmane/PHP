<?php

    session_start();

    if($_SERVER['REQUEST_METHOD']==='GET'){

        $name = isset($_GET['name']) && preg_match('/^[a-zA-Z]+$/',$_GET['name']) ? htmlspecialchars($_GET['name']) : false;
        $email = isset($_GET['email']) && filter_var($_GET['email'],FILTER_VALIDATE_EMAIL) ? htmlspecialchars($_GET['email'] ): false;
        $message = isset($_GET['message']) && (strlen($_GET['message']) >10 ) ? htmlspecialchars($_GET['message']) : false;


        if($name && $email && $message){
            $_SESSION['name']=$name;
            $_SESSION['email']=$email;

        }else{
            unset($_SESSION['name']);
            setcookie("name","",time()-3600,"/"); // delete cookies
            session_destroy();
            header('Location: index.php');

            exit;
        }



    }


?>

<!--  cookies -->
<?php

    setcookie("name",$name,time()+3600,"/"); // add or update

    header('Location: index.php');
?>

    

