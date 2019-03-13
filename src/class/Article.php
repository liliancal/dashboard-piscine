<?php

class Article{

    private $_date_derniere_modif;
    private $_article_title;
    private $_article_content;
    private $_image_coverimage;
    private $_id_auteur;
    private $_prenom_nom_auteur;
    private $_id_status;
    private $_article_status_type;
    private $_id_category_blog;
    private $_category_blog_type;
    private $_id_article;
    private $_bdd;

    function __construct($bdd, $idArticle = null){
        $this->_bdd=$bdd;
        if($idArticle !== NULL){
            $article = $this->getArticle($idArticle);
            $this->_id_article=$idArticle;
            $this->_id_status=$article['id_article_status'];
            $this->_id_auteur=$article['user_id'];
            $this->_article_title=$article['title'];
            $this->_article_content=$article['content'];
            $this->_prenom_nom_auteur=$article['nom']." ".$article['prenom'];
            $this->_date_derniere_modif=$article['date'];
            $this->_image_coverimage=$article['coverImage'];
            $this->_article_status_type=$article['type'];
            $this->_id_category_blog=$article['id_category_blog'];
            $this->_category_blog_type=$article['category_blog_type'];
        }
        //la variable $bdd n'est pas accessible depuis l'interieur de la classe vers l'exterieur de la classe
        //donc on passe a l'instanciation de la classe article l'objet BDD
        //la variable bdd recu a l'interieur du _consarticlet n'est pas accessible des autres méthodes
        //donc on initialise la variable bdd en dehors de la méthode consarticlet et a l'interieur de la classe
        //on l'appelle maintenant avec this->_bdd
    }

    //Obtention des infos concernant 1 article en spécifiant sont ID dans la méthode
    function getArticle($id){

        $req = $this->_bdd->prepare('SELECT article.id, title, content,coverImage, user.nom, user.prenom, 
                                      article_status.type, user.id AS user_id, rel_event_article.id_article_status, 
                                      date, category_blog.id AS id_category_blog, category_blog.type AS category_blog_type 
               FROM article
               INNER JOIN rel_event_article ON rel_event_article.id_article=article.id
               INNER JOIN user ON user.id = rel_event_article.id
               INNER JOIN article_status ON article_status.id = rel_event_article.id_article_status
               INNER JOIN rel_article_category ON rel_article_category.id_article = article.id
               INNER JOIN category_blog ON category_blog.id = rel_article_category.id
               AND rel_event_article.id_article_status !=3
               AND date = (SELECT MAX(date)
                       FROM rel_event_article
                       WHERE rel_event_article.id_article = article.id)
               WHERE article.id = :idArticle');
        $req->bindParam(':idArticle', $id);
        $req->execute();
        return $req->fetch();
    }

    //Obtention de la liste de tous les articles
    function getListArticle(){

        $req = $this->_bdd->prepare('SELECT article.id, title, content, user.nom, user.prenom, article_status.type 
                        FROM article 
                        INNER JOIN rel_event_article ON rel_event_article.id_article=article.id 
                        INNER JOIN user ON user.id = rel_event_article.id
                        INNER JOIN article_status ON article_status.id = rel_event_article.id_article_status 
                        AND rel_event_article.id_article_status !=3
                        AND date = (SELECT MAX(date)
                                FROM rel_event_article
                                WHERE rel_event_article.id_article = article.id)
                        ORDER BY article.id');
        $req->execute();
        return $req->fetchAll();
    }

    //creation d'un article
    function createArticle($titre,$content,$img)
    {
        $req = $this->_bdd->prepare('INSERT INTO article (title, content, coverImage) 
                        VALUES (:titre, :content, :coverImage)');
        $req->bindParam (':titre', $titre);
        $req->bindParam (':content', $content);
        $req->bindParam (':coverImage', $img);
        $req->execute();
        return 'true';
    }


    //Update d'un article
    function uptadeArticle($titre,$content,$img,$id_article){
        $req = $this->_bdd->prepare('UPDATE article SET title=":title",content=":content",coverImage=":img" WHERE id=:id_article;');
        $req->bindParam (':titre', $titre);
        $req->bindParam (':content', $content);
        $req->bindParam (':coverImage', $img);
        $req->bindParam (':id_article', $id_article);
        $req->execute();
        return 'true';
    }

    //Update d'un article
    function uptadeStatus($id_user,$id_article,$status,$date){
        $req = $this->_bdd->prepare('INSERT INTO rel_event_article(id,id_article, id_article_status, date) 
            VALUES (:id_user , :id_article , :status, :date)');
        $req->bindParam (':id_user', $id_user);
        $req->bindParam (':id_article', $id_article);
        $req->bindParam (':status', $status);
        $req->bindParam (':date', $date);
        $req->execute();
        return 'true';
    }

    //Suppresion d'un article
    function deleteArticle($id_user,$id_article,$status,$date){
        $req = $this->_bdd->prepare('INSERT INTO rel_event_article(id,id_article, id_article_status, date) 
                                      VALUES (:id_user, :id_article,3, :date');
        $req->bindParam (':id_user', $id_user);
        $req->bindParam (':id_article', $id_article);
        $req->bindParam (':status', $status);
        $req->bindParam (':date', $date);
        $req->execute();
        return 'true';
    }

    //liste des commentaires
    function listComment($id_article){
        $req = $this->_bdd->prepare('SELECT content, authorized, date, id_user FROM comment WHERE id_article = :id_article');
        $req->bindParam (':id_article', $id_article);
        $req->execute();
        return 'true';
    }

}

//TEST//

//$article=new Article($bdd);

//Obtention de la liste de tous les articles
//$test= $article->getListArticle();
/*echo '<pre>';
print_r($test);
echo '</pre>';*/

//Obtention des infos concernant 1 article en spécifiant sont ID dans la méthode
//$test2=$article->getArticle(1);

//creation d'un article
//$test3=$article->createArticle($_POST['titre'],$_POST['content'],$_POST['coverImage']);

//Update d'un article
//$test4=$article->uptadeArticle($_POST['titre'],$_POST['content'],$_POST['coverImage'],$_POST['id_article']);

//Update du status
//$test5=$article->uptadeStatus($_POST['id_user'],$_POST['id_article'],$_POST['status'],$_POST['date']);

//Suppresion d'un article
//$test6=$article->deleteArticle($_POST['id_user'], $_POST['id_article'],$_POST['status'],$_POST['date']);

//liste des commentaires
//$test7=$article->listComment($_POST['id_article']);

//echo '<pre>';
//print_r($result2);
//echo '</pre>';

//$article->createArticle($_POST['titre'],$_POST['content'],$_POST['img']);


//$article=new Article($bdd,2);
