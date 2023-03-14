<?php
     include "../config/connection.php";
     include "functions.php";
    session_start();
    header('Content-Type: application/json');
    if($_SERVER['REQUEST_METHOD']== 'POST'){
        $idAns = $_POST['id_answer'];
        $idUser = $_SESSION['korisnik']->id_user;
        $idPoll = $_POST['anketaId'];
        writeAnswer($idAns,$idUser,$idPoll);
        echo json_encode("Successful");
        http_response_code(200);
    }
    else{
        http_response_code(404);
    }

?>