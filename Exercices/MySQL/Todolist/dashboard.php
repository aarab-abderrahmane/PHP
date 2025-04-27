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
    </style>
</head>
<body>
    

        <nav class="navbar navbar-expand-md alert alert-dark m-4 rounded-4">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">MySite</a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0"> <!-- Removed the incorrect semicolon -->
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">ToDos</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#">Archive</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#">Add ToDo</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#">Account</a>
                            </li>
                        </ul>

                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>

                    </div>
                </div>
            </nav>


        <main>

                <?php
                
                    if(mysqli_num_rows($todos_result) <=0){
                        
                        echo "<p class='alert alert-warning mt-5 text-center'>You haven't added anything yet <a class='link-add' href='todo.php' target='_Blank' >Click here to add.</a></p>";
                    }
                ?>

        </main>


</body>
</html>