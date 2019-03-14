<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11.04.2018
 * Time: 11:42
 */
?>

<!DOCTYPE HTML>
<html lang="de">
<head>
    <title>Theaterstück löschen</title>
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
            $theater = $_POST['theater'];
            ?>
            <form method="post">
                <h2>Sind Sie sicher?</h2>
                <div class="table">
                    <div class="tr">
                        <div class="th">
                            <input type="submit" name="del_yes" value="Ja">
                            <input type="submit" name="del_no" value="Nein">
                            <input type="hidden" name="thea_id" value="<?php echo $theater ?>">
                        </div>
                    </div>
                </div>
            </form>
            <?php
        } catch (Exception $e) {

        }
    } else if (isset($_POST['del_yes'])) {
        try {
            $theaterID = $_POST['thea_id'];

            $bindParam = array($theaterID);

            ?>
            <h2>Theaterstück: "
                <?php
                $query = 'select * from drama where dra_id = ?';
                $stmt = GetStatement($con, $query, $bindParam);
                while($row = $stmt->fetch(PDO::FETCH_NUM)) {

                echo $row[1];
            }
                ?>
                " wurde efolgreich gelöscht!</h2>
            <?php

            $con->beginTransaction();



            $query = 'delete from drama where dra_id = ?';

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
        <form method="post">
            <div class="table">
                <div class="tr">
                    <div class="th">
                        <label for="ein">Bereits vorhandene Theaterstücke:</label>
                    </div>
                </div>

                <div class="tr">
                    <div class="td">
                        <?php
                        $query = 'select dra_id , dra_name as "Stückname" from drama order by dra_id';
                        $stmt = GetStatement($con, $query);
                        echo '<table class="table function-table">';
                            echo '<tr class="tr">';
                                for ($i = 0; $i < $stmt->columnCount(); $i++) {
                                echo '<th class="th">' . $stmt->getColumnMeta($i)['name'] . '</th>';
                                }
                                echo '</tr>';
                            while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
                            echo '<tr class="tr">';
                                foreach ($row as $r) {
                                echo '<td class="td">' . $r . '</td>';
                                }
                                echo '</tr>';
                            }?>
                    </div>
                </div>
                <h2>Wählen Sie das Theaterstück, das Sie löschen möchten:</h2>
                <div class="tr">
                    <div class="th">
                        <label for="gew">Theaterstück:</label>
                    </div>
                </div>

                <div class="tr">
                    <div class="td">
                        <select id="gew" name="theater">
                            <?php
                            $query = 'select * from drama order by dra_id';
                            $stmt = GetStatement($con, $query);  // Wegen diesem beschissenen $CON ?!!!
                            while($row = $stmt->fetch(PDO::FETCH_NUM))
                            {
                                echo '<option value="'.$row[0].'">'.$row[0];
                            }
                            ?>
                        </select>
                    </div>
                </div>
                    <div class="tr">
                        <div class="td">
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

