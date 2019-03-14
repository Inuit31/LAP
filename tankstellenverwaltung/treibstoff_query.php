<?php
?>
<!DOCTYPE HTML>
<html lang="de">
<head>
    <title>Kunde anzeigen</title>
    <meta charset="utf-8">
</head>
<body>
<?php
?>
<nav>
</nav>
<main>
    <?php
    if(isset($_POST['show'])) {
        try {

            $kunde = $_POST['kunde'];
           // $con->beginTransaction();
            $queryTreibstoff = 'select concat(vorname, " ", nachname) as "Name", Bezeichnung as "Treibstoff"
            from Verbrauch 
            inner join Treibstoff on treibstoff.treibstoff_id = Verbrauch.treibstoff_id
            inner join Kunde on kunde.kunde_id = Verbrauch.kunde_id
            where kunde.kunde_id = '.$kunde.''
            ;

            ShowTable($con, $queryTreibstoff);

        }  catch (Exception $e) {
            $e->getMessage();
           // $con->rollBack();
        }
    } else {
        ?>
        <h2>Welcher Kunde benutzt welchen Treibstoff</h2>
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
                <h2>Wählen Sie den Kunden, den Sie anzeigen möchten:</h2>
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
                        <input type="submit" name="show" value="anzeigen">
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

