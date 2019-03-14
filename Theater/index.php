<!DOCTYPE HTML>
<html>
<head>
    <!-- D.Kogu -->
    <title>Schule</title>

<meta charset="utf-8">
</head>
<body>
 <link rel="stylesheet" href="css/skeleton.css">
<nav>
    <?php
   include ('menu.html');
    ?>
<main>
    <?php
    include('funktionen.php');
    include('config.php');

    switch ($_GET['menu'])
    {
      
        case 'erfassen':
            include ('erfassen.php');
            break;
            case 'delete':
            include ('delete.php');
            break;
              case 'suche':
            include ('suche.php');
            break;
            case 'search':
            include ('search.php');
            break;
        default:
            include ('welcome.php');
    }
    ?>
</main>
</body>
</html>