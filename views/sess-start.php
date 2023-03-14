<?php
    session_start();
    $korisnik;
    if(isset($_SESSION['korisnik'])){
    $korisnik = $_SESSION['korisnik'];
    }
?>