<?php

class Categorie {
    private $_bdd;
    private $_id;
    private $_type;
    private $_verify;
    private $_adress = 'category_blog';

    function __construct($bdd = NULL, $idcategorie = NULL){
        if ($idcategorie != NULL) {
            $this->_id = $idcategorie;
        }
        if ($bdd == NULL) {
            $this->_bdd = new PDO('mysql:host=localhost;dbname=blog_e_commerce;charset=utf8', 'root', 'root');
        }     
        else{
            $this->_bdd = $bdd;
        }   
    }

    // function __construct($idcategorie = NULL){
    //     if ($idcategorie != NULL) {
    //         $this->_id = $idcategorie;
    //     }
    //     $this->_bdd = new PDO('mysql:host=localhost;dbname=blog_e_commerce;charset=utf8', 'root', 'root');
    // }

    function create($type) {
        $this->_type = $type;
        $req = $this->_bdd->prepare('INSERT INTO '.$this->_adress.' (type) VALUES (:type)');
        $req->execute(array(
            ':type' => $this->_type
        ));
        return true;
    }

    function read($idcategorie) {
        $this->_id = $idcategorie;
        $req = $this->_bdd->prepare('SELECT * FROM '.$this->_adress.' WHERE id=:id'); 
        $req->bindParam(':id', $this->_id);
        $req->execute();
        $this->_verify = $req->fetch();
        if(!empty($this->_verify)) {
            return $this->_verify;
        } else {
            return 0;
        }
    }
    function lilian($i){
        if($i==1)
            return 2;
        else
            return false;
    }
    function getAll() {
        $req = $this->_bdd->prepare('SELECT * FROM '.$this->_adress);
        $req->execute();
        return $req->fetchAll();
    }

    function update($idcategorie, $type) {
        $this->_id = $idcategorie;
        $this->_type = $type;
        if($this->idVerify()) {
            $req = $this->_bdd->prepare('UPDATE '.$this->_adress.' SET type=:type WHERE id=:id');
            $req->execute(array(
            ':id' => $this->_id,
            ':type' => $this->_type
            ));
            return true;
        } else {
            return 0;
        }
    }

    function delete($idcategorie) {
        $this->_id = $idcategorie;
        if($this->idVerify()) {
            $req = $this->_bdd->prepare('DELETE FROM '.$this->_adress.' WHERE id=:id');
            $req->execute(array(
                ':id' => $this->_id
            ));
            return true;
        } else {
            return 0;
        }
    }

    function idVerify() {
        $req = $this->_bdd->prepare('SELECT * FROM '.$this->_adress.' WHERE id=:id'); 
        $req->bindParam(':id', $this->_id);
        $req->execute();
        $this->_verify = $req->fetch();
        if(!empty($this->_verify)) {
            return 1;
        } else {
            return 0;
        }
    }
}


?>