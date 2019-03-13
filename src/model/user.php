<?php
    $req = $bdd->prepare('SELECT id, nom, prenom, mail FROM user');
    $req->execute();
    $result=$req->fetchAll();
    // echo '<pre>';
    // print_r($result);
    // echo '</pre>';
    $row="";

    //for ($i=0; $i < count($result); $i++) { 
    foreach($result as $element){
        $row .= '
        <tr>
        <td>'.$element['prenom'].'</td>
        <td>'.$element['nom'].'</td>
        <td>'.$element['mail'].'</td>
        <td>'.$element['id'].'</td>
        </tr>
        ';
    }

?>