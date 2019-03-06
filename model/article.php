<?php
    $req = $bdd->prepare('SELECT title, content, coverImage FROM article');
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
        <td>'.$element['title'].'</td>
        <td>'.$element['content'].'</td>
        </tr>
        ';
    }

?>