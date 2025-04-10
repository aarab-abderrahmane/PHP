<?php
    $errors=[];
    if ($_SERVER['REQUEST_METHOD']==='POST'){

        $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
        $email = isset($_POST['email']) ?  $_POST['email'] : '';
        $matricule=isset($_POST['matricule']) ? $_POST['matricule'] : '';
        $URL =isset($_POST['URL'])  ? $_POST['URL'] : '';
        $imageName = isset($_FILES['image']) ? $_FILES['image']['name'] : '';
        $pdf = isset($_FILES['pdf']) ? $_FILES['pdf']['name'] : "";

        $errors=[];

        if((empty($nom) || $nom==="") && (empty($email) || $email==="") && (empty($URL) || $URL==="") && (empty($imageName) || $imageName==="") && (empty($pdf) || $pdf=== "")){
            $errors[]="all fields are required.";
        }else{
            
            if(empty($nom)){
                array_push($errors,"name is required");
            }
            if(empty($email)){
                $errors[]="email is required.";
            }else{
                if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $errors[]="Invalid email format.";
                }
            }
            if(empty($URL)){
                $errors[]="URL is required";
            }else{
                if(!filter_var($URL,FILTER_VALIDATE_URL)){
                    $errors[]= "Invalid URL format.";
                };
            }


            #image check

            if(empty($imageName)){
                array_push($errors,'Image is required.');
            }else{

                $uploadDir = "uploads/";
                if(!is_dir($uploadDir)){
                    mkdir($uploadDir,0755,true);

                }
                $imagePath = $uploadDir. basename($imageName);
                $imageFileTYpe=strtoupper(pathinfo($imagePath,PATHINFO_EXTENSION));


                $allowedTypes=['JPG','PNG','JPEG','GIF','SVG'];

                if(!in_array($imageFileTYpe,$allowedTypes)){
                    $errors[]='only JPG,JPEG,PNG,SVG,GIF files are allowed';
                }

                if($_FILES['image']['size'] >5*1024*1024){     //convert to bits
                    $errors[]='File size must  be less than 5MB';
                }

                if(empty($errors)){
                    if(!move_uploaded_file($_FILES['image']['tmp_name'],$imagePath) || $_FILES['pdf']['error']!==0){
                        $errors[]='Failed to upload image.';
                    }
                }
            }


            #pdf check
            
            if(empty($pdf)){
                $errors[]='Pdf is required';
            }else{

                $allowedTypes_pdf=['application/pdf'];

                $fileTmpPath = $_FILES['pdf']['tmp_name'];
                $filename = $_FILES['pdf']['name'];
                $fileSize = $_FILES['pdf']['size'];
                $fileType = $_FILES['pdf']['type'];

                if (!in_array($fileType,$allowedTypes_pdf)){
                    $errors[]='Only PDF files are allowed';
                    exit;
                }

                if($fileSize > 5*1014*1024){
                    $errors[]='File size should be less than 5MB.';
                    exit;
                }

                if (!is_dir($uploadDir)){
                    mkdir($uploadDir,0755,true);
                }

                $pdfPath = $uploadDir . basename($filename);

                if(!move_uploaded_file($fileTmpPath,$pdfPath)){
                    $errors[]= 'Failed to upload pdf';
                }

            }

            
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
                $data[]=['nom'=>$nom,'email'=>$email,'matricule'=>$matricule,'URL'=>$URL,'image'=>$imagePath,'pdf'=>$pdfPath];
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
                <label for="file">pdf</label>
                <input type="file" name="pdf" id="file" accept=".pdf">
                <button type="submit">Add</button>
        </form>
    </div>

</body>
</html>