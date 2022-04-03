<?php
    include_once('../_db/connexionDB.php');
    
    $var = $_SESSION['firstname']; //voir si le POST fonctionne 
    
    $id_post = $_POST["job_post_id"];

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

        header('Location: offers-pilote.php');
    }

    // On écrit notre requête
    $sql = 'SELECT * FROM `job_post` NATURAL JOIN `activity` NATURAL JOIN `need` NATURAL JOIN `business_sector` NATURAL JOIN `skills` NATURAL JOIN `skills_needed` NATURAL JOIN `location` NATURAL JOIN `company` WHERE job_post_id=:job_post_id';
    // On prépare la requête
    $query = $bdd->prepare($sql);
    // On exécute la requête
    $query->execute(["job_post_id"=>$id_post]);
    // On stocke le résultat dans un tableau associatif
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    //Enregistrer les modifications

    $sql_bis = 'SELECT * FROM `job_post` NATURAL JOIN `activity` NATURAL JOIN `need` NATURAL JOIN `business_sector` NATURAL JOIN `skills` NATURAL JOIN `skills_needed` NATURAL JOIN `location` NATURAL JOIN `company` WHERE job_post_id=:job_post_id';
    $query_bis = $bdd->prepare($sql_bis);
    $query_bis->execute(["job_post_id"=>$id_post]);
    $result_bis = $query->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST['company_name'])){

        $internship_name = $_POST['internship_name'];
        $company_name = $_POST['company_name'];
        $duration = $_POST['duration'];
        $street_address = $_POST['street_address'];
        $zip = $_POST['zip'];
        $city = $_POST['city'];
        $salary = $_POST['salary'];
        $education_id = $_POST['education_id'];
        $skill_name = $_POST['skill_name'];
        $skill_level = $_POST['skill_level'];
        $number_of_places = $_POST['number_of_places'];
        $internship_description = $_POST['internship_description'];
        $job_post_id = $_POST['job_post_id'];
        $location_id = $result_bis['location_id'];
        $company_id = $result_bis['company_id'];
        $business_sector_id = $result_bis['business_sector_id'];
        $business_sector_id = $result_bis['business_sector_id'];
        $skill_id = $result_bis['skill_id'];
        $neweducation_id = $result_bis['education_id'];
        
        if(!empty($company_name)){
                $req = $bdd->prepare('UPDATE job_post SET /*company_id=:company_id,*/ number_of_places=:number_of_places, salary=:salary, duration=:duration, internship_name=:internship_name, internship_description=:internship_description WHERE job_post_id = :job_post_id');
                $req->execute([//company_id voir
                /*'company_id' =>$company_id,*/
                'number_of_places'=>$number_of_places,
                'salary' =>$salary,
                'duration' =>$duration,
                'internship_name' =>$internship_name,
                'internship_description' =>$internship_description,
                'job_post_id' =>$job_post_id,
                ]);
                
                $req2 = $bdd->prepare('UPDATE location SET street_address=:street_address, zip=:zip, city=:city WHERE location_id = :location_id');
                $req2->execute([
                'street_address' =>$street_address,
                'zip' =>$zip,
                'city' =>$city,
                'location_id' =>$location_id,
                ]);

                $req3 = $bdd->prepare('UPDATE skills SET skill_name=:skill_name WHERE skill_id=:skill_id');
                $req3->execute([
                'skill_name' =>$skill_name,
                'skill_id' =>$skill_id,
                ]);

                $req4 = $bdd->prepare('UPDATE skills_needed SET skill_level=:skill_level WHERE job_post_id = :job_post_id');
                $req4->execute([
                'job_post_id' =>$job_post_id,
                'skill_level' =>$skill_level,
                ]);

                $req5 = $bdd->prepare('UPDATE need SET education_id=:education_id WHERE job_post_id = :job_post_id AND education_id = :neweducation_id');
                $req5->execute([
                'job_post_id' =>$job_post_id,
                'education_id' =>$education_id,
                'neweducation_id' =>$neweducation_id,
                ]);
/*
                $req2 = $bdd->prepare('UPDATE job_post NATURAL JOIN location NATURAL JOIN activity NATURAL JOIN business_sector SET number_of_places=:number_of_places, salary=:salary, duration=:duration, internship_name=:internship_name, internship_description=:internship_description, street_adress=:street_address, zip=:zip, city=:city, education_id=:education_id, skill_name=:skill_name, skill_level=:skill_level, business_sector_name=:business_sector_name WHERE job_post_id = :job_post_id');
                $req->execute([
                'number_of_places'=>$number_of_places,
                'salary' =>$salary,
                'duration' =>$duration,
                'internship_name' =>$internship_name,
                'internship_description' =>$internship_description,
                'street_address' =>$street_address,
                'zip' =>$zip,
                'city' =>$city,
                'education_id' =>$education_id,
                'skill_name' =>$skill_name,
                'skill_level' =>$skill_level,
                'business_sector_name' =>$business_sector_name,
                'job_post_id' =>$job_post_id,
                ]);*/

        }
        else{
            echo "Erreur, un ou plusieurs champs";
        }
        header('Location: offers-pilote.php');
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
                <form action="modify-post.php" method="post" name="forms">
                    <section class="py-5">
                        <div class="container px-5">
                            <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
                                <div class="text-center mb-5">
                                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-pencil"></i></i></div>
                                        <h1 class="fw-bolder">Modify</h1>
                                        <p class="lead fw-normal text-muted mb-0">Here you can edit the job offer</p>
                                    </div>
                                    <div class="row gx-5 justify-content-center">
                                        <div class="col-lg-8 col-xl-6">
                                            <?php
                                                foreach($result as $produit){
                                            ?>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="internship_name" name="internship_name" value="<?=$produit['internship_name']?>" required>
                                                <label for="floatingInput">Internship Name</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="company" name="company_name" value="<?=$produit['company_name']?>" required>
                                                <label for="floatingInput">Company</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="duration" name="duration" value="<?=$produit['duration']?>" required>
                                                <label for="floatingInput">Duration</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="address" name="street_address" value="<?=$produit['street_address']?>" required>
                                                <label for="floatingInput">Address</label> 
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" for="zipcode" class="form-control" id="zipcode" placeholder="zipcode" name="zip" id="error-message" value="<?=$produit['zip']?>" required>
                                                <label for="floatingInput">Zipcode</label>
                                                <div style="display: none; color: #f55;" id="error-message"></div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <select class="form-control" name="city" id="city" value="<?=$produit['city']?>">
                                                </select>
                                                <label for="floatingInput">City</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="salary" name="salary" value="<?=$produit['salary']?>" required>
                                                <label for="floatingInput">Salary</label> 
                                            </div>
                    
                                            <div class="form-floating mb-3">
                                                    <select class="form-select form-select-s mb-3" aria-label=".form-select-m example" name="education_id" value="" required>
                                                        <option value="<?=$produit['education_id']?>" selected>Promotion</option>
                                                        <option value="1">IT - 2025</option>
                                                        <option value="2">Generaliste - 2025</option>
                                                        <option value="3">BTP - 2025</option>
                                                        <option value="4">S3E - 2025</option>
                                                    </select>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="skill_name" name="skill_name" value="<?=$produit['skill_name']?>" required>
                                                <label for="floatingInput">Skills</label> 
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="level" name="skill_level" value="<?=$produit['skill_level']?>" required>
                                                <label for="floatingInput">Level</label> 
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="Number of places" name="number_of_places" value="<?=$produit['number_of_places']?>" required>
                                                <label for="floatingInput">Number of places</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" placeholder="Description" name="internship_description" value="<?=$produit['internship_description']?>" id="floatingTextarea">
                                                <label for="floatingTextarea">Description</label>
                                            </div>
                                            <div class="d-grid">
                                            <input type="hidden" name="job_post_id" value="<?=$produit['job_post_id']?>">
                                            <a href="offers-pilote.php" type="button" name="cancel" class="btn btn-danger mb-3 btn-lg" value="">Cancel</a>
                                                <button type="submit" name="inscription" class="btn btn-primary btn-lg" value="Submit">Save changes</button>
                                            </div>
                                            <?php
                                                }
                                            ?>
                                            <div class="container" id="container">
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
            require_once('footer-pilote.php')
        ?>

<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="script.js"></script>
        <script>
           $(document).ready(function(){
            const apiUrl = 'https://geo.api.gouv.fr/communes?codePostal=';
            const format = '&format=json';

            let zipcode = $('#zipcode'); let city = $('#city'); let errorMessage = $('#error-message'); 

            $(zipcode).on('blur', function(){
                let code = $(this).val();
                //console.log(code);
                let url = apiUrl+code+format;
                //console.log(url);

                fetch(url, {method: 'get'}).then(response => response.json()).then(results => {
                    //console.log(results);
                    $(city).find('option').remove();
                    if(results.length){
                        $(errorMessage).text('').hide();
                        $.each(results, function(key, value){
                            //console.log(value);
                            console.log(value.nom);
                            $(city).append('<option value="'+value.nom+'">'+value.nom+'</option>');
                        });
                    }
                    else{
                        if($(zipcode).val()){
                            console.log('Erreur de code postal.');
                            $(errorMessage).text('Aucune commmune avec ce code postal.').show();
                        }
                        else{
                            $(errorMessage).text('').hide();
                        }
                    }
                }).catch(err => {
                    console.log(err);
                    $(city).find('option').remove();
                });
            });
        });
        </script>

    </body>
</html>
