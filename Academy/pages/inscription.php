<?php

session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/Academy/commons/db.php";

$idd = $_SESSION['id'];
$dep = $_SESSION['department_id'];

$d = $db->prepare("SELECT * FROM public.calendar ORDER BY id ASC");

$d->execute();
$dr = $d->fetchAll();

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
                    <div class="col-lg-12 col-lg-offset-2">
                        <form class="needs-validation" novalidate>
                            <fieldset class="border rounded-3 p-3">
                                <legend class="float-none w-auto px-3">Inscriptions</legend>
                                <article class=" blog-post">

                                    <div class="row g-3">
                                        <div class="col-3">
                                            <label for="calendar" class="form-label">Calendar</label>
                                            <select class="form-select" name="calendar" id="calendar" required>
                                                <option value="">Choose...</option>
                                                <?php

                                                foreach ($dr as $c) {
                                                    echo '<option value="' . $c['id'] . '">' . $c['description'] . '</option>';
                                                }

                                                ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a valid country.
                                            </div>
                                        </div>

                                        <div class="col-9">
                                            <label for="program" class="form-label">Program</label>
                                            <select class="form-select" name="program" id="program" required>
                                                <option value="">Choose...</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a valid country.
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

                                        <div class="col-4">
                                            <label for="state" class="form-label">department</label>
                                            <select class="form-select" name="state" id="state" required>
                                                <option value="">Choose...</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a valid department.
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <label for="region" class="form-label">Region</label>
                                            <select class="form-select" name="region" id="region" required>
                                                <option value="">Choose...</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please provide a valid region.
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <label for="semester" class="form-label">semester</label>
                                            <select class="form-select" name="semester" id="semester" required>
                                                <option value="">Choose...</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a valid country.
                                            </div>
                                        </div>

                                        <div class="col-8">
                                            <label for="subject" class="form-label">Asignatura</label>
                                            <select class="form-select" name="subject" id="subject" required>
                                                <option value="">Choose...</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please provide a valid asignatura.
                                            </div>
                                        </div>

                                       

                                        <br>
                                        <div class="table-responsive">
                                            <table class="table table-striped table table-bordered"
                                                id="selectedDatesTable">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th class="index">#</th>
                                                        <th class="day-column">code</th>
                                                        <th class="day-column">Name</th>
                                                        <th class="day-column">last name</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="selectedDatesTableBody">
                                                </tbody>
                                            </table>
                                        </div>



                                    </div>

                                </article>
                            </fieldset>
                        </form>
                    </div>
                    <?php
                    include '../commons/footers.php';
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../js/inscription.js"></script>
</body>

</html>