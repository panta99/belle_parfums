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
    $ime = $korisnik->first_name;
    $prezime = $korisnik->last_name;
?>
<div class="container my-5">
        <h1 class="text-center">Complete Order</h1>
    <form id="registracijaForma" class="col-md-6  mx-auto text-center" action="">
      <div class="mb-3">
        <label for="firstName" class="form-label text-dark fw-bold">First Name</label>
        <input type="text" value="<?=$ime?>" class="form-control text-center border-dark text-dark fw-bold" id="firstName" placeholder="Enter your first name" required>
      </div>
      <div class="mb-3">
        <label for="lastName" class="form-label text-dark fw-bold">Last Name</label>
        <input type="text" value="<?=$prezime?>" class="form-control text-center border-dark text-dark fw-bold" id="lastName" placeholder="Enter your last name" required>
      </div>
      <div class="mb-3">
        <label for="city" class="form-label text-dark fw-bold">City</label>
        <input type="text" class="form-control text-center border-dark text-dark fw-bold" id="city" placeholder="Enter your city" required>
      </div>
      <div class="mb-3">
        <label for="address" class="form-label text-dark fw-bold">Address</label>
        <input type="text" class="form-control text-center border-dark text-dark fw-bold" id="address" placeholder="Enter your address" required>
      </div>
      <div class="mb-3">
        <label for="phoneNumber" class="form-label text-dark fw-bold">Phone number</label>
        <input type="text" class="form-control text-center border-dark text-dark fw-bold" id="phoneNumber" placeholder="Example: +38164123123 " required>
      </div>
      <div class="text-center">
      <button type="button" id="btnSbmOrder" class="btn btn-primary me-3">Submit</button>
      <button type="reset" id="restartBtn" class="btn btn-secondary">Restart</button>
      </div>
      <p class="h4 mb-5 mt-2 text-success sakrij" id="lozinkaAlert"></p>
    </form>
  </div>
<?php
        include "views/footer.php";
?>