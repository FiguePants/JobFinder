<?php
include_once('../_db/connexionDB.php');

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = strip_tags($_GET['id']);
    $sql = "DELETE FROM skills_needed WHERE job_post_id = :id";
    $query = $bdd->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();

    $sql2 = "DELETE FROM need WHERE job_post_id = :id";
    $query2 = $bdd->prepare($sql2);
    $query2->bindValue(':id', $id, PDO::PARAM_INT);
    $query2->execute();

    $sql3 = "DELETE FROM job_post WHERE job_post_id = :id";
    $query3 = $bdd->prepare($sql3);
    $query3->bindValue(':id', $id, PDO::PARAM_INT);
    $query3->execute();
    
    header('Location: offers-pilote.php'); //tester # à pour ne pas rafraichir la page
}
?>