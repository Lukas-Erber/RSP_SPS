<?php
require_once "includes/dbconn.inc.php";
require_once 'includes/funkce.inc.php';

$clanekId = trim($_GET["clanekId"]);

updateClanekRedaktorPotvrzeni($conn, $clanekId);

header("location: redaktor.php");
