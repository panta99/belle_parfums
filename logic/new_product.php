<?php 
     include "../config/connection.php";
     include "functions.php";
    session_start();
    header('Content-Type: application/json');
    if($_SERVER['REQUEST_METHOD']== 'POST'){
        global $conn;
        $greska = 0;
        $file = $_FILES['file'];
        $data = json_decode($_POST['data'],true);
        $brand = $data['brand'];
        $category = $data['category'];;
        $volume = $data['volume'];
        $prName = $data['prName'];
        $price = $data['price'];
        $discount = $data['discount'];
        $regExPrName = '/^(?:[A-Za-z][A-Za-z\'-]*\s){0,9}[A-Za-z][A-Za-z\'-]*$/';
        $regExPrice = '/^\d{1,10}$/';
        $regExDiscount = '/^(\d{1,10})?$/';
        $regExImg = '/^.*\.((jpg)|(jpeg)|(png))$/';
        $fileExtensions = array("jpg","jpeg","png");
        $extFile = $file['name'];
        if(!preg_match($regExImg,$extFile)){
            $greska++;
        }
        if(!checkBrand($brand)){
            $greska++;
        }
        if(!checkCategory($category)){
            $greska++;
        }
        if(!checkVolume($volume)){
            $greska++;
        }
        if (!preg_match($regExPrName, $prName)) {
            $greska++;
        }
        if(!preg_match($regExPrice,$price)){
            $greska++;
        }
        if(!preg_match($regExDiscount,$discount)){
            $greska++;
        }
        if($greska !=0){
            $responseCode = 422;
        }
        else{
        if($discount =="")
        $discount = null;
        createNewProduct($brand,$category,$volume,$prName,$price,$discount,$file);
        $responseCode = 201;
        $odgovor = ["poruka"=>"Successfully uploaded new product"];
        }
    }
    else{
        $responseCode = 404;
        $odgovor = ["poruka"=>"PAGE NOT FOUND"];
     }
    echo json_encode($odgovor);
    http_response_code($responseCode);
?>