<?php

if(isset($_POST["submit"])) {
    // načtení hodnot
    $login          = trim($_POST["login"]);
    $heslo          = trim($_POST["heslo"]);
    $hesloKontrola  = trim($_POST["hesloKontrola"]);
    $jmeno          = trim($_POST["jmeno"]);
    $prijmeni       = trim($_POST["prijmeni"]);
    $email          = trim($_POST["email"]);

    require_once "dbconn.inc.php";
    require_once "funkce.inc.php";

    if(emptyInputSignup($login, $heslo, $hesloKontrola, $jmeno, $prijmeni, $email) !== false) {
        header("location: ../registrace.php?error=emptyinput");
        exit();
    }

    if(invalidLogin($login) !== false) {
        header("location: ../registrace.php?error=invalidlogin");
        exit();
    }

    if(invalidEmail($email) !== false) {
        header("location: ../registrace.php?error=invalidemail");
        exit();
    }

    if(invalidPasswords($heslo, $hesloKontrola) !== false) {
        header("location: ../registrace.php?error=pwdmatcherror");
        exit();
    }

    if(loginExists($conn, $login) !== false) {
        header("location: ../registrace.php?error=loginexists");
        exit();
    }

    createUser($conn, $login, $heslo, $jmeno, $prijmeni, $email); 
} else {
    header("location: ../registrace.php");
    exit();
}
