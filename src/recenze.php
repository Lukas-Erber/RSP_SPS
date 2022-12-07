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
        <h1>Recenze</h1>

        <!--Šablona posudku -->
        <div class="sablona">   
          <h2>Šablona ke stažení</h2>
          <a href="./sablony/recenzni-sablona.pdf"><i class=" fa-sharp fa-solid fa-file-word"></i></a>
        </div>  

        <!--Články k recenzi -->
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
            </tr>

            <?php
                }
              }
            ?>
      </div>
    </section>

    <?php include 'includes/footer.inc.php'; ?>
  </body>
</html>
