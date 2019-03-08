<?php
$pageTitle="Liste des utilisateurs";
// HTML 
// include('model/table.php');         
// include('view/head_table.php');          
// include('view/topbar.php');    
// include('view/sidebar.php');             
// include('view/table.php');
// include('view/footer.php');        
// include('view/footer_table.php'); 
echo $twig->render('table.html', 
array('title' => 'Liste des utilisateurs', 
'assets' => 'assets/',
'name' => $_SESSION['surname']." ".$_SESSION['name'],
'projectName' => "LaPiscine",
'projectNameShort' => "L-P",
'list' => $row,
'deconnexion' => $_url_deconnexion )
);