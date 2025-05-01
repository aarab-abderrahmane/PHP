<!-- Categorie (idCat, libelle)
Todo(idTodo, text, #idCat,image,#idUser)
User(idUser, nom ,prenom,email,password,role (admin/user))
créer la base de données avec la contrainre FK
créer le fichier db.php
créer la page connexion.php 
un user va être redireger vers myTodos.php (qui afficher uniquement la liste de ses todos)  avec possibilité de delete and update
un admin vas être etre rediriger vers dashboardadmin.php  un select qui affiche la liste des users ( on change un table html va afficher tout les todos de l user selectionné ) et bien sur admin peut modifier et supprimer les todos -->


<?php

        if(!isset($_COOKIE['user_email'])){
            header('Location: login.php');
            exit;
        }


        include 'connection-db.php';
        $email_user = $_COOKIE['user_email'];

        $id_user_query  = "SELECT idUser FROM userss WHERE email ='$email_user'";

        $id_result = mysqli_query($connection,$id_user_query);

        if($id_result && $row=mysqli_fetch_assoc($id_result)){
            $id_user = $row['idUser'];

            $query_todos = "SELECT * FROM todouser WHERE idUser='$id_user'";
            $todos_result = mysqli_query($connection,$query_todos);


        }




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <title>Document</title>


    <style>
        body{
            background-color: #242423;
            font-family: monospace;
        }

        .navbar-toggler-icon{
            width: 20px;
            height: 20px;
        }

        .link-add{
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .link-add:hover{
            text-decoration: underline;
        }

        @media (max-width:1000px){
            .link-add{
                text-decoration: underline;
            }
        }

        main{
            width: 100%;
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 300px));
            gap: 15px;
            justify-content: center;
        }

        .card{
            background-color: #000000;
            border-radius:5 ;
            color:white;
            
        }

        .card hr {background-color: white;height: 2px;width: 100%;padding: 0;margin: 0;}

        .card .text {
            padding: 10px;
        }
        .card .category{padding:5px 10px 0 10px;background-color: ;}

        .card:hover{
            box-shadow: 4px 4px 0px white;
        }

        .image{
            width: auto;
            height: 300px;
            border-radius: 5px;
            border-bottom-left-radius: 0px;
            border-bottom-right-radius: 0px;
        }

        .navbar{
            background-color: #000000 !important;
        }
        .navbar-brand {color:white !important};

        .custom-input:focus {
            outline: none !important;
            box-shadow: none !important;
            border-color: #ffffff !important;
            background-color: #000000 !important;
            color: #ffffff !important;
            outline : 2px solid white !important;
        }

        b{
            user-select: none;
            -webkit-user-select: none; /* For Safari */
            -moz-user-select: none;    /* For Firefox */
            -ms-user-select: none;     /* For Internet Explorer/Edge */
        }
        

        .nav-item:hover{
            border: 2px solid white !important;
            border-radius: 15px !important;
        }

/* 
        @meadi (min-width:13001px){
            .todos{
                padding: 50vw;
            }
        }*/

        @media (max-width:992px) {
            .nav-item{
                margin: 5px 0 !important;
            }
            body{
                font-size: 0.8rem;
            }


        } 

        



    </style>
</head>
<body>
    

        <nav class="navbar navbar-expand-lg  py-3" >
                <div class="container-fluid" >
                    <a class="navbar-brand" href="#">MySite</a>

                    <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0"> <!-- Removed the incorrect semicolon -->
                            <li class="nav-item ms-3">
                                <a class="nav-link active px-4" aria-current="page" href="#"  style="background-color: white;color:black;border:none !important;border-radius:15px !important">Home</a>
                            </li>

                            <li class="nav-item mx-3">
                                <a class="btn btn-danger" style="background-color: black;color:white;border:none;border-radius:15px !important"  href="#">Archive</a>
                            </li>

                            <li class="nav-item ">
                                <a class="btn btn-danger" style="background-color: black;color:white;border:none;border-radius:15px !important" href="todo.php">Add ToDo</a>
                            </li>

                            <li class="nav-item dropdown mx-3">
                                <a class="btn btn-danger dropdown-toggle" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: black; color: white; border: none; border-radius: 15px !important;">
                                    Account
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="accountDropdown">
                                    <li><a class="dropdown-item" href="account.php">Profile</a></li>
                                    <li><a class="dropdown-item" href="logout.php" >logout</a></li>
                                </ul>
                            </li>

                        </ul>

                        <form class="d-flex" role="search">
                            <input id="search-input" class="custom-input rounded-3 mx-3 px-2" type="text" placeholder="Search" aria-label="Search">
                            <button class="btn btn-success" style="background-color:#ff8ae4;color:black" type="submit">Search</button>
                        </form>

                    </div>
                </div>
            </nav>

        <div>
            <?php  if(mysqli_num_rows($todos_result) <=0)  : ?>
                <p class='alert alert-warning mt-5 text-center '>You haven't added anything yet <a class='link-add' href='todo.php' target='_Blank' >Click here to add.</a></p>
            <?php endif;?>
        </div>
        <div >

        <main class="todos w-100">

                <?php
                
                    if(mysqli_num_rows($todos_result) > 0){
                        


                        while($row=mysqli_fetch_assoc($todos_result)){
                                
                                $category_query = "SELECT libelle FROM categorie WHERE idCat=".$row['idCat'].""; 
                                $category_result = mysqli_query($connection,$category_query);

                                $imageData = $row['image'];
                                $base64Image = base64_encode($imageData);
                                $imageSrc = "data:image/png;base64,".$base64Image;

                                echo "
                                
                                    <div class='card'>
                                        <img src=".$imageSrc." class='image' oncontextmenu='return false;' draggable='false' ><br>
                                        <div class='text'>
                                        <p><b>Title : </b>".$row['titleTodo']."</p>
                                        <p><b>description : </b>".$row['textTodo']."</p>
                                        
                                        </div>
                                        <div><hr></div>
                                        <div class='category'>
                                        <p><b style='background-color:#ff89e3;color:black'>category :</b>  ".mysqli_fetch_assoc($category_result)['libelle']."</p>
                                        </div>
                                    </div>
                                ";
                        }
                    }
                ?>

        </main>
        </div>        


</body>
</html>