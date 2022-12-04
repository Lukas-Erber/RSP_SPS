<?php
//require "includes/header.inc.php";
if (isset($_SESSION["uzivatel_id"])) {

    echo $_SESSION["jmeno"];
    echo " ";
    echo $_SESSION["prijmeni"];
    echo " ";

    echo "Vaše role je: ";
    echo $_SESSION["role_nazev"];

}

if (isset($_SESSION["role_kod"])) {
    $roleKod = $_SESSION["role_kod"];

    if (strcmp($roleKod, "autor") == 0) {

        require "includes/obsah_autor.php";
    }

    if (strcmp($roleKod, "recenzent") == 0) {
        echo "<a href=\"recenze.php\"><li>Recenze</li></a>";
    }

    if (strcmp($roleKod, "admin") == 0) {
        echo "<a href=\"administrace.php\"><li>Administrace</li></a>";
    }
}