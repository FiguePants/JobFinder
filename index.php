<?php
    require_once('_db/connexionDB.php');
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
        <!-- PWA -->
        <link rel="manifest" href="manifest.json">
        <link rel="apple-touch-icon" href="assets/icons/icon-96x96.png">
        <meta name="apple-mobile-web-app-status-bar" content="white">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="theme-color" content="white">
    </head>
    <body class="d-flex flex-column h-100">
        <main class="flex-shrink-0">
            <!-- Header-->
            <header class="bg-dark py-5">
                <div class="container px-5">
                    <div class="row gx-5 align-items-center justify-content-center">
                        <div class="col-lg-8 col-xl-7 col-xxl-6">
                            <div class="my-5 text-center text-xl-start">
                                <h1 class="display-5 fw-bolder text-white mb-2">Find your dreaming internship</h1>
                                <p class="lead fw-normal text-white-50 mb-4">The leading platform to find your internship, around you or wherever in the world.</p>
                                <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                                    <a class="btn btn-primary btn-lg px-4 me-sm-3" href="offers.php">Our Offers</a>
                                    <a class="btn btn-outline-light btn-lg px-4" href="#features">Learn More</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center"><img class="img-fluid rounded-3 my-5" src="./assets/images/entreprise.jpg" alt="Affichage" /></div>
                    </div>
                </div>
            </header>
            <!-- Features section-->
            <section class="py-5" id="features">
                <div class="container px-5 my-5">
                    <div class="row gx-5">
                        <div class="col-lg-4 mb-5 mb-lg-0"><h2 class="fw-bolder mb-0">A better way to start your research.</h2></div>
                        <div class="col-lg-8">
                            <div class="row gx-5 row-cols-1 row-cols-md-2">
                                <div class="col mb-5 h-100">
                                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-briefcase-fill"></i></div>
                                    <h2 class="h5">Offers</h2>
                                    <p class="mb-0">Around 20 offers per day are posted on our website. We are conviced that you will find the internship of your dreams.</p>
                                </div>
                                <div class="col mb-5 h-100">
                                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-person-plus-fill"></i></div>
                                    <h2 class="h5">+40000</h2>
                                    <p class="mb-0">It's the number of students that have already found an internship since the creation of the platform.</p>
                                </div>
                                <div class="col mb-5 mb-md-0 h-100">
                                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-building"></i></div>
                                    <h2 class="h5">Companies</h2>
                                    <p class="mb-0">More than 1000 companies use our platform to find the perfect talent for their needs.</p>
                                </div>
                                <div class="col h-100">
                                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-alarm-fill"></i></div>
                                    <h2 class="h5">2 weeks</h2>
                                    <p class="mb-0">It's the average time for a student to find an internship which correspond to his objectives, using our platform.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Testimonial section-->
            <div class="py-5 bg-light">
                <div class="container px-5 my-5">
                    <div class="row gx-5 justify-content-center">
                        <div class="col-lg-10 col-xl-7">
                            <div class="text-center">
                                <div class="fs-4 mb-4 fst-italic">"Working with JobFinder's platform has saved me tons of searching time when I was trying to find an internship! JobFinder just makes things easier!"</div>
                                <div class="d-flex align-items-center justify-content-center">
                                    <img class="rounded-circle me-3" src="./assets/images/bernard.png" alt="CCNA" />
                                    <div class="fw-bold">
                                        Ben Ladinde
                                        <span class="fw-bold text-primary mx-1">/</span>
                                        Student, CESI
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Blog preview section-->
            <section class="py-5">
                <div class="container px-5 my-5 text-center">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe width="80%" height="480px" src="https://www.youtube.com/embed/nh3F1K50XFU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </section>
        </main>
        <!-- Menu-->
        <?php
            require_once('_menu/menu.php')
        ?>
        <!-- Footer-->
        <?php
            require_once('_footer/footer.php')
        ?>
        <script src="js/app.js"> </script>
    </body>
</html>
