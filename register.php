<?php
    include "config/connection.php";
    include "logic/functions.php";
    include "views/head.php";
    global $korisnik;
    if(isset($korisnik)){
      header("Location: index.php");
    }
    include "views/spinner.php";
    include "views/navbar.php";
?>
    <div class="container my-5">
        <h1 class="text-center">Register</h1>
    <form id="registracijaForma" class="col-md-6  mx-auto text-center" action="">
      <div class="mb-3">
        <label for="firstName" class="form-label text-dark fw-bold">First Name</label>
        <input type="text" class="form-control text-center border-dark text-dark fw-bold" id="firstName" placeholder="Enter your first name" required>
      </div>
      <div class="mb-3">
        <label for="lastName" class="form-label text-dark fw-bold">Last Name</label>
        <input type="text" class="form-control text-center border-dark text-dark fw-bold" id="lastName" placeholder="Enter your last name" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label text-dark fw-bold">Email</label>
        <input type="email" class="form-control text-center border-dark text-dark fw-bold" id="email" placeholder="Enter your email address" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label text-dark fw-bold">Password</label>
        <input type="password" class="form-control text-center border-dark text-dark fw-bold" id="password" placeholder="Enter your password" required>
      </div>
      <div class="mb-3">
        <label for="confirmPassword" class="form-label text-dark fw-bold">Confirm Password</label>
        <input type="password" class="form-control text-center border-dark text-dark fw-bold" id="confirmPassword" placeholder="Confirm your password" required>
      </div>
      <div class="text-center">
      <button type="button" id="btnSbmReg" class="btn btn-primary me-3">Submit</button>
      <button type="reset" id="restartBtn" class="btn btn-secondary">Restart</button>
      </div>
      <p class="h4 mb-5 mt-2 text-danger sakrij" id="lozinkaAlert">Password must have capital letter, 8 characters and one special character</p>
      <p class="mt-3 text-dark fw-bold h4 sakrij" id="verMail" ></p>
    </form>
  </div>
<?php 
    include "views/footer.php";

?>