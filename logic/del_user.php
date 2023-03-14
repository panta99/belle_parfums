<?php 
     include "../config/connection.php";
     include "functions.php";
    session_start();
    echo $_GET['id'];
    $responseCode;
    if(isset($_SESSION['korisnik']) && isset($_GET['id']))
    {
        $id = $_GET['id'];
        $korisnik = $_SESSION['korisnik'];
        if($korisnik->role_name == "admin"){
            $kor = selektujZaBrisanje($id);
            if($kor->role_name=="admin"){
                http_response_code(403);
                header("Location: ../users_info.php");
            }
            else{
                obrisiKorisnika($id);
                header("Location: ../users_info.php");
            }
        }
        else{
            http_response_code(403);
        }
    }
?>