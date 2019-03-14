<?php
if(isset($_POST['save'])) {
    try {
        $kundennummer = $_POST['knummer'];
        $vname = $_POST['vn'];
        $nname = $_POST['nn'];
        $strasse = $_POST['strasse'];
        $ort = $_POST['ort'];
        $plz = $_POST['plz'];
        $geb = $_POST['bday'];

        $con->beginTransaction();

        $query = 'insert into kunde(kunde_id, vorname, nachname,strasse, ort, plz, geburtsdatum) 
        values(?, ?, ?, ?, ?, ?, ?)';

        $bindArray = array($kundennummer, $vname, $nname, $strasse, $ort, $plz, $geb);

        GetStatement($con, $query, $bindArray);

        echo '<h2>Die Daten wurden erfolgreich gespeichert!</h2>';
        $con->commit();
    } catch (Exception $e)
    {
        $code = $e->getCode();
            //echo '<h2>OO Bad Bunny</h2>';
        if($code == 23000)
        {
            echo "<br>Die Kundennummer existiert bereits!";
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
        <h2>Neuen Kunden erfassen</h2>
        <form method="post">
            <div class="table">
                <div class="tr">
                    <div class="th">
                        <label for="titeld">Kundennummer:</label>
                    </div>
                    <div class="td">
                        <input id="titel" type="text" name="knummer" required>
                    </div>
                </div>
                <div class="tr">
                    <div class="th">
                        <label for="titeld">Vorname:</label>
                    </div>
                    <div class="td">
                        <input id="titel" type="text" name="vn" required>
                    </div>
                </div>
                <div class="tr">
                    <div class="th">
                        <label for="titeld">Nachname:</label>
                    </div>
                    <div class="td">
                        <input id="titel" type="text" name="nn" required>
                    </div>
                </div>
                <div class="tr">
                    <div class="th">
                        <label for="titeld">Strasse:</label>
                    </div>
                    <div class="td">
                        <input id="titel" type="text" name="strasse" required>
                    </div>
                </div>
                <div class="tr">
                    <div class="th">
                        <label for="titeld">Ort:</label>
                    </div>
                    <div class="td">
                        <input id="titel" type="text" name="ort" required>
                    </div>
                </div>
                <div class="tr">
                    <div class="th">
                        <label for="titeld">PLZ:</label>
                    </div>
                    <div class="td">
                        <input id="titel" type="text" name="plz" required>
                    </div>
                </div>
                <div>
                    <label for="bday">Geburtsdatum:</label>
                    <input type="date" id="bday" name="bday">
                </div>
                <br>
                <div class="tr">
                    <div class="th">
                        <input type="submit" name="save" value="speichern">
                    </div>
                </div>

            </div>
        </form>
        <?php
    }
//    catch(Exception $e)
  //  {


//    }
 