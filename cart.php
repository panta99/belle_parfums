<?php   
    include "config/connection.php";
    include "logic/functions.php";
    include "views/head.php";
    if(isset($korisnik)){
        if($korisnik->role_name == "admin"){ 
        header("Location: index.php");
        }
    }
    else{
        header("Location: index.php");
    }
    include "views/spinner.php";
    include "views/navbar.php";

?>

        <section class="mt-5 text-dark fw-bold" id="korpaProizvodi">
            <div class="container  row  mx-auto align-items-start justify-content-start" id="prikazKorpe">
                <!--Loading products-->
        </section>


<?php
        include "views/footer.php";
?>