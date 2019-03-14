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
    if(isset($_POST['delete'])) {
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
    } else if (isset($_POST['del_yes'])) {
        try {
         
            $kunde_id = $_POST['kun_id'];

            $bindParam = array($kunde_id);
            ?>
            <h2>Der Kunde: "
                <?php
                $query = 'select * from kunde where kunde_id = ?';
                $bindName = array($kunde_id);
                $stmt3 = GetStatement($con, $query, $bindName);
                while($row = $stmt3->fetch(PDO::FETCH_NUM)) {
                    echo $row[1];
                }
                ?>
            " wurde efolgreich gelöscht!</h2>
            <?php

            $con->beginTransaction();

            $query = 'delete from kunde where kunde_id = ?;';
            $stmt = GetStatement($con, $query, $bindParam);

            $con->commit();

            echo '<h4>Bitte kurz warten. Die Seite wird neu geladen!</h4>';

            header("refresh: 4;");

        } catch (Exception $e) {
            $e->getMessage();
            $con->rollBack();
        }
    } else if(isset($_POST['del_no'])) {

        echo '<br>Es wurden keine Daten gelöscht!';
        echo '<h4>Bitte kurz warten. Die Seite wird neu geladen!</h4>';

        header("refresh: 4;");

    } else {
        ?>
        <h2>Bereits registrierte Kunden löschen</h2>
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
                <h2>Wählen Sie den Kunden, den Sie löschen möchten:</h2>
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
                        <input type="submit" name="delete" value="Löschen">
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

