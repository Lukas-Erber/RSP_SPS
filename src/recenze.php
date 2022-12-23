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
    <?php include 'includes/posudek-modal.inc.php'; ?>

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
                    <input type="hidden" name="clanekId" id="clanek-id">

                    <input type="text"   name="text" placeholder="Text posudku" required>
                    <input type="number" name="hodnoceni1" min="1" max="5" placeholder="Aktuálnost (1-5)" required>
                    <input type="number" name="hodnoceni2" min="1" max="5" placeholder="Zajímavost (1-5)" required>
                    <input type="number" name="hodnoceni3" min="1" max="5" placeholder="Přínosnost (1-5)" required>
                    <input type="number" name="hodnoceni4" min="1" max="5" placeholder="Originalita (1-5)" required>
                    <input type="number" name="hodnoceni5" min="1" max="5" placeholder="Odborná úroveň (1-5)" required>
                    <input type="number" name="hodnoceni6" min="1" max="5" placeholder="jazyková a stylistická úroveň (1-5)" required>

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
          $sql = "SELECT clanek.id, clanek.nazev, uzivatel.jmeno, uzivatel.prijmeni, clanek.datum, clanek.soubor, stav.nazev as stav_nazev, posudek.id as posudek_id, posudek.aktualnost as r1_hod1, posudek.zajimavost as r1_hod2, posudek.prinosnost as r1_hod3, posudek.originalita as r1_hod4, posudek.odborna_uroven as r1_hod5, posudek.jazykova_uroven as r1_hod6, posudek.text as r1_text
                  FROM clanek 
                  INNER JOIN uzivatel ON clanek.id_autor = uzivatel.id 
                  INNER JOIN stav ON clanek.id_stav = stav.id
                  LEFT JOIN posudek ON posudek.id_clanek = clanek.id
                  WHERE clanek.id_recenzent = {$userId} AND stav.kod = 'odeslano_k_posudku';";

            $result = mysqli_query($conn, $sql);
          ?>

          <table>
            <tr>
              <th>Název článku</th>
              <th>Autor</th>
              <th>Datum</th>
              <th>Stav</th>
              <th>Posudek</th>
              <th>Akce 1</th>
              <th>Akce 2</th>
            </tr>
            
            <?php 
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
            ?>
            
            <tr>
              <td><a href="./pdf/<?php echo $row['soubor'] ?>"><?php echo $row["nazev"]; ?></a></td>
              <td><?php echo $row["jmeno"]." ".$row["prijmeni"]; ?></td>
              <td><?php echo $row["datum"]; ?></td>
              <td><?php echo $row["stav_nazev"]; ?></td>
              <td>
                                    <a class="rec" data-toggle="modal" data-target="#recenzeModal" 
                                            data-hod1="<?php echo $row['r1_hod1'] ?>" 
                                            data-hod2="<?php echo $row['r1_hod2'] ?>" 
                                            data-hod3="<?php echo $row['r1_hod3'] ?>"
                                            data-hod4="<?php echo $row['r1_hod4'] ?>"
                                            data-hod5="<?php echo $row['r1_hod5'] ?>"
                                            data-hod6="<?php echo $row['r1_hod6'] ?>"
                                            data-text="<?php echo $row['r1_text'] ?>"
                                    >

                                    Zobrazit posudek</a>
                                </td>
              <td>
                <?php 
                  if(empty($row["r1_text"])) {
                ?>
                  <a href="#myModal" class="aaa" role="button" data-toggle="modal" data-id="<?php echo $row['id'] ?>">
                    <i class="fa-solid fa-circle-plus"></i>
                  </a>
                <?php 
                  } else {
                ?>
                    <a href="posudek_odstranit.php?posudekId=<?php echo $row['posudek_id'] ?>">Odstranit posudek</a>;
                <?php
                  }
                ?>
              </td>

              <td>
                <?php 
                  if(empty($row["text"])) { 
                    echo "Musíte vytvořit posudek!";
                  } else {
                ?>
                <a href="clanek_recenzent_odeslat.php?clanekId=<?php echo $row['id'] ?>">Odeslat redaktorovi</a>
                <?php } ?>
              </td>
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

    <script type="text/javascript">
          $(document).ready(function(){
            $(".aaa").click(function(){
                $("#clanek-id").val($(this).data("id"));
            });

            $('.rec').click(function() {     
                var text = $(this).data('text');  
                var hod1 = $(this).data('hod1'); 
                var hod2 = $(this).data('hod2');
                var hod3 = $(this).data('hod3');
                var hod4 = $(this).data('hod4');
                var hod5 = $(this).data('hod5');
                var hod6 = $(this).data('hod6');

                $('#text').val(text);  
                $('#hod1').val(hod1);  
                $('#hod2').val(hod2);
                $('#hod3').val(hod3);
                $('#hod4').val(hod4);
                $('#hod5').val(hod5);
                $('#hod6').val(hod6);
            });
        });
    </script>
  </body>
</html>
