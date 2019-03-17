
<!DOCTYPE HTML>
<html>
<head>
    <!-- D.Kogu -->
    <title>Database</title>

    <meta charset="utf-8">
    <link rel="stylesheet" href="css/skeleton.css";>
    
<?php
$db="";
include 'function.php';
include 'config.php';

if(isset($_POST['show'])) {
    try {
        $database = $_POST['database'];
        $db = $database;
        ?>
       <form method="post">
        <select id="Table" name="tables">
        <?php
        $con = new PDO ('mysql: host='.$server.';dbname=' .$database.';charset=utf8',$user, $pwd);
        $query = 'show tables';
        $stmt = GetStatement($con, $query);

        while($row = $stmt->fetch(PDO::FETCH_NUM))
        {
            echo '<option value="'.$row[0].'">'.$row[0];
        }
        ?>
        </select>
        
        <div class="tr">
    <div class="th">
        <input type="submit" name="attributes" value="anzeigen">
    </div>
    </div>
    </form>
       <?php
    } catch (Exception $e)
    {
        $code = $e->getCode();
     
       // $con->rollBack();
    }
} else if (isset($_POST['attributes']))
{
    $tables = $_POST['tables']; 

    $query = 'select * from '.$tables.'';
    $con = new PDO ('mysql: host='.$server.';dbname='.$db.';charset=utf8',$user, $pwd);
    PrintTable ($con, $query);

    echo '<h2>OOO Bad Bunny</h2>';

} else {
try{
    echo '<h2>Bei Klick auf den jeweiligen Button werden alle Datenbanken</h2>';

    echo '<br>';

?>
   <form method="post">
   <select id="kun" name="database">
   <?php
   $query = 'show databases';
   $stmt = GetStatement($con, $query);

   while($row = $stmt->fetch(PDO::FETCH_NUM))
   {
       echo '<option value="'.$row[0].'">'.$row[0];
   }
   ?>
</select>

<div class="tr">
    <div class="th">
        <input type="submit" name="show" value="anzeigen">
    </div>
</div>
</form>
<?php
} catch (Exception $e) 
    {
        $code = $e->getCode();
    }
}

?>