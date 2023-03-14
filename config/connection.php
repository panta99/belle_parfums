<?php
    $server = "localhost";
    $dataBase = "belle_parfums";
    $userName = "root";
    $password = "";
    try{
        $conn = new PDO("mysql:host=".$server.";dbname=".$dataBase.";charset=utf8", $userName, $password);
        
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $ex){
        echo $ex->getMessage();
    }
?>