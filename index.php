<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require('system/init.php');

include('model/front.php');
echo $twig->render('front.html',
array('title' => 'Accueil',
'assets_front' => 'assets/front/',
'article' => $article));

?>
