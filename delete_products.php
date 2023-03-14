<?php
    include "config/connection.php";
    include "logic/functions.php";
    include "views/head.php";
    global $korisnik;
    if(isset($korisnik)){
        if($korisnik->role_name == "user")
        header("Location: index.php");
    }
    else{
        header("Location: index.php");
    }
    include "views/navbar.php";
    $proizvodi = getProductsForDelete();
?>

    <section class="mt-5 text-dark fw-bold mb-5" id="brisanjeProizvodi">
            <div class="container  row  mx-auto align-items-start justify-content-start" id="prikazKorpe">
            <?php

            foreach($proizvodi as $pr):{  
            ?>
            <div class="row mx-0 my-2 align-items-center border border-3 p-2 proizvod">
                    <div class="col-4 col-lg-2">
                        <img src="assets/img/products/<?=$pr->img_path?>" class="img-fluid" alt="perfume"/>
                    </div>
                    <div class="col-8 col-lg-5">
                        <p class="fw-bold textUKorpi"><?=$pr->brand_name.' '.$pr->product_name?></p>
                    </div>
                    <div class="col-6 col-lg-3 mt-3 mt-lg-0">
                        <p>Volume:</p>
                        <span><?=$pr->volume?></span>
                    </div>
                    <div class="col-6 col-lg-2 text-right">
                        <a href="logic/del_product.php?id=<?=$pr->id_product?>" class="btn btn-danger obrisi"><i class="fa-solid fa-trash"></i></a>
                    </div>
                </div>
                <?php
                }
                endforeach;
                ?>
        </section>


<?php 
    include "views/footer.php";

?>