<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>

        
    </style>
</head>
<body>
    <h2>Add New User : </h2>
    <div class="container">
        <form method="post">
                <label for="name">Nom</label>
                <input id="name" type="text" name="nom"></input>
                <label for="email">Email</label>
                <input type="text" name="email" id="email">
                <label for="matricule">Nombre de matricule</label>
                <input type="number" min="1000" max="5000" value="1000">
                <label for="URL">Likedin URL</label>
                <input type="URL" name="URL" id="URL">
                <label  for="image">image</label>
                <input type="file" id="image" name="image">
        </from>
    </div>
</body>
</html>