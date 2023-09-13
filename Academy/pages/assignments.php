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
                    <div class="col-lg-12 col-lg-offset-2 ">

                        <fieldset class="border rounded-3 p-3">
                            <legend class="float-none w-auto px-3">Student</legend>

                            <label for="firstName" class="form-label">username</label>
                            <form class="needs-validation" novalidate>
                                <div class="row">
                                    <div class="col-6">

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input type="number" class="form-control" id="firstName" name="name"
                                                    placeholder="" value="" required>
                                                <div class="invalid-feedback">
                                                    Valid Name is required.
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <button class="btn btn-success" type="button">Search</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>

                            <br>
                            <div class="row">
                                <div class="col-3">
                                    <label class="form-label">Name</label>
                                </div>
                                <div class="col-3">
                                    <label class="form-label">last name</label>
                                </div>
                                <div class="col-2">
                                    <label class="form-label">semestre</label>
                                </div>
                                <div class="col-4">
                                    <label class="form-label">Programa</label>
                                </div>
                            </div>

                            <div id="data" class="row"></div>

                            <br><br>
                            <h4>Asignaciones</h4>

                            <form class="needs-validation" novalidate>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="program" class="form-label">Type</label>
                                        <select class="form-select" name="type" id="type" required>
                                            <option value="">Choose...</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a valid type event.
                                        </div>

                                    </div>
                                    <div class="col-8">
                                        <label for="program" class="form-label">Event</label>
                                        <select class="form-select" name="event" id="event" required>
                                            <option value="">Choose...</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a valid event.
                                        </div>
                                    </div>

                                </div>

                                <br>
                                <button class="w-100 btn btn-primary" type="button">Send</button>
                            </form>
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
    <script src="../js/assignments.js"></script>
    <script src="../js/checkout.js"></script>
</body>

</html>