
    <!-- Topbar Start -->
    <div class="container-fluid bg-light ps-5 pe-0 d-none d-lg-block">
        <div class="row gx-0">
            <div class="col-md-6 text-center text-lg-start mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center">
                    <small class="py-2"><i class="far fa-clock text-primary me-2"></i>Opening Hours: Mon - Sat : 6.00 - 22:00 , Sunday Closed </small>
                </div>
            </div>
            <div class="col-md-6 text-center text-lg-end">
                <div class="position-relative d-inline-flex align-items-center bg-primary text-white top-shape px-5">
                    <div class="me-3 pe-3 border-end py-2">
                        <p class="m-0"><i class="fa fa-envelope-open me-2"></i>belleparfums@gmail.com</p>
                    </div>
                    <div class="py-2">
                        <p class="m-0"><i class="fa fa-phone-alt me-2"></i>+381 011 123 456</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm px-5 py-3 py-lg-0">
        <a href="index.php" class="navbar-brand p-0">
            <h1 class="m-0 text-primary">BelleParfums</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="index.php" class="nav-item nav-link">Home</a>
                <a href="products.php" class="nav-item nav-link">Shop</a>
                <?php
                if(isset($korisnik)){
                    echo '';
                }
                else{
                    echo '<a href="register.php" class="nav-item nav-link">Register</a>
                    </div>
                    <a href="login.php" class="btn btn-primary py-2 px-4" id="login"><i class="fa-solid fa-user mx-1"></i>Log in</a>';
                }
                ?>
            </div>
            <?php
                if(isset($korisnik)){ 
                    if($korisnik->role_name == "admin"){
                        echo '<a href="orders.php" class="btn btn-secondary py-2 px-4 nav-item nav-link" id="truck"><i class="fa-solid fa-solid fa-truck r mx-1"></i></a>
                        <a href="adm_panel.php" class="btn btn-primary py-2 px-4 nav-item nav-link" id="gear"><i class="fa-solid fa-gears r mx-1"></i></a>
                        <a href="logic/logOut.php" class="nav-link font-weight-medium fw-bold" id="logOut">Log out</a>';
                    }
                    else{ 
                echo '<a href="cart.php" class="btn btn-secondary py-2 px-4 nav-item nav-link" id="cart"><i class="fa-solid fa-cart-shopping r mx-1"><sup id="brojArtikala">0</sup></i></a>
                <a href="profile.php" class="btn btn-primary py-2 px-4 nav-item nav-link" id="profile"><i class="fa-solid fa-user r mx-1"></i></a>
                <a href="logic/logOut.php" class="nav-link font-weight-medium fw-bold" id="logOut">Log out</a>';
            }
            }
            ?>
        </div>
    </nav>
    <!-- Navbar End -->
