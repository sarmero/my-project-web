<?php

session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/Academy/commons/db.php";

$idd = $_SESSION['id'];
$dep = $_SESSION['department_id'];

$b = $db->prepare("SELECT users.usrname, users.first_name, users.last_name, users.phone, users.email,
type_teacher.description FROM public.users
JOIN public.teacher ON teacher.user_id = users.id
JOIN public.type_teacher ON type_teacher.id = teacher.type_teacher_id
JOIN public.department ON department.id =teacher.department_id and department.id = :d
 ORDER BY users.first_name ASC");

$b->bindValue(':d', $dep, PDO::PARAM_INT);

$b->execute();
$br = $b->fetchAll();

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
                            <legend class="float-none w-auto px-3">Teachers</legend>
                            <article class=" blog-post">

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
                                                <th scope="col">Type</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            <?php

                                            if (count($br) > 0) {
                                                $n = 1;
                                                foreach ($br as $c) {

                                                    echo '<tr class="align-bottom">
                                                    <th style ="color: white;" scope="row">' . $n . '</th>
                                                    <td style ="color: white;">' . $c['usrname'] . '</td>
                                                    <td style ="color: white;">' . $c['first_name'] . '</td>
                                                    <td style ="color: white;">' . $c['last_name'] . '</td>
                                                    <td style ="color: white;">' . $c['email'] . '</td>
                                                    <td style ="color: white;">' . $c['phone'] . '</td>
                                                    <td style ="color: white;">' . $c['description'] . '</td>
                                                    </tr>';
                                                    $n++;
                                                }
                                            }

                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </article>
                        </fieldset>
                    </div>
                    
                    <?php
                    include '../commons/footers.php';
                    ?>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>