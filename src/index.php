<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

/* Exemple de pagination pour l'url rewriting */
require('system/init.php');
if(isset($_GET['p']) AND $_GET['p']=="page1"){
    echo "mapage1";
}
elseif(isset($_GET['p']) AND $_GET['p']=="page2"){
    echo "mapage2";    
}
else{
    include('model/front.php');
    echo $twig->render('front.html',
    array('title' => 'Accueil',
    'assets_front' => 'assets/front/',
    'article' => $article));
}


?>
