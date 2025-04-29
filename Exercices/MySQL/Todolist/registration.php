<?php

    if(isset($_COOKIE['user_email'])){
        header("Location: dashboard.php");
        exit;
    }

    include "connection-db.php";

    $query = "SELECT * FROM userss";
    $result = mysqli_query($connection,$query);
    $registration_succ='';

    $errors=[];
    
    if($_SERVER['REQUEST_METHOD']=="POST"){
            $fname = trim($_POST['fname']);
            $lname = trim($_POST['lname']);
            $email = strtolower(trim($_POST['email']));
            $password = $_POST['password'];
            $conpassword = $_POST['conpassword'];

            if(isset($_POST['fname'])  && (empty($fname )  || !preg_match("/^[a-zA-Z]{3,}$/",$fname))){
                $errors['fname']='-> Only letters allowed ,min 3 caracters ';
            }

            if(isset($_POST['lname']) && ((empty($lname))  || !preg_match('/^[a-z-A-Z]{4,}$/',$lname)) ){
                $errors['lname']="-> Only letters allowed,min 4 caracters";
            }

            if(isset($_POST['email']) && ((empty($email))  || !filter_var($email,FILTER_VALIDATE_EMAIL) ) ){
                $errors['email']="-> Invalid email";
            }

            if(isset($_POST['password']) && ((empty($password))  ||  !preg_match('/^(?=(?:.*[a-zA-Z]){5,})(?=.{11,}).*$/',$password)  ) ){
                $errors['password']="-> Password must be more than 10 characters and contain at least 5 letters";
            }

            if(isset($_POST['conpassword']) && ((empty($conpassword))  || ($password !== $conpassword))){
                $errors['conpassword']="-> password does not match";
            }


            if(empty($errors)){
                
                $email_check = "SELECT * FROM userss WHERE email='$email'";
                $result = mysqli_query($connection,$email_check);

                if(mysqli_num_rows($result) >0){
                    $registration_succ=false;
                    
                }else{

                    $sql  = "INSERT INTO userss (fname,lname,email,password,role) VALUES ('$fname','$lname','$email','$password','user')";

                    if(mysqli_query($connection,$sql)){
                        setcookie('user_email',$email,time()+86400,"/");
                        header('Location: dashboard.php');
                        exit;
                    }else{
                        echo "There was an error while registering the user.";
                    }
                }



            }


            


    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Akaya+Kanadaka&family=Bungee+Spice&family=Courier+Prime:ital,wght@0,400;0,700;1,400;1,700&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Document</title>

    <style>
        *::selection{
            background-color:rgb(187, 16, 255);
            color: black;
        }
      
        body{
            display: flex;
            flex-direction: column;
            /* justify-content: center; */
            align-items: center;
            min-height : 100vh;
            font-weight: bold;
            font-family: monospace;
            /* align-items: flex-start; */


            background-color: #622785;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100%25' height='100%25' viewBox='0 0 1200 800'%3E%3Cdefs%3E%3CradialGradient id='a' cx='0' cy='800' r='800' gradientUnits='userSpaceOnUse'%3E%3Cstop offset='0' stop-color='%23390b59'/%3E%3Cstop offset='1' stop-color='%23390b59' stop-opacity='0'/%3E%3C/radialGradient%3E%3CradialGradient id='b' cx='1200' cy='800' r='800' gradientUnits='userSpaceOnUse'%3E%3Cstop offset='0' stop-color='%23311443'/%3E%3Cstop offset='1' stop-color='%23311443' stop-opacity='0'/%3E%3C/radialGradient%3E%3CradialGradient id='c' cx='600' cy='0' r='600' gradientUnits='userSpaceOnUse'%3E%3Cstop offset='0' stop-color='%2308000f'/%3E%3Cstop offset='1' stop-color='%2308000f' stop-opacity='0'/%3E%3C/radialGradient%3E%3CradialGradient id='d' cx='600' cy='800' r='600' gradientUnits='userSpaceOnUse'%3E%3Cstop offset='0' stop-color='%23622785'/%3E%3Cstop offset='1' stop-color='%23622785' stop-opacity='0'/%3E%3C/radialGradient%3E%3CradialGradient id='e' cx='0' cy='0' r='800' gradientUnits='userSpaceOnUse'%3E%3Cstop offset='0' stop-color='%2310001D'/%3E%3Cstop offset='1' stop-color='%2310001D' stop-opacity='0'/%3E%3C/radialGradient%3E%3CradialGradient id='f' cx='1200' cy='0' r='800' gradientUnits='userSpaceOnUse'%3E%3Cstop offset='0' stop-color='%23000000'/%3E%3Cstop offset='1' stop-color='%23000000' stop-opacity='0'/%3E%3C/radialGradient%3E%3C/defs%3E%3Crect fill='url(%23a)' width='1200' height='800'/%3E%3Crect fill='url(%23b)' width='1200' height='800'/%3E%3Crect fill='url(%23c)' width='1200' height='800'/%3E%3Crect fill='url(%23d)' width='1200' height='800'/%3E%3Crect fill='url(%23e)' width='1200' height='800'/%3E%3Crect fill='url(%23f)' width='1200' height='800'/%3E%3C/svg%3E");
            background-attachment: fixed;
            background-size: cover;

        }

        .notification{
            width: 100%;
            display: flex;
            justify-content: center;
            margin-top: 20px;
            position:sticky;
            top:10px;
        }

        .buttons{
            display: flex;
            align-items: center;
            gap:10px
        }

        .container{
            /* max-width: 800px; */
            display: flex;
            justify-content: space-between;
            align-items: start;
            align-items: stretch;
            gap:10px;
            height: auto;
            border: 1px gray solid;
            border-radius: 15px;;
            padding: 0;
            width: auto;
            margin: 10vh  0;
            /* overflow:scroll; */

            
        }

        #image{
            width: 34vw;
            height: auto;
            object-fit:cover;
            margin: 0;
            border-top-left-radius: 15px;
            border-bottom-left-radius: 15px;
            mask: linear-gradient(to left, transparent 0%, black 100%);

        }

        form{
            width: 100%;
            margin: 20px ;
            padding: 0 5px;
        }

        input{
            background-color: rgba(0, 0, 0, 0.29) !important;
            color: gray !important;
            font-weight: bold;
            height: 40px;
            border-color:rgb(66, 66, 66) !important;
        }

        input::placeholder{
            color: red !important;
        }
        
        .error{
            color: yellow;
            font-size: 0.85rem;
        }

        input:-webkit-autofill {
        background-color: #1e1e2f !important;
        -webkit-box-shadow: 0 0 0 1000px #1e1e2f inset !important;
        -webkit-text-fill-color: white !important;
            }

        button[type="submit"]{
            background-color: #009c60 !important;
            border: 1px solid #00ffa4 !important;
            border-radius: 10px !important;
        }

        button[type='submit']:hover{
            background-color:rgba(0, 156, 96, 0.5)  !important;

        }

        input:focus{
            outline: purple 3px solid !important;
        }

        h2{
            text-align: center;
            margin-bottom: 10px;
            font-family:"Akaya Kanadaka", system-ui;
            font-weight: bold;
            color: #f34b00;
        }

        #login{
            
            border-color: red !important;
            background-color: #f34b00 !important;
            border-radius: 10px !important;
        }

        @media (max-width:1000px){
            .container{
                border: none;
                flex-direction: column;
                align-items: start;
                align-items: center;
                margin-top: 0;

            }

            form{
                padding: 0 10px;
            }

            #image{
                height: 50vh;
                width: 100vw;
                mask: none;
                mask: linear-gradient(to top, transparent 0%, black 100%);
                border-radius: 15px;

            }

            label,.error{
                font-size: 0.7rem;
            }
            input{
                font-size: 0.8rem !important;
            }

            .notification{
                position: sticky;
                top:0;
                margin-top: 0;

            }
            #danger-alert{
                font-size: 0.8rem;
                border-radius: 25px !important;
                border-top-right-radius: 0 !important;
                border-top-left-radius: 0 !important;

            }


        }
        @media (min-width:1001px) and ( max-width: 1300px){
            form{
                width: 31vw;;
            }

        }

        @media (min-width:1301px){
            form{
                width: 25vw;;
            }

            #image{
                width: 25vw;

            }

            form{
                padding: 5vh;
            }

            .container{
                margin: 0;
            }

            body{
                justify-content: center;

            }

        }
        

    </style>
