<?php   
    include "config/connection.php";
    include "logic/functions.php";
    include "views/head.php";
    $vr = $korisnik->id_user;
    if(isset($korisnik)){
        if($korisnik->role_name == "admin"){ 
        header("Location: index.php");
        }
        if(!isThereActivePoll($korisnik->id_user)){
            header("Location: index.php");
        }
    }
    else{
        header("Location: index.php");
    }
    include "views/spinner.php";
    include "views/navbar.php";
    $anketa = getPollId();
    $vr = $anketa->id_poll;
    $odgovori = getAnswers($anketa->id_poll);
?>
    <input type="hidden" id="anketaId" value="<?=$vr?>">
    <div class="container my-5 mt-5">
        <h1 class="text-center my-5">Poll</h1>
    <form id="registracijaForma" class="col-md-6  mx-auto text-center d-flex flex-column align-items-center" action="">
    <h3 id="pitanje" class="my-5"><?=$anketa->question?></h3>
    <?php 

    foreach($odgovori as $odg):{ 
    ?>
    <div class="col-sm-2 my-2">
        <div class="form-check">
            <input class="form-check-input" class="rating" type="radio" name="rating" value="<?=$odg->id_answer?>">
            <label class="form-check-label text-dark fw-bold" for="rating1">
            <?=$odg->answer_text?>
            </label>
        </div>
    </div>
    <?php 
    }
    endforeach;
    ?>
    <div class="text-center mt-5">
      <button type="button" id="btnSbmPoll" class="btn btn-primary me-3">Submit</button>
      <button type="reset" id="restartBtn" class="btn btn-secondary">Restart</button>
    </div>
    <p class="mt-3 text-danger fw-bold h4 sakrij" id="greska">You must choose something</p>
    <p class="mt-3 text-success fw-bold h4 sakrij" id="uspeh" >You have successfully voted!</p>
    </form>
  </div>

<?php
        include "views/footer.php";
?>