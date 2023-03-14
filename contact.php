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
    if(isset($korisnik)){
        $vr = $korisnik->id_user; 
    }
    else{
        $vr = '';
    }
?>

<div class="container my-5">
    <input type="hidden" id="idUser" value="<?=$vr?>">
    <h1 class="text-center">Contact Admin</h1>
    <form id="registracijaForma" class="col-md-6  mx-auto text-center" action="">
    <div class="form-group">
    <label for="message" class="text-dark fw-bold mt-5 mb-3">Write your message here</label>
    <textarea class="form-control border border-dark" id="message" rows="15"></textarea>
    </div>
      <div class="text-center my-5">
      <button type="button" id="btnSbm" class="btn btn-primary me-3">Submit</button>
      <button type="reset" id="restartBtn" class="btn btn-secondary">Restart</button>
      <p class="h4 mb-5 mt-2 text-success sakrij" id="poruka">Successfully sent</p>
      </div>
    </form>
  </div>


<?php
        include "views/footer.php";
?>