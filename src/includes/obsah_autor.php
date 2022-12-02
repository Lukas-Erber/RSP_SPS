
</div>
<!--toto stáhne šablonu :) -->
<div>
    <h3>šablona pro autora ke stažení</h3>
    <br>
    <a href="./sablony/sablona_SPS.docx"> <i class=" fa-sharp fa-solid fa-file-word"></i></a>

</div>

<section>
    <div class="container">

        <div class="article-table">
            <div class="head-article">

                <button type="button" class="btn-add-article" data-toggle="modal" data-target="#myModal">Přidat článek</button>
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
</section>
<section>
    <div class="container">
        <div>
            <h3>
                seznam článků publikovaných autorem:
                <?php
                $sql= "SELECT id, id_stav, tema, datum, nazev,"
                ?>

            </h3>
            <?php
            require "dbconn.inc.php";
            $promenna = $_SESSION["uzivatel_id"];

            $sql= "SELECT id, id_stav, tema, datum, nazev, soubor, spoluautori
FROM clanek  WHERE id_autor = $promenna ORDER BY id DESC " ;

            $result = $conn->query($sql);
            $status = 0;
            echo $status;
            if ($result->num_rows >0){
                echo "<table class='content-table'> <tr> 
                                        <td> ID článku          </td>
                                        <td> Název              </td>
                                        <td> Téma               </td>
                                        <td> Datum vložení      </td>
                                        <td> Stav               </td>
                                        <td> Spoluautoři        </td>                  
                              </tr>";
                while ($row = $result->fetch_assoc()){



                    //if()
                    // echo " id článku: " . $row["id"]. " Název: " . $row["nazev"];
                    echo " <tr> <td>". $row["id"]  . " </td> <td> " . $row["nazev"] ." </td> <td> " .$row["tema"]. " </td> 
                           <td> ".$row["datum"]. " </td> <td> ".$row["stav"]. " </td> <td> ".$row["spoluautori"]."</tr>" ;
                    // echo " <tr> <td>". $row["id"]  . " </td> <td> " . $row["nazev"] ." </td> <td> " .$row["tema"]. " </td> 
                    //        <td> ".$row["datum"]. " </td> <td> ".$row["spoluautori"]."</td></tr>" ;
                }
                echo "</table>";


            }
            else{
                echo "zatím nemáte žádný článek";
            }

            $conn->close();
            ?>

        </div>


    </div>

</section>



