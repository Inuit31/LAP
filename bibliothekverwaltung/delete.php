<?php
?>

<!DOCTYPE HTML>
<html lang="de">
<head>
    <title>Buch löschen</title>
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
    } else if (isset($_POST['del_yes'])) {
        try {
         
            $buch = $_POST['buch_id'];

            $bindParam = array($buch);
            ?>
            <h2>Der Kunde: "
                <?php
                $query = 'select * from buch where buc_isbn = ?';
                $bindName = array($buch);
                $stmt3 = GetStatement($con, $query, $bindName);
                while($row = $stmt3->fetch(PDO::FETCH_NUM)) {
                    echo $row[4];
                }
                ?>
            " wurde efolgreich gelöscht!</h2>
            <?php

            $con->beginTransaction();

            $query = 'delete from buch where buc_isbn = ?;';
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

      //  header("refresh: 4;");

    } else {
        ?>
        <h2>Bereits registrierte Bücher löschen</h2>
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
                        $showBuch = 'select buc_ISBN as "ISBN", buch_titel as "Titel"
                         from Buch';
                        PrintTable($con, $showBuch);
                        ?>
                    </div>
                </div>
                <br><hr>
                <h2>Wählen Sie das Buch, das Sie löschen möchten:</h2>
                <div class="tr">
                    <div class="th">
                        <label for="kun">Buch:</label>
                    </div>
                </div>
                <div class="tr">
                    <div class="td">
                        <select id="kun" name="buch">
                            <?php
                            $query = 'select * from buch order by buc_isbn desc';
                            $stmt = GetStatement($con, $query);
                            while($row = $stmt->fetch(PDO::FETCH_NUM))
                            {
                                echo '<option value="'.$row[0].'">'.$row[0]." | ".$row[4];
                            }
                            ?>
                        </select>
                        <input type="submit" name="delete"class="btn btn-primary btn-md" value="Löschen">
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

