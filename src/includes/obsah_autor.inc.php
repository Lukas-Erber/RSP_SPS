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
                                <input type="text" name="nazev" id="jmeno_souboru" placeholder="Název článku" required="">
                                <select name="tema" required>
                                    <option>1/2023: Technika</option>
                                    <option>2/2023: Příroda</option>
                                    <option>3/2023: Finance</option>
                                    <option>4/2023: Společenské vědy</option>
                                </select>
                                <input type="text" name="autori" id="" placeholder="Autoři">
                                <input type="file" name="soubor" id="" required="">
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
                    clanek.spoluautori, stav.nazev AS stav_slovy, recenzent1.jmeno as recenzent_jmeno, recenzent1.prijmeni as recenzent_prijmeni, recenzent2.jmeno as recenzent2_jmeno, recenzent2.prijmeni as recenzent2_prijmeni, recenze1.aktualnost as r1_hod1, recenze1.zajimavost as r1_hod2, recenze1.prinosnost as r1_hod3, recenze1.originalita as r1_hod4, recenze1.odborna_uroven as r1_hod5, recenze1.jazykova_uroven as r1_hod6, recenze1.text as r1_text, recenze2.aktualnost as r2_hod1, recenze2.zajimavost as r2_hod2, recenze2.prinosnost as r2_hod3, recenze2.originalita as r2_hod4, recenze2.odborna_uroven as r2_hod5, recenze2.jazykova_uroven as r2_hod6, recenze2.text as r2_text
                    FROM clanek
                    LEFT JOIN stav ON clanek.id_stav = stav.id
                    LEFT JOIN uzivatel AS recenzent1 ON recenzent1.id = clanek.id_recenzent  
                    LEFT JOIN uzivatel AS recenzent2 ON recenzent2.id = clanek.id_recenzent2
                    LEFT JOIN posudek as recenze1 ON recenze1.id_clanek = clanek.id AND recenze1.id_uzivatel = recenzent1.id
                    LEFT JOIN posudek as recenze2 ON recenze2.id_clanek = clanek.id AND recenze2.id_uzivatel = recenzent2.id
                    WHERE id_autor = $promenna 
                    ORDER BY clanek.id DESC;";

            $result = $conn->query($sql);

            if ($result->num_rows >0){
                echo "<table class=tabulka > <tr> 
                                        <td> Název              </td>
                                        <td> Téma               </td>
                                        <td> Datum vložení      </td>
                                        <td> Stav               </td>
                                        <td> Spoluautoři        </td> 
                                        <td> Recenzent1         </td> 
                                        <td> Recenzent2         </td> 
                              </tr>";
                while ($row = $result->fetch_assoc()){

                    echo "<tr><td><a href='./pdf/".$row["soubor"]."'>" . $row["nazev"] ."</a></td> <td> " .$row["tema"]. " </td> 
                           <td> ".$row["datum"]. " </td> <td> ".$row["stav_slovy"]. " </td> <td> ".$row["spoluautori"]."</td><td><a class='rec' data-toggle='modal' data-target='#recenzeModal' data-hod1='".$row["r1_hod1"]."' data-hod2='".$row["r1_hod2"]."' data-hod3='".$row["r1_hod3"]."' data-hod4='".$row["r1_hod4"]."' data-hod5='".$row["r1_hod5"]."' data-hod6='".$row["r1_hod6"]."' data-text='".$row["r1_text"]."'>".$row["recenzent_jmeno"]." ".$row["recenzent_prijmeni"]."</a></td><td><a class='rec' data-toggle='modal' data-target='#recenzeModal' data-hod1='".$row["r2_hod1"]."' data-hod2='".$row["r2_hod2"]."' data-hod3='".$row["r2_hod3"]."' data-hod4='".$row["r2_hod4"]."' data-hod5='".$row["r2_hod5"]."' data-hod6='".$row["r2_hod6"]."' data-text='".$row["r2_text"]."'>".$row["recenzent2_jmeno"]." ".$row["recenzent2_prijmeni"]."</a></td></tr>";
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
