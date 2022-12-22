<?php

if(isset($_POST["submit"])) {
    $clanekId   = trim($_POST["clanekid"]);
    $recenzent1 = trim($_POST["recenzent1"]);
    $recenzent2 = trim($_POST["recenzent2"]);
    
    require_once "includes/dbconn.inc.php";
    require_once 'includes/funkce.inc.php';

    updateRecenzenty($conn, $clanekId, $recenzent1, $recenzent2);

    header("location: redaktor.php");
} else {
    header("location: redaktor.php");
    exit();
}