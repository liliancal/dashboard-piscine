<?php
$pageTitle="Editer les articles";
// CODE PHP 
if(isset($_GET['id'])){
    $idArticle=$_GET['id'];
    include('model/modifarticle.php');        
}
else{
    include('model/editor.php');  
    $title="";
    $content="";
    $coverImage="";
}
        
echo $twig->render('editor.html', 
array('title' => $pageTitle, 
'assets' => 'assets/',
'name' => $_SESSION['surname']." ".$_SESSION['name'],
'projectName' => "LaPiscine",
'projectNameShort' => "L-P",
'titleArticle' => $title,
'contentArticle' => $content,
'coverImageArticle' => $coverImage)
); 
