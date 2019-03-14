<?php
if(isset($_POST['save'])) {
    try {
        $isbn = $_POST['isbn'];
        $autor = $_POST['autor'];
        $kategorie = $_POST['kategorie'];
        $verlag = $_POST['verlag'];
        $titel = $_POST['titel'];
        $kdesc = $_POST['kdesc'];
        $year = $_POST['year'];
        
        $con->beginTransaction();
        $query = 'insert into Buch(buc_ISBN, aut_id, kat_id,ver_id, buch_titel, buch_kurzbeschreibung, buch_erscheinungsjahr) 
        values(?, ?, ?, ?, ?, ?, ?)';

        $bindArray = array($isbn, $autor, $kategorie, $verlag, $titel,$kdesc, $year);

        
        GetStatement($con, $query, $bindArray);

        echo '<h2>Der Vorgang wird gestartet. Die Seite wird in kürze neu geladen!';

        $con->commit();    // Damit der Wert gespeichert bleibt in der Datenbank!
         header('refresh: 5;');

        $queryTable =
            'select buc_isbn as "ISBN", buch_titel as "Titel",buch_kurzbeschreibung as
            "Kurzbeschreibung", buch_erscheinungsjahr as "Erscheinungsjahr",
            kat_name as "Kategorie", concat(aut_vorname, " ", aut_nachname) as "Autor",
            ver_name as "Verlag"
            from buch 
            inner join kategorie on buch.kat_id = kategorie.kat_id
            inner join verlag on buch.ver_id = verlag.ver_id
            inner join autor on buch.aut_id = autor.aut_id';
            PrintTable($con, $queryTable);


    }  catch (Exception $e)
    {
        $code = $e->getCode();
        if($code == 23000)
        {
            echo "<br>Die Buchnummer existiert bereits!";
            echo "<br>Die Seite wird neu geladen!";
            header('refresh: 5;');
        } else
        {
            echo '<h2>Fehler: Der Kunde konnte nicht erfasst werden!</h2>';
        }
        $con->rollBack();
    }
} else {
  //try { 
        ?>
        <h2>Neues Buch erfassen</h2>
        <form method="post">
            <div class="table">
                <div class="tr">
                    <div class="th">
                        <label for="titeld">ISBN:</label>
                    </div>
                    <div class="td">
                        <input id="titel" type="text" name="isbn" required>
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
                                    $query = 'select * from autor';
                                    //$stmt = $con->prepare($query);
                                    //$stmt->execute();
                                   $stmt = GetStatement($con, $query);
                                    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
                                        echo '<option value="' . $row[0] . '">' . $row[1]." ".$row[2];
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
                            <label for="wert">Kategorie:</label>
                        </div>

                        <div class="td">
                            <!-- RICHTIGEN WERT FÜR NAME-ATTRIBUT VERGEBEN (AUCH FÜR ID, FALLS NOTWENDIG) -->
                            <select id="au" name="kategorie">
                                <?php
                                try {
                                    $query = 'select * from kategorie';
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
                            <label for="wert">Verlag:</label>
                        </div>
                        <div class="td">
                            <!-- RICHTIGEN WERT FÜR NAME-ATTRIBUT VERGEBEN (AUCH FÜR ID, FALLS NOTWENDIG) -->
                            <select id="au" name="verlag">
                                <?php
                                try {
                                    $query = 'select * from verlag';
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
                        <label for="titeld">Titel:</label>
                    </div>
                    <div class="td">
                        <input id="titel" type="text" name="titel" required>
                    </div>
                </div>
                <div class="tr">
                    <div class="th">
                        <label for="titeld">Kurzbeschreibung:</label>
                    </div>
                    <div class="td">
                        <input id="titel" type="text" name="kdesc" required>
                    </div>
                </div>
                <div class="tr">
                    <div class="th">
                        <label for="titeld">Erscheinungsjahr:</label>
                    </div>
                    <div class="td">
                        <input id="titel" type="date" name="year" required>
                    </div>
                </div>
                </div>
                <br>
                <div class="tr">
                    <div class="th">
                        <input type="submit" name="save" class="btn btn-primary btn-md" value="speichern">
                        <input type="reset"  class="btn btn-primary btn-md" value="leeren">
                    </div>
                </div>
            </div>
        </form>
        <?php
    }
//    catch(Exception $e)
  //  {


//    }
 