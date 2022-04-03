<?php
    include_once('_db/connexionDB.php');
?>

<?php
    if (isset($_POST['email']) and isset($_POST['password'])){
        $password = trim($_POST['password']);
        $email = $_POST['email'];
    
        $reponse = $bdd->prepare('SELECT * FROM account_information WHERE email = :email');
        $reponse->bindValue('email', $email);
        $reponse->execute();
        $data = $reponse->fetch(PDO::FETCH_ASSOC);
        
        if(!empty($data)){
            $hash = $data['password'];
            $verif = password_verify($password, $hash);
        
            if($verif){
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['account_type_id'] = $data['account_type_id'];
                $_SESSION['firstname'] = $data['firstname'];
                $_SESSION['account_information_id'] = $data['account_information_id'];

                if($data['account_type_id'] == 1){
                    header('Location: _student/index-student.php');
                }
                elseif($data['account_type_id'] == 2){
                    header('Location: _delegated/index-delegated.php');
                }
                elseif($data['account_type_id'] == 3){
                    header('Location: _pilote/index-pilote.php');
                }
                elseif($data['account_type_id'] == 4){
                    header('Location: _admin/index-admin.php');
                }   
            }else{
                echo "Mot de passe incorrect";
            }
                  
        }  
        else{
            $er_mail = "Veuillez renseigner tous les champs";
        }
    }
    else{
        
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>JobFinder</title>
        <?php
            require_once('_head/meta.php');
            require_once('_head/link.php');
            require_once('_head/script.php');
        ?>
    </head>
    <!-- Menu-->
    <?php
        include_once('_menu/menu.php')
    ?>
    <body class="d-flex flex-column">
        <main class="flex-shrink-0">
            <!-- Page content-->
            <form action="login.php" method="post" name="form-login">
                <section class="py-5">
                    <div class="container px-5">
                        <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
                            <div class="text-center mb-5">
                                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-person-check-fill"></i></div>
                                    <h1 class="fw-bolder">Login</h1>
                                    <p class="lead fw-normal text-muted mb-0">Welcome to the connection portal</p>
                                </div>
                                <div class="row gx-5 justify-content-center">
                                    <div class="col-lg-8 col-xl-6">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" value="" required>
                                            <label for="floatingInput">Email address</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" value="" required>
                                            <label for="floatingPassword">Password</label>
                                        </div>
                                        <div class="d-grid">
                                            <button type="submit" name="inscription" class="btn btn-primary btn-lg" value="Submit">Submit</button>
                                        </div>
                                        <br/>
                                        <p class="center">You don't have any account? <a href="inscription.php">Create account</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
        </main>
        <!-- Footer-->
        <?php
            require_once('_footer/footer.php')
        ?>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
