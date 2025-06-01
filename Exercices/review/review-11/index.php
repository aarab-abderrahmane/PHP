<?php

    include "connection-db.php";
    // const abdu = "jde";
    // echo abdu;

    $pass = "mydb";
    $hashedpass = password_hash($password,PASSWORD_DEFAULT);
    echo $hashedpass;

    $all_images = $conn->query("SELECT img FROM images");

    

    if($_SERVER['REQUEST_METHOD']==="POST"){

        $file = $_FILES['file'] ?? "";

        if (!empty($file)){
            $file_content = file_get_contents($file['tmp_name']);
            $stm = $conn->prepare("INSERT INTO images (img) VALUES (?)");
            $null = NULL;
            $stm->bind_param('b',$null);
            $stm->send_long_data(0,$file_content);
            $stm->execute();

        }



        // $get_text = file_get_contents($file['tmp_name']);
        // echo $get_text;

        // readfile($file['tmp_name']);
        // file_put_contents($file['tmp_name'],"hello world");
        // readfile($file['tmp_name']);



        
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form method="post" enctype="multipart/form-data">

        <input type="file" name="file" accept="image/png">    
        <button type="submit">Send</button>
    </form>

    <div>
        <?php

            if($all_images->num_rows >0 ){

                foreach($all_images->fetch_all(MYSQLI_ASSOC) as $image){
                    $img_data = base64_encode($image['img']);
                    echo "<img src='data:image/png;base64,$img_data' width='200' height='200' >";

                }

            }
        
        ?>
    </div>
    
</body>
</html>