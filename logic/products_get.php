<?php
    session_start();
    header('Content-Type: application/json');
    if($_SERVER['REQUEST_METHOD']== 'POST'){
    include "../config/connection.php";
    global $conn;
    $upit = "SELECT * FROM products p JOIN prices pr ON p.id_product=pr.id_product JOIN brands b ON p.id_brand=b.id_brand JOIN volume v ON p.id_volume=v.id_volume WHERE p.deleted_at IS NULL";
    $rezultat =  $conn->query($upit)->fetchAll(); 
    echo json_encode($rezultat);
    http_response_code(200);
    }
    else{
        http_response_code(404);
    }
?>