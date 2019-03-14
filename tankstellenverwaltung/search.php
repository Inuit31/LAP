<?php
/**
 * Created by PhpStorm.
 * User: Salchegger Robert
 * Date: 17.01.2019
 * Time: 08:08
 */





if(isset($_POST['search']))
{
    echo '<h2>Nach Kundennummer suchen</h2>';
    try {
        $number = $_POST['number'];
        echo '<h4>Gesucht wurde nach: '.$number.'</h4>';
        $query = 'select * from kunde where kunde_id like ?';
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

                        <select name="kunde_id">
                        <?php

                        while($row = $stmt->fetch(PDO::FETCH_NUM))
                        {
                            echo '<option value="'.$row[0].'">'.$row[0]."|".$row[1]."|".$row[2];
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
        $kunde_id = $_POST['kunde_id'];
        $kunde_id_suche = array($kunde_id);
        $query2 = 'select vorname from kunde where kunde_id=?';
        //$stmt = $con->GetStatement( $query2, $dra_id_suche);
        $stmt = GetStatement($con, $query2, $kunde_id_suche);
        $number = $stmt->fetch();


        $query = 'select kunde_id as "Kundennummer", vorname as "Vorname",
                    nachname as "Nachname",
                    strasse as "Straße", plz as "PLZ", ort as "Ort",geburtsdatum as "Geburtsdatum"
                    from kunde
                    where kunde_id =? 
                    group by kunde_id;';

        $querySum = 'select sum(menge) as "Treibstoffverbrauch",sum(preis) as "Gesamtpreis" from verbrauch where kunde_id = ?';
       // $stmt = $con->GetStatement($query, $dra_id_suche);
        $stmt = GetStatement($con, $query, $kunde_id_suche);

        echo '<br><h4>Alle Ergebnisse für '.$number[0].':</h4>';
       // $con->PrintTable($stmt);
        PrintTable($con,$query,$kunde_id_suche);

         $stmt2 = GetStatement($con, $querySum, $kunde_id_suche);
         PrintTable($con, $querySum,$kunde_id_suche);


    } catch (Exception $e)
    {
        //require_once 'exception_handling.php';
        echo $e->getMessage();
    }

}else
{
        
    ?>
    <br>
    <h3>Nach Tankstelle suchen</h3>
    <form method="post">
        <div class="table">
            <div class="tr">
                <div class="th">
                    <label for="suche">Nach Tankstellennummer suchen:</label>
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
