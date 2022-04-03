<?php
    include_once('../_db/connexionDB.php');
    
    $var = $_SESSION['firstname'];

    $sql = 'SELECT * FROM account_information NATURAL JOIN wishtlist NATURAL JOIN job_post NATURAL JOIN company NATURAL JOIN documents';
    $query = $bdd->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Validation</title>
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
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-check2-circle"></i></i></div>
                            <h2 class="fw-bolder">Validation of internships</h2>
                            <p class="lead fw-normal text-muted mb-3">Here you can see the students who have applied for an internship, and validate or not their request</p>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Firstname</th>
                    <th scope="col">Lastname</th>
                    <th scope="col">Email</th>
                    <th scope="col">Internship</th>
                    <th scope="col">Company</th>
                    <th scope="col">Validation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($result as $produit){
                    ?>
                    <tr>
                    <th scope="row"><?=$produit['account_information_id']?></th>
                    <td><?=$produit['firstname']?></td>
                    <td><?=$produit['lastname']?></td>
                    <td><?=$produit['email']?></td>
                    <td><?=$produit['internship_name']?></td>
                    <td><?=$produit['company_name']?></td>
                    <td>
                        <form method=POST action=more-pilote.php>
                            <input type="hidden" name="job_post_id" value="<?=$produit['job_post_id']?>"></input>
                            <button type="submit" class="btn btn-primary">More</button>
                        </form>
                        <form method=POST action=validate.php>
                            <input type="hidden" name="account_information_id" value="<?=$produit['account_information_id']?>"></input>
                            <input type="hidden" name="job_post_id" value="<?=$produit['job_post_id']?>"></input>
                            <button type="submit" class="btn btn-success">Validate</button>
                        </form>
                        <form method=POST action=decline.php>
                            <input type="hidden" name="account_information_id" value="<?=$produit['account_information_id']?>"></input>
                            <input type="hidden" name="job_post_id" value="<?=$produit['job_post_id']?>"></input>
                            <button type="submit" class="btn btn-danger ">Decline</button>
                        </form>
                    </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
                </table>
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