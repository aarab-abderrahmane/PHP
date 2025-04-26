<?php

        if($_SERVER['REQUEST_METHOD']=="POST"){

            $errors=[];
            $hobbies=[];


            $fname = isset($_POST['fname']) ? trim($_POST['fname']) : '';
            $lname = isset($_POST['lname']) ? trim($_POST['lname']) : '';
            $email = isset($_POST['email']) ? trim($_POST['email']) :'';
            $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
            $age = isset($_POST['age']) ? $_POST['age'] :'';
            $date_birth = isset($_POST['age']) ?  $_POST['date_birth'] :'';
            $password = isset($_POST['password']) ? $_POST['password'] :'';
            $conpassword = isset($_POST['conpassword']) ? $_POST['conpassword'] :'';
            $school_level = isset($_POST['school_level']) ? $_POST['school_level'] :'';

            #hobbies
            $h_sport = isset($_POST['h_sport']) ? $_POST['h_sport'] : '';
            $h_music = isset($_POST['h_music']) ? $_POST['h_music'] :'';
            $h_game = isset($_POST['h_game']) ? $_POST['h_game'] :'';


            $image_name = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : '';
            $pdf_name= isset($_FILES['pdf']['name']) ? $_FILES['pdf']['name'] : '';

            $desciption = isset($_POST['description']) ? $_POST['description'] :'';

            
            if(empty($fname) || !preg_match('/^[a-zA-Z]{3,}$/',$fname)){
                    $errors['fname']="invalid name , at least 3 letters";
            };

            if(empty($lname) || !preg_match('/^[a-zA-Z]{4,}$/',$lname)){
                $errors['lname']="invalid last name , at least 4 letters";
            };

            if(empty($email) || filter_var($email,FILTER_VALIDATE_EMAIL)){
                $errors["email"]= "Invalid email syntax";
            };

            if(empty($gender)){
                $errors["gender"]= "Select at least one";
            }

            if(empty($date_birth) ){
                $errors['date']="Please select date";
            }else{
                $date_input = new DateTime($date_birth);
                $date_now =  new DateTime(); //date now

                if($date_input >= $date_now){
                    $errors["date"]= "You cannot select a date in the future. Please choose today or a past date.";
                }

            }

            if(empty($password) || strlen($password) < 8){
                $errors['password']="please entre password begger than 8 caracters";

            }else{
                if(empty($conpassword) || $conpassword !== $password){
                    $errors["password"]= "Password is not same";
                }
            }

            if(empty($school_level)){
                $errors["school"]= "please select you school level";
            }

            !empty($h_game) && $hobbies[]=$h_game;
            !empty($h_sport) && $hobbies[]=$h_sport;
            !empty($h_music) && $hobbies[]=$h_music;



            if(!empty($image_name)){

                if(!is_dir('uploads/')){
                    mkdir('uploads/',0755,true);
                }

                $image_path = 'uploads/' . basename($image_name);
                #  ex : uploads/mouad.txt
                
                $imageFileType = strtolower(pathinfo($image_path,PATHINFO_EXTENSION));
                # JPG -> jpg

                $allowedTYpes = ['jpg','jpeg','gif',"png"];

                if (!in_array($imageFileType, $allowedTYpes)){
                    $errors['image']="Only jpg , jpeg , gif , png files are allowed";
                
                }elseif($_FILES['image']['size'] > 10*1024){
                    $errors['image']="File size must be less than 10 MB";
                }




            }else{
                $errors['image']="please chose image";
            }


            # pdf + comment 


        }


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

        .error{
            color:yellow;
        }


        body{
            display: flex;
            justify-content: center;
            font-family: monospace;
            font-size: 1.1rem;
        }

        .container{
            width: 60vw;
        }

        <?php  if(empty($errors)) : ?>
            body{
                background-color:green;
            }
        <?php else : ?>
            body{
                background-color:red;
            }
        <?php endif;?>

        

    </style>

</head>
<body>
    
    <div class="container" >
        <form method="post" enctype="multipart/form-data" >
                <label for="fame" >first name</label>
                <input type="text" id="fname" name="fname" value="<?= isset($_POST['fname']) ? $_POST['fname'] : '' ?>">

                <?php
                    if(isset($errors['fname'])){
                        echo '<p class="error">'.$errors['fname'].'</p>';
                    }
                ?>

                <label for="lname">last name</label>
                <input type="fname" id="fname" name="lname">

                <label for="email">Your email</label>
                <input type="text" id="email" name="email">

                <label>Gender:</label>
                <div>
                    <input type="radio" name="gender" value="homme" id="homme">
                    <label for="homme">Homme</label>
                </div>
                
                <div>
                    <input type="radio" name="gender" value="femme" id="femme">
                    <label for="femme">Femme</label>
                </div>

                <label for="age">Age</label>
                <input type="number" id="age" step="1" min="0" max="99" name="age">

                <label for="date_birth">Date of birth</label>
                <input type="date" id="date_birth" name="date_birth">

                <label for="password">Password</label>
                <input type="password" id="password" name="password">

                <label for="conpassword">Confirm password</label>
                <input type="password" id="conpassword" name="conpassword">


                <label for="school_level">School level</label>
                <select id="school_level" name="school_level">
                    <option vlaue="" selected disabled >select yout school level</option>
                    <option value="Preschool">Preschool</option>
                    <option value="Elementary School">Elementary School</option>
                    <option value="Middle School">Middle School</option>
                    <option value="High School">High School</option>
                    <option value="Undergraduate">Undergraduate</option>
                </select>

                <label for="hobbies">Hobbies</label>
                <div>
                    <input type="checkbox" id="sport" name="h_sport">
                    <label for="sport">Sport</label>

                    <input type="checkbox" id="game" name="h_game">
                    <label for="game">Game</label>

                    <input type="checkbox" id="music" name="h_music">
                    <label for="music">Music</label>

                </div>

                
                <label for="image">Image</label>
                <input type="file" id="image" name="image">

                <label for="pdf">upload your pdf</label>
                <input type="file" id="pdf" name="pdf" accept='application/pdf'>
                
                <label for="description">Description</label>
                <textarea id="description" rows="10" name="description"></textarea>


                <button type="submit">Send</button>

        </form>

    </div>

</body>
</html>