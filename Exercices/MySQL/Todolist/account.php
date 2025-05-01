<?php ob_start(); ?>

<?php


    include 'connection-db.php';
    include 'user_info.php';

    $errors=[];
    $modifications = [];
    $sql_errors = [];


    if ($_SERVER['REQUEST_METHOD']==='POST'){
        


        $new_fname = isset($_POST['fname']) ? ucfirst(trim($_POST['fname'])) :'' ;
        $new_lname = isset($_POST['lname']) ? ucfirst(trim($_POST['lname'])) :'' ;
        $newpassword = isset($_POST['password']) ? $_POST['password'] :'' ;
        $confpassword = isset($_POST['confpassword']) ? $_POST['confpassword'] : '' ;
        $new_image_name = isset($_FILES['image']['name']) ?  $_FILES['image']['name'] : '' ;

        if ($fname !== $new_fname ){

            if (!preg_match('/^[a-zA-Z]{3,}$/',$new_fname)){

                $errors['fname'] = 'the first name must be bigger than 3 leters';

            }else{
                $modifications[]='fname';
            }
        }

        if ($lname !== $new_lname ){

            if (!preg_match('/^[a-zA-Z]{3,}$/',$new_lname)){

                $errors['lname'] = 'the first name must be bigger than 3 leters';
            }else{
                $modifications[]='lname';
            }
        }

        if ($newpassword !== $password){
            if (!preg_match('/^(?=(?:.*[a-zA-Z]){5,})(?=.{11,}).*$/',$newpassword)  ) {
                $errors['password']="Password must be more than 10 characters and contain at least 5 letters";

            }else{
                if($newpassword === $confpassword){
                    
                        $modifications[]='password';
                
                }else{
                    $errors['password']= 'password does not match!';
                }
            }
        }

        if(!empty($new_image_name)){

            $image_path = $_FILES['image']['tmp_name'];

            if($_FILES['image']['error']!=0){
                $errors['image'] = 'File upload failed';
            
            }else{

                $imageFileType = strtolower(pathinfo($new_image_name,PATHINFO_EXTENSION));
                $allowed_types = ['png','jpeg','jpg'];

                if (!in_array($imageFileType,$allowed_types)){
                    $errors['image'] = 'only png jpeg jpg files are allowed';

                }elseif($_FILES['image']['size'] > 10*1024*1024){
                    $errors['image']='file must be less than 10 MB';

                }else{
                        $modifications[]='image';
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
    <title>Document</title>

    <style>
        body{
            min-height: 100vh;
            display: flex;
            gap: 20px;
            flex-direction: column;
            align-items: center;
            margin: 0;
            font-family: monospace;
            font-size: 1rem; 

            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.dev/svgjs' width='1440' height='560' preserveAspectRatio='none' viewBox='0 0 1440 560'%3e%3cg mask='url(%26quot%3b%23SvgjsMask1010%26quot%3b)' fill='none'%3e%3crect width='1440' height='560' x='0' y='0' fill='rgba(0%2c 0%2c 0%2c 0.9)'%3e%3c/rect%3e%3cpath d='M403.679436126738 38.540254243667924L366.42740532158695 103.06266428331044 481.8370357836262 126.67950547121569z' fill='rgba(255%2c 158%2c 2%2c 0.4)' class='triangle-float3'%3e%3c/path%3e%3cpath d='M937.1278572334479 304.56280460769796L926.9783039534481 401.1293535611673 1033.6944061869171 314.71235788769786z' fill='rgba(255%2c 158%2c 2%2c 0.4)' class='triangle-float1'%3e%3c/path%3e%3cpath d='M1054.720575188349-61.50197347639924L981.4338111339941 82.33139957115476 1125.2671841815481 155.61816362550957 1198.553948235903 11.784790577955576z' fill='rgba(255%2c 158%2c 2%2c 0.4)' class='triangle-float1'%3e%3c/path%3e%3cpath d='M480.5357717295541 391.0809413503689L538.9030494436583 328.48969904044253 476.3118071337319 270.12242132633827 417.9445294196277 332.71366363626464z' fill='rgba(255%2c 158%2c 2%2c 0.4)' class='triangle-float2'%3e%3c/path%3e%3cpath d='M399.5848077366072 197.35502501397764L402.15795800074443 49.93934511137462 252.1691278340042 194.7818747498404z' fill='rgba(255%2c 158%2c 2%2c 0.4)' class='triangle-float3'%3e%3c/path%3e%3cpath d='M1343.7774779364556 508.72711807915846L1234.7920957522333 399.53380688694125 1197.6193032212936 529.1707404772411z' fill='rgba(255%2c 158%2c 2%2c 0.4)' class='triangle-float1'%3e%3c/path%3e%3c/g%3e%3cdefs%3e%3cmask id='SvgjsMask1010'%3e%3crect width='1440' height='560' fill='white'%3e%3c/rect%3e%3c/mask%3e%3cstyle%3e %40keyframes float1 %7b 0%25%7btransform: translate(0%2c 0)%7d 50%25%7btransform: translate(-10px%2c 0)%7d 100%25%7btransform: translate(0%2c 0)%7d %7d .triangle-float1 %7b animation: float1 5s infinite%3b %7d %40keyframes float2 %7b 0%25%7btransform: translate(0%2c 0)%7d 50%25%7btransform: translate(-5px%2c -5px)%7d 100%25%7btransform: translate(0%2c 0)%7d %7d .triangle-float2 %7b animation: float2 4s infinite%3b %7d %40keyframes float3 %7b 0%25%7btransform: translate(0%2c 0)%7d 50%25%7btransform: translate(0%2c -10px)%7d 100%25%7btransform: translate(0%2c 0)%7d %7d .triangle-float3 %7b animation: float3 6s infinite%3b %7d %3c/style%3e%3c/defs%3e%3c/svg%3e");        }
        
        .container{
            background-color: #f4f7f9;
            width: 50vw;
            padding: 20px;
            border-radius: 7px;
        }

        header{
            height: 45px;
            background-color: orange;
            width: 100%;
            display: flex;
            justify-content: start;
            align-items: center;
        }

        .error{
            color: red;
        }

        header a {
            margin: 0 10px;
            font-weight: bold;
            text-decoration: none;
            color: black;
        }

        .container > div:first-of-type{
            display: flex;
            gap: 15px;
        }

        .image-user-2 , .image-user-1{
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 1px dashed black;
        }

        .image-user-2{
            object-fit: cover;
        }





        .image-user-1{
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 2rem;
        }

        .image-user-1:hover,#upload_pic:hover,.image-user-2:hover{
            opacity: 0.6;
            cursor: pointer;
        }

        #upload_pic{
            background-color: #fbfeff;
            padding: 5px 10px;
            outline: none;
            border: 1px solid gray;
            border-radius: 7px;

        }

        .user_info > div > input , #password{
            padding: 8px 10px;
            margin: 5px 0;
            border-radius: 7px;
            border: 1px gray solid;
            width: 90%;

        }

        .user_info > div > input:focus  , #password:focus{
            outline: 2px solid orange;
        }

        .user_info > div{
            margin-top: 7px;
        }

        .pass_frame{
            width: 55%;
        }

        #confpassword{
            width: 34%;
        }

        button[type='submit'],#delete_account{
            padding: 8px 10px;
            background-color:rgba(149, 249, 0, 0.88);
            border: 1px solid black;
            border-radius: 7px;
            margin-top: 10px ;
        }

        button[type="submit"]:hover{
                cursor: pointer;
                background-color: rgba(149, 249, 0, 0.6);
        }

        #delete_account{
            background-color:rgba(255, 64, 0, 0.77);
            font-weight: bold;

        }

        #delete_account:hover{
            cursor: pointer;
            background-color:rgba(255, 64, 0, 0.52);

        }


        .choice{
            padding: 8px 15px;
            border-radius: 5px;
            border: 1px dashed black;
            cursor: pointer;
        }

        ._2{
            background-color:rgba(136, 255, 0, 0.76);
        }


        
        




        
    </style>
