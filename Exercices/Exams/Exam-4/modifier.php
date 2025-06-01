<?php
    include 'connection-db.php';

    $result = $conn->query('SELECT * FROM stagiaires');

    $stagiaire = null;

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $code = isset($_POST['code'] ) ? $_POST['code'] :  "";

        if (!empty($code)) {
            $sql = "SELECT * FROM stagiaires WHERE code = $code";
            $res = $conn->query($sql);

            if ($res && $res->num_rows > 0) {
                $stagiaire = $res->fetch_assoc();
            }

        }else{

            $code = $_POST['new_code'];
            
            $new_nom = $_POST['new_nom'] ?? "";
            $new_prenom = $_POST['new_prenom'] ?? "";
            $new_filiere = $_POST['new_filiere'] ?? "";

            if( !empty($new_nom) && !empty($new_filiere) && !empty($new_prenom)){

                $stm =$conn->prepare("UPDATE stagiaires SET nom = ? , prenom = ? , filiere = ?  WHERE code = ?");
                $stm->bind_param("sssi",$new_nom,$new_prenom,$new_filiere,$code);
                $stm->execute();
                

            }

        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modifier Stagiaire</title>
</head>
<body>

    <div>
        <form method="post">

            <input type="hidden" name="new_code" value="<?= isset($stagiaire['code']) ? $stagiaire['code'] : "" ?>">

            New Nom:
            <input type="text" name="new_nom" value="<?= isset($stagiaire['nom']) ? $stagiaire['nom'] : "" ?>">

            New Prénom:
            <input type="text" name="new_prenom" value="<?= isset($stagiaire['prenom']) ? $stagiaire['prenom'] : "" ?>">

            New Filière:
            <input type="text" name="new_filiere" value="<?= isset($stagiaire['filiere']) ? $stagiaire['filiere'] : "" ?>">

            <button type="submit">Save Edit</button>

        </form>
    </div>

    <div class="container">
        <?php
            if ($result->num_rows > 0) {
                $stagiaires = $result->fetch_all(MYSQLI_ASSOC);

                foreach ($stagiaires as $row) {
                    echo "
                        <div style='border:1px solid #ccc;margin-bottom:10px;padding:10px'>
                            <p><b>Code: </b>".$row['code']."</p>
                            <p><b>Nom: </b>".$row['nom']."</p>
                            <p><b>Prénom: </b>".$row['prenom']."</p>
                            <p><b>Sexe: </b>".$row['sexe']."</p>
                            <p><b>Filière: </b>".$row['filiere']."</p>
                            <form method='post'>
                                <input type='hidden' name='code' value='".$row['code']."'>
                                <button type='submit'>Modifier</button>
                            </form>
                        </div>
                    ";
                }
            }
        ?>
    </div>

</body>
</html>
