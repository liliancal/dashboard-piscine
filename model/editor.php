<?php

    $req = $bdd->prepare('SELECT id, type FROM category_blog');
    $req->execute();
    $result=$req->fetchAll();

    $options="";

    foreach ($result as $elements) {
        $options .= '<option value="'.$elements['id'].'">'.$elements['type'].'</option>';
    }

    if(!empty($_POST)) {
        //On récupère les valeurs $_POST (et autre) pour les injecter
        $title = $_POST['title'];
        $content = $_POST['content'];
        $coverImage = "monimgae.jpg";
        $categorie = $_POST['categorie'];
        $userId = $_SESSION['id'];
        $art_status = 1; //brouillon par défaut
        
        //On injecte d'abord l'article dans la table 'article'
        $req = $bdd->prepare('INSERT INTO article (title, content, coverImage) VALUES (:title,:content,:coverImage)');
        $req->execute(array(
        ':title' => $title,
        ':content' => $content,
        ':coverImage' => $coverImage
        ));
        //On recupère l'ID du dernier article inseré 
        $lastId = $bdd->lastInsertId();

        //On injecte ensuite la catégorie et l'ID de l'article dans la table 'rel_article_category'
        $req = $bdd->prepare('INSERT INTO rel_article_category (id, id_article) VALUES (:categorie,:lastId)');
        $req->execute(array(
        'lastId' => $lastId,
        'categorie' => $categorie
        ));

        //On injecte ensuite l'ID user, l'ID de l'art. le status et une DATE dans la table 'rel_event_article'
        $req = $bdd->prepare('INSERT INTO rel_event_article (id, id_article, id_article_status, date) VALUES (:user,:lastId,:status,:date');
        $req->execute(array(
        'user' => $userID,
        'lastId' => $lastId,
        'status' => $art_status,
        'date' => '2019-03-04'
        ));
        
        header("location: index.php?p=article");

    }   

?>