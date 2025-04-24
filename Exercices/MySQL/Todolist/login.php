<?php
    if(isset($_COOKIE['user_email'])){
        header('Location: dashboard.php');
        exit;
    }

    include 'connection-db.php';

    $errors=[];

    if($_SERVER['REQUEST_METHOD']=="POST"){

        $email = strtolower(trim($_POST['email']));
        $password = $_POST['password'];

        

        if(isset($_POST['email']) && (empty($email) || !filter_var($email,FILTER_VALIDATE_EMAIL)) ){
            $errors['email'] = 'Email format error.';

        }
        
        if(isset($_POST['password']) && empty($password)){
            $errors['pass'] = 'Please enter your password.';

        if(empty($errors)){

            $email_check = "SELECT * FROM userss WHERE email = '$email'";
            $result = mysqli_query($connection,$email_check);
            if(mysqli_num_rows($result) <=0){
                $errors['email'] = "Email not fonud";
            }else{
                $password_check = "SELECT * FROM userss WHERE email='$email' AND password='$password'";
                $password_result = mysqli_query($connection,$password_check);
    
                if(mysqli_num_rows($password_result) >0){
                        setcookie("user_email",$email,time()+86400,'/');
                        header('Location: dashboard.php');
                        exit;
    
                }else{
                    $errors['pass'] = "Incorrect password";
                }
    
            }
        }



    }}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <title>Document</title>

    <style>
        body{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;

            background-color: #0F0F0F;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='200' height='200' viewBox='0 0 800 800'%3E%3Cg fill='none' stroke='%23584944' stroke-width='1'%3E%3Cpath d='M769 229L1037 260.9M927 880L731 737 520 660 309 538 40 599 295 764 126.5 879.5 40 599-197 493 102 382-31 229 126.5 79.5-69-63'/%3E%3Cpath d='M-31 229L237 261 390 382 603 493 308.5 537.5 101.5 381.5M370 905L295 764'/%3E%3Cpath d='M520 660L578 842 731 737 840 599 603 493 520 660 295 764 309 538 390 382 539 269 769 229 577.5 41.5 370 105 295 -36 126.5 79.5 237 261 102 382 40 599 -69 737 127 880'/%3E%3Cpath d='M520-140L578.5 42.5 731-63M603 493L539 269 237 261 370 105M902 382L539 269M390 382L102 382'/%3E%3Cpath d='M-222 42L126.5 79.5 370 105 539 269 577.5 41.5 927 80 769 229 902 382 603 493 731 737M295-36L577.5 41.5M578 842L295 764M40-201L127 80M102 382L-261 269'/%3E%3C/g%3E%3Cg fill='%23FFFFFF'%3E%3Ccircle cx='769' cy='229' r='5'/%3E%3Ccircle cx='539' cy='269' r='5'/%3E%3Ccircle cx='603' cy='493' r='5'/%3E%3Ccircle cx='731' cy='737' r='5'/%3E%3Ccircle cx='520' cy='660' r='5'/%3E%3Ccircle cx='309' cy='538' r='5'/%3E%3Ccircle cx='295' cy='764' r='5'/%3E%3Ccircle cx='40' cy='599' r='5'/%3E%3Ccircle cx='102' cy='382' r='5'/%3E%3Ccircle cx='127' cy='80' r='5'/%3E%3Ccircle cx='370' cy='105' r='5'/%3E%3Ccircle cx='578' cy='42' r='5'/%3E%3Ccircle cx='237' cy='261' r='5'/%3E%3Ccircle cx='390' cy='382' r='5'/%3E%3C/g%3E%3C/svg%3E");
            
            font-family: monospace;
        }

        .container{
            width: 35vw;
            /* border: 1px solid black; */
            background-color: #181818;
            border: 1px solid rgb(45, 45, 45) ;
        }

        input{
            background-color: #111111 !important;
            color: white !important;
            border: 1px solid rgb(45, 45, 45) !important;
        }

        input::placeholder{
            color: gray !important;
        }

        .bi{
            color: gray ;
        }

        .input-group-text{
            background-color: #111111;
            border-color: rgb(45, 45, 45);
        }

        h2,a{
            color: white;
            text-decoration: none;
        }
        p{
            color: gray;
        }

        form{
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        form div img {
            width: 50px;
            height: 50px;
        }
        form div:first-of-type{
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap:10px;
        }


        form div:nth-child(2) , form div:nth-child(3),button[type='submit']{
            width: 30vw;

        }        


        @media (max-width:1000px){
            .container{
                width: 90vw;
            }

            form div:nth-child(2) , form div:nth-child(3),button[type='submit']{
                width: 100%;

            }   
        }

        .error{
            color: yellow;
        }


        
    </style>
</head>
<body>
    
    
    <div class="container rounded-3  p-4">
            <form method="post">

                <div>
                    <img src="images/house.png" alt="house">
                    <h2>Welcome Back</h2>
                    <p>Don't have an account yet? <a href="registration.php">Sing up</a></p>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" class="form-control"  name="email" placeholder="email adress"
                    value="<?= isset($_POST['email']) ? $_POST['email'] : ''?>">
                </div>

                <?php
                    if(isset($errors['email'])) :
                ?>
                    <p class="error">-><?=$errors['email']?>
                <?php endif; ?>

                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="password" 
                    value="<?= isset($_POST['password']) ? $_POST['password'] : ''?>" >
                </div>

                <?php
                    if(isset($errors['pass'])) :
                ?>
                    <p class="error">-><?=$errors['pass']?>
                <?php endif; ?>

                <button type="submit" class="btn btn-primary form-control">Login</button>

            </form>

    </div>


</body>
</html>