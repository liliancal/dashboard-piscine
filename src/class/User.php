<?php
class User {
    private $_id;
    private $_name;
    private $_firstname;
    private $_mail;
    private $_status;
    private $_avatar;
    private $_civilité;
    private $_bdd;
 
    function __construct($bdd, $id = null){
        $this->_bdd=$bdd;
        if($id !== NULL){
            $user = $this->getUser($id);
            $this->_id = $id;
            $this->_name = $name;
            $this->_firstname = $firstname;
            $this->_mail = $mail;
            $this->_status = $status;
            $this->_avatar = $avatar;
            $this->_civilité = $civilité;
         }
    }
    function createUser ($name,
                        $firstname,
                        $mail,
                        $status,
                        $avatar,
                        $civilité){
        $req = $this->_bdd->prepare("INSERT INTO user (nom, prenom, mail, password, id_civilite, id_user_status)
                                    VALUES(:nom, :prenom, :mail, :password, :idcivilite, :idstatus)");

                        $req->bindParam(':nom', $nom);
                        $req->bindParam(':prenom', $prenom);
                        $req->bindParam(':mail', $mail);
                        $req->bindParam(':password', $password);
                        $req->bindParam(':idcivilite', $idcivilite);
                        $req->bindParam(':idstatus', $idstatus);
                        $req->execute();
                       
                    return true ;
    }

    function getUser ($id){
        $req = $this->_bdd->prepare("SELECT nom, prenom, mail, password, id_civilite, id_user_status 
                                FROM user
                                WHERE id= $id");
                    $req->execute();
                    $result = $req->fetch();
                    return $result;
    }

    function getAllUser (){
        $req = $this->_bdd->prepare("SELECT nom, prenom, mail, password, id_civilite, id_user_status FROM user");
                    $req->execute();
                    $result = $req->fetchAll();
                    return $result ;
    }

    function updateUser ($id, $name,
                            $firstname,
                            $mail,
                            $status,
                            $avatar,
                            $civilité){
        $req = $this->_bdd->prepare("UPDATE ( nom, prenom, mail, password, id_civilite, id_user_status)
                                    SET(:nom, :prenom, :mail, :password, :idcivilite, :idstatus)
                                    WHERE id= :id");    
                        $req->bindParam(':id', $id);
                        $req->bindParam(':nom', $nom);
                        $req->bindParam(':prenom', $prenom);
                        $req->bindParam(':mail', $mail);
                        $req->bindParam(':password', $password);
                        $req->bindParam(':idcivilite', $idcivilite);
                        $req->bindParam(':idstatus', $idstatus);
                        $req->execute();
                    
                    return true;

    }

    function deleteUser ($id) {
        $req = $this->_bdd->prepare("DELETE user FROM user WHERE id=id");
                    $req->execute();
                    return true;

    }

    function connexion ($mail, $password){
        if(!empty($_POST)){
                $mail = $_POST['mail'];
                $password = $_POST['pass'];

                $req = $this->_bdd->prepare('SELECT id FROM user WHERE mail= :mail');
                $req->bindParam(':mail', $mail);
                $req->execute();
                $result = $req->fetch();

        if(!empty($result)){
            
                $req = $this->_bdd->prepare('SELECT id, nom, prenom FROM user WHERE mail= :mail AND password= :password');
                $req->bindParam(':mail', $mail);
                $req->bindParam(':password', $password);
                $req->execute();
                $result2 = $req->fetch();
                
        if(!empty($result2)){

                $_SESSION['id']=$result2['id'];	
                $_SESSION['name']=$result2['nom'];	
                $_SESSION['surname']=$result2['prenom'];									
                $_SESSION['mail']=$mail;
                 header('location: admin.php');
                   
                } else {
                    $msg = "Mot de passe incorrect";
                    $mailTmp = $_POST['mail'];
            }   
                } else {
       
                $msg = "Adresse mail inconnue";
            }
        }
       

    }
}
// $user = new User ($this->_bdd, $id=1);
// $result=$user->getUser ($id=1);
// echo $result ["name"]; 


