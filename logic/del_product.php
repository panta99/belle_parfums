<?php 
    include "../config/connection.php";
    include "functions.php";
    session_start();
    $korisnik;
    if($_SESSION['korisnik']->role_name != "admin"){
        http_response_code(401);
        header("Location: ../products.php");
    }
    else{
    if($_SERVER['REQUEST_METHOD']== 'GET' && isset($_GET['id'])){
        $idSend = $_GET['id'];
        deleteProduct($idSend);
        header("Location: ../delete_products.php");
    }
    else{
        echo "<h1>Error 404 NOT FOUND</h1>";
    } }
?>