<?php
//print_r($_POST) ;
//vytvoření proměnných
$jmeno=filter_var(trim($_POST['jmeno']), FILTER_SANITIZE_STRING);
$autor=filter_var(trim($_POST['autor']), FILTER_SANITIZE_STRING);
$tema = filter_var(trim($_POST['tema']), FILTER_SANITIZE_STRING);
//$datum = date();
//$stav = "";
$soubor = filter_var(trim($_FILES['soubor']['name']), FILTER_SANITIZE_STRING);

echo $soubor;
echo $jmeno;




$error = "";
if(trim($jmeno)=='')
    $error = "zadejte jméno článku" . '<br>';
elseif (trim($autor) == ''){
    $error = "zadejte jméno autora" . '<br>';
}

elseif (trim($tema) == ''){$error = "Zadejte téma článku" . '<br>';}

elseif (trim($soubor) == '') {
    $error = "chybí Vám soubor k odeslání" . '<br>';}
if ($error !=""){
    echo $error;
    exit;
}
require "includes/dbconn.inc.php";
/*
echo $_POST['jmeno'].'<br>';
echo $_POST['autor'].'<br>';
echo $_POST['tema'].'<br>';
echo $_FILES['soubor']['size'] . '<br>';

echo $_FILES['soubor']['name'] . '<br>';
echo $_FILES['soubor']['tmp_name'] . '<br>';
*/

//zkopírování dat do souboru na serveru
if (move_uploaded_file($_FILES['soubor']['tmp_name'], 'pdf/'.$_FILES['soubor']['name'])) {
    echo "soubor byl zkopírován na server". '<br>';
    // code...
}else {
    // code..
    echo "soubor nebyl zkopírován". '<br>';
}




echo $soubor;
//zapis do databáze
//require "includes/dbconn.inc.php";

$sql = "INSERT INTO `clanek` (`nazev`,`spoluautori`,`soubor`, `tema`) values('$jmeno','$autor','$soubor','$tema')" ;

if (mysqli_query($conn, $sql)) {
    echo "Hurááá";
    echo '<script>alert("záznam byl úspěšně přidán")</script>';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);

header( "refresh:10; url=index.php");

?>
