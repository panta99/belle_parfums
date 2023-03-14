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
    $poruke = getMessages();
    include "views/navbar.php";
?>
    <div class="w-100 container d-flex justify-content-center col-lg-6 col-12 mb-5" id="conBranList">

            <table class="table table-striped mt-5 text-center border border-dark" >
            <thead>
                <tr>
                <th scope="col">Id message</th>
                <th scope="col">User Info</th>
                <th scope="col">Message</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($poruke as $p):{  
                ?>
                <tr>
                <th scope="row"><?=$p->id_message?></th>
                <td style ="word-break:break-all;"><?=$p->first_name?> <?=$p->last_name?></td>
                <td style ="word-break:break-all;"><?=$p->message_text?></td>
                </tr>
                <?php
                }
                   endforeach;
                ?>
            </tbody>
            </table>
    </div>




<?php 
    include "views/footer.php";

?>