<?php 
     include "../config/connection.php";
     include "functions.php";
    session_start();
    $responseCode = 200;
    if($_SERVER['REQUEST_METHOD']== 'POST'){
        $message = $_POST['message'];
        $idUser = $_POST['id_user'];
        $regExPoruka = "/^.{1,1000}$/";
        if(!preg_match($regExPasswd,$confirmPassword)){ 
        insertMessage($message,$idUser);
        $responseCode = 200;
        $odgovor = ["poruka"=>"Done"];
        }
        else{
            $responseCode = 422;
        }
    }
    else{
        $responseCode = 404;
        $odgovor = ["poruka"=>"PAGE NOT FOUND"];
     }
    echo json_encode($odgovor);
    http_response_code($responseCode);
?>