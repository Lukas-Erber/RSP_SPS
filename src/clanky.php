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
          <img src="./img/sps-logo.png" alt="samurailogo" />
          <div class="nav-menu">
            <ul>
                <?php include 'includes/menu.inc.php'; ?>               
            </ul>
          </div>
          <?php include 'includes/icons.inc.php'; ?>
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

    <?php include 'includes/footer.inc.php'; ?>
  </body>
</html>
