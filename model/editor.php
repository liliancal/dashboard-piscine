<?php

if(!empty($_POST)) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_POST['image'];
    
    $req = $bdd->prepare('INSERT INTO article (title, content, coverImage) VALUES (:title,:content,:coverImage)');
    $req->execute(array(
    ':title' => $title,
    ':content' => $content,
    ':coverImage' => $image
    ));

    header("location: index.php?p=article");
}

?>