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
    $brendovi = returnBrandsAsc();
    $kategorije = getCategories();
    $zapremina = getVolume();
?>
    <div class="container my-5">
        <h1 class="text-center">Insert new product:</h1>
        <form id="noviProizvod" class="col-md-6  mx-auto text-center my-5" action="">
            <label for="brand" class="form-label text-dark fw-bold my-3">Choose brand:</label>
            <select id="brand" class="form-select text-center text-dark fw-bold" aria-label="">
            <option value="0">Choose</option>
            <?php foreach($brendovi as $b):
            ?>
            <option value="<?=$b->id_brand?>"><?=$b->brand_name?></option>
            <?php endforeach; 
            ?>
            </select>
            <label for="category" class="form-label text-dark fw-bold my-3">Choose category:</label>
            <select id="category" class="form-select text-center text-dark fw-bold" aria-label="">
            <option value="0">Choose</option>
            <?php 
                foreach($kategorije as $k):
            ?>
            <option value="<?=$k->id_category?>"><?=$k->category_name?></option>
            <?php
                endforeach;
            ?>
            </select>
            <label for="volume" class="form-label text-dark fw-bold my-3">Choose volume:</label>
            <select id="volume" class="form-select text-center text-dark fw-bold" aria-label="">
            <option value="0">Choose</option>
            <?php 
                foreach($zapremina as $z):
            ?>
            <option value="<?=$z->id_volume?>"><?=$z->volume?></option>
            <?php
                endforeach;
            ?>
            </select>
            <label for="productName" class="form-label text-dark fw-bold my-3">Product Name</label>
            <input type="text" class="form-control text-center border-dark" id="productName" placeholder="" required>
            <label for="price" class="form-label text-dark fw-bold my-3">Price</label>
            <input type="text" class="form-control text-center border-dark" id="price" placeholder="" required>
            <label for="discount" class="form-label text-dark fw-bold my-3">Discount</label>
            <input type="text" class="form-control text-center border-dark" id="discount" placeholder="Optional" required>
            <div>
            <div class="mb-4 d-flex justify-content-center my-5">
                <img id="slikaUpload" class="img-fluid" src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg"
                alt="example placeholder" style="width: 400px;" />
            </div>
            <div class="d-flex justify-content-center my-5">
                <div class="btn btn-rounded">
                    <input type="file" class="form-control" id="inpSlika"/>
                </div>
            </div>
            </div>
            <button type="button" id="btnSbmProd" class="btn btn-primary me-3">Submit</button>
            <button type="reset" id="restartBtn" class="btn btn-secondary">Restart</button>
            <h4 id="uspeh" class="my-3 text-success sakrij">Successfully created product</h4>
        </form>
    </div>


<?php 
    include "views/footer.php";
?>