<?php

$bdd = mysqli_connect("localhost", "ludovic", "glados", "permanence");

if (!$bdd) {
    echo "Erreur de connexion MySQL" . PHP_EOL;
    exit;
}

ini_set('display_errors', 1);
$bdd->set_charset('utf8');

//session_start();
?>