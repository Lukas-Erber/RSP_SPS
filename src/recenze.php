<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'includes/header.inc.php'; ?>
  </head>
  <body>
    <?php include 'includes/main-bar.inc.php'; ?>

    <section>
      <div class="container">
        <h1>Recenze</h1>

        <!--Šablona posudku -->
        <div class="sablona">   
          <h2>Šablona ke stažení</h2>
          <a href="./sablony/recenzni-sablona.pdf" target="_blank"><i class="fa-solid fa-file-pdf"></i></a>
        </div>  

        <div class="pridani">
          <!-- Modal -->
          <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Přidání recenze</h4>
                </div>
                
                <div class="modal-body">
                  <form action="upload_recenze.php" method="post" class="form-add-article" enctype="multipart/form-data">
                    <input type="number" name="hodnoceni1" min="1" max="5">
                    <input type="number" name="hodnoceni2" min="1" max="5">
                    <input type="number" name="hodnoceni3" min="1" max="5">
                    <input type="number" name="hodnoceni4" min="1" max="5">
                    <input type="number" name="hodnoceni5" min="1" max="5">
                    <input type="number" name="hodnoceni6" min="1" max="5">

                    <button type="submit" name="submit">Uložit recenzi</button>
                  </form>
                </div>
                
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Zavřít</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!--Články k recenzi -->
        <div class="autor-obsah">
        <h3>Seznam článků přiřazených k hodnocení</h3>
        <?php 
          require_once 'includes/dbconn.inc.php';

          $userId = $_SESSION["uzivatel_id"];
          $sql = "SELECT clanek.id, clanek.nazev, uzivatel.jmeno, uzivatel.prijmeni, clanek.datum, stav.nazev as stav_nazev 
                  FROM clanek 
                  INNER JOIN uzivatel ON clanek.id_autor = uzivatel.id 
                  INNER JOIN stav ON clanek.id_stav = stav.id
                  WHERE clanek.id_recenzent = {$userId} AND stav.kod = 'odeslano_k_posudku';";

            $result = mysqli_query($conn, $sql);
          ?>

          <table>
            <tr>
              <th>Název článku</th>
              <th>Autor</th>
              <th>Datum</th>
              <th>Stav</th>
              <th>Akce</th>
            </tr>
            
            <?php 
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
            ?>
            
            <tr>
              <td><?php echo $row["nazev"]; ?></td>
              <td><?php echo $row["jmeno"]." ".$row["prijmeni"]; ?></td>
              <td><?php echo $row["datum"]; ?></td>
              <td><?php echo $row["stav_nazev"]; ?></td>
              <td><button type="button" class="btn-add-article" data-toggle="modal" data-target="#myModal"<?php $row['id']?>><i class="fa-solid fa-circle-plus"></i></button></td>
            </tr>

            <?php
                }
              }
            ?>
          </table>
        </div>
      </div>
    </section>

    <?php include 'includes/footer.inc.php'; ?>
  </body>
</html>
