<?php
    include "../config/connection.php";
    include "functions.php";
    header('Content-Type: application/json');
    if($_SERVER['REQUEST_METHOD']== 'POST'){
        $greske = 0;
        $odgovor = '';
        $responseCode = 200;
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $oldPassword = $_POST['oldPassword'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $regExFirstName = "/^[A-ZČĆŠĐŽ][a-zčćžđš]{2,15}(\s[A-ZČĆŠĐŽ][a-zčćžđš]{2,15}){0,1}$/";
        $regExLastName = "/^[A-ZČĆŠĐŽ][a-zčćžđš]{2,15}(\s[A-ZČĆŠĐŽ][a-zčćžđš]{2,15}){0,1}$/";
        $regExEmail = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        $regExPasswd = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[#?!@$%^&*-]).{8,}$/";
        if(!preg_match($regExFirstName,$firstName)){
            $greske++;
        }
        if(!preg_match($regExLastName,$lastName)){
            $greske++;
        }
        if(!preg_match($regExPasswd,$oldPassword)){
            $greske++;
        }
        if(!preg_match($regExEmail,$email)){
            $greske++;
        }
        if($password != ''){
            if(!preg_match($regExPasswd,$password)){
                $greske++;
            }
        }
        if($confirmPassword != ''){
            if(!preg_match($regExPasswd,$confirmPassword)){
                $greske++;
            }
        }
        if($password != $confirmPassword){
            $greske++;
        }
        if($greske !=0){
            $odgovor =["poruka"=>"Data processing error"];
            $responseCode = 422;
        }
        else{   
            if(!checkMailInDb($email)){
                $odgovor = ["poruka" => "Email not found"];
                $responseCode = 409;
            }
            else{
                if(checkCurrentPassword($oldPassword))
                {
                    changeProfile($firstName,$lastName,$oldPassword,$password,$email);
                    $responseCode = 200;
                    $odgovor = ["poruka" => "Successful change"];
                }
                else{
                    $responseCode = 401;
                    $odgovor = ["poruka" => "Wrong password"];
                }
            }
        }
        echo json_encode($odgovor);
        http_response_code($responseCode);
    }
    else{
        http_response_code(404);
    }
?>