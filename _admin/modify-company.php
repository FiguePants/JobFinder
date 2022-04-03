<?php
    include_once('../_db/connexionDB.php');
    
    $var = $_SESSION['firstname'];

    // On écrit notre requête
    $sql = 'SELECT * FROM `company` WHERE company_id=:company_id';

    // On prépare la requête
    $query = $bdd->prepare($sql);

    // On exécute la requête
    $query->execute(["company_id"=>$_POST["company_id"]]);

    // On stocke le résultat dans un tableau associatif
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    /*$sql2 = 'SELECT company.company_name, company.company_id, company.company_description, company.company_image, job_post.job_post_id, job_post.creation_date, job_post.number_of_places, job_post.salary, job_post.duration, job_post.location_id, job_post.account_information_id, job_post.internship_name, job_post.internship_description, location.location_id, location.street_address, location.zip, location.city, activity.business_sector_id, rating.grade FROM company LEFT JOIN job_post ON company.company_id = job_post.company_id LEFT JOIN location ON location.company_id = company.company_id LEFT JOIN activity ON activity.company_id = company.company_id LEFT JOIN rating ON rating.company_id = company.company_id';
    $query2 = $bdd->prepare($sql2);
    $query2->execute();
    $result2 = $query2->fetchAll(PDO::FETCH_ASSOC);*/

    //Enregistrer les modifications
    if(isset($_POST['modify'])){

        $company_id = $_POST['company_id'];
        $company_name = $_POST['company_name'];
        $company_description = $_POST['company_description'];
        $company_image = $_POST['company_image'];
        
        if(!empty($company_name)){
                $req = $bdd->prepare('UPDATE company SET company_name = :company_name, company_description = :company_description, company_image = :company_image WHERE company_id = :company_id');
                $req->execute([
                'company_name'=>$company_name,
                'company_description' =>$company_description,
                'company_image' =>$company_image,
                'company_id' =>$company_id,
                ]);
        }
        else{
            echo "Erreur, un ou plusieurs champs";
        }
        header('Location: manage-admin.php');
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
                <form action="modify-company.php" method="post" name="form-modify-company">
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
                                                <input type="text" class="form-control" id="floatingInput" placeholder="company_name" name="company_name" value="<?=$produit['company_name']?>" required>
                                                <label for="floatingInput">Company Name</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="company_description" name="company_description" value="<?=$produit['company_description']?>" required>
                                                <label for="floatingInput">Description</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="company_image" name="company_image" value="<?=$produit['company_image']?>" required>
                                                <label for="floatingInput">Image</label> 
                                            </div>
                                            
                                            <div class="d-grid">
                                                <a href="manage-delegated.php" type="button" name="cancel" class="btn btn-danger mb-3 btn-lg" value="">Cancel</a>
                                                <button type="submit" name="modify" class="btn btn-primary btn-lg" value="Submit">Save changes</button>
                                            </div>
                                            <input type="hidden" name="company_id" value="<?=$produit['company_id']?>">
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
            require_once('footer-admin.php')
        ?>
    </body>
</html>
