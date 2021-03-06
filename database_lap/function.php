<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 06.12.2018
 * Time: 15:50
 *
 * Funktionen für:
 * prepare: prepareStatement(...)
 * bindparam und oder execute bindParamete, executeStatement
 *
 * function funktionsName (parameter1, parameter2 = 1...)
 * {
 * return xyz; // optional
 * }
 */

function ExecuteStatement($con, $query, $bindparam = null)
{
    $stmt = $con->prepare($query);
    $stmt-> execute();

    return $stmt;
}

function prepareStatement($con, $query, $bindArray = null)
{
    $stmt = $con->prepare($query);
    $stmt = bindParameter($stmt, $bindArray);
    $stmt->execute();
    return $stmt;

}

function bindParameter ($stmt, $bindArray)
{
    for ($i = 0; $i < sizeof ($bindArray); $i++)
    {
        $stmt->bindParam($i+1, $bindArray[$i]);
    }
    return $stmt;
}

function GetStatement($con, $query, $paramArray = null)
{
   /* try
    {*/
        $stmt = $con->prepare($query);
        if($paramArray != null)
        {
            for($i = 0; $i < sizeof($paramArray); $i++)
            {
                $stmt->bindParam($i+1, $paramArray[$i]);
            }
        }
        $stmt->execute();
        return $stmt;

    
    /*catch (Exception $e)
    {
       echo $e->getMessage();
    }
    */
}


function PrintTable($con, $query, $boundParam=null)
{
    try {
        $stmt = $con->prepare($query);
        if ($boundParam != null) {
            for ($i = 0; $i < sizeof($boundParam); $i++) {
                $stmt->bindParam($i + 1, $boundParam[$i]);
            }
        }
        $stmt->execute();
        //Wenn nicht gebraucht, dann class function-table löschen!
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
        }

        echo '</table>';
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}



function showTable($con, $query, $bindArray = null) {
    $stmt = $con->prepare($query);
    if($bindArray != null) {
        for($i = 0; $i < sizeof($bindArray); $i++) {
            $stmt->bindParam($i + 1, $bindArray[$i]);
        }
    } else {

    }
    $stmt-> execute();

    echo '<table border="1">';

    echo'<tr>';
    for($i = 0; $i < $stmt->columnCount(); $i++)
    {
        echo '<th>'.$stmt->getColumnMeta($i) ['name'].'</th>';
    }
    echo '</tr>';
    while($row = $stmt->fetch(PDO::FETCH_NUM))
    {
        echo '<tr>';
        foreach($row as $r)
        {
            echo '<td>'.$r.'</td>';

        }
        echo '</tr>';
    }
    echo '</table>';
}