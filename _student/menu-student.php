<?php
if($_SESSION["account_type_id"] == 1) {
  $var = "index-student.php";
}elseif($_SESSION["account_type_id"] == 2) {
  $var = "../_delegated/index-delegated.php";
}elseif($_SESSION["account_type_id"] == 3) {
  $var = "../_pilote/index-pilote.php";
}elseif($_SESSION["account_type_id"] == 4) {
  $var = "../_admin/index-admin.php";
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container px-5">
        <a class="navbar-brand" href="<?= $var ?>"><i class="bi bi-search"></i>  JobFinder</a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <?php if($_SESSION["account_type_id"] == 1) {?>
                <li class="nav-item"><a type="button" class="nav-link" href="offers-student.php">Offers</a></li>
                <li class="nav-item"><a class="nav-link" href="faq-student.php">FAQ</a></li>
                <li class="nav-item"><a class="nav-link" href="contact-student.php">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="../logout.php"><i class="bi bi-person-x-fill"></i></a></li>
                <?php } elseif($_SESSION["account_type_id"] == 2) { ?>
                <li class="nav-item"><a class="nav-link" href="manage-delegated.php">Manage</a></li>
                <li class="nav-item"><a class="nav-link" href="offers-delegated.php">Offers</a></li>
                <li class="nav-item"><a class="nav-link" href="faq-delegated.php">FAQ</a></li>
                <li class="nav-item"><a class="nav-link" href="contact-delegated.php">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="../logout.php"><i class="bi bi-person-x-fill"></i></a></li>
                <?php } elseif($_SESSION["account_type_id"] == 3) { ?>
                <li class="nav-item"><a class="nav-link" href="validation-pilote.php">Validation</a></li>
                <li class="nav-item"><a class="nav-link" href="manage-pilote.php">Manage</a></li>
                <li class="nav-item"><a class="nav-link" href="offers-pilote.php">Offers</a></li>
                <li class="nav-item"><a class="nav-link" href="faq-pilote.php">FAQ</a></li>
                <li class="nav-item"><a class="nav-link" href="contact-pilote.php">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="../logout.php"><i class="bi bi-person-x-fill"></i></a></li>
                <?php } elseif($_SESSION["account_type_id"] == 4) { ?>
                <li class="nav-item"><a class="nav-link" href="validation-admin.php">Validation</a></li>
                <li class="nav-item"><a class="nav-link" href="manage-admin.php">Manage</a></li>
                <li class="nav-item"><a class="nav-link" href="offers-admin.php">Offers</a></li>
                <li class="nav-item"><a class="nav-link" href="faq-admin.php">FAQ</a></li>
                <li class="nav-item"><a class="nav-link" href="contact-admin.php">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="../logout.php"><i class="bi bi-person-x-fill"></i></a></li>
                <?php } ?>
              </ul>
        </div>
    </div>
</nav>
