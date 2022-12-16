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

    <?php
        require_once 'includes/dbconn.inc.php';

        // Přiřazení recenzentů
        $sql = "SELECT clanek.id, clanek.nazev as clanek_nazev, clanek.tema, clanek.datum, autor.jmeno, autor.prijmeni, stav.nazev as stav_nazev, recenzent.jmeno as recenzent_jmeno, recenzent.prijmeni as recenzent_prijmeni, recenzent2.jmeno as recenzent2_jmeno, recenzent2.prijmeni as recenzent2_prijmeni
                FROM clanek
                INNER JOIN stav ON stav.id = clanek.id_stav 
                INNER JOIN uzivatel AS autor ON autor.id = clanek.id_autor
                LEFT JOIN uzivatel AS recenzent ON recenzent.id = clanek.id_recenzent  
                LEFT JOIN uzivatel AS recenzent2 ON recenzent2.id = clanek.id_recenzent2 
                WHERE stav.kod = 'pridano';";

        $result = mysqli_query($conn, $sql);

        $sql_recenzent = "SELECT uzivatel.id, uzivatel.jmeno, uzivatel.prijmeni
                            FROM uzivatel
                            INNER JOIN role ON role.id = uzivatel.id_role
                            WHERE role.kod = 'recenzent';";
        $result_recenzent = mysqli_query($conn, $sql_recenzent);
        $recenzenti = array();
        
        if (mysqli_num_rows($result_recenzent) > 0) {
            while ($row_recenzent = mysqli_fetch_array($result_recenzent)) {
                $recenzenti[$row_recenzent["id"]] = $row_recenzent["jmeno"]." ".$row_recenzent["prijmeni"];
            }
        }

        // Schvalování článků
        $sql_schvalovani_clanku = "SELECT clanek.id, clanek.nazev as clanek_nazev, clanek.tema, clanek.datum, autor.jmeno, autor.prijmeni, stav.nazev as stav_nazev, recenzent.jmeno as recenzent_jmeno, recenzent.prijmeni as recenzent_prijmeni, recenzent2.jmeno as recenzent2_jmeno, recenzent2.prijmeni as recenzent2_prijmeni
                FROM clanek
                INNER JOIN stav ON stav.id = clanek.id_stav 
                INNER JOIN uzivatel AS autor ON autor.id = clanek.id_autor
                LEFT JOIN uzivatel AS recenzent ON recenzent.id = clanek.id_recenzent  
                LEFT JOIN uzivatel AS recenzent2 ON recenzent2.id = clanek.id_recenzent2 
                WHERE stav.kod = 'odeslano_redaktorovi';"; 
        $result_schvalovani_clanku = mysqli_query($conn, $sql_schvalovani_clanku);

        // Přehled článků
        $sql_prehled_clanku = "SELECT clanek.nazev as clanek_nazev, clanek.tema, clanek.datum, autor.jmeno, autor.prijmeni, stav.nazev as stav_nazev, recenzent.jmeno as recenzent_jmeno, recenzent.prijmeni as recenzent_prijmeni, recenzent2.jmeno as recenzent2_jmeno, recenzent2.prijmeni as recenzent2_prijmeni
                FROM clanek
                INNER JOIN stav ON stav.id = clanek.id_stav 
                INNER JOIN uzivatel AS autor ON autor.id = clanek.id_autor
                LEFT JOIN uzivatel AS recenzent ON recenzent.id = clanek.id_recenzent  
                LEFT JOIN uzivatel AS recenzent2 ON recenzent2.id = clanek.id_recenzent2;";
        $result_prehled_clanku = mysqli_query($conn, $sql_prehled_clanku);

        // Přehled recenzentů
        $sql_recenzent = "SELECT jmeno, prijmeni, login, email
                          FROM uzivatel
                          INNER JOIN role ON role.id = uzivatel.id_role
                          WHERE role.kod = 'recenzent';"; 
        $result_recenzent = mysqli_query($conn, $sql_recenzent);
    ?>

    <section>
      <div class="container">
        <h1>Redaktor</h1>

        <!-- Modal -->
          <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Přiřazení recenzentů</h4>
                </div>

                <div class="modal-body">    
                    <form action="clanek_update_recenzent.php" method="post" class="form-add-article" enctype="multipart/form-data">
                    <input type="hidden" name="clanekid" id="clanek-id">
                    <label>Recenzent 1: </label>
                    <select name="recenzent1">
                        <?php 
                            foreach ($recenzenti as $id => $jmeno) {
                                echo "<option value='{$id}'>{$jmeno}</option>";
                            }
                        ?>
                    </select>

                    <label>Recenzent 2: </label>
                    <select name="recenzent2">
                        <?php 
                            foreach ($recenzenti as $id => $jmeno) {
                                echo "<option value='{$id}'>{$jmeno}</option>";
                            }
                        ?>
                    </select>
                    <button id="test" type="submit" name="submit">Přiřadit</button>
                  </form>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Zavřít</button>
                </div>
              </div>
            </div>
          </div>

        <!-- Přiřazení recenzentů -->
        <div class="autor-obsah">
            <h3>Přiřazení recenzentů k článkům</h3>

              <table>
                  <tr>
                      <th>Název</th>
                      <th>Autor</th>
                      <th>Téma</th>
                      <th>Datum</th>
                      <th>Stav</th>
                      <th>Recenzent 1</th>
                      <th>Recenzent 2</th>
                      <th>Akce</th>
                  </tr>

                  <?php
                  if (mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_array($result)) {
                            ?>
                            <tr>
                                <td><?php echo $row["clanek_nazev"]; ?></td>
                                <td><?php echo $row["jmeno"]." ".$row["prijmeni"]; ?></td>
                                <td><?php echo $row["tema"]; ?></td>
                                <td><?php echo $row["datum"]; ?></td>
                                <td><?php echo $row["stav_nazev"]; ?></td>
                                <td><?php echo $row["recenzent_jmeno"]." ".$row["recenzent_prijmeni"]; ?></td>
                                <td><?php echo $row["recenzent2_jmeno"]." ".$row["recenzent2_prijmeni"]; ?></td>

                                <td>
                                    <a href="#myModal" class="aaa" role="button" data-toggle="modal" data-id="<?php echo $row['id']; ?>">
                                        <i class="fa-solid fa-circle-plus"></i>
                                    </a>
                                    <a href="clanek_priradit_recenzent.php?clanekId=<?php echo $row['id']; ?>"><i class="fa-solid fa-check"></i></a>
                                </td>
                            </tr>

                            <?php
                        }
                    }

                    $result = $conn->query($sql);
                  ?>

              </table>
          </div>
      </div>
    </section>

    <section>
      <div class="container">
        <div class="autor-obsah">
            <h3>Schvalování článků</h3>
            <table>
                <tr>
                    <th>Název</th>
                    <th>Autor</th>
                    <th>Téma</th>
                    <th>Datum</th>
                    <th>Stav</th>
                    <th>Recenzent 1</th>
                    <th>Recenzent 2</th>
                    <th>Akce</th>
                </tr>
            <?php
                if (mysqli_num_rows($result_schvalovani_clanku) > 0) {
                    while ($row = mysqli_fetch_array($result_schvalovani_clanku)) {
            ?>
                        <tr>
                            <td><?php echo $row["clanek_nazev"]; ?></td>
                            <td><?php echo $row["jmeno"]." ".$row["prijmeni"]; ?></td>
                            <td><?php echo $row["tema"]; ?></td>
                            <td><?php echo $row["datum"]; ?></td>
                            <td><?php echo $row["stav_nazev"]; ?></td>
                            <td><?php echo $row["recenzent_jmeno"]." ".$row["recenzent_prijmeni"]; ?></td>
                            <td><?php echo $row["recenzent2_jmeno"]." ".$row["recenzent2_prijmeni"]; ?></td>
                            <td>
                                <a href="clanek_prijato.php?clanekId=<?php echo $row['id']; ?>">Přijmout</a><br>
                                <a href="clanek_zamitnuto.php?clanekId=<?php echo $row['id']; ?>">Zamítnout</a><br>
                                <a href="clanek_vraceno.php?clanekId=<?php echo $row['id']; ?>">Vrátit</a><br>
                                <a href="clanek_predat_sef.php?clanekId=<?php echo $row['id']; ?>">Předat šéfredaktorovi</a>
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

    <section>
      <div class="container">
            <div class="autor-obsah">
                <h3>Přehled všech článků a jejich stav</h3>
                <table>
                    <tr>
                        <th>Název</th>
                        <th>Autor</th>
                        <th>Téma</th>
                        <th>Datum</th>
                        <th>Stav</th>
                        <th>Recenzent 1</th>
                        <th>Recenzent 2</th>
                    </tr>
                <?php
                    if (mysqli_num_rows($result_prehled_clanku) > 0) {
                        while ($row = mysqli_fetch_array($result_prehled_clanku)) {
                ?>
                            <tr>
                                <td><?php echo $row["clanek_nazev"]; ?></td>
                                <td><?php echo $row["jmeno"]." ".$row["prijmeni"]; ?></td>
                                <td><?php echo $row["tema"]; ?></td>
                                <td><?php echo $row["datum"]; ?></td>
                                <td><?php echo $row["stav_nazev"]; ?></td>
                                <td><?php echo $row["recenzent_jmeno"]." ".$row["recenzent_prijmeni"]; ?></td>
                                <td><?php echo $row["recenzent2_jmeno"]." ".$row["recenzent2_prijmeni"]; ?></td>
                            </tr>

                <?php
                        }
                    }
                ?>
                </table>
            </div>
      </div>
    </section>

    <section>
      <div class="container">
            <div class="autor-obsah">
                <h3>Přehled Recenzentů</h3>
                <table>
                    <tr>
                        <th>Jméno</th>
                        <th>Login</th>
                        <th>Email</th>
                    </tr>
                <?php
                    if (mysqli_num_rows($result_recenzent) > 0) {
                        while ($row = mysqli_fetch_array($result_recenzent)) {
                ?>
                            <tr>
                                <td><?php echo $row["jmeno"]." ".$row["prijmeni"]; ?></td>
                                <td><?php echo $row["login"]; ?></td>
                                <td><?php echo $row["email"]; ?></td>
                            </tr>

                <?php
                        }
                    }

                    $conn->close();
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
        });
    </script>
  </body>
</html>
