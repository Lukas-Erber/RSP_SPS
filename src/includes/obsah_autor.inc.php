<section class="obsah-autor">
    <div class="sablona-pridat">
    
        <!--toto stáhne šablonu :) -->
        <div class="sablona">   
            <h3>Šablona ke stažení</h3>
            <a href="./sablony/sablona_SPS.docx"> <i class=" fa-sharp fa-solid fa-file-word"></i></a>
        </div>

        <div class="pridani">
            <h3>Přidat článek</h3>
            <div class="head-article">
                <button type="button" class="btn-add-article" data-toggle="modal" data-target="#myModal"><i class="fa-solid fa-newspaper"></i></button>
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
        </div>
    </div>

    <div class="autor-obsah">
        <h3>Seznam článků publikovaných autorem:</h3>
        
        <?php
            require "dbconn.inc.php";
            $promenna = $_SESSION["uzivatel_id"];

            $sql = "SELECT clanek.id, clanek.id_stav, clanek.tema, clanek.datum, clanek.nazev, clanek.soubor,
                    clanek.spoluautori, stav.nazev AS stav_slovy
                    FROM clanek
                    LEFT JOIN stav ON clanek.id_stav = stav.id
                    WHERE id_autor = $promenna 
                    ORDER BY id DESC;";

            $result = $conn->query($sql);

            if ($result->num_rows >0){
                echo "<table class=tabulka > <tr> 
                                        <td> ID článku          </td>
                                        <td> Název              </td>
                                        <td> Téma               </td>
                                        <td> Datum vložení      </td>
                                        <td> Stav               </td>
                                        <td> Spoluautoři        </td>                  
                              </tr>";
                while ($row = $result->fetch_assoc()){

                    echo " <tr > <td>". $row["id"]  . " </td> <td> " . $row["nazev"] ." </td> <td> " .$row["tema"]. " </td> 
                           <td> ".$row["datum"]. " </td> <td> ".$row["stav_slovy"]. " </td> <td> ".$row["spoluautori"]."</tr>" ;
                }
                echo "</table>";

            }
            else{
                echo "zatím nemáte žádný článek";
            }

            $conn->close();
        ?>
    </div>
</section>
