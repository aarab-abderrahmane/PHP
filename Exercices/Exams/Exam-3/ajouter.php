<?php
    include 'inc_connection.php';

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $errors=[];

        $id = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : '';
        $nom = isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : '';
        $prenom = isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : '';
        $tel = isset($_POST['tel']) ? htmlspecialchars($_POST['tel']) : '';
        $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
        $adress = isset($_POST['adress']) ? htmlspecialchars($_POST['adress']) : '';


        $inputs = ['id'=>$id,'nom'=>$nom,'prenom'=>$prenom,'tel'=>$tel,'email'=>$email,'adr'=>$adress];
        $isAllCheck = True;
        foreach($inputs as $key=>$value){
            if(!isset($value)){

                $isAllCheck = false;

            }elseif(empty($value)){
                $errors[$key]="invalide $key";

            }elseif($key === 'email'){
                if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $errors[$key]="invalide $key syntax";

                }
            }
        }

        if(empty($errors)){
            $sql = "INSERT INTO fournisseurs (idFourn,nomFourn,prenomFourn,telFourn,emailFourn,adrFourn)
                    VALUES (?,?,?,?,?,?)";
            
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id,$nom,$prenom,$tel,$email,$adress]);

        }

    }
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire de Contact</title>
    <style>
        form {
            max-width: 400px;
            margin: 40px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-family: Arial, sans-serif;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            box-sizing: border-box;
            border-radius: 7px;
            outline: none;
            border:1px solid gray
        }
        button {
            margin-top: 15px;
            padding: 10px 15px;
            background-color: #4285f4;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #3367d6;
        }
    </style>
</head>
<body>

<form  method="post">
    <label for="id">ID :</label>
    <input type="number" name="id" id="id" required>

    <label for="nom">Nom :</label>
    <input type="text" name="nom" id="nom" required>

    <label for="prenom">Prénom :</label>
    <input type="text" name="prenom" id="prenom" required>

    <label for="tel">Téléphone :</label>
    <input type="tel" name="tel" id="tel" required pattern="[0-9]{10}" placeholder="Ex: 0612345678">

    <label for="email">Email :</label>
    <input type="email" name="email" id="email" required>

    <label for="adresse">Adresse :</label>
    <textarea name="adress" id="adresse" rows="3" required></textarea>

    <button type="submit">Envoyer</button>
</form>

</body>
</html>
