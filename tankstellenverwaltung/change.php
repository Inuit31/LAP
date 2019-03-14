<?php
?>
<!DOCTYPE HTML>
<html lang="de">
<head>
    <title>Kunde ändern</title>
    <meta charset="utf-8">
</head>
<body>
<?php
?>
<nav>
</nav>
<main>
    <?php
    if(isset($_POST['change'])) {
        try {
            $kunde = $_POST['kunde'];
            ?>
            <form method="post">
                <h2>Sind Sie sicher?</h2>
                <div class="table">
                    <div class="tr">
                        <div class="th">
                            <input type="submit" name="del_yes" value="Ja">
                            <input type="submit" name="del_no" value="Nein">
                            <input type="hidden" name="kun_id" value="<?php echo $kunde ?>">
                        </div>
                    </div>
                </div>
            </form>
            <?php
        } catch (Exception $e) {

        }
    } elseif (isset($_POST['del_yes'])) {
        try {
         
            $kunde_id = $_POST['kun_id'];

            $bindParam = array($kunde_id);
            ?>
            <?php
            echo 'kundennummer'.$kunde_id;
            ?>
        <h1>Kundendaten ändern</h1>
        <form method="post">
            <div class="table">
                <div class="tr">
                    <div class="th">
                        <label for="bst">Kundennummer:</label>
                    </div>
                    <div class="td">
                        <?php
                        echo $kunde_id;
                        //Bestellnummer speichern da beim erneuten Senden die Bestellnummer verloren geht
                        echo '<input type="hidden" name="kun_id" value="'.$kunde_id.'">';
                        ?>
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
        }  catch (Exception $e) {
            $e->getMessage();
            $con->rollBack();
        }
    
    }
        elseif (isset($_POST['save'])) {
        try 
        {
            $kunde_id = $_POST['kun_id'];
            $vname = $_POST['vn'];
            $nname = $_POST['nn'];
            $strasse = $_POST['strasse'];
            $ort = $_POST['ort'];
            $plz = $_POST['plz'];
            $geb = $_POST['bday'];
            
            $con->beginTransaction();

            $query = 'UPDATE kunde SET vorname = ?, nachname = ?, geburtsdatum = ?,
            strasse = ?, plz = ?, ort = ?  
            WHERE kunde_id = '.$kunde_id.'';



            $bindArray = array($vname, $nname, $geb, $strasse, $plz, $ort);                           
            

            $queryListe = 'select * from kunde';
            $stmt = GetStatement($con, $query, $bindArray);

           // $stmt->execute();

            $con->commit();
        
            /*
			$stmt->bindParam(1, $vorname);
			$stmt->bindParam(2, $nachname);
			$stmt->bindParam(3, $strasse);
            $stmt->bindParam(4, $ort);
            $stmt->bindParam(5, $plz);
            $stmt->bindParam(6, $ort);
			$stmt->execute();
			$con->commit();
            */

/*
            echo $kunde_id;
            echo $vname;
            echo $nname;
            echo $strasse;
            echo $ort;
            echo $plz;
            echo $geb;
            
*/
            echo '<h2>Die Kundendaten wurden geändert!<br></h2>';



            showTable($con, $queryListe, $bindArray);

           
        }
         catch (Exception $e) {
            $e->getMessage();
           $con->rollBack();
        }
    }
     elseif(isset($_POST['del_no'])) {

        echo '<h4>Bitte kurz warten. Die Seite wird neu geladen!</h4>';

        header("refresh: 4;");

    } else {
        ?>
        <h2>Kunden bearbeiten</h2>
        <form method="post">
            <div class="table">
                <div class="tr">
                    <div class="th">
                        <label for="ein">Bereits vorhandene Kunden:</label>
                    </div>
                </div>
                <div class="tr">
                    <div class="td">
                        <?php
                        $showKunde = 'select kunde_id as "Kunde ID", concat (vorname," ", nachname) as "Name"
                         from Kunde';
                        PrintTable($con, $showKunde);
                        ?>
                    </div>
                </div>
                <br><hr>
                <h2>Wählen Sie den Kunden, den Sie bearbeiten möchten:</h2>
                <div class="tr">
                    <div class="th">
                        <label for="kun">Kunde:</label>
                    </div>
                </div>
                <div class="tr">
                    <div class="td">
                        <select id="kun" name="kunde">
                            <?php
                            $query = 'select * from kunde order by kunde_id desc';
                            $stmt = GetStatement($con, $query);
                            while($row = $stmt->fetch(PDO::FETCH_NUM))
                            {
                                echo '<option value="'.$row[0].'">'.$row[0]." | ".$row[1]." ".$row[2];
                            }
                            ?>
                        </select>
                        <input type="submit" name="change" value="Ändern">
                    </div>
                </div>
            </div>
        </form>
        <?php
    }
    ?>
</main>
</body>
</html>

