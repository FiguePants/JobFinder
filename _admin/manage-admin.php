<?php
    include_once('../_db/connexionDB.php');
    
    $var = $_SESSION['firstname'];

    if(isset($_POST['account_type_id']) && isset($_POST['education_id'])){
        $account_type_id = $_POST['account_type_id'];
        $education_id = $_POST['education_id'];

        if($account_type_id !== "5" && $education_id !== "5"){

            if($account_type_id !== "0" && $education_id !== "0"){
                $sql = 'SELECT account_information_id, firstname, lastname, email, gender, account_image, account_type_name FROM `account_information` NATURAL JOIN account_type WHERE account_type_id=:account_type_id AND education_id=:education_id';
                $query = $bdd->prepare($sql);
                $query->execute([
                    'account_type_id'=>$account_type_id,
                    'education_id'=>$education_id,
                ]);
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
            }

            if($account_type_id == "0" && $education_id !== "0"){
                $sql = 'SELECT account_information_id, firstname, lastname, email, gender, account_image, account_type_name FROM `account_information` NATURAL JOIN account_type WHERE education_id=:education_id';
                $query = $bdd->prepare($sql);
                $query->execute([
                    'education_id'=>$education_id,
                ]);
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
            }

            if($account_type_id !== "0" && $education_id == "0"){
                $sql = 'SELECT account_information_id, firstname, lastname, email, gender, account_image, account_type_name FROM `account_information` NATURAL JOIN account_type WHERE account_type_id=:account_type_id';
                $query = $bdd->prepare($sql);
                $query->execute([
                    'account_type_id'=>$account_type_id,
                ]);
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
            }

            if($account_type_id == "0" && $education_id == "0"){
                $sql = 'SELECT account_information_id, firstname, lastname, email, gender, account_image, account_type_name FROM `account_information` NATURAL JOIN account_type';
                $query = $bdd->prepare($sql);
                $query->execute();
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
            }

        }else{
            $sql = 'SELECT account_information_id, firstname, lastname, email, gender, account_image, account_type_name FROM `account_information` NATURAL JOIN account_type WHERE account_type_id BETWEEN "1" AND "3"';
            $query = $bdd->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);

        }

    }else{
        $sql = 'SELECT account_information_id, firstname, lastname, email, gender, account_image, account_type_name FROM `account_information` NATURAL JOIN account_type WHERE account_type_id BETWEEN "1" AND "3"';
        $query = $bdd->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
    }

    $sql2 = 'SELECT company.company_name, company.company_id, company.company_description, company.company_image, job_post.job_post_id, job_post.creation_date, job_post.number_of_places, job_post.salary, job_post.duration, job_post.location_id, job_post.account_information_id, job_post.internship_name, job_post.internship_description, location.location_id, location.street_address, location.zip, location.city, activity.business_sector_id, rating.grade FROM company LEFT JOIN job_post ON company.company_id = job_post.company_id LEFT JOIN location ON location.company_id = company.company_id LEFT JOIN activity ON activity.company_id = company.company_id LEFT JOIN rating ON rating.company_id = company.company_id '; 
    $query2 = $bdd->prepare($sql2);
    $query2->execute();
    $result2 = $query2->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Offers</title>
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
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-shield-lock"></i></div>
                            <h2 class="fw-bolder">Manage all the persons</h2>
                            <p class="lead fw-normal text-muted mb-3">Here you can manage all the persons register</p>
                            <a href="add-student.php" type="button" class="btn btn-lg btn-primary"><i class="bi bi-plus-square"></i> Add an account</a>
                        </div>
                        <br/> 
                        <form action="manage-admin.php" method="post" name="filter">
                            <div class="form-floating mb-3">
                                <select class="form-select form-select-s mb-3" aria-label=".form-select-m example" name="account_type_id" value="" required>
                                    <option value="5" selected>Status</option>
                                    <option value="0">All</option>
                                    <option value="1">Student</option>
                                    <option value="2">Delegated</option>
                                    <option value="3">Pilote</option>
                                </select> 
                                <select class="form-select form-select-s mb-3" aria-label=".form-select-m example" name="education_id" value="" required>
                                    <option value="5" selected>Promotion</option>
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
                        </form>    
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
                    <th scope="col">Gender</th>
                    <th scope="col">Account_image</th>
                    <th scope="col">Status</th>
                    <th scope="col">Manage</th>
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
                    <td><?=$produit['gender']?></td>
                    <td><?=$produit['account_image']?></td>
                    <td><?=$produit['account_type_name']?></td>
                    <td>
                        <form method=POST action=modify-student.php>
                            <input type="hidden" name="idstudent" value="<?=$produit['account_information_id']?>"></input>
                            <button type="submit" class="btn btn-primary ">Modify</button>
                        </form>
                        <a href="delete-student.php?id=<?= $produit['account_information_id'] ?>" type="button" class="btn btn-danger">Delete</a>
                    </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
                </table>

                <div class="text-center">
                    <h2 class="fw-bolder">Manage the companies</h2>
                    <p class="lead fw-normal text-muted mb-3">Here you can manage the companies</p>
                    <a href="add-company.php" type="button" class="btn btn-lg btn-primary mb-3"><i class="bi bi-plus-square"></i> Add Company</a>
                </div>
                
                <table class="table table-dark table-striped">
                <thead>
                    <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                    <th scope="col">Adress</th>
                    <th scope="col">City</th>
                    <th scope="col">Zip</th>
                    <th scope="col">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($result2 as $produit2){
                    ?>
                    <tr>
                    <th scope="row"><?=$produit2['company_id']?></th>
                    <td><?=$produit2['company_name']?></td>
                    <td><?=$produit2['company_description']?></td>
                    <td><?=$produit2['company_image']?></td>
                    <td><?=$produit2['street_address']?></td>
                    <td><?=$produit2['city']?></td>
                    <td><?=$produit2['zip']?></td>
                    <td>
                        
                        <form method=POST action=modify-company.php>
                            <input type="hidden" name="company_id" value="<?=$produit2['company_id']?>"></input>
                            <button type="submit" class="btn btn-primary">Modify</button>
                        </form>
                        <a href="delete-company.php?id=<?= $produit2['company_id'] ?>" type="button" class="btn btn-danger">Delete</a>
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
            require_once('footer-admin.php')
        ?>
    </body>
</html>