<?php

    require_once 'db.php';

    $consulta = $pdo->query(
        "SELECT country, DATE_FORMAT(moment, '%d/%m/%Y %H:%i:%s') as moment 
            FROM api_call WHERE id = (SELECT count(id) from api_call)"    
    );

    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        echo "Última consulta: " . $linha['country'] . " - " . $linha['moment'];
    }

?>