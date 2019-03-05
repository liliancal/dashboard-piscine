<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$_assets="assets/";
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

    if(!isset($_GET['p'])){
        $pageTitle="Accueil";
        // HTML 
        include('view/dashboard.php');
    }
    elseif(isset($_GET['p']) AND $_GET['p']=="users"){
        $pageTitle="Liste des utilisateurs";
        // HTML 
        include('view/table.php');
    }
}
else {
    // Traitement du formulaire de connexion
    include('model/login.php');
    // HTML 
    include('view/login.php');    
}
