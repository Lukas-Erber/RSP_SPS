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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
          <div class="head-article">
          <h2>Články</h2>
          <button type="button" class="btn-add-article" data-toggle="modal" data-target="#myModal">Přidat článek</button>
          </div>


          <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Přidání nového článku</h4>
        </div>
        <div class="modal-body">    
            <form action="upload.php" method="post" class="form-add-article" enctype="multipart/form-data">
            <input type="text" name="nazev" id="jmeno_souboru" placeholder="Název článku">
            <input type="text" name="tema" id="" placeholder="Téma článku">
            <input type="text" name="autori" id="" placeholder="Autoři">
            <input type="file" name="soubor" id="">
            <button type="submit" name="submit">Uložit článek</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Zavřít</button>
        </div>
    </div>
    </div>
    </div>


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
