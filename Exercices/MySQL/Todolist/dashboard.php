<!-- Categorie (idCat, libelle)
Todo(idTodo, text, #idCat,image,#idUser)
User(idUser, nom ,prenom,email,password,role (admin/user))
créer la base de données avec la contrainre FK
créer le fichier db.php
créer la page connexion.php 
un user va être redireger vers myTodos.php (qui afficher uniquement la liste de ses todos)  avec possibilité de delete and update
un admin vas être etre rediriger vers dashboardadmin.php  un select qui affiche la liste des users ( on change un table html va afficher tout les todos de l user selectionné ) et bien sur admin peut modifier et supprimer les todos -->



<?php 
        include "connection-db.php";

        $query = "SELECT * FROM category";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <title>Document</title>
</head>
<body class="bg-dark">
    
    <header>

    </header>

    <div class="container ">
            <form method="post" class="needs-validation" novalidate>

                <input type="hidden" name="idtodo">

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" id="title" required>

                </div>
                
                <div class="mb-3">
                    <label for="text" class="form-label">Text</label>
                    <textarea name="text" id="text" class="form-control" required></textarea>

                </div>

                <div class="mb-3">
                    <label for="options" class="form-label">Category</label>
                    <select name="category" id="options" class="form-select" required>
                        <option value="" disabled selected>Select a category</option>
                    </select>

                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" id="image" name="image" class="form-control" accept="image/jpg, image/png, image/jpeg, image/gif">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
    </div>

</body>
</html>