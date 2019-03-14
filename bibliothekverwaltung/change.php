<?php
?>
<!DOCTYPE HTML>
<html lang="de">
<head>
    <title>Buch ändern</title>
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
            $buch = $_POST['buch'];
            ?>
            <form method="post">
                <h2>Sind Sie sicher?</h2>
                <div class="table">
                    <div class="tr">
                        <div class="th">
                            <input type="submit" name="del_yes" value="Ja">
                            <input type="submit" name="del_no" value="Nein">
                            <input type="hidden" name="buch_id" value="<?php echo $buch ?>">
                        </div>
                    </div>
                </div>
            </form>
            <?php
        } catch (Exception $e) {

        }
    } elseif (isset($_POST['del_yes'])) {
        try {
         
            $buch_id = $_POST['buch_id'];

            $bindParam = array($buch_id);
            ?>
            
        <h1>Datensätze der Lektüre ändern</h1>
        <form method="post">
            <div class="table">
                <div class="tr">
                    <div class="th">
                        <label for="bst">Buchnummer:</label>
                    </div>
                    <div class="td">
                        <?php
                        echo $buch_id;
                        //Bestellnummer speichern da beim erneuten Senden die Bestellnummer verloren geht
                        echo '<input type="hidden" name="buch_id" value="'.$buch_id.'">';
                        ?>
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
                        <label for="titeld">Erscheiungsjahr:</label>
                    </div>
                    <div class="td">
                        <input id="titel" type="date" name="year" required>
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
        }  catch (Exception $e) {
            $e->getMessage();
            $con->rollBack();
        }
    
    }
        elseif (isset($_POST['save'])) {
        try 
        {
            $buch_id = $_POST['buch_id'];
            $titel = $_POST['titel'];
            $kdesc = $_POST['kdesc'];
            $year = $_POST['year'];
            
            echo '<h2>Der Vorgang startet!</h2>';
    
            $con->beginTransaction();
            $queryBuch = 'UPDATE buch SET buch_titel =?,buch_kurzbeschreibung =?, buch_erscheinungsjahr =?
            WHERE buc_ISBN = '.$buch_id.'';
            $bindArray = array($titel, $kdesc, $year);                           
            
            $stmt = GetStatement($con, $queryBuch, $bindArray); 
           // $stmt->execute();
           
  

// Alternativ



         //   $con->commit();
            echo '<h2>Die Datensätze der Lektüre wurden erfolgreich geändert!<br></h2>';
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
        
        
        }catch (Exception $e) {
            $e->getMessage();
           $con->rollBack();
        }
    }
     elseif(isset($_POST['del_no'])) {

        echo '<h4>Bitte kurz warten. Die Seite wird neu geladen!</h4>';

        header("refresh: 4;");

    } else {
        ?>
        <h2>Bibliothek bearbeiten</h2>
        <form method="post">
            <div class="table">
                <div class="tr">
                    <div class="th">
                        <label for="ein">Bereits vorhandene Bücher:</label>
                    </div>
                </div>
                <div class="tr">
                    <div class="td">
                        <?php
                        $showKunde = 'select buc_ISBN as "ISBN", buch_titel as "Titel"
                         from Buch';
                        PrintTable($con, $showKunde);
                        ?>
                    </div>
                </div>
                <br><hr>
                <h2>Wählen Sie die Lektüre, die Sie bearbeiten möchten:</h2>
                <div class="tr">
                    <div class="th">
                        <label for="kun">Buch:</label>
                    </div>
                </div>
                <div class="tr">
                    <div class="td">
                        <select id="kun" name="buch">
                            <?php
                            $query = 'select * from buch order by buc_ISBN desc';
                            $stmt = GetStatement($con, $query);
                            while($row = $stmt->fetch(PDO::FETCH_NUM))
                            {
                                echo '<option value="'.$row[0].'">'.$row[0]." | $row[4]";
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

