<?php
    include_once('../_db/connexionDB.php');
    
    $var = $_SESSION['firstname'];
    const API_URL = 'https://geo.api.gouv.fr/';

    if(!empty($_POST['zipcode']) && !empty($_POST['city']))
    {
        $zipcode = strip_tags($_POST['zipcode']);
        $city = strip_tags($_POST['city']);

        $client = new GuzzleHttp\Client(['base_uri' => API_URL]);

        $response = $client->request('GET', 'communes?codePostal='.$zipcode.'&fields=nom&format=json');
        $response = json_decode($response->getBody()->getContents());

        $cities = [];

        foreach($response as $resp){
            array_push($cities, $resp->nom);
        }

        if(in_array($city, $cities)){
            $success = 'Informations envoyées';
        }
        else{
            $error = 'Le code postal et la commune ne correspondent pas.';
        }
    }

    if(isset($_POST['company_name'])){

        $company_name = $_POST['company_name'];
        $company_description = $_POST['company_description'];
        $company_image = $_POST['company_image'];
        $business_sector_name = $_POST['business_sector_name'];
        $street_address = $_POST['street_address'];
        
        if(!empty($company_name) AND !empty($company_description) AND !empty($company_image)){
    
            $req = $bdd->prepare('INSERT INTO company(company_name, company_description, company_image)
            VALUES(:company_name, :company_description, :company_image)');
            $req->execute([
            'company_name'    =>$company_name,
            'company_description' =>$company_description,
            'company_image' =>$company_image,
            ]);

            $req2 = $bdd->prepare('INSERT INTO business_sector(business_sector_name)
            VALUES(:business_sector_name)');
            $req2->execute([
            'business_sector_name' =>$business_sector_name,
            ]);


            }
            header('Location: manage-delegated.php');
        }
        else{
            echo "Erreur, un ou plusieurs champs";
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
                <form action="add-company.php" method="post" name="forms">
                    <section class="py-5">
                        <div class="container px-5">
                            <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
                                <div class="text-center mb-5">
                                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-clipboard-plus"></i></div>
                                        <h1 class="fw-bolder">Add Company</h1>
                                        <p class="lead fw-normal text-muted mb-0">You can add a company to the platform</p>
                                    </div>
                                    <div class="row gx-5 justify-content-center">
                                        <div class="col-lg-8 col-xl-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="company_name" name="company_name" value="" required>
                                                <label for="floatingInput">Name</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <textarea class="form-control" name="company_description" placeholder="company_description" id="floatingTextarea"> </textarea>
                                                <label for="floatingTextarea">Description</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="business_sector_name" name="business_sector_name" value="" required>
                                                <label for="floatingTextarea">Business Sector</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="street_address" name="street_address" value="" required>
                                                <label for="floatingInput">Adress</label> 
                                            </div>
                                            
                                            <div class="form-floating mb-3">
                                                <input type="text" for="zipcode" class="form-control" id="zipcode" placeholder="zipcode" name="zip" id="error-message" value="" required>
                                                <label for="floatingInput">Zipcode</label>
                                                <div style="display: none; color: #f55;" id="error-message"></div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="city" name="city" value="" required>
                                                <label for="floatingInput">City</label> 
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="Image" name="company_image" value="" required>
                                                <label for="floatingInput">Image</label> 
                                            </div>
                                            <div class="d-grid">
                                                <a href="manage-admin.php" type="button" name="cancel" class="btn btn-danger mb-3 btn-lg" value="">Cancel</a>
                                                <button type="submit" name="inscription" class="btn btn-primary btn-lg" value="Submit">Submit</button>
                                            </div>
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
