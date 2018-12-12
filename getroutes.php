<?php
    include 'session.php';

    //If it is an admin logged in, get all routes. If it is a guardian, then get only some routes
    if($_SESSION["is_admin"]){
        $stmt = $pdo->prepare('CALL prcGetRoutes();');
    }
    else{
    $stmt = $pdo->prepare('CALL prcGetSomeRoutes(\''.$user_shuttle.'\');');
    }

    $stmt->execute();

  
    $json = '{ "routes": [';

    foreach ($stmt as $row) {
        $json .= $row['json'];
        $json .= ',';
    }
   
    $json = rtrim($json, ",");
    $json .= '] }';

    header('Content-Type: application/json');
    echo $json;
    
?>
