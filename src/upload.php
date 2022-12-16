<?php
session_start();

require "includes/dbconn.inc.php";

//vytvoření proměnných
$nazev      = filter_var(trim($_POST['nazev']),             FILTER_SANITIZE_STRING);
$autori     = filter_var(trim($_POST['autori']),            FILTER_SANITIZE_STRING);
$tema       = filter_var(trim($_POST['tema']),              FILTER_SANITIZE_STRING);
$soubor     = filter_var(trim($_FILES['soubor']['name']),   FILTER_SANITIZE_STRING);

$error = "";
if(trim($nazev) == '') {
    $error = "zadejte jméno článku" . '<br>';
}


elseif (trim($tema) == ''){$error = "Zadejte téma článku" . '<br>';}

elseif (trim($soubor) == '') {
    $error = "chybí Vám soubor k odeslání" . '<br>';}
if ($error !=""){
    echo $error;
    exit;
}


//zkopírování dat do souboru na serveru
if (move_uploaded_file($_FILES['soubor']['tmp_name'], 'pdf/'.$_FILES['soubor']['name'])) {
    echo "soubor byl zkopírován na server". '<br>';
}else {
    echo "soubor nebyl zkopírován". '<br>';
}

$sql = "INSERT INTO clanek (id_stav, id_autor, id_recenzent, id_recenzent2, tema, datum, nazev, soubor, spoluautori) values(?, ?, ?, ?, ?, ?, ?, ?, ?)" ;
$stmt = mysqli_stmt_init($conn);

$today = date("Y-m-d");
$stavId = 1;
$recenzentId = 0;
$userId = $_SESSION["uzivatel_id"];

if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "chyba";
    exit();
}

mysqli_stmt_bind_param($stmt, "iiiisssss", $stavId, $userId, $recenzentId, $recenzentId, $tema, $today, $nazev, $soubor, $autori);

if (mysqli_stmt_execute($stmt)) {
    echo '<script>alert("záznam byl úspěšně přidán")</script>';
    header("Refresh:1; clanky.php");

} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_stmt_close($stmt);

?>
