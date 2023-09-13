<?php

session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/Academy/commons/db.php";

$idd = $_SESSION['id'];
$dep = $_SESSION['department_id'];

$d = $db->prepare("SELECT * FROM public.calendar ORDER BY id ASC");

$d->execute();
$cal = $d->fetchAll();

$x = $db->prepare("SELECT * FROM public.state_offer ORDER BY state_offer.state ASC ");
$x->execute();
$st = $x->fetchAll();

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
                    <div class="col-lg-12 col-lg-offset-2">

                        <div class="row">
                            <div class="col-8">
                                <div class="position-sticky" style="top: 0rem;">
                                    <fieldset class="border rounded-3 p-3">
                                        <legend class="float-none w-auto px-3">offers</legend>
                                        <article class=" blog-post">

                                            <div class="row g-3">
                                                <div class="col-4">
                                                    <label for="calendar" class="form-label">Calendar</label>
                                                    <select class="form-select" name="calendar" id="calendar" required>
                                                        <option value="">Choose...</option>
                                                        <?php
                                                        foreach ($cal as $c) {
                                                            echo '<option value="' . $c['id'] . '">' . $c['description'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="col-8">
                                                    <label for="program" class="form-label">Program</label>
                                                    <select class="form-select" name="program" id="program" required>
                                                        <option value="">Choose...</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="row g-3">
                                                <div class="col-3">
                                                    <label for="pensum" class="form-label">Pensum</label>
                                                    <select class="form-select" name="pensum" id="pensum" required>
                                                        <option value="">Choose...</option>
                                                    </select>
                                                </div>


                                                <div class="col-3">
                                                    <label for="semester" class="form-label">semester</label>
                                                    <select class="form-select" name="semester" id="semester" required>
                                                        <option value="">Choose...</option>
                                                    </select>
                                                </div>

                                                <div class="col-3">
                                                    <label for="state" class="form-label">department</label>
                                                    <select class="form-select" name="state" id="state" required>
                                                        <option value="">Choose...</option>
                                                    </select>
                                                </div>

                                                <div class="col-3">
                                                    <label for="region" class="form-label">Region</label>
                                                    <select class="form-select" name="region" id="region" required>
                                                        <option value="">Choose...</option>
                                                    </select>
                                                </div>

                                            </div>

                                            <br>

                                            <div class="table-responsive">
                                                <table class="table table-striped table table-bordered align-middle">
                                                    <thead class="table-dark">
                                                        <tr>
                                                            <th class="text-center" scope="col">#</th>
                                                            <th scope="col">Code</th>
                                                            <th scope="col">Asignatura</th>
                                                            <th scope="col">State</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody id="selectedDatesTableBody">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </article>
                                    </fieldset>
                                </div>

                            </div>

                            <div class="col-4 ">

                                <fieldset class="border rounded-3 p-3">
                                    <legend class="float-none w-auto px-3">Register</legend>
                                    <article class=" blog-post">


                                        <form class="needs-validation" novalidate>

                                            <label for="xcalendar" class="form-label">Calendar</label>
                                            <select class="form-select" name="xcalendar" id="xcalendar" required>
                                                <option value="">Choose...</option>
                                                <?php
                                                foreach ($cal as $c) {
                                                    echo '<option value="' . $c['id'] . '">' . $c['description'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a valid calendar.
                                            </div>

                                            <label for="xprogram" class="form-label">Program</label>
                                            <select class="form-select" name="xprogram" id="xprogram" required>
                                                <option value="">Choose...</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a valid program.
                                            </div>


                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="xpensum" class="form-label">Pensum</label>
                                                    <select class="form-select" name="xpensum" id="xpensum" required>
                                                        <option value="">Choose...</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please select a valid pensum.
                                                    </div>
                                                </div>


                                                <div class="col-6">
                                                    <label for="xsemester" class="form-label">semester</label>
                                                    <select class="form-select" name="xsemester" id="xsemester"
                                                        required>
                                                        <option value="">Choose...</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please select a valid semester.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="xstate" class="form-label">department</label>
                                                    <select class="form-select" name="xstate" id="xstate" required>
                                                        <option value="">Choose...</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please select a valid department.
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <label for="xregion" class="form-label">Region</label>
                                                    <select class="form-select" name="xregion" id="xregion" required>
                                                        <option value="">Choose...</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please provide a valid region.
                                                    </div>
                                                </div>
                                            </div>


                                            <label for="xsubject" class="form-label">Asignatura</label>
                                            <select class="form-select" name="xsubject" id="xsubject" required>
                                                <option value="">Choose...</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please provide a valid asignatura.
                                            </div>

                                            <br>
                                            <button class="w-100 btn btn-success btn-lg" type="button">Send</button>
                                        </form>


                                    </article>
                                </fieldset>

                                <br>
                                <div class="">

                                    <fieldset class="border rounded-3 p-3">
                                        <legend class="float-none w-auto px-3">Edit</legend>
                                        <article class=" blog-post">
                                            <form class="needs-validation" novalidate>
                                                <label for="statex" class="form-label">State</label>
                                                <select class="form-select" name="statex" id="statex" required>
                                                    <?php
                                                    foreach ($st as $c) {
                                                        echo '<option value="' . $c['id'] . '">' . $c['state'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a valid state.
                                                </div>


                                                <label for="codeEdit" class="form-label">Code:</label>
                                                <div class=" row">
                                                    <div class="col-8">
                                                        <input type="text" class="form-control" name="codeEdit"
                                                            id="codeEdit" required>
                                                        <div class="invalid-feedback">
                                                            Please select a valid code.
                                                        </div>
                                                    </div>

                                                    <div class="col-4">
                                                        <button class="w-100 btn btn-primary align-middle"
                                                            type="button">Edit</button>
                                                    </div>
                                                </div>

                                            </form>
                                        </article>
                                    </fieldset>
                                </div>

                                <br>
                                <?php include '../commons/delete.php'; ?>

                            </div>

                        </div>
                    </div>
                    <br>
                    <?php
                    include '../commons/footers.php';
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../js/offer.js"></script>
    <script src="../js/offer_register.js"></script>
    <script src="../js/checkout.js"></script>
</body>

</html>