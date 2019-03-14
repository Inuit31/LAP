<!DOCTYPE HTML>
<html>
<head>
    <!-- D.Kogu -->
    <title>Schule</title>

    <meta charset="utf-8">
    <link rel="stylesheet" href="css/skeleton.css";>
    
</head>
<body>
<nav>
    <?php
    include 'menu.html';
    ?>
</nav>
<main>
    <?php
    include('funktionen.php');
    include('config.php');

  /*  if(!isset($_GET['menu']))
    {
        include ('start.php');
    }
*/

    switch ($_GET['menu'])
    {
        case 'suche':
            include ('suche.php');
            break;
             case 'search':
            include ('search.php');
            break;
        case 'erfassen':
            include ('erfassen.php');
            break;
        case 'kundenliste':
            include ('kundenliste.php');
            break;
        case 'delete':
            include ('delete.php');
            break;
        case 'change':
            include ('change.php');
            break;    
            case 'treibstoff_query':
            include ('treibstoff_query.php');
            break;    
        default:
            include ('start.php');
    }
    ?>
</main>
</body>
</html>