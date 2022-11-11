<?php

function emptyInputSignup($login, $heslo, $hesloKontrola, $jmeno, $prijmeni, $email) {
    $result;

    if (empty($login) || empty($heslo) || empty($hesloKontrola) || empty($jmeno) || empty($prijmeni) || empty($email)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function invalidLogin($login) {
    $result;

    if (!preg_match("/^[a-zA-Z0-9]*$/", $login)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function invalidEmail($email) {
    $result;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function invalidPasswords($heslo, $hesloKontrola) {
    $result;

    if ($heslo !== $hesloKontrola) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function loginExists($conn, $login) {
    $sql = "SELECT * FROM uzivatel WHERE login = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../registrace.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $login);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $login, $heslo, $jmeno, $prijmeni, $email) {
    $sql = "INSERT INTO uzivatel (id_role, login, heslo, jmeno, prijmeni, email) VALUES(?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../registrace.php?error=stmtfailed");
        exit();
    }

    $passwordHash = password_hash($heslo, PASSWORD_DEFAULT);
    $idRole = 2; // Autor

    mysqli_stmt_bind_param($stmt, "isssss", $idRole, $login, $passwordHash, $jmeno, $prijmeni, $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../registrace.php?error=none");
    exit();
}

function emptyInputLogin($login, $heslo) {
    $result;

    if (empty($login) || empty($heslo)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function loginUser($conn, $login, $heslo) {
    $loginExists = loginExists($conn, $login);

    if ($loginExists == false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $hesloDB = $loginExists["heslo"];
    $isCorrectPassword = password_verify($heslo, $hesloDB);

    if ($isCorrectPassword == false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    } else {
        session_start();
        $_SESSION["uzivatel_id"]    = $loginExists["id"];
        $_SESSION["login"]          = $loginExists["login"];
        $_SESSION["jmeno"]          = $loginExists["jmeno"];
        $_SESSION["prijmeni"]       = $loginExists["prijmeni"];

        header("location: ../index.html");
        exit();
    }
}
