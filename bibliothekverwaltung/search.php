<?php
/**
 * Created by PhpStorm.
 * User: Salchegger Robert
 * Date: 17.01.2019
 * Time: 08:08
 */





if(isset($_POST['search']))
{
    echo '<h2>Nach Buchnummer suchen</h2>';
    try {
        $number = $_POST['number'];
        echo '<h4>Gesucht wurde nach: '.$number.'</h4>';
        $query = 'select * from buch where buc_isbn like ?';
        $number = $number.'%';
        $numarray = array($number);
        //$stmt = $con->GetStatement($query, $namearray);
        $stmt = GetStatement($con, $query, $numarray);
        $count = $stmt->rowCount();

        if($count == null) throw new Exception('<h4>Die Suchanfrage brachte keine Ergebnisse</h4>');
        ?>

        <form method="post">
            <div class="table">
                <div class="tr">
                    <div class="th">
                        <label for="suche">Ergebnisliste der Suche:</label>
                    </div>
                    <div class="td">

                        <select name="buch_id">
                        <?php

                        while($row = $stmt->fetch(PDO::FETCH_NUM))
                        {
                            echo '<option value="'.$row[0].'">'.$row[0]."|".$row[4];
                        }
                        ?>
                        </select>

                    </div>
                </div>
                <div class="tr">
                    <div class="td">
                        <input type="submit" name="show" value="anzeigen">
                    </div>
                </div>
            </div>
        </form>
        <?php


    } catch (Exception $e)
    {
        echo $e->getMessage();
    }
} else if(isset($_POST['show'])) {

    try {
        $buch_id = $_POST['buch_id'];
        $buch_id_suche = array($buch_id);
        $query2 = 'select buch_titel from buch where buc_ISBN=?';
        //$stmt = $con->GetStatement( $query2, $dra_id_suche);
        $stmt = GetStatement($con, $query2, $buch_id_suche);
        $number = $stmt->fetch();     // Fetch ohne While 

        $showBook = 'select buc_isbn as "ISBN", buch_titel as "Titel",
                        kat_name as "Kategorie", concat(aut_vorname, " ", aut_nachname) as "Autor",
                        ver_name as "Verlag"
                        from buch 
                        inner join kategorie on buch.kat_id = kategorie.kat_id
                        inner join verlag on buch.ver_id = verlag.ver_id
                        inner join autor on buch.aut_id = autor.aut_id
                        where buc_isbn like "' . $buch_id . '" 
                        group by buc_isbn';
                        echo '<br>';

       // $stmt = $con->GetStatement($query, $dra_id_suche);
        $stmt = GetStatement($con, $showBook, $buch_id_suche);

        echo '<br><h4>Alle Ergebnisse für '.$number[0].':</h4>';
       // $con->PrintTable($stmt);
        PrintTable($con,$showBook,$buch_id_suche);

    } catch (Exception $e)
    {
        //require_once 'exception_handling.php';
        echo $e->getMessage();
    }

}else
{
        
    ?>
    <br>
    <h3>Suche nach Buch</h3>
    <form method="post">
        <div class="table">
            <div class="tr">
                <div class="th">
                    <label for="suche">Nach Buchnummer suchen:</label>
                </div>
                <div class="td">
                    <input class="textonly" id="suche" type="text" name="number" maxlength="10">
                </div>
            </div>
            <div class="tr">
                <div class="td">
                    <input type="submit" name="search" value="suchen">
                </div>
            </div>
        </div>
    </form>
    <?php
}
