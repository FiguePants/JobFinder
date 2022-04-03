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

        if(isset($_POST['internship_description'])){
            $business_sector_name = $_POST['business_sector_name'];
            $sql2 = $bdd->prepare('INSERT INTO business_sector(business_sector_name) VALUES (:business_sector_name)');
            //$query2 = $bdd->prepare($sql2);
            $sql2->execute(['business_sector_name'=>$business_sector_name]);
            //$result2 = $query2->fetchAll(PDO::FETCH_ASSOC);

            $company_name = $_POST['company_name'];
            $sql3 = 'SELECT `company_id` FROM `company` WHERE company_name=:company_name';
            $query3 = $bdd->prepare($sql3);
            $query3->execute(['company_name'=>$company_name]);
            $result3 = $query3->fetch(PDO::FETCH_ASSOC);

            $sql4 = 'SELECT `business_sector_id` FROM `business_sector` WHERE business_sector_name = :business_sector_name';
            $query4 = $bdd->prepare($sql4);
            $query4->execute(['business_sector_name'=>$business_sector_name]);
            $result4 = $query4->fetch(PDO::FETCH_ASSOC);

            $sql14 = 'SELECT * FROM `activity` WHERE company_id=:company_id';
            $query14 = $bdd->prepare($sql14);
            $query14->execute([
                'company_id'=>$result3['company_id'],
            ]);
            $result14 = $query14->fetch(PDO::FETCH_ASSOC);
            
            if(empty($result14)){
                $sql5 = 'INSERT INTO `activity`(company_id, business_sector_id) VALUES (:result3, :result4)';
                $query5 = $bdd->prepare($sql5);
                $query5->bindValue('result3', $result3['company_id']);
                $query5->bindValue('result4', $result4['business_sector_id']);
                $query5->execute();
                $result5 = $query5->fetch(PDO::FETCH_ASSOC);
            }
            
            $street_address = $_POST['street_address'];
            $city = $_POST['city'];
            $zip = $_POST['zip'];
            $sql6 = 'INSERT INTO `location`(street_address, city, country, zip, company_id) VALUES (:street_address, :city, "France", :zip, :company_id)';
            $query6 = $bdd->prepare($sql6);
            $query6->execute([
                'street_address'=>$street_address,
                'city'=>$city,
                'zip'=>$zip,
                'company_id'=>$result3['company_id'],
            ]);
            $result6 = $query6->fetch(PDO::FETCH_ASSOC);

            $sql12 = 'SELECT `location_id` FROM `location` WHERE street_address=:street_address AND zip=:zip';
            $query12 = $bdd->prepare($sql12);
            $query12->execute([
                'street_address'=>$street_address,
                'zip'=>$zip,
            ]);
            $result12 = $query12->fetch(PDO::FETCH_ASSOC);

            $skill_name = $_POST['skill_name'];
            $sql7 = 'INSERT INTO `skills` (skill_name) VALUES (:skill_name)';
            $query7 = $bdd->prepare($sql7);
            $query7->execute(['skill_name'=>$skill_name]);
            $result7 = $query7->fetch(PDO::FETCH_ASSOC);

            $sql8 = 'SELECT `skill_id` FROM `skills` WHERE skill_name = :skill_name';
            $query8 = $bdd->prepare($sql8);
            $query8->execute(['skill_name'=>$skill_name]);
            $result8 = $query8->fetch(PDO::FETCH_ASSOC);

            $number_of_places = $_POST['number_of_places'];
            $salary = $_POST['salary'];
            $duration = $_POST['duration'];
            $internship_name = $_POST['internship_name'];
            $internship_description = $_POST['internship_description'];
            $sql9 = 'INSERT INTO `job_post`(number_of_places, salary, duration, creation_date, internship_name, internship_description, location_id, company_id) VALUES (:number_of_places, :salary, :duration, "2022-03-16", :internship_name, :internship_description, :location_id, :company_id)';
            $query9 = $bdd->prepare($sql9);
            $query9->execute([
                'number_of_places'=>$number_of_places,
                'salary'=>$salary,
                'duration'=>$duration,
                'internship_name'=>$internship_name,
                'internship_description'=>$internship_description,
                'location_id'=>$result12['location_id'],
                'company_id'=>$result3['company_id'],
            ]);
            $result9 = $query9->fetch(PDO::FETCH_ASSOC);

            $sql10 = 'SELECT `job_post_id` FROM `job_post` WHERE number_of_places = :number_of_places AND salary = :salary AND duration = :duration';
            $query10 = $bdd->prepare($sql10);
            $query10->execute([
                'number_of_places'=>$number_of_places,
                'salary'=>$salary,
                'duration'=>$duration,
            ]);
            $result10 = $query10->fetch(PDO::FETCH_ASSOC);
            
            $skill_level = $_POST['skill_level'];
            $sql11 = 'INSERT INTO `skills_needed`(job_post_id, skill_id, skill_level) VALUES (:job_post_id, :skill_id, :skill_level)';
            $query11 = $bdd->prepare($sql11);
            $query11->execute([
                'job_post_id'=>$result10['job_post_id'],
                'skill_id'=>$result8['skill_id'],
                'skill_level'=>$skill_level,
            ]);
            $result11 = $query11->fetch(PDO::FETCH_ASSOC);

            $education_id = $_POST['education_id'];
            $sql13 = 'INSERT INTO `need`(job_post_id, education_id) VALUES (:job_post_id, :education_id)';
            $query13 = $bdd->prepare($sql13);
            $query13->execute([
                'job_post_id'=>$result10['job_post_id'],
                'education_id'=>$education_id,
            ]);
            $result13 = $query13->fetch(PDO::FETCH_ASSOC);

            header('Location: offers-pilote.php');
        }
        
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
            <form action="create.php" method="post" name="forms">
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
                                            <input type="text" class="form-control" id="floatingInput" placeholder="address" name="street_address" value="" required>
                                            <label for="floatingInput">Address</label> 
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" for="zipcode" class="form-control" id="zipcode" placeholder="zipcode" name="zip" id="error-message" value="" required>
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
                                                <select class="form-select form-select-s mb-3" aria-label=".form-select-m example" name="education_id" value="" required>
                                                    <option value="" selected>Promotion</option>
                                                    <option value="1">IT - 2025</option>
                                                    <option value="2">Generaliste - 2025</option>
                                                    <option value="3">BTP - 2025</option>
                                                    <option value="4">S3E - 2025</option>
                                                </select>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="skills" name="skill_name" value="" required>
                                            <label for="floatingInput">Skills</label> 
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="level" name="skill_level" value="" required>
                                            <label for="floatingInput">Level</label> 
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="Number of places" name="number_of_places" value="" required>
                                            <label for="floatingInput">Number of places</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="business_sector_name" name="business_sector_name" value="" required>
                                            <label for="floatingInput">Sector</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" placeholder="Description" name="internship_description" id="floatingTextarea"></textarea>
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