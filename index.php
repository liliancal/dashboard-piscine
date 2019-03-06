<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require('system/init.php');

$_assets="assets/";
// /index.php !== de index.php
//$_url_deconnexion = "index.php?p=deconnexion";
$_url_deconnexion = "index.php?p=deconnexion";
session_start();

/*
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
*/

// $_GET existe toujours

if(!empty($_SESSION)){
    $projectName="LaPiscine";
    $projectNameShort="L-P";
    $name=$_SESSION['surname']." ".$_SESSION['name'];

    //isset = est-ce que la variable existe = est-ce qu'elle est définie ?
    if(!isset($_GET['p'])){
        $_GET['p']="home";          
    }
    if(file_exists('controler/'.$_GET['p'].'.php')){
        include('controler/'.$_GET['p'].'.php'); 
    }
    else {
        echo "cette page n'existe pas";
    }     
}
else {
    // Traitement du formulaire de connexion
    // On créé les sessions ici lorsque le formulaire a été envoyé
    include('model/login.php');
    // HTML 
    include('view/login.php');    
}
