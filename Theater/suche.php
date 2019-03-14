<?php
/**
 * Created by PhpStorm.
 * User: Kogu Daniel
 * Date: 17.01.2019
 * Time: 08:08
 */



if(isset($_POST['search']))
{
    echo '<h2>Nach Theaterstück suchen</h2>';
    try {
        $titel = $_POST['titel'];
        echo '<h4>Gesucht wurde nach: '.$titel.'</h4>';
        $query = 'select * from drama where dra_name like ?';
        $titel = '%'.$titel.'%';
        $titelarray = array($titel);
        $stmt = GetStatement($con, $query, $titelarray);
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
                        <select name="titelid">
                            <?php

                            while($row = $stmt->fetch(PDO::FETCH_NUM))
                            {
                                echo '<option value="'.$row[0].'">'.$row[1];

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
        $titelid = $_POST['titelid'];
        $titel_suche = array($titelid);
        $query2 = 'select dra_name from drama where dra_id=?';
        $stmt = GetStatement($con, $query2, $titel_suche);
        $titel = $stmt->fetch();
        $query = 'select * from drama where dra_id=? order by dra_id';

        $stmt = GetStatement($con, $query, $titel_suche);
        echo '<h4>Alle Ergebnisse für '.$titel[0].':</h4>';
        /*while($row = $stmt->fetch(PDO::FETCH_NUM))
        {*/

           // echo '<hr>Titelnummer '.$row[0].': '.$row[1];
            $query1 = ' select dra_id as "Nr", gen_name as "Genre",dra_name as "Name des Stücks", concat(per_vName, " ", per_nName) as "Autor"
                         ,eve_termin as "Erstauffführung"
                        from Drama 
                         LEFT JOIN Genre USING (gen_id)
                         LEFT JOIN dramaevent using (dra_id)
                         LEFT join crew using (eve_id)
                        LEFT join person on drama.autor_id = person.per_id
                        WHERE dra_id = ?
                        ORDER BY dra_id';

            $Array = array($titelid);
            $stmt = GetStatement($con, $query1, $Array);
            PrintTable($con, $query1, $Array);
            //break;
    //}
    // PrintTable($con, $query1, $zubArray);
    } catch (Exception $e)
    {
        echo $e->getMessage();
    }

}else
{

    ?>
    <br>
    <meta charset="utf-8">
    <h3>Theaterstück suchen</h3>
    <form method="post">
        <div class="table">
            <div class="tr">
                <div class="th">
                    <label for="suche">Titel des gesuchten Stücks:</label>
                </div>
                <div class="td">
                    <input class="textonly" id="suche" type="text" name="titel" placeholder="z.B. romeo">
                </div>
            </div>
            <div class="tr">
                <div class="td">
                    <input type="submit" name="search" value="Suche starten">
                </div>
            </div>
        </div>
    </form>
    <?php
}
