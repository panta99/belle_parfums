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
    $users = getUsersData();
?>
<div class="w-100 container d-flex justify-content-center col-lg-6 col-12 mb-5" id="conBranList">
    <?php
        if(count($users)==0){
            echo'<p class="alert alert-danger my-3">No availabile brends</p>';     
        }
        else{
            ?>
            <table class="table table-striped mt-5 text-center border border-dark" >
            <thead>
                <tr>
                <th scope="col">User ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Password</th>
                <th scope="col">Active</th>
                <th scope="col">User Type</th>
                <th scope="col"></th>

                </tr>
            </thead>
            <tbody>
            <?php 
                foreach($users as $korisnik):
            ?>
                <tr>
                <th scope="row"><?=$korisnik->id_user?></th>
                <td style ="word-break:break-all;"><?=$korisnik->first_name?></td>
                <td style ="word-break:break-all;"><?=$korisnik->last_name?></td>
                <td style ="word-break:break-all;"><?=$korisnik->email?></td>
                <td style ="word-break:break-all;"><?=$korisnik->pass?></td>
                <td style ="word-break:break-all;"><?=$korisnik->active?></td>
                <td style ="word-break:break-all;"><?=$korisnik->role_name?></td>
                <?php 
                    if($korisnik->role_name == "admin")
                    echo'<td><i class="fa-solid fa-ban"></i></td>';
                    else
                    echo '<td><a href="logic/del_user.php?id='.$korisnik->id_user.'"><i class="fa-solid fa-trash delete"></i></a></td>';
                
                ?>
                </tr>
            <?php
                endforeach;
            ?>
            </tbody>
            </table>
    
            <?php
            }
            ?>
</div>








<?php 
    include "views/footer.php";
?>