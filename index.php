<?php

// Fichier de connexion à la base de donnnées
require_once 'Database/config.php';
include_once 'fonctions/fonctions.php';
include_once 'fonctions/traitements.php';
include_once 'fonctions/html/fonctions.php';

// Définition de la Page courante
if (isset($_GET['p']) and !empty($_GET['p'])) {
    $page = trim(strtolower($_GET['p']));
} else {
    $page = 'home';
}



// tableau contenant toutes les pages

$toutLesPages = scandir('pages/');

if (in_array($page . '.php', $toutLesPages)) {

    include_once 'pages/' . $page . '.php';
} else if ($_GET['p'] === "emplois") {
    include_once 'emploi_du_temps/emplois.php';
} else {
    include_once 'pages/404.php';
}
