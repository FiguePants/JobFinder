<?php
    include_once('../_db/connexionDB.php');
    $var = $_SESSION['firstname'];
    $var2 = $_SESSION['account_information_id'];
    $id = $_POST['job_post_id'];

    $stmt = $bdd->prepare("SELECT job_post_id FROM job_post WHERE job_post_id=:job_post_id");
    $stmt->execute(['job_post_id'=>$id]); 
    $user = $stmt->fetch();

    if(isset($_POST['cv'])){
        $cv = $_POST['cv'];
        $cover_letter = $_POST['cover_letter'];
        $job_post_id = $_POST['job_post_id'];

        $stmt2 = $bdd->prepare("SELECT * FROM documents WHERE job_post_id=:job_post_id AND account_information_id=:account_information_id");
        $stmt2->execute([
            'job_post_id'=>$job_post_id,
            'account_information_id'=>$var2,
        ]); 
        $user2 = $stmt2->fetch();

        $stmt3 = $bdd->prepare("SELECT * FROM wishtlist WHERE job_post_id=:job_post_id AND account_information_id=:account_information_id");
        $stmt3->execute([
            'job_post_id'=>$job_post_id,
            'account_information_id'=>$var2,
        ]); 
        $user3 = $stmt3->fetch();

        if(empty($user2)){
            $sql = $bdd->prepare('INSERT INTO documents(cv, cover_letter, account_information_id, job_post_id) VALUES (:cv, :cover_letter, :account_information_id, :job_post_id)');
            $sql->execute([
                'cv'=>$cv,
                'cover_letter'=>$cover_letter,
                'account_information_id'=>$var2,
                'job_post_id'=>$job_post_id,
            ]);

            $sql2 = $bdd->prepare('UPDATE job_post SET account_information_id=:account_information_id WHERE job_post_id = :job_post_id');
            $sql2->execute([
                'account_information_id'=>$var2,
                'job_post_id'=>$job_post_id,
            ]);

            if(empty($user3)){
                $sql5 = $bdd->prepare('INSERT INTO wishtlist(job_post_id, account_information_id, apply) VALUES (:job_post_id, :account_information_id, "1")');
                $sql5->execute([
                'account_information_id'=>$var2,
                'job_post_id'=>$job_post_id,
                ]);
            }else{
                $sql6 = $bdd->prepare('UPDATE wishtlist SET apply="1" WHERE job_post_id = :job_post_id AND account_information_id = :account_information_id)');
                $sql6->execute([
                    'account_information_id'=>$var2,
                    'job_post_id'=>$job_post_id,
                    ]);
            }

        }else{
            $sql3 = $bdd->prepare('UPDATE documents SET cv=:cv, cover_letter=:cover_letter WHERE job_post_id = :job_post_id');
            $sql3->execute([
            'cv'=>$cv,
            'cover_letter'=>$cover_letter,
            'job_post_id'=>$job_post_id,
            ]);

            $sql4 = $bdd->prepare('UPDATE job_post SET account_information_id=:account_information_id WHERE job_post_id = :job_post_id');
            $sql4->execute([
            'account_information_id'=>$var2,
            'job_post_id'=>$job_post_id,
            ]);

            if(empty($user3)){
                    $sql5 = $bdd->prepare('INSERT INTO wishtlist(job_post_id, account_information_id, apply) VALUES (:job_post_id, :account_information_id, "1")');
                    $sql5->execute([
                    'account_information_id'=>$var2,
                    'job_post_id'=>$job_post_id,
                    ]);
                }else{
                    $sql6 = $bdd->prepare('UPDATE wishtlist SET apply="1" WHERE job_post_id=:job_post_id AND account_information_id=:account_information_id');
                    $sql6->execute([
                        'account_information_id'=>$var2,
                        'job_post_id'=>$job_post_id,
                        ]);
                }
            }

        header('Location: offers-student.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Apply</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/styles.css" rel="stylesheet" />
    </head>
    <body class="d-flex flex-column h-100">
        <main class="flex-shrink-0">
            <!-- Page Content-->
            <section class="py-5">
                <div class="container px-5 my-5">
                    <form action="apply-post.php" method="post" name="apply">
                        <section class="py-5">
                            <div class="container px-5">
                                <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
                                    <div class="text-center mb-5">
                                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-award"></i></div>
                                            <h1 class="fw-bolder">Apply to this job offer</h1>
                                            <p class="lead fw-normal text-muted mb-0">Please fill in all fields</p>
                                        </div>
                                        <div class="row gx-5 justify-content-center">
                                            <div class="col-lg-8 col-xl-6">
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label">CV :</label>
                                                    <input class="form-control" type="file" id="formFile" name="cv" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label">Cover letter :</label>
                                                    <input class="form-control" type="file" id="formFile" name="cover_letter" required>
                                                </div>
                                                <br/>
                                                <input type="hidden" name="job_post_id" id="job_post_id" value="<?= $user[0]?>">
                                                <div class="d-grid">
                                                    <a href="offers-student.php" type="button" name="cancel" class="btn btn-danger mb-3 btn-lg" value="">Cancel</a>
                                                    <button type="submit" name="apply" class="btn btn-primary btn-lg" value="Submit">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </form>
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
