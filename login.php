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
    <div id="loginBlok" class="container my-5 d-flex flex-column justify-content-center">
        <h1 class="text-center">Log in</h1>
    <form id="loginforma" class="col-md-6 col-12 mx-auto text-center" action="">
      <div class="mb-3">
        <label for="email" class="form-label text-dark fw-bold">Email</label>
        <input type="email" class="form-control text-center border-dark text-dark fw-bold" id="email" placeholder="Enter your email address" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label text-dark fw-bold">Password</label>
        <input type="password" class="form-control text-center border-dark text-dark fw-bold" id="password" placeholder="Enter your password" required>
      </div>
      <div class="text-center mt-3">
      <button type="button" class="btn btn-primary me-3" id="btnLogin" >Log in</button>
      <p class="mt-2 sakrij h4 text-danger"id="loginAlert">Greska email</p>
      </div>
    </form>
  </div>




<?php 
    include "views/footer.php";

?>