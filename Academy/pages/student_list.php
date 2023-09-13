<?php

session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/Academy/commons/db.php";

$idd = $_SESSION['id'];
$dep = $_SESSION['department_id'];

$d = $db->prepare("SELECT profession.profession,profession.id
FROM public.profession where profession.department_id = :i");

$d->bindValue(':i', $dep, PDO::PARAM_INT);

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

                        <fieldset class="border rounded-3 p-3">
                            <legend class="float-none w-auto px-3">Students</legend>
                            <article class=" blog-post">

                                <div class="row">
                                    <div class="col-8">
                                        <label for="program" class="form-label">Program</label>
                                        <select class="form-select" name="program" id="program" required>
                                            <option value="">Choose...</option>
                                            <?php
                                            foreach ($dr as $c) {
                                                echo '<option value="' . $c['id'] . '">' . $c['profession'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-4">
                                        <label for="semester" class="form-label">semester</label>
                                        <select class="form-select" name="semester" id="semester" required>
                                            <option value="">Choose...</option>
                                        </select>
                                    </div>

                                

                                    <div class="col-6">
                                        <label for="state" class="form-label">department</label>
                                        <select class="form-select" name="state" id="state" required>
                                            <option value="">Choose...</option>
                                        </select>
                                    </div>

                                    <div class="col-6">
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
                                                <th scope="col">User</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Last name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Phone</th>
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
    <script src="../js/student.js"></script>
</body>

</html>