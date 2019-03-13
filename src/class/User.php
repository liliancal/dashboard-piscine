<?php

class User {
    private $_id;
    public $_name;
    public $_firstname;
    public $_mail;
    private $_password;
    private $_status;
    private $_civilite;
    private $_avatar;

    private $_verifyPass;
    private $_bdd;

    function __construct($bdd, $id = null)
    {
        $this->_bdd = $bdd;
        if($id != NULL){
            $user = $this->getUser($id);
            $this->_id = $id;
            $this->_name = $user['nom'];
            $this->_firstname = $user['prenom'];
            $this->_mail = $user['mail'];
            $this->_password = $user['password'];
            $this->_avatar = $user['avatar'];
            $this->_civilite = $user['id_civilite'];
            $this->_status = $user['id_user_status'];
        }
    }
    
    function getUser($id)
    {
        $req = $this->_bdd->prepare("SELECT nom, prenom, mail, password, avatar, id_civilite, id_user_status 
                                FROM user
                                WHERE id=:id");
                    $req->bindParam(':id', $id);
                    $req->execute();
                    $result = $req->fetch();
                    return $result;
    }

    function getAllUser()
    {
        $req = $this->_bdd->prepare("SELECT id, nom, prenom, mail, avatar, id_civilite, id_user_status 
                                    FROM user");
                    $req->execute();
                    $result = $req->fetchAll();
                    return $result ;
    }

    function createUser($name,$firstname,$mail,$password,$avatar,$civilite,$status) 
    {
        $this->_password = password_hash($password, PASSWORD_DEFAULT);
        $req = $this->_bdd->prepare("INSERT INTO user (nom, prenom, mail, password, avatar, id_civilite, id_user_status)
                                    VALUES (:nom, :prenom, :mail, :password, :avatar, :idcivilite, :idstatus)");
                    $req->execute(array(
                        'nom' => $name,
                        'prenom' => $firstname,
                        'mail' => $mail,
                        'password' => $this->_password,
                        'avatar' => $avatar,
                        'idcivilite' => $civilite,
                        'idstatus' => $status
                    ));
                    return true ;
    }

    function updateUser($id,$name,$firstname,$mail,$avatar,$civilite,$status)
    {
        $req = $this->_bdd->prepare("UPDATE user
                                    SET nom=:nom, prenom=:prenom, mail=:mail, avatar=:avatar, 
                                        id_civilite=:idcivilite, id_user_status=:idstatus
                                    WHERE id=:id");    
                    $req->execute(array(
                        'id' => $id,
                        'nom' => $name,
                        'prenom' => $firstname,
                        'mail' => $mail,
                        'avatar' => $avatar,
                        'idcivilite' => $civilite,
                        'idstatus' => $status
                    ));
                    return true;
    }

    function deleteUser($id) 
    {
        $req = $this->_bdd->prepare("DELETE FROM user WHERE id=:id");
                    $req->execute(array('id' => $id));
                    return true;
    }

    function passChange($id, $oldPassword, $newPassword) 
    {
        $req = $this->_bdd->prepare("SELECT password FROM user WHERE id=:id");
                    $req->bindParam(':id', $id);
                    $req->execute();
                    $result = $req->fetch();
        $this->_verifyPass = $result['password'];
        if(password_verify($oldPassword, $this->_verifyPass)) {
            $this->_password = password_hash($newPassword, PASSWORD_DEFAULT);
            $req = $this->_bdd->prepare("UPDATE user
                                        SET password=:newPassword
                                        WHERE id=:id");    
                    $req->execute(array('id' => $id, 'newPassword' => $this->_password));
                    return true;
        } else {
            return 'Le mot de passe ne correspond pas.';
        }
    }

    function connexion($mail, $password)
    {
        $req = $this->_bdd->prepare('SELECT id, nom, prenom, password FROM user WHERE mail= :mail');
        $req->bindParam(':mail', $mail);
        $req->execute();
        $checkMail = $req->fetch();

        if(!empty($checkMail)){
            $checkPass = password_verify($password, $checkMail['password']);
    
            if($checkPass){
                $_SESSION['id']=$checkMail['id'];	
                $_SESSION['name']=$checkMail['nom'];	
                $_SESSION['surname']=$checkMail['prenom'];									
                $_SESSION['mail']=$mail;
                header('location: admin.php');
                return "Vous êtes connecté";
            } else {
                $this->_mail = $mail;
                return "Mot de passe incorrect";
            }
        } else {
            return "Adresse mail inconnue";
        }
    }
}

// $user = new User ($bdd);
// //$user->createUser('yoyo','asticot','yoastico@gmail.com','papayoyo','img.pjg',3,3);
// //$user->updateUser(8,'name','firstname','mail','avatar',1,2);
// //$user->deleteUser(7);
// //$user->passChange(9, 'papayoyo', 'papayoyo');
// //$test = $user->connexion('yoastico@gmail.com','papayoyo');

// //$result = $user->getUser(9);
// $result = $user->getAllUser();

// echo '<pre>';
// //print_r($test);
// echo '<br>';
// print_r($result);
// echo '</pre>';


