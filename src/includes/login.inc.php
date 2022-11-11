<?php

if(isset($_POST["submit"])) {
    $login  = trim($_POST["login"]);
    $heslo  = trim($_POST["heslo"]); 

    require_once 'dbconn.inc.php';
    require_once 'funkce.inc.php';

    if (emptyInputLogin($login, $heslo) !== false) {
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $login, $heslo);

} else {
    header("location: ../login.php");
    exit();
}
