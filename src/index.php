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

      // Přehled článků
      $sql_clanky = "SELECT clanek.id, clanek.nazev as clanek_nazev, clanek.tema, clanek.datum, clanek.soubor, autor.jmeno, autor.prijmeni, stav.nazev as stav_nazev
                     FROM clanek
                     INNER JOIN stav ON stav.id = clanek.id_stav 
                     INNER JOIN uzivatel AS autor ON autor.id = clanek.id_autor
                     WHERE stav.kod = 'odeslano_do_nakladatelstvi';"; 
      $result_clanky = mysqli_query($conn, $sql_clanky);
    ?>

    <section>
      <div class="container">
        <h1>Samurai Programming Solution Magazine</h1>
        <div class="our-intro">
          <p>
            <b >Samurai Programming Solution</b> je vysokoškolský odborný
            recenzovaný časopis, který slouží pro publikační aktivity
            akademických pracovníků Vysoké školy polytechnické Jihlava i jiných
            vysokých škol, univerzit a výzkumných organizací.
          </p>
        </div>
    </section>

    <section>
      <div class="container">
        <div class="autor-obsah">
            <h3>Zveřejněné články</h3>
            <table>
                <tr>
                    <th>Název</th>
                    <th>Autor</th>
                    <th>Téma</th>
                    <th>Datum</th>
                </tr>
            <?php
                if (mysqli_num_rows($result_clanky) > 0) {
                    while ($row = mysqli_fetch_array($result_clanky)) {
            ?>
                        <tr>
                            <td><a href="./pdf/<?php echo $row['soubor'] ?>"><?php echo $row["clanek_nazev"]; ?></a></td>
                            <td><?php echo $row["jmeno"]." ".$row["prijmeni"]; ?></td>
                            <td><?php echo $row["tema"]; ?></td>
                            <td><?php echo $row["datum"]; ?></td>
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
