<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>

        *{
            font-family: monospace;
            font-size: 1rem;
        }
        body{
            margin: 0;
            display: grid;
            grid-template-columns: 300px 1fr;
        }

        body > div:first-child{
            margin-top: 50px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            align-items: center;

        }

        .marke{
            border:1px solid black;
            padding: 10px 15px;
            width: 140px;

            position: relative;

        }

        /* .marke{

            background-color: black;
            width: 20px;
            height: auto;
        } */

        .marke::after{
            content: "";
            width: 10px;
            height: 100%;
            position: absolute;
            right: 0;
            top:0;
            background-color: black;
        }

        form{
            width: 80%;
            max-width: 800px;
        }

        fieldset{
            display: flex;
            flex-direction: column;
            gap:10px;
        }

        .container{
            margin-top:50px;
        }


    </style>
</head>
<body>


    <div>
        <div class="marke">
            <a href="">Accueil</a>
        </div>

        <div class="marke">
            <a href="">Ajouter</a>
        </div>

        <div class="marke">
            <a href="">Rechercher</a>
        </div>

        <div class="marke">
            <a href="">Modifier</a>
        </div>

        <div class="marke">
            <a href="">Supprimer</a>
        </div>

        <div class="marke">
            <a href="">Afficher</a>
        </div>

    </div>
    <div class="container">
        <h1>Site Inscription des Stagiaires</h1>
        <form method="post" >

            <fieldset>

                <legend>Fiche Stagaire</legend>
                <div>
                code : 
                <input type="text" name="code">
                </div>

                <div>
                Nom : 
                <input type="text" name="nom">
                </div>

                <div>
                Prenom : 
                <input type="text" name="prenom">
                </div>

                <div>
                    Homme
                    <input type="radio" name="gender" value="homme">
                    Femme
                    <input type="radio" name="gender" value="femme">
                </div>

                <div>
                    Filiere : 
                    <input type="text" name="filiere">
                </div>


                <div>
                    <button type="reset">Effacer</button>
                    <button type="submit">Envoyer</button>
                </div>
            </fieldset>

        </form>
    </div>
    
</body>
</html>