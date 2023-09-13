<?php
session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/Academy/commons/db.php";

$dep = $_SESSION['department_id'];
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


                        <form class="needs-validation" novalidate>
                            <fieldset class="border rounded-3 p-3">
                                <legend class="float-none w-auto px-3">Programming of subject</legend>
                                <div class="row g-3">
                                    <div class="col-4">
                                        <label for="calendar" class="form-label">Calendar</label>
                                        <select class="form-select" name="calendar" id="calendar" required>
                                            <option value="">Choose...</option>
                                            <?php
                                            $d = $db->prepare("SELECT * FROM public.calendar ORDER BY id ASC");

                                            $d->execute();
                                            $dr = $d->fetchAll();

                                            foreach ($dr as $c) {
                                                echo '<option value="' . $c['id'] . '">' . $c['description'] . '</option>';
                                            }

                                            ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a valid country.
                                        </div>
                                    </div>

                                    <div class="col-8">
                                        <label for="program" class="form-label">Program</label>
                                        <select class="form-select" name="program" id="program" required>
                                            <option value="">Choose...</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a valid country.
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <label for="pensum" class="form-label">Pensum</label>
                                        <select class="form-select" name="pensum" id="pensum" required>
                                            <option value="">Choose...</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a valid country.
                                        </div>
                                    </div>


                                    <div class="col-3">
                                        <label for="semester" class="form-label">semester</label>
                                        <select class="form-select" name="semester" id="semester" required>
                                            <option value="">Choose...</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a valid country.
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <label for="state" class="form-label">department</label>
                                        <select class="form-select" name="state" id="state" required>
                                            <option value="">Choose...</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a valid country.
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <label for="region" class="form-label">Region</label>
                                        <select class="form-select" name="region" id="region" required>
                                            <option value="">Choose...</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please provide a valid state.
                                        </div>
                                    </div>




                                    <div class="col-6">
                                        <label for="subject" class="form-label">Subject offer</label>
                                        <select class="form-select" name="subject" id="subject" required>
                                            <option value="">Choose...</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please provide a valid state.
                                        </div>
                                    </div>


                                    <div class="col-6">
                                        <label for="teacher" class="form-label">teacher</label>
                                        <select class="form-select" name="teacher" id="teacher" required>
                                            <option value="">Choose...</option>
                                            <?php
                                            $d = $db->prepare("SELECT teacher.id, users.first_name FROM public.teacher
                                            JOIN public.users ON users.id = teacher.user_id 
                                            JOIN public.department ON department.id = teacher.department_id and department.id = :i
                                            ORDER BY users.first_name ASC");

                                            $d->bindValue(':i', $dep, PDO::PARAM_INT);
                                            $d->execute();

                                            $d->execute();
                                            $dr = $d->fetchAll();

                                            foreach ($dr as $c) {
                                                echo '<option value="' . $c['id'] . '">' . $c['first_name'] . '</option>';
                                            }

                                            ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a valid country.
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                        <br>

                        <fieldset class="border rounded-3 p-3">
                            <legend class="float-none w-auto px-3">Fechas y Horas</legend>
                            <div>
                                <?php include '../commons/date_selected.php' ?>
                            </div>
                        </fieldset>

                        <hr class="my-4">

                        <button class="w-100 btn btn-primary btn-lg" type="submit">Send</button>


                        

                        <?php
                        include '../commons/footers.php';
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../js/calendar.js"></script>
    <script src="../js/save_calendar.js"></script>
</body>

</html>