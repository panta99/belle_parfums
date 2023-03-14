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

    <div class="container d-flex justify-content-center mt-5 align-items-center" id="admUl">
        <div id="admMenu" class="col-lg-6 col-12">
            <ul>
                <li><a href="ins_product.php" class="btn btn-primary py-2 px-4 nav-item nav-link fw-bold">Insert New Product <i class="fa-solid fa-upload"></i></a></li>
                <li><a href="ins_brand.php" class="btn btn-primary py-2 px-4 nav-item nav-link fw-bold">Insert New Brand <i class="fa-solid fa-upload"></i></a></li>
                <li><a href="users_info.php" class="btn btn-primary py-2 px-4 nav-item nav-link fw-bold">Users Info  <i class="fa-solid fa-pen-to-square"></i></a></li>
                 <li><a href="delete_products.php" class="btn btn-primary py-2 px-4 nav-item nav-link fw-bold">Delete Product <i class="fa-solid fa-trash"></i></a></li>
                 <li><a href="messages_for_admin.php" class="btn btn-primary py-2 px-4 nav-item nav-link fw-bold">Messages For Admin <i class="fa-regular fa-message"></i></a></li>
                 <li><a href="result_poll.php" class="btn btn-primary py-2 px-4 nav-item nav-link fw-bold">Check Poll Results <i class="fa-solid fa-square-poll-vertical"></i></a></li>
                 
                 <li><a href="profile.php" class="btn btn-primary py-2 px-4 nav-item nav-link fw-bold">Profile <i class="fa-solid fa-user r mx-1"></i></a></li>
                </ul>
        </div>
    </div>






<?php 
    include "views/footer.php";

?>