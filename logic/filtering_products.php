<?php
     include "../config/connection.php";
     include "functions.php";
    session_start();
    header('Content-Type: application/json');
    if($_SERVER['REQUEST_METHOD']== 'POST'){
    global $conn;
    $search = $_POST['search'];
    $lowPrice = $_POST['lowPrice'];
    $highPrice = $_POST['highPrice'];
    $sortType = $_POST['sortType'];
    $regExSearch = "/^(?:[A-Za-z][A-Za-z'-]*\s){0,9}[A-Za-z][A-Za-z'-]*$|^$/";
    $regExPrice = '/^[0-9]*$/';
    if(empty($_POST['categories'])){
        $categories = null;
    }
    else{
        $categories = $_POST['categories'];
    }
    if(empty($_POST['brands'])){
        $brands = null;
    }
    else{
        $brands = $_POST['brands'];;
    }
    if(empty($_POST['volumes'])){
        $volumes = null;
    }
    else{
        $volumes = $_POST['volumes'];
    }
    // echo $search;
    // echo $lowPrice;
    // echo $highPrice;
    // // echo $categories;
    // echo "Brendovi";
    // foreach($brends as $b){
    //     echo $b;
    // }
    // // echo $volumes;
    // echo $sortType;
    $proizvodi = $conn->query("SELECT * FROM products p JOIN prices pr ON p.id_product=pr.id_product JOIN brands b ON p.id_brand=b.id_brand JOIN volume v ON p.id_volume=v.id_volume WHERE p.deleted_at IS NULl")->fetchAll();
    $novi = array();
    //Search by name and brand
    if(isset($search) && $search!=''){
        if(preg_match($regExSearch,$search)){
        $search = strtolower($search);
        foreach($proizvodi as $pro){
            $pom = strtolower($pro->brand_name.' '.$pro->product_name);
            if(strpos($pom,$search) !==false){
             $novi[]=$pro;
            }
        }}
        else{
            http_response_code(422);
        }
    }
    else{
        $novi = $proizvodi;
    }
    //Filter by lowest price
    if(isset($lowPrice) && $lowPrice!=''){
        $tmp = array();
        if(preg_match($regExPrice,$lowPrice)){
            foreach($novi as $n){
               if($n->discount != null){
                if($n->discount >= $lowPrice){
                    $tmp[] = $n;
                }
               }
               else{
                if($n->price >= $lowPrice){
                    $tmp[] = $n;
                }
               } 
            }
            $novi = $tmp;
        }
        else{
            http_response_code(422);
        }
    }
    //Filter by highest price
    if(isset($highPrice) && $highPrice!=''){
        $tmp = array();
        if(preg_match($regExPrice,$highPrice)){
            foreach($novi as $n){
               if($n->discount != null){
                if($n->discount <= $highPrice){
                    $tmp[] = $n;
                }
               }
               else{
                if($n->price <= $highPrice){
                    $tmp[] = $n;
                }
               } 
            }
            $novi = $tmp;
        }
        else{
            http_response_code(422);
        }
    }
    //Filter by categories
    if($categories !=null){
        $tmp =[];
        foreach($novi as $n){
            if(in_array($n->id_category,$categories)){
                $tmp[] =$n;
            }
        }
        $novi = $tmp;
    }
    //Filter by brands
    if($brands !=null){
        $tmp = [];
        foreach($novi as $n){
            if(in_array($n->id_brand,$brands)){
                $tmp[] = $n;
            }
        }
        $novi = $tmp;
    }
    //Filter by volume 
    if($volumes != null){
        $tmp=[];
        foreach($novi as $n){
            if(in_array($n->id_volume,$volumes)){
                $tmp[] = $n;
            }
        }
        $novi = $tmp;
    }
    //Sort ascending by prize
        if($sortType=='priceAsc'){
            for($i=0;$i<count($novi);$i++){
                for($j=$i+1;$j<count($novi);$j++){
                    if($novi[$i]->discount != null){
                        if($novi[$j]->discount !=null){
                            if($novi[$i]->discount > $novi[$j]->discount){
                                $tmp = $novi[$i];
                                $novi[$i] = $novi[$j];
                                $novi[$j] = $tmp;
                            }
                        }
                        else{
                           if($novi[$i]->discount > $novi[$j]->price) {
                                $tmp = $novi[$i];
                                $novi[$i] = $novi[$j];
                                $novi[$j] = $tmp;
                           }
                        }
                    }
                    else{
                        if($novi[$j]->discount !=null){
                            if($novi[$i]->price > $novi[$j]->discount){
                                $tmp = $novi[$i];
                                $novi[$i] = $novi[$j];
                                $novi[$j] = $tmp;
                            }
                        }
                        else{
                           if($novi[$i]->price > $novi[$j]->price) {
                                $tmp = $novi[$i];
                                $novi[$i] = $novi[$j];
                                $novi[$j] = $tmp;
                           }
                        }
                    }
                }
            }
        }
    //Sort Descending by prize
        if($sortType=='priceDesc'){
            for($i=0;$i<count($novi);$i++){
                for($j=$i+1;$j<count($novi);$j++){
                    if($novi[$i]->discount != null){
                        if($novi[$j]->discount !=null){
                            if($novi[$i]->discount < $novi[$j]->discount){
                                $tmp = $novi[$i];
                                $novi[$i] = $novi[$j];
                                $novi[$j] = $tmp;
                            }
                        }
                        else{
                           if($novi[$i]->discount < $novi[$j]->price) {
                                $tmp = $novi[$i];
                                $novi[$i] = $novi[$j];
                                $novi[$j] = $tmp;
                           }
                        }
                    }
                    else{
                        if($novi[$j]->discount !=null){
                            if($novi[$i]->price < $novi[$j]->discount){
                                $tmp = $novi[$i];
                                $novi[$i] = $novi[$j];
                                $novi[$j] = $tmp;
                            }
                        }
                        else{
                           if($novi[$i]->price < $novi[$j]->price) {
                                $tmp = $novi[$i];
                                $novi[$i] = $novi[$j];
                                $novi[$j] = $tmp;
                           }
                        }
                    }
                }
            }
        }
    //Sort by Name A-Z
    if($sortType == "nameAsc"){
        function compareBrandsAndNames($a, $b) {
            $a_merged = $a->brand_name . $a->product_name;
            $b_merged = $b->brand_name . $b->product_name;
            return strcmp($a_merged, $b_merged);
        }
        usort($novi, "compareBrandsAndNames");
    }
    //Sort by Name Z-A
    if($sortType == "nameDesc"){
        function compareBrandsAndNames($a, $b) {
            $a_merged = $a->brand_name . $a->product_name;
            $b_merged = $b->brand_name . $b->product_name;
            return strcmp($b_merged,$a_merged);
        }
        usort($novi, "compareBrandsAndNames");
    }
    echo json_encode($novi);
    http_response_code(200);
    }
    else{
        http_response_code(404);
    }
?>