<?php
include('system/init.php');

// On charge toutes les librairies installées avec composer 
// (dont twig)
require_once 'vendor/autoload.php';

// $loader est une variable qui contient un objet ayant été généré
// grâce à l'instanciation de la classe Twig_Loader_Filesystem
// à laquelle nous avons passé un paramètre qui est 'templates'
// en l'occurence il s'agit d'un chemin d'accès (PATH)
$loader = new Twig_Loader_Filesystem('templates');

// $twig est une variable qui contient un objet ayant été généré
// grâce à l'instanciation de la classe Twig_Environment
// à laquelle nous avons passé un paramètre qui est la variable $loader
// en l'occurence il s'agit d'un objet
$twig = new Twig_Environment($loader);

//debug($twig);

/* On charge dans twig et on affiche le fichier index.html */
//echo $twig->render('index.html');

/* On affiche ce que nous renvoi la méthode render qui interprête 
    les variables twig dans le fichier table.html 
    on  lui fait passer également 2 variables twig (title et nom) */
echo $twig->render('table.html', 
    array('title' => 'Accueil',
            'nom' => 'Lilian')
    );
