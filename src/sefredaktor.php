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
        // Články vyžadující akci
        $sql_clanky = "SELECT clanek.id, clanek.nazev as clanek_nazev, clanek.tema, clanek.datum, clanek.soubor, stav.nazev as stav_nazev, uzivatel.jmeno as autor_jmeno, uzivatel.prijmeni as autor_prijmeni, recenzent1.jmeno as recenzent_jmeno, recenzent1.prijmeni as recenzent_prijmeni, recenzent2.jmeno as recenzent2_jmeno, recenzent2.prijmeni as recenzent2_prijmeni 
                       FROM clanek 
                       INNER JOIN uzivatel ON uzivatel.id = clanek.id_autor
                       INNER JOIN stav ON stav.id = clanek.id_stav AND stav.kod = 'odeslano_sefredaktorovi'
                       LEFT JOIN uzivatel AS recenzent1 ON recenzent1.id = clanek.id_recenzent  
                       LEFT JOIN uzivatel AS recenzent2 ON recenzent2.id = clanek.id_recenzent2;";
        $result_clanky = mysqli_query($conn, $sql_clanky);

        // Články 
        $sql_clanky_prehled = "SELECT clanek.nazev as clanek_nazev, clanek.tema, clanek.datum, clanek.soubor, stav.nazev as stav_nazev, uzivatel.jmeno as autor_jmeno, uzivatel.prijmeni as autor_prijmeni, recenzent1.jmeno as recenzent_jmeno, recenzent1.prijmeni as recenzent_prijmeni, recenzent2.jmeno as recenzent2_jmeno, recenzent2.prijmeni as recenzent2_prijmeni 
                       FROM clanek 
                       INNER JOIN uzivatel ON uzivatel.id = clanek.id_autor
                       INNER JOIN stav ON stav.id = clanek.id_stav
                       LEFT JOIN uzivatel AS recenzent1 ON recenzent1.id = clanek.id_recenzent  
                       LEFT JOIN uzivatel AS recenzent2 ON recenzent2.id = clanek.id_recenzent2;";
        $result_clanky_prehled = mysqli_query($conn, $sql_clanky_prehled);

        // Autoři
        $sql_autor = "SELECT jmeno, prijmeni, login, email, role.nazev as role_nazev
                          FROM uzivatel
                          INNER JOIN role ON role.id = uzivatel.id_role
                          WHERE role.kod = 'autor';"; 
        $result_autor = mysqli_query($conn, $sql_autor);

        // Recenzenti
        $sql_recenzent = "SELECT jmeno, prijmeni, login, email, role.nazev as role_nazev
                          FROM uzivatel
                          INNER JOIN role ON role.id = uzivatel.id_role
                          WHERE role.kod = 'recenzent';"; 
        $result_recenzent = mysqli_query($conn, $sql_recenzent);

        // Redaktoři
        $sql_redaktor = "SELECT jmeno, prijmeni, login, email, role.nazev as role_nazev
                          FROM uzivatel
                          INNER JOIN role ON role.id = uzivatel.id_role
                          WHERE role.kod = 'redaktor';"; 
        $result_redaktor = mysqli_query($conn, $sql_redaktor);
    ?>

    <section>
      <div class="container">
        <h1>Šéfredaktor</h1>

        <!-- Přiřazení recenzentů -->
        <div class="autor-obsah">
            <h3>Články vyžadující reakci</h3>

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
                  if (mysqli_num_rows($result_clanky) > 0) {
                      while ($row = mysqli_fetch_array($result_clanky)) {
                            ?>
                            <tr>
                                <td><a href="./pdf/<?php echo $row['soubor'] ?>"><?php echo $row["clanek_nazev"]; ?></a></td>
                                <td><?php echo $row["autor_jmeno"]." ".$row["autor_prijmeni"]; ?></td>
                                <td><?php echo $row["tema"]; ?></td>
                                <td><?php echo $row["datum"]; ?></td>
                                <td><?php echo $row["stav_nazev"]; ?></td>
                                <td><?php echo $row["recenzent_jmeno"]." ".$row["recenzent_prijmeni"]; ?></td>
                                <td><?php echo $row["recenzent2_jmeno"]." ".$row["recenzent2_prijmeni"]; ?></td>
                                <td>
                                  <a href="clanek_prijato.php?clanekId=<?php echo $row['id']; ?>">Přijmout</a><br>
                                  <a href="clanek_zamitnuto.php?clanekId=<?php echo $row['id']; ?>">Zamítnout</a><br>
                                  <a href="clanek_vraceno.php?clanekId=<?php echo $row['id']; ?>">Vrátit</a>
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
            <h3>Přehled článků a jejich stavů</h3>

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
                  if (mysqli_num_rows($result_clanky_prehled) > 0) {
                      while ($row = mysqli_fetch_array($result_clanky_prehled)) {
                            ?>
                            <tr>
                                <td><a href="./pdf/<?php echo $row['soubor'] ?>" target="blank"><?php echo $row["clanek_nazev"]; ?></a></td>
                                <td><?php echo $row["autor_jmeno"]." ".$row["autor_prijmeni"]; ?></td>
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
            <h3>Přehled Autorů</h3>
            <table>
                <tr>
                    <th>Jméno</th>
                    <th>Login</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Akce</th>
                </tr>
            <?php
                if (mysqli_num_rows($result_autor) > 0) {
                    while ($row = mysqli_fetch_array($result_autor)) {
            ?>
                        <tr>
                            <td><?php echo $row["jmeno"]." ".$row["prijmeni"]; ?></td>
                            <td><?php echo $row["login"]; ?></td>
                            <td><?php echo $row["email"]; ?></td>
                            <td><?php echo $row["role_nazev"]; ?></td>
                            <td>
                                <a href="mailto:<?php echo $row['email']; ?>">Informovat emailem</a>
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
            <h3>Přehled Recenzentů</h3>
            <table>
                <tr>
                    <th>Jméno</th>
                    <th>Login</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Akce</th>
                </tr>
            <?php
                if (mysqli_num_rows($result_recenzent) > 0) {
                    while ($row = mysqli_fetch_array($result_recenzent)) {
            ?>
                        <tr>
                            <td><?php echo $row["jmeno"]." ".$row["prijmeni"]; ?></td>
                            <td><?php echo $row["login"]; ?></td>
                            <td><?php echo $row["email"]; ?></td>
                            <td><?php echo $row["role_nazev"]; ?></td>
                            <td>
                                <a href="mailto:<?php echo $row['email']; ?>">Informovat emailem</a>
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
            <h3>Přehled Redaktorů</h3>
            <table>
                <tr>
                    <th>Jméno</th>
                    <th>Login</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Akce</th>
                </tr>
            <?php
                if (mysqli_num_rows($result_redaktor) > 0) {
                    while ($row = mysqli_fetch_array($result_redaktor)) {
            ?>
                        <tr>
                            <td><?php echo $row["jmeno"]." ".$row["prijmeni"]; ?></td>
                            <td><?php echo $row["login"]; ?></td>
                            <td><?php echo $row["email"]; ?></td>
                            <td><?php echo $row["role_nazev"]; ?></td>
                            <td>
                                <a href="mailto:<?php echo $row['email']; ?>">Informovat emailem</a>
                            </td>
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
