<?php 

  if (isset($_SESSION["uzivatel_id"])) {
    echo "<a href=\"profil.php\"><li>Profil</li></a>";
  }

  if (isset($_SESSION["role_kod"])) {
    $roleKod = $_SESSION["role_kod"];

    if (strcmp($roleKod, "autor") == 0) {
      echo "<a href=\"clanky.php\"><li>Články</li></a>";
    } 

    if (strcmp($roleKod, "recenzent") == 0) {
      echo "<a href=\"recenze.php\"><li>Recenze</li></a>";
    } 

    if (strcmp($roleKod, "admin") == 0) {
      echo "<a href=\"administrace.php\"><li>Administrace</li></a>";
    }
  }                
