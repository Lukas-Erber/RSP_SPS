<?php
require_once 'includes/dbconn.inc.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM uzivatel WHERE id='".$id."'");
header("Location: administrace.php");
?>