</head>
<body  style="color:white;">
    
    <div class="notification">
        <?php
            if($registration_succ===false){
                
                echo '  <div class="alerts">
                            <div
                            id="danger-alert"
                            class="relative w-full max-w-140 flex flex-wrap items-center justify-center py-1 px-4 rounded-lg text-base font-medium transition-all duration-500 border border-red-500 text-red-700 bg-red-100"
                            >
                            <!-- Close button -->
                            <button
                            id="close-danger-btn"
                            type="button"
                            aria-label="close-success"
                            class="absolute right-4 p-1 rounded-md transition-opacity text-red-500 border border-red-500 opacity-40 hover:opacity-100"
                            >
                            <svg
                            stroke="currentColor"
                            fill="none"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            height="16"
                            width="16"
                            class="h-4 w-4"
                            xmlns="http://www.w3.org/2000/svg"
                            >
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                            </svg>
                            </button>

                            <!-- Content -->
                            <p class="flex flex-row items-center justify-center gap-x-2 w-full">
                            <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-7 w-7 text-red-700 mt-3"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                            >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            <span class="mt-3 me-3">The email is already registered. Please try with a different email.</span>
                            </p>
                            </div>
                            </div>

            ';
            }
        ?>
    </div>
    
    <div class="container ">

            <img src="images/wallpaperflare.com_wallpaper (1).jpg" id="image">
            <form  method="post" >

                    <h2>Registration</h2>
                    <label for="fname" class="from-label">first name :</label>
                    <input type="text" name="fname" id="fname" class="form-control" value="<?= isset($_POST['fname']) ? $_POST['fname'] : ''?>" >
                    <?php if(isset($errors['fname'])):?>
                        <p class="error"><?= $errors['fname']?></p>
                    <?php endif ; ?>

                    <label for="lname" class="form-label mt-3">last name :</label>
                    <input type="text" name="lname" id="lname" class="form-control" value="<?= isset($_POST['lname']) ? 
                    $_POST['lname'] : ''?>">
                    <?php if(isset($errors['lname'])):?>
                        <p class="error"><?= $errors['lname']?></p>
                    <?php endif ; ?>

                    <label for="email" class="form-label mt-3">Email</label>
                    <input type="text" name="email" id="email" class="form-control" value="<?= isset($_POST['email']) ? 
                    $_POST['email'] : ''?>">
                    <?php if(isset($errors['email'])):?>
                        <p class="error"><?= $errors['email']?></p>
                    <?php endif ; ?>

                    <label for="password" class="form-label mt-3">password</label>
                    <input type="password" name="password" id="password" class="form-control" value="<?= isset($_POST['password']) ? 
                    $_POST['password'] : ''?>">
                    <?php if(isset($errors['password'])):?>
                        <p class="error"><?= $errors['password']?></p>
                    <?php endif ; ?>

                    <label for="conpassword" class="form-label mt-3">Confirm password</label>
                    <input type="password" name="conpassword" id="conpassword" class="form-control" value="<?= isset($_POST['conpassword']) ? 
                    $_POST['conpassword'] : ''?>">
                    <?php if(isset($errors['conpassword'])):?>
                        <p class="error"><?= $errors['conpassword']?></p>
                    <?php endif ; ?>
                    
                    <div class="buttons">
                        <button type="submit" class="btn btn-success mt-3"><i class="bi bi-patch-plus me-2"></i>Sign UP</button>  
                        <span class="mt-3">OR</span>
                        <button type="button" id="login" class="btn btn-danger mt-3 "><i class="bi bi-box-arrow-in-right me-2"></i>Login</button>   
                    </div>
            </form>

    </div>



    <script>
        window.onload = function(){
            const alert_zone = document.querySelector('.alerts');
            const close_danger_btn = document.getElementById('close-danger-btn');

            const login_btn = document.getElementById('login');

            if(alert_zone && close_danger_btn){
                
                close_danger_btn.addEventListener('click',function () {
                    alert_zone.style.display="none";
                })

            }

            if(login_btn){
                login_btn.addEventListener('click',function () {
                    window.location.href="login.php";
                })
            }
        }


    </script>
    


</body>
</html>