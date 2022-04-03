<?php
    include_once('../_db/connexionDB.php');
    
    $var = $_SESSION['firstname'];

    if(isset($_POST['email'])){

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $campus_id = $_POST['campus_id'];
        $education_id = $_POST['education_id'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_ARGON2I);
        $account_type_id = $_POST['account_type_id'];
        $account_image = $_POST['account_image'];
        
        if(!empty($email) AND !empty($password)){
    
            $stmt = $bdd->prepare("SELECT * FROM account_information WHERE email=?");
            $stmt->execute([$email]); 
            $user = $stmt->fetch();
            if ($user) {
                $message='Adresse mail déjà utilisée';
                echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
            } 
            else{
                $req = $bdd->prepare('INSERT INTO account_information(email, password, gender, firstname, lastname, account_image, education_id, account_type_id, campus_id)
                VALUES(:email, :password, :gender, :firstname, :lastname, :account_image, :education_id, (SELECT account_type_id FROM account_type WHERE account_type_name = :account_type_id), :campus_id)');
                $req->execute([
                'email'    =>$email,
                'password' =>$password,
                'gender' =>$gender,
                'firstname' =>$firstname,
                'lastname' =>$lastname,
                'account_image' =>$account_image,
                'campus_id' =>$campus_id,
                'account_type_id' =>$account_type_id,
                'education_id' =>$education_id,
                ]);
            }
        }
        else{
            echo "Erreur, un ou plusieurs champs";
        }
        header('Location: manage-pilote.php');
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
                <form action="add-student.php" method="post" name="forms">
                    <section class="py-5">
                        <div class="container px-5">
                            <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
                                <div class="text-center mb-5">
                                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-person-plus-fill"></i></div>
                                        <h1 class="fw-bolder">Add</h1>
                                        <p class="lead fw-normal text-muted mb-0">You can create an account</p>
                                    </div>
                                    <div class="row gx-5 justify-content-center">
                                        <div class="col-lg-8 col-xl-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="account_image" name="account_image" value="" required>
                                                <label for="floatingInput">Account image</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="lastname" name="lastname" value="" required>
                                                <label for="floatingInput">Lastname</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="Password" name="firstname" value="" required>
                                                <label for="floatingInput">Firstname</label> 
                                            </div>
                                            <div class="form-floating mb-3">
                                                <select class="form-select form-select-s mb-3" aria-label=".form-select-m example" name="gender" value="" required>
                                                    <option value="" selected>Gender</option>
                                                    <option value="F">Female</option>
                                                    <option value="M">Male</option>
                                                    <option value="O">Other</option>
                                                </select> 
                                            </div>
                                            <div class="form-floating mb-3">
                                                <select class="form-select form-select-s mb-3" aria-label=".form-select-m example" name="campus_id" value="" required>
                                                    <option value="" selected>Campus</option>
                                                    <option value="1">Nice</option>
                                                    <option value="2">Toulouse</option>
                                                </select> 
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
                                                <select class="form-select form-select-s mb-3" aria-label=".form-select-m example" name="account_type_id" value="" required>
                                                    <option value="" selected>Role</option>
                                                    <option value="student">Student</option>
                                                    <option value="delegated">Delegated</option>
                                                    <option value="pilote">Pilote</option>
                                                </select>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" value="" required>
                                                <label for="floatingInput">Email address</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" value="" required>
                                                <label for="floatingPassword">Password</label>
                                            </div>
                                            <div class="d-grid">
                                                <a href="manage-pilote.php" type="button" name="cancel" class="btn btn-danger mb-3 btn-lg" value="">Cancel</a>
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
            require_once('footer-pilote.php')
        ?>
    </body>
</html>
