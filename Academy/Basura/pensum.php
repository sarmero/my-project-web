<?php
session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/Academy/commons/db.php";

$dep = $_SESSION['department_id'];

$ps = $db->prepare("SELECT curriculum.description, profession.profession FROM public.curriculum 
JOIN public.profession ON profession.id = curriculum.profession_id
JOIN public.department ON department.id = profession.department_id and department.id = :i
ORDER BY curriculum.description ASC");

$ps->bindValue(':i', $dep, PDO::PARAM_INT);

$ps->execute();
$pr = $ps->fetchAll();

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

                        <h4 class="mb-3 text-center" style="color:white;">Pensum</h4>

                        <form action="../services/save_pensum.php" method="post">
                            <form class="needs-validation" novalidate>

                                <div class="row g-3">
                                    <div class="col-8">
                                        <label for="name" class="form-label" style="color:white;">Nombre:</label>
                                        <input type="text" class="form-control" name="name" id="name" required>

                                        <div class="invalid-feedback">
                                            Please select a valid Name.
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <label for="program" class="form-label" style="color:white;">Program:</label>
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
                                </div>

                                <br>

                                <button class="w-100 btn btn-primary btn-lg" type="submit">Send</button>
                            </form>
                        </form>

                        <br>

                        <div class="table-responsive">
                            <table class="table table-striped table table-bordered" id="selectedDatesTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="index">#</th>
                                        <th >Pensum</th>
                                        <th >Program</th>
                                    </tr>
                                </thead>
                                <tbody id="selectedDatesTableBody">
                                    <?php
                                    $n = 1;
                                    foreach ($pr as $c) {
                                        echo '<tr>
                                                <td class="align-middle text-center" style="color:white;">' . $n . '</td>
                                                <td class="align-middle" style="color:white;">' . $c[0] . '</td>
                                                <td class="align-middle" style="color:white;">' . $c[1] . '</td>
                                            <tr>';
                                        $n++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/checkout.js"></script>
</body>

</html>