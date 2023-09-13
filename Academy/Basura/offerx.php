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
    <link rel="stylesheet" href="../css/main-profile.css">
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

                        <h4 class="mb-3 text-center">Offer</h4>

                        <form action="../services/save_offer.php" method="post">
                            <form class="needs-validation" novalidate>

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
                                </div>


                                <div class="row g-3">
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


                                </div>

                                <div class="g-3">
                                    <label for="subject" class="form-label">Subject offer</label>
                                    <select class="form-select" name="subject" id="subject" required>
                                        <option value="">Choose...</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please provide a valid state.
                                    </div>
                                </div>
                                <br>
                                <button class="w-100 btn btn-primary btn-lg" type="submit">Send</button>
                            </form>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../js/offer_list.js"></script>
    <script src="../js/checkout.js"></script>
</body>

</html>