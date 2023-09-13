<?php
session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/Academy/commons/db.php";

$dep = $_SESSION['department_id'];

$x = $db->prepare("SELECT curriculum.code, curriculum.description, profession.profession FROM public.curriculum 
JOIN public.profession ON profession.id = curriculum.profession_id
JOIN public.department ON department.id = profession.department_id and department.id = :i
ORDER BY curriculum.description ASC");

$x->bindValue(':i', $dep, PDO::PARAM_INT);

$x->execute();
$xr = $x->fetchAll();

$s = $db->prepare("SELECT profession.id, profession.profession FROM public.profession 
JOIN public.department ON department.id = profession.department_id and department.id = :i");

$s->bindValue(':i', $dep, PDO::PARAM_INT);

$s->execute();
$sr = $s->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Academy</title>
    <script src="../js/jquery.min.js"></script>
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

                            <div class="col-8">
                                <fieldset class="border rounded-3 p-3">
                                    <legend class="float-none w-auto px-3">Pensum</legend>
                                    <div class="table-responsive">
                                        <table class="table table-striped table table-bordered" id="selectedDatesTable">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th class="index">#</th>
                                                    <th class="day-column">Code</th>
                                                    <th class="day-column">description</th>
                                                    <th class="day-column">Program</th>
                                                </tr>
                                            </thead>
                                            <tbody id="selectedDatesTableBody">
                                                <?php
                                                $n = 1;
                                                foreach ($xr as $c) {
                                                    echo '<tr>
                                                        <td class="align-middle text-center" style="color:white;">' . $n . '</td>
                                                        <td class="align-middle text-center" style="color:white;">' . $c['code'] . '</td>
                                                        <td class="align-middle text-center" style="color:white;">' . $c['description'] . '</td>
                                                        <td class="align-middle" style="color:white;">' . $c['profession'] . '</td>
                                                    <tr>';
                                                    $n++;
                                                }

                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="col-4">
                                <div class="position-sticky" style="top: 0rem;">
                                    <fieldset class="border rounded-3 p-3">
                                        <legend class="float-none w-auto px-3">Register</legend>

                                        <form action="../services/save_pensum.php" method="post">
                                            <form class="needs-validation" novalidate>
                                                <label for="name" class="form-label"
                                                    style="color:white;">Nombre:</label>
                                                <input type="text" class="form-control" name="name" id="name" required>

                                                <div class="invalid-feedback">
                                                    Please select a valid name.
                                                </div>

                                                <br>

                                                <label for="program" class="form-label"
                                                    style="color:white;">Program:</label>
                                                <select class="form-select" name="program" id="program" required>
                                                    <option value="">Choose...</option>

                                                    <?php
                                                    foreach ($sr as $c) {
                                                        echo '<option value="' . $c['id'] . '">' . $c['profession'] . '</option>';
                                                    }
                                                    ?>

                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a valid Program.
                                                </div>
                                                <br>
                                                <button class="w-100 btn btn-success btn-lg" type="buttom">Send</button>
                                            </form>
                                        </form>

                                    </fieldset>

                                    <br>

                                    <div class="">

                                        <fieldset class="border rounded-3 p-3">
                                            <legend class="float-none w-auto px-3">Edit</legend>
                                            <article class=" blog-post">
                                                <form class="needs-validation" novalidate>

                                                    <label for="codeEdit" class="form-label">Code:</label>
                                                    <input type="text" class="form-control" name="codeEdit"
                                                        id="codeEdit" required>
                                                    <div class="invalid-feedback">
                                                        Please select a valid code.
                                                    </div>
                                                    <br>

                                                    <label for="newName" class="form-label">New name:</label>
                                                    <input type="text" class="form-control" name="newName" id="newName"
                                                        required>
                                                    <div class="invalid-feedback">
                                                        Please select a valid name.
                                                    </div>
                                                    <br>

                                                    <label for="xprogram" class="form-label"
                                                        style="color:white;">Program:</label>
                                                    <select class="form-select" name="xprogram" id="xprogram" required>
                                                        <option value="">Choose...</option>

                                                        <?php
                                                        foreach ($sr as $c) {
                                                            echo '<option value="' . $c['id'] . '">' . $c['profession'] . '</option>';
                                                        }

                                                        ?>

                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please select a valid Program.
                                                    </div>

                                                    <br>
                                                    <button class="w-100 btn btn-primary align-middle"
                                                        type="button">Edit</button>

                                                </form>
                                            </article>
                                        </fieldset>
                                    </div>

                                    <br>
                                    <?php include '../commons/delete.php'; ?>
                                    
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../js/checkout.js"></script>
    <script src="../js/pensum.js"></script>
</body>

</html>