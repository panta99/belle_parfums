<?php
    include "../config/connection.php";
    include "functions.php";
    session_start();
    if($_SERVER['REQUEST_METHOD']== 'POST'){
        global $conn;
        $greska = 0;
        $regExFirstName = '/^[A-ZČĆŠĐŽ][a-zčćžđš]{2,15}(\s[A-ZČĆŠĐŽ][a-zčćžđš]{2,15}){0,1}$/';
        $regExLastName = '/^[A-ZČĆŠĐŽ][a-zčćžđš]{2,15}(\s[A-ZČĆŠĐŽ][a-zčćžđš]{2,15}){0,1}$/';
        $regExCity = '/^[a-zA-Z][a-zA-Z]*( [a-zA-Z][a-zA-Z]*){0,8}$/';
        $regExAddress = '/^[a-zA-Z0-9]+( [a-zA-Z0-9]+)*$/';
        $regExPhoneNumber = '/^\+?\d{1,3}[ -]?\d{3}[ -]?\d{3}[ -]?\d{4}$/';
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $city = $_POST['city'];
        $address = $_POST['address'];
        $id_user = $_SESSION['korisnik']->id_user;
        $phoneNumber = $_POST['phoneNumber'];
        $products = json_decode($_POST['products']);
        if(!preg_match($regExFirstName, $firstName)){
            $greska++;
        }
        if(!preg_match($regExLastName, $lastName)){
            $greska++;
        }
        if(!preg_match($regExFirstName, $firstName)){
            $greska++;
        }
        if(!preg_match($regExCity, $city)){
            $greska++;
        }
        if(!preg_match($regExAddress, $address)){
            $greska++;
        }
        if(!preg_match($regExPhoneNumber, $phoneNumber)){
            $greska++;
        }
        foreach($products as $prod){
            if($prod->kolicina == 0 || $prod->kolicina==null){
                $greska++;
            }
        }
        if($greska != 0){
            http_response_code(422);
        }
        else{
            insertOrder($firstName,$lastName,$city,$address,$phoneNumber,$products,$id_user);
            echo json_encode("Successful");
            http_response_code(200);
        }
    }
    else{
        http_response_code(404);
    }
?>