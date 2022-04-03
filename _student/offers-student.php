<?php
    include_once('../_db/connexionDB.php');
    
    $var = $_SESSION['firstname'];
    $var2 = $_SESSION['account_information_id'];

    

    if(isset($_POST['education_id'])){
        $education_id = $_POST['education_id'];

        if($education_id !== "0"){

            $sql = 'SELECT * FROM `company` NATURAL JOIN `job_post` NATURAL JOIN `skills_needed` NATURAL JOIN `skills` NATURAL JOIN `need` NATURAL JOIN `education` WHERE education_id=:education_id';
            $query = $bdd->prepare($sql);
            $query->execute(['education_id'=>$education_id]);
            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            $sql2 = 'SELECT job_post_id FROM `wishtlist` WHERE account_information_id = :var2' ;
            $query2 = $bdd->prepare($sql2);
            $query2->execute(['var2'=>$var2]);
            $result2 = $query2->fetchAll(PDO::FETCH_ASSOC);

            if($result2 == false){

            }else{
                $sql3 = 'SELECT * FROM `job_post` NATURAL JOIN `location` NATURAL JOIN `company` NATURAL JOIN `activity` NATURAL JOIN `business_sector` NATURAL JOIN `skills_needed` NATURAL JOIN `skills`
                NATURAL JOIN `need` NATURAL JOIN `education` WHERE job_post_id = :result2' ;
                $query3 = $bdd->prepare($sql3);
                $query3->execute(['result2'=>$result2['job_post_id']]);
                $result3 = $query3->fetchAll(PDO::FETCH_ASSOC);
            }
        }else{
            $sql = 'SELECT * FROM `company` NATURAL JOIN `job_post` NATURAL JOIN `skills_needed` NATURAL JOIN `skills` NATURAL JOIN `need` NATURAL JOIN `education`';
            $query = $bdd->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            $sql2 = 'SELECT job_post_id FROM `wishtlist` WHERE account_information_id = :var2' ;
            $query2 = $bdd->prepare($sql2);
            $query2->execute(['var2'=>$var2]);
            $result2 = $query2->fetch(PDO::FETCH_ASSOC);

            if($result2 == false){

            }else{
                $sql3 = 'SELECT * FROM `job_post` NATURAL JOIN `location` NATURAL JOIN `company` NATURAL JOIN `activity` NATURAL JOIN `business_sector` NATURAL JOIN `skills_needed` NATURAL JOIN `skills`
                NATURAL JOIN `need` NATURAL JOIN `education` WHERE job_post_id = :result2' ;
                $query3 = $bdd->prepare($sql3);
                $query3->execute(['result2'=>$result2['job_post_id']]);
                $result3 = $query3->fetchAll(PDO::FETCH_ASSOC);
            }
        }

    }else{
        $sql = 'SELECT * FROM `company` NATURAL JOIN `job_post` NATURAL JOIN `skills_needed` NATURAL JOIN `skills` NATURAL JOIN `need` NATURAL JOIN `education`';
        $query = $bdd->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        $sql2 = 'SELECT job_post_id FROM `wishtlist` WHERE account_information_id = :var2' ;
        $query2 = $bdd->prepare($sql2);
        $query2->execute(['var2'=>$var2]);
        $result2 = $query2->fetch(PDO::FETCH_ASSOC);

        if($result2 == false){

        }else{
        $sql3 = 'SELECT * FROM `job_post` NATURAL JOIN `location` NATURAL JOIN `company` NATURAL JOIN `activity` NATURAL JOIN `business_sector` NATURAL JOIN `skills_needed` NATURAL JOIN `skills`
        NATURAL JOIN `need` NATURAL JOIN `education` WHERE job_post_id = :result2' ;
        $query3 = $bdd->prepare($sql3);
        $query3->execute(['result2'=>$result2['job_post_id']]);
        $result3 = $query3->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Offers</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/styles.css" rel="stylesheet" />
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
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-heart-fill"></i></i></div>
                                <h2 class="fw-bolder">Favorites</h2>
                                <p class="lead fw-normal text-muted mb-5">Find here all the offers you are interesting in</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion mb-5" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThreee">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThreee" aria-expanded="false" aria-controls="collapseThreee">
                                Click here to review your wishlist
                            </button>
                            </h2>
                            <div id="collapseThreee" class="accordion-collapse collapse" aria-labelledby="headingThreee" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                            <?php
                            if($result2 == false){
                            }
                            else{
                            foreach($result3 as $produit2){
                            ?>
                            <div class="col-lg-4 mb-5">
                                <div class="card" style="width: 20rem;">
                                    <img src="<?= $produit2['company_image'] ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $produit2['internship_name'] ?></h5>
                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingOne">
                                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            En savoir plus
                                                        </button>
                                                    </h2>
                                                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                            <strong>Détail de l'offre : </strong> <?= $produit2['internship_description'] ?>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                                
                                        <h5 class="card-title mb-3">Skills : <?= $produit2['skill_name'] ?> level : <?= $produit2['skill_level'] ?>%</h5></p>
                                        <h5 class="card-title mb-3">Graduation Year : <?= $produit2['graduation_year'] ?> Minor : <?= $produit2['minor'] ?></h5></p>
                                        <h5 class="card-title mb-3">Minor : <?= $produit2['minor'] ?></h5></p>
                                        <h5 class="card-title mb-3">Duration : <?= $produit2['duration'] ?> days</h5></p>
                                        <h5 class="card-title mb-3">Salary : <?= $produit2['salary'] ?>€</h5></p>
                                        <div class="card-footer p-0 pt-0 bg-transparent border-top-0">
                                            <div class="d-flex align-items-end justify-content-between">
                                                <div class="d-flex align-items-left">
                                                    <div class="medium">
                                                        <div class="fw-bold"><?= $produit2['company_name'] ?></div>
                                                        <div class="text-muted"><?= $produit2['creation_date'] ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <a href="" class="btn btn-primary">Apply</a>
                                        <input type="hidden" id="id-post" value="<?= $produit2['job_post_id']?>">
                                        <input type="hidden" id="id-person" value="<?= $var2?>">
                                        <div id="btn-favoris">
                                            <button class="btn btn-danger float-end" name="favoris"><i class="bi bi-heart"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                            }
                            ?>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="row gx-5 justify-content-center">
                        <div class="col-lg-8 col-xl-6">
                            <div class="text-center">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-card-checklist"></i></div>
                                <h2 class="fw-bolder">Internship Offers</h2>
                                <p class="lead fw-normal text-muted mb-3">Find here all the internship offers available</p>
                                <a href="create.php" type="button" class="btn btn-primary btn-lg px-4 mb-4"><i class="bi bi-plus-square"></i> Add Offer</a>
                            </div>
                        </div>
                    </div>
                    <div class="row gx-5">
                        <form action="offers-student.php" method="post" name="filter">
                            <div class="form-floating mb-3">
                                <select class="form-select form-select-s mb-3" aria-label=".form-select-m example" name="education_id" value="" required>
                                    <option value="0" selected>Promotion</option>
                                    <option value="0">All</option>
                                    <option value="1">IT - 2025</option>
                                    <option value="2">Generalist - 2025</option>
                                    <option value="3">BTP - 2025</option>
                                    <option value="4">S3E - 2025</option>
                                </select> 
                            </div>
                            <div class="d-grid">
                                <button type="submit" name="filter" class="btn btn-primary btn-lg" value="Submit">Search</button>
                            </div>
                            <br/> 
                        </form>       
                        <?php
                            foreach($result as $produit){
                        ?>
                            <div class="col-lg-4 mb-5">
                                <div class="card" style="width: 20rem;">
                                    <img src="<?= $produit['company_image'] ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $produit['internship_name'] ?></h5>
                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingOne">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="collapseOne" aria-controls="collapseOne">
                                                            Read more
                                                        </button>
                                                    </h2>
                                                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                            <strong>Details : </strong> <?= $produit['internship_description'] ?>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                                
                                        <h5 class="card-title mb-3">Skills : <?= $produit['skill_name'] ?> level : <?= $produit['skill_level'] ?>%</h5></p>
                                        <h5 class="card-title mb-3">Graduation Year : <?= $produit['graduation_year'] ?> Minor : <?= $produit['minor'] ?></h5></p>
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
                                        <form method=POST action=apply-post.php>
                                            <input type="hidden" name="job_post_id" id="job_post_id" value="<?=$produit['job_post_id']?>"></input>
                                            <button type="submit" class="btn btn-primary">Apply</button>
                                        </form>
                                        <input type="hidden" id="id-post" value="<?= $produit['job_post_id']?>">
                                        <input type="hidden" id="id-person" value="<?= $var2?>">
                                        <div id="btn-favoris">
                                            <button class="btn btn-danger float-end" name="favoris"><i class="bi bi-heart"></i></button>
                                        </div>
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
            require_once('../_student/menu-student.php')
        ?>
        <!-- Footer-->
        <?php
            require_once('footer-student.php')
        ?>
    </body>
</html>
