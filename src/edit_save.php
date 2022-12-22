<?php
require_once 'includes/dbconn.inc.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$id = $_POST['id'];
$rolee = $_POST['id_role'];
$prijmeni = $_POST['prijmeni'];
$email = $_POST['email'];
$jmeno = $_POST['jmeno'];
mysqli_query($conn,"UPDATE uzivatel SET jmeno='".$jmeno."' WHERE id='".$id."'");
mysqli_query($conn,"UPDATE uzivatel SET prijmeni='".$prijmeni."' WHERE id='".$id."'");
mysqli_query($conn,"UPDATE uzivatel SET email='".$email."' WHERE id='".$id."'");
mysqli_query($conn,"UPDATE uzivatel SET id_role='".$rolee."' WHERE id='".$id."'");
//header("Location: administrace.php");
header("Refresh:0; url=administrace.php");
?>