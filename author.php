<?php   
    include "config/connection.php";
    include "logic/functions.php";
    include "views/head.php";
    include "views/spinner.php";
    include "views/navbar.php";
?>
            <h1 class="text-center my-5">About author</h1>
    <div class="container d-flex justify-content-center align-items-center my-5">
        <div class="row">
        <div class="col-lg-6 col-12 text-center mb-3">
            <img src="assets/img/author.jpg" alt="authorPhoto" class="img-fluid" id="authoPhoto"/>
        </div>
        <div class="col-lg-6 col-12 text-center my-auto">
            <h2>My name is Aleksa Pantic. I finished Technical High school Valjevo, majoring in computer network administrator. I'm currently student at ICT College of Vocational Studies.</h2>
        </div>
        </div>
    </div>





<?php
        include "views/footer.php";
?>