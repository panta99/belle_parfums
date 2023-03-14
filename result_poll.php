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
    $anketa = getPollId();
    $odgovori = getAnswers($anketa->id_poll);
?>

<div class="container my-5" id="rezAnketa">
        <h1 class="text-center">Poll Results</h1>
    <div id="" class=" mx-auto text-center my-5" action="">
    <div id="statistika" class="col-md-6  mx-auto text-center text-dark" action="">
        <h3 id="pitanje">Question: </br><?=$anketa->question?></h3>
        <div class="stat">
        <table class="table table-striped mt-5 text-center border border-dark" >
            <thead>
                <tr>
                <th scope="col">Answer</th>
                <th scope="col">Number Of Votes</th>
                </tr>
            </thead>
            <tbody>
        <?php 
            foreach($odgovori as $odg):{
        ?>
            <tr>
            <td style ="word-break:break-all;"><?=$odg->answer_text?></td>
            <td style ="word-break:break-all;"><?php echo numberOfVotes($odg->id_answer)?></td>
            <tr>
        <?php
         }
        endforeach;
        ?>
        </tbody>
        </table>
        </div>
    </div>

    </div>
</div>
<?php 
    include "views/footer.php";

?>