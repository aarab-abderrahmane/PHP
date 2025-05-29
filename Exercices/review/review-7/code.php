<?php

    session_start();

    if($_SERVER['REQUEST_METHOD']==='POST'){

        $name = isset($_POST['name']) && preg_match('/^[a-zA-Z]+$/',$_POST['name']) ? htmlspecialchars($_POST['name']) : false;
        $email = isset($_POST['email']) && filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) ? htmlspecialchars($_POST['email'] ): false;
        $message = isset($_POST['message']) && (strlen($_POST['message']) >10 ) ? htmlspecialchars($_POST['message']) : false;

        $image_name = isset($_FILES['image']) ? $_FILES['image']['name'] : false;
        $pdf_name = isset($_FILES['pdf']) ? $_FILES['pdf']['name'] : false;


        // Array == name of input
        // (
        //     [name] => example.jpg
        //     [type] => image/jpeg
        //     [tmp_name] => /tmp/php/php6h3o12.jpg
        //     [error] => 0
        //     [size] => 98174
        // )

        if($image_name){

            $allowed_types = ['image/png','image/jpg','image/gif'];
            if (in_array($_FILES['image']['type'],$allowed_types)){

                if($_FILES['image']['size'] > (5*1024*1024)){
                    $image_name=false;
                }

                if(!is_dir('uploads/')){
                        mkdir('uploads/',0755,true);
                }

                $image_path = 'uploads/'.basename($image_name);
                
                if(!move_uploaded_file($_FILES['image']['tmp_name'],$image_path)){
                    $image_name=false;
                }
                

            }else{
                $image_name=false;
            }

        }


        if($pdf_name){

            $allowed_types = ['application/pdf'];
            if (in_array($_FILES['pdf']['type'],$allowed_types)){

                if($_FILES['pdf']['size'] > (5*1024*1024)){
                    $pdf_name=false;
                }

                $pdf_path = 'uploads/'.basename($pdf_name);
                
                if(!move_uploaded_file($_FILES['pdf']['tmp_name'],$pdf_path)){
                    $pdf_name=false;
                }

            }else{
                $pdf_name=false;
            }

        }
        

        if($name && $email && $message && $image_name && $pdf_name){
            
            $_SESSION['name']=$name;
            $_SESSION['email']=$email;



        }else{
            // unset($_SESSION['name']);
            setcookie("name","",time()-3600,"/"); // delete cookies
            session_destroy();

            exit;
        }

    }

?>

<!--  cookies -->
<?php

    setcookie("name",$name,time()+3600,"/") ; // add or update
    header('Location: index.php');
?>

    

