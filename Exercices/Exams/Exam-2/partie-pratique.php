
<?php

    $nbr=8;
    $i =0;

    for ($nbr ; $nbr >= 0; $nbr--){

        for ($j=0 ; $j < $nbr; $j++ ){
            echo '* ';
        }

        for ($j=0 ; $j < $i ; $j++){
            echo'1 ';
        }

        
        $i++;
        echo "<br>";

    }

?>

<!-- Exerccice 3 :  -->

<?php
    echo "<br><br>";
    $t1 = 10;

    // if ($_SERVER['REQUEST_METHOD']=="POST")
    if ($t1){

        // $t1 = isset($_POST['t1'])  ? $_POST['t1'] : '';

        if (!empty($t1) && is_numeric($t1)){

            $somme=0 ;

            echo "le programme affiche : ";
            for ($i=1 ; $i<=$t1 ; $i++){
                $somme+=$i;
                echo $i < $t1 ? $i .' + ' : $i;
            }

            // $somme = array_sum($somme);
            echo " = $somme";




        }
    }

?>

<!-- Exercice 4 : -->

<?php


    #mysqli procedural

    #code connection base données 

    $query = "SELECT * FROM Etudiant";
    $result = mysqli_query($cnx,$query);

    if ($result){
        echo `
            <table>
                <th>
                    <td>code Etudiant</td>
                    <td>nom</td>
                    <td>prenom</td>
                    <td>age</td>
                    <td>Moyenne Bac</td>
                </th>
        `;


        while ($row = mysqli_fetch_assoc($result)){
                echo `
                    <tr>
                        <td>`.$row['code_Etudiant'].`</td>
                        <td>`.$row['nom'].`</td>
                        <td>`.$row['prenom'].`</td>
                        <td>`.$row['age'].`</td>
                        <td>`.$row['moyenne_Bac'].`</td>
                    </tr>
                `;
        }

        echo "</table>";

    }


?>

<?php

    #PDO 
    try{
        $conn = new PDO('mysql:host=localhost;dbname=Ecole',"root","");
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        $query = "SELECT * FROM Etudiant";
        $result = $conn->query($query);

        echo "
            <table>
                <th>
                    <td>code Etudiant</td>
                    <td>nom</td>
                    <td>prenom</td>
                    <td>age</td>
                    <td>Moyenne Bac</td>
                </th>
        ";

        foreach($result as $row){
            echo `
            <tr>
                <td>`.$row['code_Etudiant'].`</td>
                <td>`.$row['nom'].`</td>
                <td>`.$row['prenom'].`</td>
                <td>`.$row['age'].`</td>
                <td>`.$row['moyenne_Bac'].`</td>
            </tr>
            `;
        }
        echo "</table>";


    } catch(PDOException $e){
        echo "Erreur : ".$e->getMessage();
    }


?>