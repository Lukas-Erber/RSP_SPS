<?php
session_start();

if(isset($_POST["submit"])) {
    $clanekId  = trim($_POST["clanekId"]);
    $userId = $_SESSION["uzivatel_id"];

    $text       = trim($_POST["text"]);
    $hodnoceni1 = trim($_POST["hodnoceni1"]);
    $hodnoceni2 = trim($_POST["hodnoceni2"]);
    $hodnoceni3 = trim($_POST["hodnoceni3"]);
    $hodnoceni4 = trim($_POST["hodnoceni4"]);
    $hodnoceni5 = trim($_POST["hodnoceni5"]);
    $hodnoceni6 = trim($_POST["hodnoceni6"]);

    require_once 'includes/dbconn.inc.php';
    require_once 'includes/funkce.inc.php';

    zalozitRecenzi($conn, $clanekId, $userId, $text, $hodnoceni1, $hodnoceni2, $hodnoceni3, $hodnoceni4, $hodnoceni5, $hodnoceni6);

} else {
    header("location: recenze.php");
    exit();
}
