<!DOCTYPE HTML>

<html>
<head>
    <title>Theater erfassen</title>
    <meta charset="utf-8">
</head>
<body>
<nav>
<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 17.01.2019
 * Time: 08:37
 */


echo '<h2>Willkommen im Theater der Zukunft</h2>';

echo '<h4>Wir zeigen und zeigten</h4>';


$query = 'select dra_id "Nr", gen_name as "Genre",dra_name as "Name des Stücks", concat_ws(" ", per_vname, per_nName) as "Autor"
          , eve_termin as "Erstaufführung" 
          from drama 
          LEFT JOIN Genre USING (gen_id)
          LEFT JOIN dramaevent using (dra_id)
          LEFT join crew using (eve_id)
          LEFT join person on drama.autor_id = person.per_id
          LEFT JOIN rolle using (rol_id)
          GROUP by dra_id';

try {

    $stmt = $con->prepare($query);
    $stmt->execute();
    // Alternativ
    $meta = array();
    $count = $stmt->columnCount(); // Anzahl der Atrribute aus Select
    showTable($con, $query, $meta);



} catch(Exception $e)
{
    if($e->getCode())
    {
        echo $e->getMessage();
    }
}


