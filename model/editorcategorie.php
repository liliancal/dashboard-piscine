<?php

if(!empty($_POST)) {
    $type = $_POST['category'];
    // $title = $_POST['title'];
    // $content = $_POST['content'];
    // $image = $_POST['image'];
    
    $req = $bdd->prepare('INSERT INTO category_blog (type) VALUES (:type)');
    $req->execute(array(
    ':type' => $type
    ));

    header("location: admin.php?p=categoriearticles");
}

?>