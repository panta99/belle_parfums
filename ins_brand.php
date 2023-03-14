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

?>
<div id="unosBrenda" class="container d-flex justify-content-center">
<div class="col-lg-4 col-6">
<form class="text-center  my-5"  action="" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1" class="fw-bold">Name of new brend</label>
    <input type="text" class="form-control" id="novibrend" name="newBrend" aria-describedby="emailHelp">
    </div>
    <button id="insBrandBtn" type="button" class="btn btn-primary mt-3">Submit</button>
    </form>
</div>
</div>
<div class="container d-flex justify-content-center col-lg-6 col-12 mb-5" id="conBranList">
    <?php
        $brendovi = returnBrands();
        if(count($brendovi)==0){
            echo'<p class="alert alert-danger my-3">No availabile brends</p>';     
        }
        else{
            ?>
            <table class="table table-striped mt-5 text-center border border-dark">
            <thead>
                <tr>
                <th scope="col">Brand ID</th>
                <th scope="col">Brand Name</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                foreach($brendovi as $brend):
            ?>
                <tr>
                <th scope="row"><?=$brend->id_brand?></th>
                <td><?=$brend->brand_name?></td>
                </tr>
            <?php
                endforeach;
            ?>
            </tbody>
            </table>
    
            <?php
            }
            ?>
</div>
<?php 
    include "views/footer.php";
?>