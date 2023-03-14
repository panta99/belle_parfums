<?php
    include "../config/connection.php";
    include "functions.php";
    session_start();
    if($_SERVER['REQUEST_METHOD']== 'GET' && isset($_GET['id'])){
        if($_SESSION['korisnik']->role_name != "admin"){
            http_response_code(401);
            header("Location: ../products.php");
        }
        else{ 
        $idSend = $_GET['id'];
        promeniStatus($idSend);
        header("Location: ../orders.php");
        }
    }
    else{
        echo "<h1>Error 404 NOT FOUND</h1>";
    }
?>