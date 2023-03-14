<?php 
     include "../config/connection.php";
     include "functions.php";
    session_start();
    header('Content-Type: application/json');
    if($_SERVER['REQUEST_METHOD']== 'POST'){
        $noviBrend = $_POST['newBrend'];
        global $conn;
        $upit = "INSERT INTO brands (id_brand,brand_name) VALUE ('',:noviBrend)";   
        $priprema = $conn->prepare($upit);
        $priprema->bindParam(":noviBrend",$noviBrend);
        $priprema->execute();
        $reponseCode = 200;
    }
    else{
        $reponseCode = 404;
    }
    http_response_code($reponseCode);
?>