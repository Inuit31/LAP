<?php
include 'function.php';
if(isset($_POST['show'])) {
    try {
        $database = $_POST['database'];
        ?>
       <form method="post">
        <select id="Table" name="tables">
        <?php
        $server = "localhost";
        $user = "root";
        $pwd = "";
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
    include 'config.php';
    $db = "theater";
    $con = new PDO ('mysql: host='.$server.';dbname='.$db.';charset=utf8',$user, $pwd);
    PrintTable ($con, $query);

    echo '<h2>OOO Bad Bunny</h2>';

} else {
try{
    echo '<h2>Bei Klick auf den jeweiligen Button werden alle Datenbanken</h2>';

    echo '<br>';


   include 'config.php';

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