<?php
require_once 'includes/dbconn.inc.php';
require_once 'includes/funkce.inc.php';

$id = $_GET['id'];
deleteClanek($conn, $id);

header("Location: administrace.php");
