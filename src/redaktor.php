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
        <h1>Redaktor</h1>

        <!-- Přiřazení recenzentů -->
        <div class="autor-obsah">
            <h3>Přiřazení recenzentů k článkům</h3>
            <?php
                require_once 'includes/dbconn.inc.php';

                $sql = "SELECT clanek.id, clanek.nazev as clanek_nazev, clanek.tema, clanek.datum, uzivatel.jmeno, uzivatel.prijmeni, stav.nazev as stav_nazev
                FROM clanek
                INNER JOIN stav ON stav.id = clanek.id_stav 
                INNER JOIN uzivatel ON uzivatel.id = clanek.id_autor
                WHERE stav.kod = 'pridano' AND clanek.id_recenzent = 0 AND clanek.id_recenzent2 = 0;";


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
            ?>

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

                                <!-- Recenzent 1 -->
                                <td>
                                    <select name="recenzent1">
                                    <?php 
                                        foreach ($recenzenti as $id => $jmeno) {
                                            echo "<option value='{$id}'>{$jmeno}</option>";
                                        }
                                    ?>
                                    </select>
                                </td>

                                <!-- Recenzent 2 -->
                                <td>
                                    <select name="recenzent2">
                                    <?php 
                                        foreach ($recenzenti as $id => $jmeno) {
                                            echo "<option value='{$id}'>{$jmeno}</option>";
                                        }
                                    ?>
                                    </select>
                                </td>
                                <td><a href="clanek_update_recenzent.php?id=<?php echo $row['id'];?>">Potvrdit recenzenty</a></td>
                            </tr>

                            <?php
                        }
                    }

                  $result = $conn->query($sql);

                  $conn->close();
                  ?>

              </table>
          </div>
      </div>
    </section>

    <?php include 'includes/footer.inc.php'; ?>
  </body>
</html>
