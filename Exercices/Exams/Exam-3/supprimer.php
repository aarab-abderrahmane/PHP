<?php
    include 'inc_connection.php';

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query="DELETE FROM fournisseurs WHERE idFourn= :id";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->execute();

        header('Location: afficher.php');
        exit();

    }

?>