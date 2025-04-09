<?php
    $errors=[];
    if ($_SERVER['REQUEST_METHOD']==='POST'){

        $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
        $email = $_POST['email'];
        $matricule=isset($_POST['matricule']) ? $_POST['matricule'] : '';
        $URL = $_POST['URL'];
        $image = isset($_FILES['image']) ? $_FILES['image']['name'] : '';
        $errors=[];
        
        if(empty($nom) || empty($email) || empty($URL)){
            $errors[]="all fields are required.";
        }
        if(empty($nom)){
            array_push($errors,"name is required");
        }
        if(empty($email)){
            $errors[]="email is required.";
        }
        if(empty($URL)){
            $errors[]="URL is required";
        }
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $errors[]="Invalid email format.";
        }
        if(!filter_var($URL,FILTER_VALIDATE_URL)){
            $errors[]= "Invalid URL format.";
        };
    }; 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        form{
            display: flex;
            flex-direction: column;
            gap:10px;
        }

        .container{
            width: 70vw;
        }
        
    </style>
</head>
<body>
    <h2>Add New User : </h2>
    <div class="container">
        <?php
        if($_SERVER['REQUEST_METHOD']==="POST"){
            if(empty($errors)){


                $data = isset($_COOKIE['users']) ? json_decode($_COOKIE['users'],true) : [];
                $data[]=['nom'=>$nom,'email'=>$email,'matricule'=>$matricule,'URL'=>$URL,'image'=>$image];
                setcookie('users',json_encode($data),time()+(24*60*60));
                header('Location:home.php');


                echo'<h1 style="color:green">Add Successfully!</h1>';
                exit;
            }else{
                echo '<div class="alert">';
                foreach($errors as $error){
                        echo '<p><b>'.$error.'</b></p>';
                }   
                echo '</div>';

            }
        }      
        ?>
        <form method="post" enctype="multipart/form-data">
                <label for="name">Nom</label>
                <input id="name" type="text" name="nom"></input>
                <label for="email">Email</label>
                <input type="text" name="email" id="email">
                <label for="matricule">Nombre de matricule</label>
                <input type="number" name="matricule" min="1000" max="5000" value="1000">
                <label for="URL">Linkedin URL</label>
                <input type="URL" name="URL" id="URL">
                <label  for="image">image</label>
                <input type="file" id="image" name="image">
                <button type="submit">Add</button>
        </form>
    </div>

</body>
</html>