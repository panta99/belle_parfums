    <?php
    include "config/connection.php";
    include "logic/functions.php";
    include "views/head.php";
    include "views/spinner.php";
    include "views/navbar.php";
    ?>

    <!-- Carousel Start -->
    <div class="container-fluid p-0">
        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="assets/img/carousel-new.jpg" alt="perfume">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h1 class="display-1 text-white mb-md-4 animated zoomIn">Check Out Our Shop</h1>
                            <a href="products.php" class="btn btn-secondary py-md-3 px-md-5 animated slideInRight">Shop</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100 img-fluid" src="assets/img/carousel-new2.jpg" alt="perfume">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h1 class="display-1 text-white mb-md-4 animated zoomIn">Wide Selection</h1>
                            <a href="products.php" class="btn btn-secondary py-md-3 px-md-5 animated slideInRight">Shop</a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        
    </div>
    <!-- Carousel End -->

    <?php
        include "views/footer.php";
        http_response_code(200);
    ?>