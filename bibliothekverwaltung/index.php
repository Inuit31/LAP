<!DOCTYPE HTML>
<html>
<head>
    <!-- D.Kogu -->
    <title>Schule</title>

    <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    
</head>
<body>
 <link rel="stylesheet" href="css/bootstrap.css">
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
      
        case 'buchliste':
            include ('buchliste.php');
            break;
            case 'erfassen':
            include ('erfassen.php');
            break;
              case 'bootstrap':
            include ('bootstrap.php');
            break;
        case 'suche':
        include ('suche.php');
        break;    
        case 'change':
        include ('change.php');
        break;    
        case 'delete':
        include ('delete.php');
        break;
        case 'search':
        include ('search.php');
        break;
        default:
            include ('start.php');
    }
    ?>
</main>
</body>
</html>