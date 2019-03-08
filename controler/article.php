<?php
$pageTitle="Listearticles";
// HTML 
include('model/article.php');         
// include('view/head_table.php');          
// include('view/topbar.php');    
// include('view/sidebar.php');             
// include('view/article.php');
// include('view/footer.php');        
// include('view/footer_table.php');  
echo $twig->render('table.html', 
array('title' => 'Liste des utilisateurs', 
'assets' => 'assets/',
'name' => $_SESSION['surname']." ".$_SESSION['name'],
'projectName' => "LaPiscine",
'projectNameShort' => "L-P",
'list' => $row )
);