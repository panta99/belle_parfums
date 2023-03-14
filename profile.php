<?php   
    include "config/connection.php";
    include "logic/functions.php";
    include "views/head.php";
    if(isset($korisnik)){
    }
    else{
        header("Location: index.php");
    }
    include "views/spinner.php";
    include "views/navbar.php";
    $ime = $korisnik->first_name;
    $prezime = $korisnik->last_name;
    $email = $korisnik->email;
?>  
    <div class="container d-flex flex-column align-items-center my-5">
            <div class="row">
                <div id="profilna">
                <img src="assets/img/profile.png" class="img-fluid" alt="profilePhoto"/>
                </div>
            </div>
    <div class="container my-5">
        <form id="registracijaForma" class="col-md-6  mx-auto text-center" action="">
        <div class="mb-3">
            <label for="firstName" class="form-label text-dark fw-bold">First Name</label>
            <input type="text" value="<?=$ime?>" class="form-control text-center border-dark text-dark fw-bold" id="firstName" placeholder="Enter your first name" required>
        </div>
        <div class="mb-3">
            <label for="lastName" class="form-label text-dark fw-bold">Last Name</label>
            <input type="text" value="<?=$prezime?>" class="form-control text-center border-dark text-dark fw-bold" id="lastName" placeholder="" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label text-dark fw-bold" >Email</label>
            <input type="email" class="form-control text-center border-dark text-dark fw-bold" id="email" placeholder="Enter your email address" value="<?=$email?>" required readonly>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label text-dark fw-bold">Current Password</label>
            <input type="password" class="form-control text-center border-dark text-dark fw-bold" id="oldPassword" placeholder="Enter your current password" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label text-dark fw-bold">New Password</label>
            <input type="password" class="form-control text-center border-dark text-dark fw-bold" id="password" placeholder="Enter your new password" required>
        </div>
        <div class="mb-3">
            <label for="confirmPassword" class="form-label text-dark fw-bold">Confirm New Password</label>
            <input type="password" class="form-control text-center border-dark text-dark fw-bold" id="confirmPassword" placeholder="Confirm your new password" required>
        </div>
        <div class="text-center">
        <button type="button" id="btnSbmPromeni" class="btn btn-primary me-3">Submit</button>
        </div>
        <p class="h4 mb-1 mt-2 text-danger " id="lozinkaAlert">Password must have capital letter, 8 characters and one special character</p>
        <p class="h4 mb-5 mt-2 text-danger " id="changeAlert">To change your profile you must type your current password</p>
        <h3 id="greske" class="my-2 text-danger"></h2>    
    </form>
    </div>
    </div>



<?php
        include "views/footer.php";
?>