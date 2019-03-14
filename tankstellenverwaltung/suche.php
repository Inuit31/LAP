<?php
/**
 * Created by PhpStorm.
 * User: goran
 * Date: 07.04.2018
 * Time: 21:33
 */
?>

<!DOCTYPE HTML>
<html lang="de">
<head>
    <title>Kundensuche</title>
    <meta charset="utf-8">
</head>
<body>
<?php
?>
<main>
    <?php
    if(isset($_POST['search'])) {
        try {
            $kunde = $_POST['searchKunde'];
            $likeKunde = $kunde;
            $bindArray = array($likeKunde);

            $query = 'select * from kunde where kunde_id like ?';
            $stmt = GetStatement($con, $query, $bindArray);


            if($stmt->fetchColumn() != 0) {
                ?>
                <h2>Gesucht wurde nach: <?php echo $kunde ?></h2>
                <?php
                $selectKunde = 'select * from Kunde
                          where kunde_id like ?';

                $bindParam = array($kunde);
                $stmt = GetStatement($con, $selectKunde, $bindParam);


                    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {

                        $showKunde = 'select kunde_id as "Kundennummer", vorname as "Vorname",
                    nachname as "Nachname",
                    strasse as "Straße", plz as "PLZ", ort as "Ort",geburtsdatum as "Geburtsdatum"
                    from kunde
                    where kunde_id like "' . $row[0] . '" 
                    group by kunde_id
                     ';

                        $query = 'select sum(menge) as "Treibstoffverbrauch",sum(preis) as "Gesamtpreis"
                        from verbrauch where kunde_id = "' . $row[0] . '"';


                           echo '<br>';

                        $stmt = GetStatement($con, $showKunde, $bindParam);
                        PrintTable($con, $showKunde);



                        $stmt2 = GetStatement($con, $query);
                        PrintTable($con, $query);

                        break;
                    }
                }

            else {
                echo '<br>Der Kunde wurde nicht gefunden oder ungültige Eingabe!';
                echo '<h4>Bitte kurz warten. Die Seite wird neu geladen!</h4>';

                header("refresh: 4;");
            }
            ?>
            <?php

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } else {
        ?>
        <h2>Suche nach Kundennummer</h2>
        <form method="post">
            <div class="table">
                <div class="tr">
                    <div class="th">
                        <label for="rs">Kundennummer:</label>
                    </div>
                    <div class="td">
                        <input id="rs" type="text" name="searchKunde" required>
                    </div>
                </div>
                <div class="tr">
                    <div class="th">
                        <input type="submit" name="search" value="suchen">
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
