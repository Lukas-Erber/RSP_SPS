<?php

	$clanekId = $_GET['clanekId'];

	require_once "includes/dbconn.inc.php";
    require_once 'includes/funkce.inc.php';

    clanekPrijato($conn, $clanekId);

    header("Location: redaktor.php");
