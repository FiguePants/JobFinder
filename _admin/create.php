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



        //
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
        <title>Create Offer</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/styles.css" rel="stylesheet" />
    </head>
    <!-- Menu-->
    <?php
            require_once('../_student/menu-student.php');
    ?>
    <body class="d-flex flex-column">
        <main class="flex-shrink-0">
            <!-- Page content-->
            <form action="inscription.php" method="post" name="forms">
                <section class="py-5">
                    <div class="container px-5">
                        <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
                            <div class="text-center mb-5">
                                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-person-plus-fill"></i></div>
                                    <h1 class="fw-bolder">Create</h1>
                                    <p class="lead fw-normal text-muted mb-0">Add a new offer to the JobFinder's platform</p>
                                </div>
                                <div class="row gx-5 justify-content-center">
                                    <div class="col-lg-8 col-xl-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="internship_name" name="internship_name" value="" required>
                                            <label for="floatingInput">Internship Name</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="company" name="company_name" value="" required>
                                            <label for="floatingInput">Company</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="duration" name="duration" value="" required>
                                            <label for="floatingInput">Duration</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="location" name="location" value="" required>
                                            <label for="floatingInput">Address</label> 
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" for="zipcode" class="form-control" id="zipcode" placeholder="name@example.com" name="email" id="error-message" value="" required>
                                            <label for="floatingInput">Zipcode</label>
                                            <div style="display: none; color: #f55;" id="error-message"></div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select class="form-control" name="city" id="city">
                                            </select>
                                            <label for="floatingInput">City</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="salary" name="salary" value="" required>
                                            <label for="floatingInput">Salary</label> 
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select class="form-select form-select-s mb-3" aria-label=".form-select-m example" name="gender" value="" required>
                                                <option value="" selected><?= $produit['graduation_year'] ?></option>
                                                <p><?= $produit['graduation_year'] ?></P>
                                            </select> 
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="salary" name="salary" value="" required>
                                            <label for="floatingInput">Graduation Year</label> 
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="salary" name="salary" value="" required>
                                            <label for="floatingInput">Minor</label> 
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="salary" name="salary" value="" required>
                                            <label for="floatingInput">Skills</label> 
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="salary" name="salary" value="" required>
                                            <label for="floatingInput">Level</label> 
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="duration" name="duration" value="" required>
                                            <label for="floatingInput">Number of places</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" placeholder="Description" id="floatingTextarea"></textarea>
                                            <label for="floatingTextarea">Description</label>
                                        </div>
                                        <div class="d-grid">
                                            <button type="submit" name="inscription" class="btn btn-primary btn-lg" value="Submit">Submit</button>
                                        </div>

                                        <div class="container" id="container">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
			</div>
		</div><!-- /.container -->
        </main>
        <!-- Footer-->
        <?php
            require_once('../_footer/footer.php');
        ?>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
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