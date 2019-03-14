<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 09.12.2018
 * Time: 13:45
 */


echo '<h2>Kundenliste</h2>';
//phpinfo();
try
{

    $query =
        'select kunde_id as "Kunden ID",vorname as "Vorname", nachname as "Nachname", strasse as "Strasse", ort as "Ort", plz as "PLZ",geburtsdatum as "Gebursdatum"
         from kunde';


    $stmt = $con->prepare($query);
    $stmt->execute();


    // Alternativ

    $meta = array();

    $count = $stmt->columnCount(); // Anzahl der Atrribute aus Select


    showTable($con, $query, $meta);

    echo '<br>';

} catch (Exception $e)
{
    echo $e->getMessage();
}