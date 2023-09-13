<?php
session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/Academy/commons/db.php";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Academy</title>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/checkout.js"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/offer.css">
</head>

<body>
    <div id="wrapper">
        <?php include '../commons/menu_admin.php'; ?>
        <div id="page-content-wrapper">
            <button type="button" class="hamburger animated fadeInLeft is-closed" data-toggle="offcanvas">
                <span class="hamb-top"></span>
                <span class="hamb-middle"></span>
                <span class="hamb-bottom"></span>
            </button>

            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-lg-offset-2">

                        <form action="/Academy/services/save_student.php" method="post">
                            <form class="needs-validation" novalidate>

                                <?php
                                include "../commons/info_user.php";
                                ?>

                                <br>
                                <fieldset class="border rounded-3 p-3">
                                    <legend class="float-none w-auto px-3">information Academic</legend>
                                    <article class=" blog-post">

                                        <div class="row g-3">
                                            <div class="col-sm-12">
                                                <label for="program" class="form-label">Program</label>
                                                <select class="form-select" name="program" id="program" required
                                                    alt="gandalf">
                                                    <option value="">Choose...</option>
                                                    <?php

                                                    $p = 2;

                                                    $d = $db->prepare("SELECT profession.id, profession.profession
                                                    FROM public.profession 
                                                    JOIN public.department ON department.id = profession.department_id and department.id = :i");

                                                    $d->bindValue(':i', $p, PDO::PARAM_INT);

                                                    $d->execute();
                                                    $dr = $d->fetchAll();

                                                    foreach ($dr as $c) {
                                                        echo '<option value="' . $c['id'] . '">' . $c['profession'] . '</option>';
                                                    }

                                                    ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a valid program.
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="pensum" class="form-label">Pensum</label>
                                                <select class="form-select" name="pensum" id="pensum" required>
                                                    <option value="">Choose...</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please provide a valid state.
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="semester" class="form-label">semester</label>
                                                <select class="form-select" name="semester" id="semester" required>
                                                    <option value="">Choose...</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a valid semester.
                                                </div>
                                            </div>
                                        </div>

                                    </article>
                                </fieldset>

                                <hr class="my-4">

                                <button class="w-100 btn btn-primary btn-lg" type="submit">Send</button>
                                <br><br>
                            </form>

                        </form>
                        <?php
                        include '../commons/footers.php';
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../js/checkout.js"></script>
    <script src="../js/user.js"></script>
</body>

</html>