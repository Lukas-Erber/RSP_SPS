<?php
require_once "includes/dbconn.inc.php";
require_once 'includes/funkce.inc.php';

$clanekId = trim($_GET["clanekId"]);

clanekPotvrzeniPridelenychRecenzentu($conn, $clanekId);

header("location: redaktor.php");
