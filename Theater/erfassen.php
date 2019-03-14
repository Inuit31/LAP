
    <?php
  //  include'config.php';
    if(isset($_POST['save'])) {
        try {

            $titel= $_POST['titel'];
            $autor = $_POST['autor'];
            $genre = $_POST['genre'];
            $erst = $_POST['erst'];


            echo 'Folgende Daten werden gespeichert:
             <br> '.$titel. '|'.$autor .'|' .$genre.'|'.$erst.' | <br>';

            $con->beginTransaction();

            $query1 = 'insert into drama(dra_name, gen_id, autor_id ) values(?, ?, ?)';

            //$bindArray = array($titel, $autor, $genre, $erst);
            $bindArray = array($titel, $genre, $autor);
            GetStatement($con, $query1, $bindArray);
            $theaterID = $con->lastInsertId();

            $con->commit();
         //   $theaterID = $con->GetLastInsertID(); //
            
        /* TO DO : insert into dramaevent ... */
            $con->beginTransaction();
            $query = 'insert into dramaevent(eve_id, eve_termin, dra_id) VALUES ('.$theaterID.', ?)';
            $bindArray1 = array($erst);
            GetStatement($con, $query, $bindArray1);
            
            $queryTable = 'select dra_id "Nr", gen_name as "Genre",dra_name as "Name des Stücks", concat_ws(" ", per_vname, per_nName) as "Autor"
            , eve_termin as "Erstaufführung" 
            from drama 
            LEFT JOIN Genre USING (gen_id)
            LEFT JOIN dramaevent using (dra_id)
            LEFT join crew using (eve_id)
            LEFT join person on drama.autor_id = person.per_id
            LEFT JOIN rolle using (rol_id)
            GROUP by dra_id';
           showTable($con, $queryTable);  
           $eingetragen = mysql_query($query); 
            //$con->lastInsertId();
            $con->commit();

        } catch (Exception $e)
        {
            $code = $e->getCode();

            if($code == 23000)
            {
                echo "<br>Das Theater Stück existiert bereits";
              //  header('refresh: 4;');
            }
            else {

                echo '<h2>Fehler: Das Theaterstück konnte nicht gespeichert werden!</h2>';
            }
           //$con->rollBack();
           
        }

    } else {
            ?>
            <h2>Theaterstück erfassen</h2>
            <form method="post">
                <div class="table">
                    <!-- CODE FÜR LABEL + INPUT-FELDER -->
                    <div class="tr">
                        <div class="th">
                            <label for="titeld">Titel des Stücks:</label>
                        </div>
                        <div class="td">
                            <input id="titel" type="text" name="titel" required placeholder="z.B Faust">
                        </div>
                    </div>
                    <!-- CODE FÜR DROPDOWN-FELD -->
                    <div class="tr">
                        <div class="th">
                            <!-- WERT FÜR FOR VERGEBEN -->
                            <label for="wert">Autor:</label>
                        </div>

                        <div class="td">
                            <!-- RICHTIGEN WERT FÜR NAME-ATTRIBUT VERGEBEN (AUCH FÜR ID, FALLS NOTWENDIG) -->
                            <select id="au" name="autor">
                                <?php
                                try {
                                    $query = 'select * from Person where rol_id = 4';
                                    //$stmt = $con->prepare($query);
                                    //$stmt->execute();
                                    $stmt = GetStatement($con, $query);
                                    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
                                        echo '<option value="' . $row[0] . '">' . $row[1];
                                        //echo '<option>bla';
                                    }
                                } catch (Exception $e) {
                                    echo $e->getMessage();
                                }

                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="tr">
                        <div class="th">
                            <!-- WERT FÜR FOR VERGEBEN -->
                            <label for="wert">Genre:</label>
                        </div>
                        <div class="td">
                            <!-- RICHTIGEN WERT FÜR NAME-ATTRIBUT VERGEBEN (AUCH FÜR ID, FALLS NOTWENDIG) -->
                            <select id="Ge" name="genre">
                                <?php
                                $query1 = 'select gen_id, gen_name
                                from Genre';
                                //$stmt = $con->prepare($query1);
                                //$stmt->execute();
                                $stmt = GetStatement($con, $query1);
                                while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
                                    echo '<option value="' . $row[0] . '">' . $row[1];
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="tr">
                        <div class="th">
                            <label for="geb">Erstaufführung am:</label>
                        </div>
                        <div class="td">
                            <input type="date" input id="datum" type="text" name="erst" min="1900-01-01" required>
                        </div>
                    </div>

                    <!-- CODE FÜR INPUT-FELDER
                    NICHT VERGESSEN FÜR DIE ATTRIBUTE DIE RICHTIGEN WERTE ZU VERGEBEN-->

                    <!-- CODE FÜR SUBMIT-BUTTON -->
                    <div class="tr">
                        <div class="th">
                            <input type="submit" name="save" value="speichern">
                        </div>
                    </div>

                </div>
            </form>
            <?php
    }
    ?>
