<?php

	$clanekId = $_GET['clanekId'];

	require_once "includes/dbconn.inc.php";
    require_once 'includes/funkce.inc.php';

    recenzentClanekOdeslat($conn, $clanekId);

    header("Location: recenze.php");