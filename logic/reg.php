<?php
     header('Content-Type: application/json');
     if($_SERVER['REQUEST_METHOD']== 'POST'){
        include "../config/connection.php";
        include "functions.php";
     try{
        $greska = 0;
        $statusniKod = "";
        $odgovor = "";
        $firstname = $_POST["firstName"];
        $lastname = $_POST["lastName"];
        $email = $_POST["email"];
        $passwd = $_POST["password"];
        $btnClicK = $_POST["btnClicK"];
        $regExFirstName = "/^[A-ZČĆŠĐŽ][a-zčćžđš]{2,15}(\s[A-ZČĆŠĐŽ][a-zčćžđš]{2,15}){0,1}$/";
        $regExLastName = "/^[A-ZČĆŠĐŽ][a-zčćžđš]{2,15}(\s[A-ZČĆŠĐŽ][a-zčćžđš]{2,15}){0,1}$/";
        $regExEmail = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        $regExPasswd = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[#?!@$%^&*-]).{8,}$/";
        if(!preg_match($regExFirstName,$firstname)){
            $greska++;
        }
        if(!preg_match($regExEmail, $email)){
            $greska++;
        }
        if(!preg_match($regExLastName, $lastname)){
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
        if(checkMailInDb($email)){
            $odgovor = ["poruka" => "The email is already in use, try another one"];
            $statusniKod = 409;
        }
        else{
            if(regUpis($firstname,$lastname,$email,$passwd))
            {
            $statusniKod = 201;
            $odgovor = ["poruka"=> "Check your mail for activation link"];
        }}
        }
        echo json_encode($odgovor);
        http_response_code($statusniKod);
     }  
     catch(PDOException $ex){
        http_response_code(500);
     }}
     else{
        http_response_code(404);
     }    
?>