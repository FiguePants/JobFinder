<?php
    include_once('../_db/connexionDB.php');
    
    $var = $_SESSION['firstname'];

    $sql = 'SELECT * FROM account_information NATURAL JOIN wishtlist NATURAL JOIN job_post NATURAL JOIN company NATURAL JOIN documents NATURAL JOIN skills NATURAL JOIN skills_needed NATURAL JOIN activity NATURAL JOIN location NATURAl JOIN education WHERE job_post_id=:job_post_id';
    $query = $bdd->prepare($sql);
    $query->execute(['job_post_id'=>$_POST['job_post_id']]);
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>More</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="../jquery/themes/bootstrap/easyui.css">
        <link rel="stylesheet" type="text/css" href="../jquery/themes/icon.css">
        <script type="text/javascript" src="../jquery/jquery.min.js"></script>
        <script type="text/javascript" src="../jquery/jquery.easyui.min.js"></script>
    </head>
    <body class="d-flex flex-column h-100">
        <main class="flex-shrink-0"> 
            <section class="py-5">
            <div class="container px-5 my-5">
                <div class="row gx-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6">
                        <div class="text-center">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-bookmark-plus"></i></div>
                            <h2 class="fw-bolder">Internship</h2>
                            <p class="lead fw-normal text-muted mb-3">Here you can find more information about the internship</p>
                        </div>
                    </div>
                </div>
            </div>
                <div class="container px-5 my-5">
                <div class="row gx-5">
                        <?php
                            foreach($result as $produit){
                        ?>
                            <div class="col-lg-4 mb-5">
                                <div class="card" style="width: 20rem;">
                                    <img src="<?= $produit['company_image'] ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $produit['internship_name'] ?> </h5>
                                        
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
                                        <h5 class="card-title mb-3">Graduation Year : <?= $produit['graduation_year'] ?></h5></p>
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
                                        <a href="validation-pilote.php" class="btn btn-primary">Close</a>
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
            require_once('footer-pilote.php')
        ?>
    </body>
</html>