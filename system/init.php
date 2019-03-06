<?php

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=blog_e_commerce;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
