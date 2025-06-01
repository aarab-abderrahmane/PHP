<?php

    if($_SERVER['REQUEST_METHOD']==="POST"){

        $image = $_FILES['image'] ?? "";
        if(isset($_FILES['image']) && !empty($image) && $_FILES['image']['error'] === UPLOAD_ERR_OK){

            $image_name = $image['name'];
            $uploadDir = "uploads/"; 
            $image_path = $uploadDir.basename($image_name);

            if (!is_dir('uploads/')){
                mkdir("uploads/",0755,true);

            }

            $allowed_type = ['png',"gif"];
            $image_type = strtolower(pathinfo($image_path,PATHINFO_EXTENSION));
            if(in_array($image_type,$allowed_type)){

                if($image['size'] < 5*1024*1024){

                    if(move_uploaded_file($image['tmp_name'],$image_path)){

                        setcookie("image",$image_path,time()+3600,"/");

                    }
                    header("Location: ".$_SERVER['PHP_SELF']);


                }
                

            
            }

        }elseif(isset($_FILES['new_image']) && $_FILES['new_image']['error']=== UPLOAD_ERR_OK){

            $image = $_FILES['new_image'] ?? "";
            if(!empty($image)){

                $allowed_types=['png',"gif"];
                $new_image_type = strtolower(pathinfo($image['name'],PATHINFO_EXTENSION));
                if(in_array($new_image_type,$allowed_types) && $image['size'] < 5*1024*1024){

                    $new_image_path = "uploads/".basename($image['name']);
                    if(!file_exists($new_image_path)){

                        unlink($_COOKIE['image']);
                        if(move_uploaded_file($image['tmp_name'],$new_image_path)){

                            setcookie("image",$new_image_path,time()+3600,"/");
                            

                        }else{
                            setcookie("image","",time()-3600,"/");
                        }

                        header("Location: ".$_SERVER['PHP_SELF']);


                    }


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
</head>
<body>


<div>

</div>
<div>
    
</div>

    <form  method="post"  enctype="multipart/form-data">

        <?php if(!isset($_COOKIE['image'])) : ?>
        <input type="file" name="image">
        <?php else : ?>
        <img src="<?= $_COOKIE['image'] ?>" width="100" height="100">
        <input type="file" name="new_image">
        <?php endif; ?>
        <button type="submit">Save</button>

    </form>
    
</body>
</html>