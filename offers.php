<?php
    include_once('_db/connexionDB.php');

    // On écrit notre requête
    $sql = 'SELECT * FROM `company` JOIN `job_post` ON company.company_id = job_post.company_id JOIN `skills_needed` ON job_post.job_post_id = skills_needed.job_post_id JOIN `skills` ON skills_needed.skill_id = skills.skill_id JOIN `need` ON job_post.job_post_id = need.job_post_id JOIN `education` ON need.education_id = education.education_id';

    // On prépare la requête
    $query = $bdd->prepare($sql);

    // On exécute la requête
    $query->execute();

    // On stocke le résultat dans un tableau associatif
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Offers</title>
        <?php
            require_once('_head/meta.php');
            require_once('_head/link.php');
            require_once('_head/script.php');
        ?>
    </head>
    <body class="d-flex flex-column h-100">
        <main class="flex-shrink-0">
            <!-- Page Content-->
            <!-- Blog preview section-->
            <section class="py-5">
                <div class="container px-5 my-5">
                    <div class="row gx-5 justify-content-center">
                        <div class="col-lg-8 col-xl-6">
                            <div class="text-center">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-card-checklist"></i></div>
                                <h2 class="fw-bolder">Internship Offers</h2>
                                <p class="lead fw-normal text-muted mb-5">Find here all the internship offers available</p>
                            </div>
                        </div>
                    </div>
                    <div class="row gx-5">
                        <?php
                            foreach($result as $produit){
                        ?>
                            <div class="col-lg-4 mb-5">
                                <div class="card" style="width: 20rem;">
                                    <img src="<?= $produit['company_image'] ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $produit['internship_name'] ?></h5>
                                        <p class="card-text"><?= $produit['internship_description'] ?></p>
                                        <h5 class="card-title mb-3">Skills : <?= $produit['skill_name'] ?> level : <?= $produit['skill_level'] ?>%</h5></p>
                                        <h5 class="card-title mb-3">Graduation Year : <?= $produit['graduation_year'] ?></p>
                                        <h5 class="card-title mb-3">Minor : <?= $produit['minor'] ?></h5></p>
                                        <h5 class="card-title mb-3">Duration : <?= $produit['duration'] ?> days</h5></p>
                                        <h5 class="card-title mb-3">Salary : <?= $produit['salary'] ?>€</h5></p>
                                        <div class="card-footer p-0 pt-0 bg-transparent border-top-0">
                                            <div class="d-flex align-items-end justify-content-between">
                                                <div class="d-flex align-items-left">
                                                    <div class="medium">
                                                        <div class="fw-bold"><?= $produit['company_name'] ?></div>
                                                        <div class="text-muted"><?= $produit['creation_date'] ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <a href="login.php" class="btn btn-primary">Apply</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </section>
        </main>
        <!-- Menu-->
        <?php
            require_once('_menu/menu.php')
        ?>
        <!-- Footer-->
        <?php
            require_once('_footer/footer.php')
        ?>
    </body>
</html>
