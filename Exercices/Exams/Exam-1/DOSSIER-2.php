<?php

    #calculSomme
    $x=5;
    $y= 10;

    function CalculSomme($x,$y){
        return $x + $y;
    };

    echo "la Somme de $x + $y est : ",CalculSomme($x,$y),"";


?>


<?php

    function AfficherDecision(float $number){

        if ($number >=10){
            return "Réussite";

        }else{
            return "échec";
        }


    }

    echo "<br>",AfficherDecision($x);
    echo "<br>",AfficherDecision($y),"</br>";



?>


<?php 

    $villes = ['Rabat','Casablanca','Tanger'];

    echo "<ul>";
    foreach ($villes as $ville){
        echo "<li>$ville</li>";
    }
    echo "</ul><br>";

?>

<?php

    #calcule le montant des allocations 

    function amountAllowance(int $numberOfChild){

        if ($numberOfChild == 1){
            return "300 dh";
        }elseif($numberOfChild == 2){
            return "500 dh";
        }elseif($numberOfChild >= 3){
            return "600 dh";
        }
    }

?>


<?php
// Get login form inputs
$login = $_POST['login'] ?? '';
$password = $_POST['password'] ?? '';

$conn = mysqli_connect('localhost', 'root', '', 'ISTA');

if (!$conn) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

// Prepare and execute the query
$query = "SELECT * FROM users WHERE login='$login' AND password='$password'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo "Authentification réussie.";
} else {
    echo "Login ou mot de passe incorrect.";
}

mysqli_close($conn);
?>


<?php

    $query = "SELECT * FROM users";
    $result = mysqli_query($conn,$query);

    while ($row = mysqli_fetch_assoc($result)){
        echo $row['nom'];
    }

?>
