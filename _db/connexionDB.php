<?php
session_start();
try{
  $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '',
  array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
  die('Erreur : '.$e->getMessage());
}
?>