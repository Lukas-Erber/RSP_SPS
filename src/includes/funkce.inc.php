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

        $userRole = findUserRole($conn, $loginExists["id_role"]);
        $_SESSION["role_kod"]       = $userRole["kod"];
        $_SESSION["role_nazev"]     = $userRole["nazev"];
        
        header("location: ../index.php");
        exit();
    }
}

function findUserRole($conn, $userRoleId) {
    $sql = "SELECT * FROM role WHERE id = ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $userRoleId);
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

function deleteClanek($conn, $clanekId) {
    $sql = "DELETE FROM clanek WHERE id=?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $clanekId);
    mysqli_stmt_execute($stmt);
}

function deletePosudek($conn, $posudekId) {
    $sql = "DELETE FROM posudek WHERE id=?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $posudekId);
    mysqli_stmt_execute($stmt);
}

function updateRecenzenty($conn, $clanekId, $recenzent1, $recenzent2) {
    $sql = "UPDATE clanek SET id_recenzent = ?, id_recenzent2 = ? WHERE clanek.id = ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
    }

    mysqli_stmt_bind_param($stmt, "iii", $recenzent1, $recenzent2, $clanekId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function clanekPotvrzeniPridelenychRecenzentu($conn, $clanekId) {
    $sql = "UPDATE clanek SET id_stav = ? WHERE clanek.id = ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../redaktor.php");
        exit();
    }

    $stav = stavExist($conn, "odeslano_k_posudku");

    if ($stav == false) {
        header("location: ../redaktor.php");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ii", $stav["id"], $clanekId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function stavExist($conn, $stav) {
    $sql = "SELECT * FROM stav WHERE kod = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $stav);
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

function recenzentClanekOdeslat($conn, $clanekId) {
    $sql = "UPDATE clanek SET id_stav = ? WHERE clanek.id = ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: recenze.php");
        exit();
    }

    $stav = stavExist($conn, "odeslano_redaktorovi");

    if ($stav == false) {
        header("location: recenze.php");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ii", $stav["id"], $clanekId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function clanekPrijato($conn, $clanekId, $jeSefredaktor) {
    $sql = "UPDATE clanek SET id_stav = ? WHERE clanek.id = ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)) {
        if($jeSefredaktor) {
            header("location: sefredaktor.php");
        } else {
            header("location: redaktor.php");
        }
        exit();
    }

    $stav = stavExist($conn, "prijato");

    if ($stav == false) {
        if($jeSefredaktor) {
            header("location: sefredaktor.php");
        } else {
            header("location: redaktor.php");
        }
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ii", $stav["id"], $clanekId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function clanekVraceno($conn, $clanekId, $jeSefredaktor) {
    $sql = "UPDATE clanek SET id_stav = ? WHERE clanek.id = ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)) {
        if($jeSefredaktor) {
            header("location: sefredaktor.php");
        } else {
            header("location: redaktor.php");
        }
        exit();
    }

    $stav = stavExist($conn, "vraceno");

    if ($stav == false) {
        if($jeSefredaktor) {
            header("location: sefredaktor.php");
        } else {
            header("location: redaktor.php");
        }
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ii", $stav["id"], $clanekId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function clanekZamitnuto($conn, $clanekId, $jeSefredaktor) {
    $sql = "UPDATE clanek SET id_stav = ? WHERE clanek.id = ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)) {
        if($jeSefredaktor) {
            header("location: sefredaktor.php");
        } else {
            header("location: redaktor.php");
        }
        exit();
    }

    $stav = stavExist($conn, "zamitnuto");

    if ($stav == false) {
        if($jeSefredaktor) {
            header("location: sefredaktor.php");
        } else {
            header("location: redaktor.php");
        }
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ii", $stav["id"], $clanekId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function clanekPredatSef($conn, $clanekId) {
    $sql = "UPDATE clanek SET id_stav = ? WHERE clanek.id = ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: redaktor.php");
        exit();
    }

    $stav = stavExist($conn, "odeslano_sefredaktorovi");

    if ($stav == false) {
        header("location: redaktor.php");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ii", $stav["id"], $clanekId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function zalozitRecenzi($conn, $clanekId, $userId, $text, $aktualnost, $zajimavost, $prinosnost, $originalita, $odborna_uroven, $jazykova_uroven) {
    //TODO: INSERT
    $sql = "INSERT INTO posudek (id_uzivatel, id_clanek, datum, text, aktualnost, zajimavost, prinosnost, originalita, odborna_uroven, jazykova_uroven) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: recenze.php?error=stmtfailed");
        exit();
    }

    $datum = date("Y-m-d");

    mysqli_stmt_bind_param($stmt, "iissiiiiii", $userId, $clanekId, $datum, $text, $aktualnost, $zajimavost, $prinosnost, $originalita, $odborna_uroven, $jazykova_uroven);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: recenze.php");
    exit();
}
