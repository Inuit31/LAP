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
            $book = $_POST['searchBook'];
            $likeBook = $book;
            $bindArray = array($likeBook);

            $query = 'select * from buch where buc_ISBN like ?';
            $stmt = GetStatement($con, $query, $bindArray);

               if($stmt->fetchColumn() != 0) {
                ?>
                <h2>Gesucht wurde nach: <?php echo $book ?></h2>
                <?php
                $selectBook = 'select * from buch
                          where buc_ISBN like ?';

                $bindParam = array($book);
                $stmt = GetStatement($con, $selectBook, $bindParam);


                    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {

                        $showBook = 'select buc_isbn as "ISBN", buch_titel as "Titel",
                        kat_name as "Kategorie", concat(aut_vorname, " ", aut_nachname) as "Autor",
                        ver_name as "Verlag"
                        from buch 
                        inner join kategorie on buch.kat_id = kategorie.kat_id
                        inner join verlag on buch.ver_id = verlag.ver_id
                        inner join autor on buch.aut_id = autor.aut_id
                        where buc_isbn like "' . $row[0] . '" 
                        group by buc_isbn';
                        echo '<br>';


                        $stmt = GetStatement($con, $showBook);
                        PrintTable($con, $showBook);
                        break;
                    }
                }
            else {
                echo '<br>Informationen zum Buch wurden nicht gefunden oder ungültige Eingabe!';
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
        <h2>Suche nach Buchnummer</h2>
        <form method="post">
            <div class="table">
                <div class="tr">
                    <div class="th">
                        <label for="rs">Buchnummer:</label>
                    </div>
                    <div class="td">
                        <input id="rs" type="text" name="searchBook" required>
                    </div>
                </div>
                <br>
                <div class="tr">
                    <div class="th">
                        <input type="submit" name="search" class="btn btn-primary btn-md" value="suchen">
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
