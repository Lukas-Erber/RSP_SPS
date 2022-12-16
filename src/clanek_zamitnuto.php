<?php
	session_start();

	$clanekId = $_GET['clanekId'];
	$jeSefredaktor = $_SESSION["role_kod"] == "sefredaktor";

	require_once "includes/dbconn.inc.php";
    require_once 'includes/funkce.inc.php';

    clanekZamitnuto($conn, $clanekId, $jeSefredaktor);

	if($jeSefredaktor) {
        header("location: sefredaktor.php");
    } else {
        header("location: redaktor.php");
    }