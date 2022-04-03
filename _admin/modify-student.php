<?php
    include_once('../_db/connexionDB.php');
    
    $var = $_SESSION['firstname'];

    // On écrit notre requête
    $sql = 'SELECT * FROM `account_information` NATURAL JOIN `education` NATURAL JOIN `campus` NATURAL JOIN `account_type` WHERE account_information_id = :idstudent';

    // On prépare la requête
    $query = $bdd->prepare($sql);

    // On exécute la requête
    $query->execute(["idstudent"=>$_POST["idstudent"]]);

    // On stocke le résultat dans un tableau associatif
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    /*$sql2 = 'SELECT company.company_name, company.company_id, company.company_description, company.company_image, job_post.job_post_id, job_post.creation_date, job_post.number_of_places, job_post.salary, job_post.duration, job_post.location_id, job_post.account_information_id, job_post.internship_name, job_post.internship_description, location.location_id, location.street_address, location.zip, location.city, activity.business_sector_id, rating.grade FROM company LEFT JOIN job_post ON company.company_id = job_post.company_id LEFT JOIN location ON location.company_id = company.company_id LEFT JOIN activity ON activity.company_id = company.company_id LEFT JOIN rating ON rating.company_id = company.company_id';
    $query2 = $bdd->prepare($sql2);
    $query2->execute();
    $result2 = $query2->fetchAll(PDO::FETCH_ASSOC);*/

    //Enregistrer les modifications
    if(isset($_POST['modify'])){

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $campus_id = $_POST['campus_id'];
        $education_id = $_POST['education_id'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $account_type_id = $_POST['account_type_id'];
        $account_image = $_POST['account_image'];
        $account_information_id = $_POST['account_information_id'];
        
        if(!empty($email)){
                $req = $bdd->prepare('UPDATE account_information SET firstname = :firstname, lastname = :lastname, email = :email, gender = :gender, account_image = :account_image, account_type_id = :account_type_id, campus_id = :campus_id, education_id = :education_id WHERE account_information_id = :account_information_id');
                $req->execute([
                'email'    =>$email,
                'gender' =>$gender,
                'firstname' =>$firstname,
                'lastname' =>$lastname,
                'account_image' =>$account_image,
                'campus_id' =>$campus_id,
                'account_type_id' =>$account_type_id,
                'education_id' =>$education_id,
                'account_information_id' => $account_information_id,
                ]);
        }
        else{
            echo "Erreur, un ou plusieurs champs";
        }
        header('Location: manage-delegated.php');
    }

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
    </head>
    <body class="d-flex flex-column h-100">
        <main class="flex-shrink-0">
            <!-- Page Content-->
            <!-- Blog preview section-->
            <section class="py-5">
                <form action="modify-student.php" method="post" name="form-modify-student">
                    <section class="py-5">
                        <div class="container px-5">
                            <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
                                <div class="text-center mb-5">
                                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-pencil"></i></div>
                                        <h1 class="fw-bolder">Modify</h1>
                                        <p class="lead fw-normal text-muted mb-0">Here you can edit the data</p>
                                    </div>
                                    <div class="row gx-5 justify-content-center">
                                        <div class="col-lg-8 col-xl-6">
                                            <?php
                                                foreach($result as $produit){
                                            ?>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="account_image" name="account_image" value="<?=$produit['account_image']?>" required>
                                                <label for="floatingInput">Account image</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="lastname" name="lastname" value="<?=$produit['lastname']?>" required>
                                                <label for="floatingInput">Lastname</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="Password" name="firstname" value="<?=$produit['firstname']?>" required>
                                                <label for="floatingInput">Firstname</label> 
                                            </div>
                                            <div class="form-floating mb-3">
                                                <select class="form-select form-select-s mb-3" aria-label=".form-select-m example" name="gender" value="" required>
                                                    <option value="<?=$produit['gender']?>" selected><?=$produit['gender']?></option>
                                                    <option value="F">Female</option>
                                                    <option value="M">Male</option>
                                                    <option value="O">Other</option>
                                                </select> 
                                            </div>
                                            <div class="form-floating mb-3">
                                                <select class="form-select form-select-s mb-3" aria-label=".form-select-m example" name="campus_id" value="" required>
                                                    <option value="<?=$produit['campus_id']?>" selected><?=$produit['campus_location']?></option>
                                                    <option value="1">Nice</option>
                                                    <option value="2">Toulouse</option>
                                                </select> 
                                            </div>
                                            <div class="form-floating mb-3">
                                                <select class="form-select form-select-s mb-3" aria-label=".form-select-m example" name="education_id" value="" required>
                                                    <option value="<?=$produit['account_type_id']?>" selected><?=$produit['minor']?> <?=$produit['graduation_year']?></option>
                                                    <option value="1">IT - 2025</option>
                                                    <option value="2">Generaliste - 2025</option>
                                                    <option value="3">BTP - 2025</option>
                                                    <option value="4">S3E - 2025</option>
                                                </select>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <select class="form-select form-select-s mb-3" aria-label=".form-select-m example" name="account_type_id" value="" required>
                                                    <option value="<?=$produit['account_type_id']?>" selected><?=$produit['account_type_id']?></option>
                                                    <option value="1">Student</option>
                                                    <option value="2">Delegated</option>
                                                    <option value="3">Pilote</option>
                                                </select>
                                            </div>
                                            
                                            <div class="form-floating mb-3">
                                                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" value="<?=$produit['email']?>" required>
                                                <label for="floatingInput">Email</label>
                                            </div>
                                            
                                            <div class="d-grid">
                                                <a href="manage-delegated.php" type="button" name="cancel" class="btn btn-danger mb-3 btn-lg" value="">Cancel</a>
                                                <button type="submit" name="modify" class="btn btn-primary btn-lg" value="Submit">Save changes</button>
                                            </div>
                                            <input type="hidden" name="account_information_id" value="<?=$produit['account_information_id']?>">
                                            <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </form>
            </section>
        </main>
        <!-- Menu-->
        <?php
            require_once('../_student/menu-student.php')
        ?>
        <!-- Footer-->
        <?php
            require_once('footer-delegated.php')
        ?>
    </body>
</html>
