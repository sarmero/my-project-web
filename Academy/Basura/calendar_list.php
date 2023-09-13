<?php

session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/Academy/commons/db.php";
$idd = $_SESSION['id'];


if (isset($_GET["col"])) {
    $cal = $_GET["col"];
} else {
    $cal = 1;
}

if (isset($_GET["sem"])) {
    $sem = $_GET["sem"];
} else {
    $sem = 1;
}

$x = $db->prepare("SELECT * FROM public.calendar ORDER BY id ASC");
$x->execute();
$xr = $x->fetchAll();

$w = $db->prepare("SELECT * FROM public.weeks ORDER BY id ASC");
$w->execute();
$wr = $w->fetchAll();

$dep = $_SESSION['department_id'] ;

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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/main-profile.css">

</head>

<body>
    <div class=" wrapper d-flex align-items-stretch">
        <?php include '../commons/menu.php'; ?>
        <div class="container">
            <br><br>

            <div class="row g-5 ">
                <div class="col-md-4 ">
                    <?php
                    foreach ($xr as $c) {
                        if ($c['id'] == $cal) {
                            echo '<h3 class="mb-3"> Calendario :' . $c['description'] . '</h3>';
                        }
                    }
                    ?>

                </div>

                <div class="col-md-4 ">
                    <?php
                    echo '<h4 class="mb-3 text-center">Semestre ' . $sem . '</h4>';
                    ?>

                </div>

                <div class="col-md-4">
                    <div class="d-flex gap-2 justify-content-end ">
                        <button type="button" class=" btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Calendario
                        </button>
                        <ul class="dropdown-menu">
                            <?php
                            foreach ($xr as $c) {
                                echo '<li><a class="dropdown-item"  href="#?col=' . $c['id'] . '" > ' . $c['description'] . '</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>

            <br>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <?php
                    for ($i = 1; $i <= 10; $i++) {
                        echo '<li class="page-item"><a class="page-link" href="#?sem=' . $i . '&col=' . $cal . '">semestre ' . $i . '</a></li>';
                    }
                    ?>

                </ul>
            </nav>


            <div class="table-responsive">

                <table class="table table-striped table table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center" scope="col">Semana</th>
                            <th scope="col">Monday</th>
                            <th scope="col">Tuesday</th>
                            <th scope="col">Wednesday</th>
                            <th scope="col">Thursday</th>
                            <th scope="col">Friday</th>
                            <th scope="col">Saturday</th>
                            <th scope="col">Sunday</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        for ($j = 1; $j <= 30; $j++) {
                            $b = $db->prepare("SELECT subject.subject, timetable.date,
                                users.first_name, timetable.start_time, timetable.end_time, timetable.day_id
                                FROM public.offer
                                JOIN public.inscription ON offer.id = inscription.offer_id
                                JOIN public.calendar ON calendar.id = offer.calendar_id and calendar.id = :c
                                JOIN public.plan_study ON plan_study.id = offer.plan_study_id
                                JOIN public.subject ON subject.id = plan_study.subject_id
                                JOIN public.department ON subject.department_id = department.id and department.id = :d
                                JOIN public.programming ON programming.offer_id = offer.id
                                JOIN public.timetable ON timetable.programming_id = programming.id
                                JOIN public.weeks ON timetable.week_id = weeks.id  and  weeks.id = :sm
                                JOIN public.teacher ON teacher.id = programming.teacher_id
                                JOIN public.semester ON plan_study.semester_id = semester.id and semester.id = :s
                                JOIN public.users ON teacher.user_id =users.id ORDER BY subject.subject, timetable.start_time, timetable.day_id ASC");

                            $b->bindValue(':d', $dep, PDO::PARAM_INT);
                            $b->bindValue(':c', $cal, PDO::PARAM_INT);
                            $b->bindValue(':s', $sem, PDO::PARAM_INT);
                            $b->bindValue(':sm', $j, PDO::PARAM_INT);

                            $b->execute();
                            $br = $b->fetchAll();



                            if (count($br) > 0) {

                                $fil = 0;
                                foreach ($br as $c) {
                                    $count = 0;
                                    foreach ($br as $a) {
                                        if ($c['day_id'] == $a['day_id']) {
                                            $count++;
                                        }
                                    }

                                    if ($count > $fil) {
                                        $fil = $count;
                                    }
                                }

                                echo '<tr class="align-bottom">
                                <td class="align-middle text-center" scope="row" rowspan="' . $fil + 1 . '" style = "color: #cdfeaa;">' . $j . '</td>
                            </tr>';


                                $pos = 0;
                                for ($l = 0; $l < $fil; $l++) {


                                    echo '<tr>';
                                    $n = count($br);

                                    for ($i = 1; $i <= 7; $i++) {

                                        $ban = false;
                                        $n = 0;
                                        foreach ($br as $c) {
                                            if ($i == $c['day_id']) {

                                                echo '
                                                    <td class="align-middle">
                                                        <ul class="list-unstyled"> 
                                                            <li style = "color: #cdfeaa;">' . $c['date'] . ' ' . $c['start_time'] . '-' . $c['end_time'] . 'H</li>
                                                            <li  style = "color: #66ced6;">' . $c['subject'] . '</li>
                                                            <li style = "color: #cdfeaa;">' . $c['first_name'] . '</li>
                                                            
                                                        </ul>
                                                    </td>';

                                                $br[$n]['day_id'] = -1;
                                                $ban = true;
                                                break;
                                            }

                                            $n++;

                                        }

                                        if ($ban == false) {
                                            echo '<td class="align-middle">
                                                    <p><small> </small></p>
                                                    <p style = "color: #cdfeaa;"><small>  </small></p>
                                                    <p><small> </small></p>
                                                </td>';
                                        }

                                    }
                                    echo '</tr>';


                                }
                            }
                        }
                        ?>



                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php
    include '../commons/footers.php';
    ?>
</body>

</html>