</head>


<body >        

            <?php
            
                if(empty($errors) && !empty($modifications)){

                        if (in_array('fname',$modifications)){
                            $query = "UPDATE userss SET fname = '$new_fname' WHERE email = '$email_user' AND idUser = $id_user";
                            if(!mysqli_query($connection,$query)){
                                $sql_errors[]="Error updating record: " . mysqli_error($conn);
                            }
                        }

                        if (in_array('lname',$modifications)){
                            $query = "UPDATE userss SET lname = '$new_lname' WHERE email = '$email_user' AND idUser = $id_user";
                            if(!mysqli_query($connection,$query)){
                                $sql_errors[]="Error updating record: " . mysqli_error($conn);
                            }
                        }

                        if (in_array('password',$modifications)){
                            $query = "UPDATE userss SET password = '$newpassword' WHERE email = '$email_user' AND idUser = $id_user";
                            if(!mysqli_query($connection,$query)){
                                $sql_errors[]="Error updating record: " . mysqli_error($conn);
                            }
                        }

                        
                        if (in_array('image',$modifications)){

                            $imageData = file_get_contents($_FILES['image']['tmp_name']);
                            $imageData = mysqli_real_escape_string($connection, $imageData);

                            $query = "UPDATE userss SET imageUser = '$imageData' WHERE email = '$email_user' AND idUser = $id_user";
                            if(!mysqli_query($connection,$query)){
                                $sql_errors[]="Error updating record: " . mysqli_error($conn);
                            }
                        }

                        header("Location: ".$_SERVER['PHP_SELF']);
                        exit;

                }

            ?>
    
            <header><a href="dashboard.php"> <- Back to Home</a></header>

            <form id="form" method="post" enctype="multipart/form-data">
            <div class="container">

                    <div id="user">
                        <?php
                            if (empty($image_user)){
                                $make_username = strtoupper($lname[0]."".$fname[0]) ;
                                echo "<div class='image-user-1'><span>$make_username</span></div>";
                                
                            }else{
                                $base64Image = base64_encode($image_user);
                                $imageSrc = "data:image/png;base64,".$base64Image;
                                echo "<img src='$imageSrc' class='image-user-2'>";
                            }
                        ?>
                        <!-- <img src="images/house.png" class="image-user-2"> -->
                        <div >
                            <p><strong><?= $lname."  ".$fname?></strong></p>
                            <p><?=$email_user ?></p>
                            <input type="file" name="image" accept="image/png;image/jpeg;image/jpg" style="display:none" id="image_input">
                            <button type="button" id="upload_pic">Upload profile picture</button>
                        </div>

                    </div>
                    <div class="user_info">
                        <div>
                            <p>Personal</p><hr>
                        </div>

                        <div>
                            <label for="fname">Fisrt name :</label>
                            <input id="fname" type="text" value="<?= isset($_POST['fname']) ? $_POST['fname'] : $fname?>" name="fname">

                            <?php

                                if(isset($errors['fname'])){
                                    echo "<p class='error'>".$errors['fname']."</br>";
                                }

                            ?>
                        </div>

                        <div>
                            <label for="lname">Last name :</label>
                            <input id="lname" type="text" value="<?= isset($_POST['lname']) ? $_POST['lname'] : $lname?>" name="lname">
                            <?php

                                if(isset($errors['lname'])){
                                    echo "<p class='error'>".$errors['lname']."</br>";
                                }

                            ?>
                        </div>
                        
                        <div>
                            <label >Password :</label><br>
                            <div  class="pass_frame" style="position: relative; display: inline-block;">
                                <input type="password" name="password"  id="password" placeholder="Enter your password" value="<?= isset($_POST['password']) ? $_POST['password'] : $password?>" >
                                <button type="button" id="eye" onclick="togglePassword()" style="position: absolute; right: 20px; top: 50%; transform: translateY(-50%); border: none; background: none; cursor: pointer;">
                                    👁️
                                </button>
                            </div>
                            <input id="confpassword" name="confpassword" type="text" placeholder="confirm password" disabled>
                        </div>
                        <?php

                            if(isset($errors['password'])){
                                echo "<p class='error'>".$errors['password']."</br>";
                            }

                        ?>

                        <div class="buttons">
                            <button type="submit">Save Changes</button>
                            <button type="button" id="delete_account" onclick="deleteAccount()">Delete Account</button>
                        </div>

                    </div>
            </div>
            </form>

            <div id="confirmBox" style="display: none;border-radius:7px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
                            background: white; padding: 20px; border: 2px solid #444; z-index: 1000; text-align: center;">
                <p>Are you sure you want to delete this account?</p>
                <button class="choice _1" onclick="handleChoice(true)">Yes</button>
                <button class="choice _2" onclick="handleChoice(false)">No</button>
            </div>
    

    <script>

        const uploadBtn = document.getElementById('upload_pic');
        const fileInput = document.getElementById('image_input');
        const usernameFrame = document.querySelector('.image-user-1');
        const imageUser = document.querySelector('.image-user-2');

        const user_frame = document.getElementById('user');

        const inputPass = document.getElementById('password');
        const confirm_password = document.getElementById('confpassword');
        const eyeBtn = document.getElementById('eye');

        

        if(inputPass.value !== "<?=addslashes($password)?>" ){
                confirm_password.disabled = false ;
                eye.click();

        }


        if(imageUser){

            imageUser.addEventListener('click',()=>{
                
                var result =  confirm("Are you sure you want delete image?");
                if (result){
                    window.open('delete_image.php','_self')
                
                }

        
            })}

        
        
        if(usernameFrame){

            usernameFrame.addEventListener('click',()=>{
                fileInput.value = "";
                fileInput.click();
            })
        }

        uploadBtn.addEventListener('click',()=>{
            fileInput.value = "";
            fileInput.click();
        })

        
        fileInput.addEventListener('change', function() {
            const userimage = document.querySelector('.image-user-2');
            const reader = new FileReader();
            reader.onload= function (event){

                if (fileInput.files[0] && usernameFrame && !userimage) {

                    usernameFrame.style.display = 'none'; 

                    const img = document.createElement('img');

                    img.src = event.target.result;
                    img.classList.add('image-user-2');
                    usernameFrame.classList.remove('image-user-1');
                    user_frame.insertBefore(img, user_frame.firstChild);


                }else if(fileInput.files[0] && userimage){
                    userimage.src=event.target.result;

                }
            };

            if (fileInput.files[0]) {
                reader.readAsDataURL(fileInput.files[0]);
            }

        
        });


        function togglePassword(){
            inputPass.type =        inputPass.type==="password" ? "text" : "password";
        }

        inputPass.addEventListener('input',function () {

            if(inputPass.value !== "<?=addslashes($password)?>" ){
                confirm_password.disabled = false ;

            }else{
                confirm_password.disabled = true;
            }

        })

        function deleteAccount(){

            document.getElementById('form').style.opacity="0.7";
            document.getElementById('confirmBox').style.display = 'block';

            

        }

        function handleChoice(choice){

                if (choice){

                    window.open("deleteAccount.php", "_self");

                }else{
                    document.getElementById('form').style.opacity="1";
                    document.getElementById('confirmBox').style.display = 'none';
                }
        }



    </script>

</body>
</html>
<?php ob_end_flush(); ?>
