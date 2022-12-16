<?php

	$clanekId = $_GET['clanekId'];

	require_once "includes/dbconn.inc.php";
    require_once 'includes/funkce.inc.php';

    clanekZamitnuto($conn, $clanekId);

    header("Location: redaktor.php");