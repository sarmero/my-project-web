<?php
session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/Academy/commons/db.php";

$dep = $_SESSION['department_id'];

$x = $db->prepare("SELECT profession.id, profession.profession
FROM public.profession 
JOIN public.department ON department.id = profession.department_id and department.id = :i");

$x->bindValue(':i', $dep, PDO::PARAM_INT);

$x->execute();
$xr = $x->fetchAll();

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Academy</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/checkout.js"></script>
    <script src="../js/calendar.js"></script>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/offer.css">

    <style>
        td,
        label {
            color: white;
        }
    </style>
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

                        <form action="../services/save_plan_study.php" method="post">
                            <form class="needs-validation" novalidate>

                                <fieldset class="border rounded-3 p-3">
                                    <legend class="float-none w-auto px-3">Plan of study</legend>
                                    <article class=" blog-post">

                                        <div class="row g-3">

                                            <div class="col-8">
                                                <label for="program" class="form-label"
                                                    style="color:white;">Program:</label>
                                                <select class="form-select" name="program" id="program" required>
                                                    <option value="">Choose...</option>
                                                    <?php

                                                    $x = $db->prepare("SELECT profession.id, profession.profession FROM public.profession 
                                                JOIN public.department ON department.id = profession.department_id and department.id = :i");

                                                    $x->bindValue(':i', $dep, PDO::PARAM_INT);

                                                    $x->execute();
                                                    $xr = $x->fetchAll();

                                                    foreach ($xr as $c) {
                                                        echo '<option value="' . $c['id'] . '">' . $c['profession'] . '</option>';
                                                    }

                                                    ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a valid Program.
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <label for="pensum" class="form-label">Pensum</label>
                                                <select class="form-select" name="pensum" id="pensum" required>
                                                    <option value="">Choose...</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a valid country.
                                                </div>
                                            </div>

                                       
                                            <div class="col-2">
                                                <label for="semester" class="form-label">semester</label>
                                                <select class="form-select" name="semester" id="semester" required>
                                                    <option value="">Choose...</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a valid country.
                                                </div>
                                            </div>

                                            <div class="col-5">
                                                <label for="department" class="form-label">Department</label>
                                                <select class="form-select" name="department" id="department" required>
                                                    <option value="">Choose...</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please provide a valid department.
                                                </div>
                                            </div>

                                            <div class="col-5">
                                                <label for="subject" class="form-label">Asignaturas</label>
                                                <select class="form-select" name="subject" id="subject" required>
                                                    <option value="">Choose...</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please provide a valid Asignatura.
                                                </div>
                                            </div>

                                        </div>

                                        <br>

                                        <button class="w-100 btn btn-primary btn-lg" type="submit">Send</button>
                                    </article>
                                </fieldset>
                            </form>
                        </form>
                        <br>
                        <fieldset class="border rounded-3 p-3">
                            <legend class="float-none w-auto px-3">Asignaturas</legend>
                            <article class=" blog-post">

                                <div class="table-responsive">
                                    <table class="table table-striped table table-bordered" id="selectedDatesTable">
                                        <thead class="table-dark">
                                            <tr>
                                                <th class="index">#</th>
                                                <th class="day-column">Asignatura</th>
                                            </tr>
                                        </thead>
                                        <tbody id="selectedDatesTableBody">
                                        </tbody>
                                    </table>
                                </div>


                            </article>
                        </fieldset>
                        <?php
                        include '../commons/footers.php';
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../js/plan_study.js"></script>
    <script src="../js/checkout.js"></script>
</body>

</html>