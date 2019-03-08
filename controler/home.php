<?php
$pageTitle="Accueil";
// HTML 
// include('view/head_dashboard.php');         
// include('view/topbar.php');    
// include('view/sidebar.php');                         
// include('view/dashboard.php');
// include('view/footer.php'); 
// include('view/footer_dashboard.php');  
echo $twig->render('dashboard.html', 
array('title' => 'Accueil', 
'assets' => 'assets/',
'name' => $_SESSION['surname']." ".$_SESSION['name'],
'projectName' => "LaPiscine",
'projectNameShort' => "L-P", )
);