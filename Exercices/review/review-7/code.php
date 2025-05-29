<?php

    session_start();

    if($_SERVER['REQUEST_METHOD']==='POST'){

        $name = isset($_POST['name']) && preg_match('/^[a-zA-Z]+$/',$_POST['name']) ? htmlspecialchars($_POST['name']) : false;
        $email = isset($_POST['email']) && filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) ? htmlspecialchars($_POST['email'] ): false;
        $message = isset($_POST['message']) && (strlen($_POST['message']) >10 ) ? htmlspecialchars($_POST['message']) : false;


        if($name && $email && $message){
            $_SESSION['name']=$name;
            $_SESSION['email']=$email;

        }else{
            // unset($_SESSION['name']);
            setcookie("name","",time()-3600,"/"); // delete cookies
            session_destroy();
            header('Location: index.php');

            exit;
        }



    }


?>

<!--  cookies -->
<?php

    setcookie("name",$name,time()+3600,"/") // add or update

?>

    

