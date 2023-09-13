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
                    <div class="col-lg-12 col-lg-offset-2">
                        <div class="row g-3">
                            <div class="col-7">
                                <fieldset class="border rounded-3 p-3">
                                    <legend class="float-none w-auto px-3">Eventos</legend>

                                    <div class="col-4">
                                        <label for="event" class="form-label">Type</label>
                                        <select class="form-select" name="event" id="event" required>
                                            <option value="">Choose...</option>
                                            <?php

                                            $d = $db->prepare("SELECT * FROM public.type_event ORDER BY id ASC ");

                                            $d->execute();
                                            $dr = $d->fetchAll();

                                            foreach ($dr as $c) {
                                                echo '<option value="' . $c['id'] . '">' . $c['event'] . '</option>';
                                            }

                                            ?>
                                        </select>
                                    </div>
                                    <br>

                                    <div class="table-responsive">
                                        <table class="table table-striped table table-bordered" id="selectedDatesTable">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th class="index">#</th>
                                                    <th class="day-column">code</th>
                                                    <th class="day-column">event</th>
                                                </tr>
                                            </thead>
                                            <tbody id="selectedDatesTableBody">
                                            </tbody>
                                        </table>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-5">
                                <form action="../services/save_event.php" method="post">
                                    <form class="needs-validation" novalidate>


                                        <fieldset class="border rounded-3 p-3">
                                            <legend class="float-none w-auto px-3">Register</legend>

                                            <div class="row g-3">
                                                <div class="col-8">
                                                    <label for="name" class="form-label">Nombre</label>
                                                    <input type="text" class="form-control" name="name" id="name">

                                                    <div class="invalid-feedback">
                                                        Please select a valid country.
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <label for="program" class="form-label">Type</label>
                                                    <select class="form-select" name="program" id="program" required>
                                                        <option value="">Choose...</option>
                                                        <?php

                                                        $d = $db->prepare("SELECT * FROM public.type_event ORDER BY id ASC ");

                                                        $d->execute();
                                                        $dr = $d->fetchAll();

                                                        foreach ($dr as $c) {
                                                            echo '<option value="' . $c['id'] . '">' . $c['event'] . '</option>';
                                                        }

                                                        ?>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please select a valid country.
                                                    </div>
                                                </div>
                                            </div>

                                            <br>
                                            <button class="w-100 btn btn-primary btn-lg" type="buttom">Send</button>

                                        </fieldset>

                                        <br>
                                        <?php include '../commons/edit.php'; ?>
                                        <br>
                                        <?php include '../commons/delete.php'; ?>
                                    </form>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../js/event.js"></script>
</body>

</html>