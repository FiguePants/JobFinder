<?php
include_once('../_db/connexionDB.php');

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = strip_tags($_GET['id']);
    $sql6 = 'SELECT `job_post_id` FROM `job_post` WHERE company_id = :id';
    $query6 = $bdd->prepare($sql6);
    $query6->execute(['id'=>$id]);
    $result6 = $query6->fetch(PDO::FETCH_ASSOC);

    $sql7 = "DELETE FROM need WHERE job_post_id = :job_post_id";
    $query7 = $bdd->prepare($sql7);
    $query7->execute(['job_post_id'=>$result6['job_post_id']]);
    
    $sql9 = 'SELECT `skill_id` FROM `skills_needed` WHERE job_post_id = :job_post_id';
    $query9 = $bdd->prepare($sql9);
    $query9->execute(['job_post_id'=>$result6['job_post_id']]);
    $result9 = $query9->fetch(PDO::FETCH_ASSOC);

    $sql8 = "DELETE FROM skills_needed WHERE job_post_id = :job_post_id";
    $query8 = $bdd->prepare($sql8);
    $query8->execute(['job_post_id'=>$result6['job_post_id']]);

    $sql10 = "DELETE FROM skills WHERE skill_id = :skill_id";
    $query10 = $bdd->prepare($sql10);
    $query10->execute(['skill_id'=>$result9['skill_id']]);

    $sql11 = "DELETE FROM job_post_activity WHERE job_post_id = :job_post_id";
    $query11 = $bdd->prepare($sql11);
    $query11->execute(['job_post_id'=>$result6['job_post_id']]);

    //$id = strip_tags($_GET['id']);
    $sql = "DELETE FROM job_post WHERE company_id = :id";
    $query = $bdd->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();

    $id2 = strip_tags($_GET['id']);
    $sql2 = "DELETE FROM location WHERE company_id = :id";
    $query2 = $bdd->prepare($sql2);
    $query2->bindValue(':id', $id, PDO::PARAM_INT);
    $query2->execute();

    $id4 = strip_tags($_GET['id']);
    $sql4 = "DELETE FROM rating WHERE company_id = :id";
    $query4 = $bdd->prepare($sql4);
    $query4->bindValue(':id', $id, PDO::PARAM_INT);
    $query4->execute();
    
    $id3 = strip_tags($_GET['id']);
    $sql3 = "DELETE FROM activity WHERE company_id = :id";
    $query3 = $bdd->prepare($sql3);
    $query3->bindValue(':id', $id, PDO::PARAM_INT);
    $query3->execute();

    $id5 = strip_tags($_GET['id']);
    $sql5 = "DELETE FROM company WHERE company_id = :id";
    $query5 = $bdd->prepare($sql5);
    $query5->bindValue(':id', $id, PDO::PARAM_INT);
    $query5->execute();
    
    header('Location: manage-delegated.php'); //tester # à pour ne pas rafraichir la page
}
?>