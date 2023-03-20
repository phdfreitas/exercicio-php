<?php

    require_once 'db.php';

    try{
        $stmt = $pdo->prepare("INSERT INTO api_call (country) VALUES (:pais)");
        $stmt->execute(array(
            ':pais' => $_GET['pais']
        ));
    }catch(PDOException $e){
        echo $e->getMessage();
    }

?>