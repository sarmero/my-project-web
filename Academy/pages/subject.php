<?php
session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/Academy/commons/db.php";

$dep = $_SESSION['department_id'];

$x = $db->prepare("SELECT subject.subject, subject.code from public.subject 
JOIN department ON department.id = subject.department_id and department.id = :i
ORDER BY subject.subject ASC ");

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
                    <div class="col-lg-12 col-lg-offset-2">

                        <div class="row">

                            <div class="col-7">
                                <fieldset class="border rounded-3 p-3">
                                    <legend class="float-none w-auto px-3">Program</legend>
                                    <div class="table-responsive">
                                        <table class="table table-striped table table-bordered" id="selectedDatesTable">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th class="index">#</th>
                                                    <th class="day-column">Code</th>
                                                    <th class="day-column">Asignatura</th>
                                                </tr>
                                            </thead>
                                            <tbody id="selectedDatesTableBody">
                                                <?php
                                                $n = 1;
                                                foreach ($xr as $c) {
                                                    echo '<tr>
                                                            <td class="align-middle text-center" style="color:white;">' . $n . '</td>
                                                            <td class="align-middle text-center" style="color:white;">' . $c['code'] . '</td>
                                                            <td class="align-middle" style="color:white;">' . $c['subject'] . '</td>
                                                        <tr>';
                                                    $n++;
                                                }


                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </fieldset>


                            </div>

                            <div class="col-5">
                                <div class="position-sticky" style="top: 0rem;">
                                    <fieldset class="border rounded-3 p-3">
                                        <legend class="float-none w-auto px-3">Register</legend>

                                        <form action="../services/save_subject.php" method="post">
                                            <form class="needs-validation" novalidate>

                                                <label for="subject" class="form-label"
                                                    style="color:white;">Nombre:</label>
                                                <input type="text" class="form-control" name="subject" id="subject"
                                                    required>

                                                <div class="invalid-feedback">
                                                    Please select a valid name.
                                                </div>

                                                <br>
                                                <button class="w-100 btn btn-success btn-lg" type="buttom">Send</button>
                                            </form>
                                        </form>

                                    </fieldset>

                                    <br>
                                    <?php include '../commons/delete.php'; ?>
                                    <br>
                                    <?php include '../commons/edit.php'; ?>


                                </div>
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

    <script src="../js/jquery.min.js"></script>
    <script src="../js/checkout.js"></script>
    <script src="../js/subject.js"></script>
</body>

</html>