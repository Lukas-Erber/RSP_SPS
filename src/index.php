<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/home-page.css" />
    <link rel="stylesheet" href="./css/all.min.css" />
    <title>Hlavní stránka</title>
  </head>
  <body>
    <header>
      <div class="container">
        <div class="main-head">
          <img src="./img/sps-logo.png" alt="samurailogo" />
          <div class="nav-menu">
            <ul>
              <?php 
                if (isset($_SESSION["uzivatel_id"])) {
                  echo "<a href=\"#\"><li>Profil</li></a>";
                }
              ?>
              <a href="#"><li>Články</li></a>
              <a href="#"><li>Recenze</li></a>
              <a href="#"><li>Položka</li></a>
              <a href="#"><li>Administrace</li></a>
            </ul>
          </div>
          <div class="icons">
            <a href="index.php"> <i class="fa-solid fa-house"></i></a>

            <?php 
              if (isset($_SESSION["uzivatel_id"])) {
                echo "<a href=\"includes/logout.inc.php\"><i class=\"fa-solid fa-book-open-reader\"></i></a>";
              } else {
                echo "<a href=\"login.php\"><i class=\"fa-solid fa-book-open-reader\"></i></a>";
              }
            ?>
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
        <div class="article-table">
          <h2>Články</h2>

          <table>
            <tr>
              <td>
                <h4>Název článku</h4>
                <p>Autor: XXX XXX</p>
                <p>Stav</p>
                <p>Datum</p>
                <p>Hodnocení</p>
              </td>
              <td>
                <h4>Název článku</h4>
                <p>Autor: XXX XXX</p>
                <p>Stav</p>
                <p>Datum</p>
                <p>Hodnocení</p>
              </td>
              <td>
                <h4>Název článku</h4>
                <p>Autor: XXX XXX</p>
                <p>Stav</p>
                <p>Datum</p>
                <p>Hodnocení</p>
              </td>
              <td>
                <h4>Název článku</h4>
                <p>Autor: XXX XXX</p>
                <p>Stav</p>
                <p>Datum</p>
                <p>Hodnocení</p>
              </td>
            </tr>
            <tr>
              <td>
                <h4>Název článku</h4>
                <p>Autor: XXX XXX</p>
                <p>Stav</p>
                <p>Datum</p>
                <p>Hodnocení</p>
              </td>
              <td>
                <h4>Název článku</h4>
                <p>Autor: XXX XXX</p>
                <p>Stav</p>
                <p>Datum</p>
                <p>Hodnocení</p>
              </td>
              <td>
                <h4>Název článku</h4>
                <p>Autor: XXX XXX</p>
                <p>Stav</p>
                <p>Datum</p>
                <p>Hodnocení</p>
              </td>
              <td>
                <h4>Název článku</h4>
                <p>Autor: XXX XXX</p>
                <p>Stav</p>
                <p>Datum</p>
                <p>Hodnocení</p>
              </td>
            </tr>
            <tr>
              <td>
                <h4>Název článku</h4>
                <p>Autor: XXX XXX</p>
                <p>Stav</p>
                <p>Datum</p>
                <p>Hodnocení</p>
              </td>
              <td>
                <h4>Název článku</h4>
                <p>Autor: XXX XXX</p>
                <p>Stav</p>
                <p>Datum</p>
                <p>Hodnocení</p>
              </td>
              <td>
                <h4>Název článku</h4>
                <p>Autor: XXX XXX</p>
                <p>Stav</p>
                <p>Datum</p>
                <p>Hodnocení</p>
              </td>
              <td>
                <h4>Název článku</h4>
                <p>Autor: XXX XXX</p>
                <p>Stav</p>
                <p>Datum</p>
                <p>Hodnocení</p>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </section>

    <footer>
      <div class="container">
        &copy;
        <script>
          document.write(new Date().getFullYear());
        </script>
        SPS
      </div>
    </footer>
  </body>
</html>
