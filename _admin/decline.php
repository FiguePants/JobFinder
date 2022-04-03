<?php
    include_once('../_db/connexionDB.php');
    
    $var = $_SESSION['firstname'];

    $sql = 'DELETE FROM wishtlist WHERE job_post_id=:job_post_id AND account_information_id=:account_information_id';
    $query = $bdd->prepare($sql);
    $query->execute([
        'job_post_id'=>$_POST['job_post_id'],
        'account_information_id'=>$_POST['account_information_id'],
    ]);
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    header('Location: validation-admin.php')
?>