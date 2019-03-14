<h2>Kundenliste</h2>;

<?php

try
{
    $query =
        'select buc_isbn as "ISBN", buch_titel as "Titel",
        kat_name as "Kategorie", concat(aut_vorname, " ", aut_nachname) as "Autor",
        ver_name as "Verlag"
        from buch 
        inner join kategorie on buch.kat_id = kategorie.kat_id
        inner join verlag on buch.ver_id = verlag.ver_id
        inner join autor on buch.aut_id = autor.aut_id';
    /*$stmt = $con->prepare($query);
    $stmt->execute();


    // Alternativ

    $meta = array();

    $count = $stmt->columnCount(); // Anzahl der Atrribute aus Select


    showTable($con, $query, $meta);   Für echte Tabelle

    */
    PrintTable($con, $query);





} catch (Exception $e)
{
    echo $e->getMessage();
}