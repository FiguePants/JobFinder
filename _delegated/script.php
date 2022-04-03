<?php
    include_once('../_db/connexionDB.php');

    $var = $_SESSION['firstname'];
    $var2 = $_SESSION['account_information_id'];
    echo "OK";
    var_dump($_POST);
  
    if($_POST["checked"] == false){
        echo "OK";
        $sql = 'INSERT INTO wishtlist (job_post_id, account_information_id) VALUES (:idpost, :idperson)';
        $query = $bdd->prepare($sql);
        $result = $query->execute(["idpost"=>$_POST["idpost"],"idperson"=>$_POST["idperson"]]);
        echo($result);
        
    }
    else{
        $sql2 = 'DELETE FROM `wishtlist` WHERE `wishtlist`.`job_post_id` = :idpost AND `wishtlist`.`account_information_id` = :idperson';
        $query2 = $bdd->prepare($sql2);
        $result2 = $query2->execute(["idpost"=>$_POST["idpost"],"idperson"=>$_POST["idperson"]]);
    }
    /*// On écrit notre requête
    $sql = 'SELECT * FROM `company` JOIN `job_post` ON company.company_id = job_post.company_id JOIN `skills_needed` ON job_post.job_post_id = skills_needed.job_post_id JOIN `skills` ON skills_needed.skill_id = skills.skill_id JOIN `need` ON job_post.job_post_id = need.job_post_id JOIN `education` ON need.education_id = education.education_id';

    // On prépare la requête
    $query = $bdd->prepare($sql);

    // On exécute la requête
    $query->execute();

    // On stocke le résultat dans un tableau associatif
    $result = $query->fetchAll(PDO::FETCH_ASSOC);*/
?>