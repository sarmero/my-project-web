<?php
session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/Academy/commons/db.php";

$dep = $_SESSION['department_id'];

$x = $db->prepare("SELECT subject.subject from public.subject 
JOIN department ON department.id = subject.department_id and department.id = :i
ORDER BY subject.subject ASC ");

$x->bindValue(':i', $dep, PDO::PARAM_INT);
$x->execute();

$subject = $x->fetchAll();

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

                        <h3 class="mb-3 text-center" style="color:white;">Asignaturas</h3>

                        <form action="../services/save_subject.php" method="post">
                            <form class="needs-validation" novalidate>

                                <div class="row g-3">
                                    <div class="col-10">
                                        <label for="subjectx" class="form-label" style="color:white;">Nombre:</label>
                                        <input type="text" class="form-control" name="subjectx" id="subjectx">

                                        <div class="invalid-feedback">
                                            Please select a valid subject.
                                        </div>
                                    </div>

                                    <div class="col-2">
                                    <br>
                                        <button class="w-100 btn btn-primary" type="submit">Send</button>
                                    </div>
                                </div>


                            </form>
                        </form>

                        <br>

                        <div class="table-responsive">
                            <table class="table table-striped table table-bordered" id="selectedDatesTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="index">#</th>
                                        <th class="day-column">Asignatura</th>
                                    </tr>
                                </thead>
                                <tbody id="selectedDatesTableBody">
                                    <?php
                                    $n = 1;
                                    foreach ($subject as $c) {
                                        echo '<tr>
                                                <td class="align-middle text-center" style="color:white;">' . $n . '</td>
                                                <td class="align-middle" style="color:white;">' . $c[0] . '</td>
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