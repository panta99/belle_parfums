<?php   
    include "config/connection.php";
    include "logic/functions.php";
    include "views/head.php";
    include "views/spinner.php";
    include "views/navbar.php";
    if(isset($korisnik)){
        $vr = $korisnik->role_name; 
    }
    else{
        $vr = '';
    }
?>
    <input type="hidden" id="ulogovan" value="<?=isset($korisnik)?>">
    <input type="hidden" id="uloga" value="<?=$vr?>">
    <div id="modal-container">
        <div id="modal">
            <p class="fw-bold modaltxt">Product added to cart!</p>
            <input type="button" value="Close" class="" id="dugmeOk">
        </div>
    </div>
    <div class="container my-5">
            <div class="row w-100">
                <div class="col-lg-3">
                    <div class="row">
                       <div class="col-12">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <p class="fw-bold">Search:</p>
                                    <input type="text" id="pretraga" name="pretraga"/>
                                </li>
                            </ul>
                           <p class="fw-bold mt-3">Sort by:</p>
                           <select class="form-select border-dark" id="sortBy">
                                <option selected value="0">Choose</option>
                                <option value="priceAsc">Price: Low To High</option>
                                <option value="priceDesc">Price: High To Low</option>
                                <option value="nameAsc">Name: A-Z</option>
                                <option value="nameDesc">Name: Z-A</option>
                          </select>
                       </div> 
                    </div>
                    <div class="row w-50">
                    <div class="col-6 col-lg-12  mt-3">
                        <p class="fw-bold">Lowest price</p>
                       <input type="text" name="lowPrice" id="lowPrice" class="">
                       <p class="fw-bold mt-3">Highest price</p>
                       <input type="text" name="highPrice" id="highPrice">
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-9 col-lg-12">
                            <p class="fw-bold mt-3">Categories</p>
                            <ul class="list-group" id="categories">
                                <?php 
                                    $kategorije = getCategories();
                                    foreach($kategorije as $kat):
                                ?>
                                <li class="list-group-item">
                                    <input type="checkbox" value="<?=$kat->id_category?>" class="kategorija" name="kategorija"/><span class="mx-2"><?=$kat->category_name?></span>
                                </li>
                                <?php
                                endforeach;
                                ?>
                            </ul>
                        </div>
                        <div class="col-9 col-lg-12  mt-3">
                            <p class="fw-bold">Brands</p>
                            <ul class="list-group" id="brands">
                                <?php 
                                $brendovi = returnBrandsAsc();
                                foreach($brendovi as $brend):
                                ?>
                                <li class="list-group-item">
                                    <input type="checkbox" value="<?=$brend->id_brand?>" class="brand" name="brand"/><span class="mx-2"><?=$brend->brand_name?></span>
                                </li>
                                <?php
                                endforeach;
                                ?>
                            </ul>
                        </div>
                        <div class="col-9 col-lg-12  mt-3">
                            <p class="fw-bold">Volume</p>
                            <ul class="list-group" id="volume">
                                <?php 
                                $zapremina = getVolume();
                                foreach($zapremina as $zap):
                                ?>
                                <li class="list-group-item">
                                    <input type="checkbox" value="<?=$zap->id_volume?>" class="volume" name="volume"/><span class="mx-2"><?=$zap->volume?></span>
                                </li>
                                <?php
                                endforeach;
                                ?>
                            </ul>
                        </div>
                        <div class="text-center my-5">
                        <button type="button" id="btnSearch" class="btn btn-primary me-3">Apply</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row w-100 mb-5  d-flex " id="products">
                        
                    
                    </div>
                </div>
            </div>
        </div>
<?php
        include "views/footer.php";
?>