<?php include("config.php");
include("functions.php");?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
    <?php
    //setNull($bdd);
    $date=date("Y-m-d");
    if(checkDay($bdd,$date)){
        newDay($bdd,$date);
    }
    displayActivities($bdd,$date);
    ?>
    </body>
</html>