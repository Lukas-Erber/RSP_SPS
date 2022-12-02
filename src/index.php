<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'includes/header.inc.php'; ?>
  </head>
  <body>
    <header>
      <div class="container">
        <div class="main-head">
          <div class="left-side">
          <img src="./img/sps-logo.png" alt="samurailogo" />
          <?php 
        if (isset($_SESSION["uzivatel_id"])) {
          echo $_SESSION["jmeno"];
          echo " ";
          echo $_SESSION["prijmeni"];
          echo "<br>";
          echo "Vaše role je: ";
          echo $_SESSION["role_nazev"];
        }
        ?>
          </div>
          <div class="nav-menu">
            <ul>
                <?php include 'includes/menu.inc.php'; ?>               
            </ul>
          </div>
          <div class="right-side">
            <div class="icons-right">
          <?php include 'includes/icons.inc.php'; ?>
          </div>
          <!-- <?php 
        // if (isset($_SESSION["uzivatel_id"])) {
        //   echo $_SESSION["jmeno"];
        //   echo " ";
        //   echo $_SESSION["prijmeni"];
        //   echo "<br>";
        //   echo "Vaše role je: ";
        //   echo $_SESSION["role_nazev"];
        // }
        ?> -->
        </div>
        </div>
       
      </div>
    </header>

    <section>
      <div class="container">
        <h1>Samurai Programming Solution Magazine</h1>
        <div class="our-intro">
          <p>
            <b>Samurai Programming Solution</b> je vysokoškolský odborný
            recenzovaný časopis, který slouží pro publikační aktivity
            akademických pracovníků Vysoké školy polytechnické Jihlava i jiných
            vysokých škol, univerzit a výzkumných organizací.
          </p>
        </div>
    </section>

    <section>
        <div class="container">
            <h1>obsahová čáast</h1>
            <div class="">
                <?php
                require "includes/obsah_general.php";
                ?>
            </div>
    </section>


    <?php include 'includes/footer.inc.php'; ?>
  </body>
</html>
