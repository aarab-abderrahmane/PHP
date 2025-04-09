<?php

    $data = isset($_COOKIE['users'])  ? json_decode($_COOKIE['users'],true) : [];



?>  



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body{
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container{
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;    
            }

        .btn-edit{
            background-color: blue;
            cursor: pointer;

        }

        .btn-add{
            background-color: green;
            cursor: pointer;
        }


        .actions >*{
            width: 100px;
            height: 35px;
            border-radius: 15px;
            color : white;
            border : 2px solid black ;
            
        }

        .actions > *:hover{opacity: 0.7;}
        <?php
            if(empty($data)){
                echo '
                    .btn-edit:hover{
                        opacity:1;
                    }
                ';
            }
        ?>



    </style>
</head>
<body>  
        <h2>Users List : </h2>
        <div class="actions">
                <?php
                    if(empty($data)){
                        echo '<button disabled class="btn-edit" onclick="open_edit_page()">edit</button>';
                    }else{
                        echo'<button class="btn-edit" onclick="open_edit_page()">edit</button>';
                    }
                ?>
                <button class="btn-add" onclick="open_add_page()" >Add New user</button>
        </div> 
        <div class="container">

            <?php if(!empty($data)){ ?>
                    <?php foreach ($data as $index => $user): ?>
                        <div class="user_div">
                            <img src="<?= htmlspecialchars($user['image'])?>"  width="100" height="100">
                            <div>
                                <p><b>nom : </b><?= htmlspecialchars($user['nom'])?></p>
                                <p><b>email : </b><?= htmlspecialchars($user['email'])?></p>
                                <p><b>Matricule unique : </b><?= htmlspecialchars($user['matricule'])?></p>
                                <p><b>linkedin URL : </b><?= htmlspecialchars($user['URL'])?></p>
                            </div>
                        </div>       
                        
                    <?php endforeach ?> 


            <?php }else{?>

                <h1>No users found..</h1>
            
            <?php }?>
            

  
                
        </div>



        <script>

            function open_edit_page(index){
                    window.location.href ="edit.php?index=".index
            }

            function open_add_page(){
                window.location.href="add.php";
            }

        </script>


</body>
</html>