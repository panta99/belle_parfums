<?php 
    session_start();
    header('Content-Type: application/json');
    if($_SERVER['REQUEST_METHOD']== 'POST'){
       include "../config/connection.php";
       include "functions.php";
       try{
        $greska = 0;
        $statusniKod = "";
        $odgovor = "";
        $rezLogovanja;
        $email = $_POST["email"];
        $passwd = $_POST["password"];
        $regExEmail = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        $regExPasswd = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[#?!@$%^&*-]).{8,}$/";
        if(!preg_match($regExEmail, $email)){
            $greska++;
        }
        if(!preg_match($regExPasswd, $passwd)){
            $greska++;
        }
        if($greska != 0){
            $odgovor =["poruka"=>"Data processing error"];
            $statusniKod = 422;
        }
        else{
            $sifPasswd = sha1($passwd);
            $korisnik = checkLogIn($email,$sifPasswd);
            if($korisnik){
                $_SESSION['korisnik'] = $korisnik; 
                $odgovor = ["poruka"=>"Successful login"];
                $statusniKod = 200;
                header("Location: ../index.php");
            }
            else{
                $odgovor = ["poruka"=>"You have entered an invalid username or password"];
                $statusniKod = 401;
            }
        }
        echo json_encode($odgovor);
        http_response_code($statusniKod);
        }
        catch(PDOException $ex){
            http_response_code(500);
        }
    }
    else{
        http_response_code(404);
     }   
?>