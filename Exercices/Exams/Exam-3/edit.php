<?php

    include 'inc_connection.php';

    if(isset($_POST['id'])){

        $id = $_POST['id'];

        $stmt = $conn->prepare('SELECT * FROM fournisseurs WHERE idFourn = :id');

        $stmt->execute(['id'=>$id]);   //execute() returns a boolean, not a result object.
        echo var_dump(get_class($stmt));

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }
?>

<?php

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $errors=[];

        $new_id = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : '';
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
            // $query = "INSERT INTO fournisseurs (idFourn,nomFourn,prenomFourn,telFourn,emailFourn,adrFourn)
            //         VALUES (?,?,?,?,?,?)";
            if(in_array($id,$all_ids)){
                    $query = "UPDATE fournisseurs SET nomFourn = :nom , prenomFourn = :prenom ,telFourn = :tel ,emailFourn= :email,adrFourn= :adr WHERE idFourn = $id";
            
                    $stmt = $conn->prepare($query);
                    $stmt->execute(['nom'=>$nom,'prenom'=>$prenom,'tel'=>$tel,'email'=>$email,'adr'=>$adress]);
            }
            else{
                $query = "UPDATE fournisseurs SET idFourn = :id ,nomFourn = :nom , prenomFourn = :prenom ,telFourn = :tel ,emailFourn= :email,adrFourn= :adr WHERE idFourn = $id";
                
            
                $stmt = $conn->prepare($query);
                $stmt->execute(['id'=>$new_id,'nom'=>$nom,'prenom'=>$prenom,'tel'=>$tel,'email'=>$email,'adr'=>$adress]);
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
        <input type="number" name="id" id="id" required value="<?php echo $result['idFourn']?>">

        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required  value="<?= $result['nomFourn']?>">

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" required value="<?= $result['prenomFourn']?>">

        <label for="tel">Téléphone :</label>
        <input type="tel" name="tel" id="tel" required pattern="[0-9]{10}" placeholder="Ex: 0612345678"  value="<?= $result['telFourn']?>">

        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required  value="<?= $result['emailFourn']?>">

        <label for="adresse">Adresse :</label>
        <textarea name="adress" id="adresse" rows="3" required  ><?= $result['adrFourn']?></textarea>

        <button type="submit">Save</button>
    </form>


</body>
</html>
