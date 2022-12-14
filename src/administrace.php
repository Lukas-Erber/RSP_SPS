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
        <h1>Administrace</h1>
          <!--Uživatelé -->
          <div class="autor-obsah">
              <h3>Seznam uživatelů</h3>
              <?php
              require_once 'includes/dbconn.inc.php';

              $sql = "SELECT uzivatel.id, uzivatel.id_role, uzivatel.jmeno, uzivatel.prijmeni, uzivatel.email, role.nazev AS role_nazev
                FROM uzivatel
                INNER JOIN role ON uzivatel.id_role = role.id";


              $result = mysqli_query($conn, $sql);


              ?>

              <table>
                  <tr>
                      <th>ID uživatele</th>
                      <th>Role</th>
                      <th>Jméno</th>
                      <th>Příjmení</th>
                      <th>e-mail</th>
                      <th>Odstranit</th>
                      <th>Upravit</th>

                  </tr>

                  <?php
                  if (mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_array($result)) {
                          ?>
                          <tr>
                              <td><?php echo $row["id"]; ?></td>
                              <td><?php echo $row["role_nazev"]; ?></td>
                              <td><?php echo $row["jmeno"]; ?></td>
                              <td><?php echo $row["prijmeni"]; ?></td>
                              <td><?php echo $row["email"]; ?></td>
                              <td><a href="delete.php?id=<?php echo $row['id'];?>">Delete</a></td>
                              <td><a href="edit.php?id=<?php echo $row['id'];?>">Edit</a></td>
                          </tr>

                          <?php
                      }
                  }
                  ?>

              </table>
          </div>

          <!--Články -->
          <div class="autor-obsah">
              <h3>Seznam Článků</h3>
              <?php
              require_once 'includes/dbconn.inc.php';

              $sql = "SELECT clanek.id, clanek.tema, clanek.datum, clanek.nazev as clanek_nazev, clanek.spoluautori, stav.nazev as stav_nazev, uzivatel.jmeno, uzivatel.prijmeni
                FROM clanek
                INNER JOIN stav ON stav.id = clanek.id_stav 
                INNER JOIN uzivatel ON uzivatel.id = clanek.id_autor";


              $result = mysqli_query($conn, $sql);


              ?>

              <table>
                  <tr>
                      <th>ID článku</th>
                      <th>Autor</th>
                      <th>Téma</th>
                      <th>Datum</th>
                      <th>Název</th>
                      <th>Spoluautoři</th>
                      <th>Stav</th>
                      <th>Akce</th>
                  </tr>

                  <?php
                  if (mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_array($result)) {
                          ?>
                          <tr>
                              <td><?php echo $row["id"]; ?></td>
                              <td><?php echo $row["jmeno"]." ".$row["prijmeni"]; ?></td>
                              <td><?php echo $row["tema"]; ?></td>
                              <td><?php echo $row["datum"]; ?></td>
                              <td><?php echo $row["clanek_nazev"]; ?></td>
                              <td><?php echo $row["spoluautori"]; ?></td>
                              <td><?php echo $row["stav_nazev"]; ?></td>
                              <td><a href="clanek_delete.php?id=<?php echo $row['id'];?>">Delete</a></td>
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
