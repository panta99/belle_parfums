<?php 
    include "../config/connection.php";
    include "functions.php";
    if($_SERVER['REQUEST_METHOD']== 'GET' && isset($_GET['activ_code'])){
        $activcode = $_GET["activ_code"];
        $stampaj = activateAcc($activcode);
        echo "<h1>".$stampaj."</h1>";
    }
    else{
        echo "<h1>Error 404 NOT FOUND</h1>";
    }
?>