<?php
include_once('../_db/connexionDB.php');

$id = strip_tags($_GET['id']);
$sql = 'SELECT `account_type_id` FROM `account_information` WHERE account_information_id = :account_information_id';
$query = $bdd->prepare($sql);
$query->execute(['account_information_id'=>$id]);
$result = $query->fetch(PDO::FETCH_ASSOC);


if(isset($_GET['id']) && !empty($_GET['id']) && $result['account_type_id'] !== "3"){
    $sql = "DELETE FROM account_information WHERE account_information_id = :id";
    $query = $bdd->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    
    header('Location: manage-pilote.php'); //tester # à pour ne pas rafraichir la page
}else{
    header('Location: manage-pilote.php');
}
?>