<?php
     include "../config/connection.php";
     include "functions.php";
    session_start();
    header('Content-Type: application/json');
    if($_SERVER['REQUEST_METHOD']== 'POST'){
    global $conn;
    $korpa = $_POST['ids'];
    $selektovani = '';
    $selektovani = implode(',', $korpa);
    $upit = "SELECT * FROM products p JOIN prices pr ON p.id_product=pr.id_product JOIN brands b ON p.id_brand=b.id_brand WHERE p.id_product IN (".$selektovani.")";
    $rezultat = $conn->query($upit)->fetchAll();
    echo json_encode($rezultat);
    http_response_code(200);
    }
    else{
        http_response_code(404);
    }
?>