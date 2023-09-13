<?php

session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/Academy/commons/db.php";
$idd = $_SESSION['id'];

if (isset($_GET["sem"])) {
    $sem = $_GET["sem"];
} else {
    $sem = 1;
}

$x = $db->prepare("SELECT subject.id, subject.subject FROM plan_study
JOIN public.semester ON semester.id = plan_study.semester_id and semester.id = :sem
JOIN public.subject ON subject.id = plan_study.subject_id ORDER BY subject.subject ASC");

$x->bindValue(':sem', $sem, PDO::PARAM_INT);

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
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/main-profile.css">
</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <?php include '../commons/menu.php'; ?>
        <div class="container">
            <br><br><br>
            <div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?php
                        for ($i = 1; $i <= 10; $i++) {
                            echo '<li class="page-item"><a class="page-link" href="/Academy/pages/calendar.php?sem=' . $i . '">semestre ' . $i . '</a></li>';
                        }
                        ?>

                    </ul>
                </nav>
            </div>

            <div class="justify-content-md-center">
                <?php
                echo '<h4 class="mb-3 text-center">Semestre ' . $sem . '</h4>';
                ?>

            </div>

            <div class="justify-content-md-left">
                <h5 class="card-title">Asignaturas</h5>
                <br>
            </div>

            <div class="justify-content-md-center">
                <?php
                foreach ($xr as $c) {

                    $h = $db->prepare("SELECT teacher.id, calendar.description, inscription.id, offer.state
            FROM public.users 
            JOIN public.student ON users.id = student.user_id and users.id = :i
            JOIN public.inscription ON student.id = inscription.student_id
            JOIN public.offer ON offer.id = inscription.offer_id
            JOIN public.plan_study ON plan_study.id = offer.plan_study_id 
            JOIN public.semester ON semester.id = plan_study.semester_id and semester.id = :sem
            JOIN public.subject ON subject.id = plan_study.subject_id and subject.id = :sbj
            JOIN public.programming ON programming.offer_id = offer.id
            JOIN public.teacher ON teacher.id = programming.teacher_id
            JOIN public.calendar ON calendar.id = offer.calendar_id");

                    $h->bindValue(':i', $idd, PDO::PARAM_INT);
                    $h->bindValue(':sem', $sem, PDO::PARAM_INT);
                    $h->bindValue(':sbj', $c['id'], PDO::PARAM_INT);
                    $h->execute();
                    $hr = $h->fetchAll();



                    if (count($hr) > 0) {

                        $t = $db->prepare("SELECT users.first_name FROM users
                JOIN public.teacher ON users.id = teacher.user_id and teacher.id = :t");

                        $t->bindValue(':t', $hr[0]['id'], PDO::PARAM_INT);

                        $t->execute();
                        $tr = $t->fetchAll();

                        $inc = $db->prepare("SELECT SUM(note.note * (note.percentage/100)) FROM public.note 
                JOIN inscription ON inscription.id = note.inscription_id and inscription.id =:i");

                        $inc->bindValue(':i', $hr[0][2], PDO::PARAM_INT);

                        $inc->execute();
                        $incr = $inc->fetchAll();
                        $nt = round($incr[0]['sum'], 2);

                        if ($hr[0]['state'] == "culminado") {
                            $stt = "Terminado";
                            if ($nt >= 3) {
                                $clr = "success";
                            } else {
                                $clr = "danger";
                            }
                        } else if ($hr[0]['state'] == "offer") {
                            $stt = "Matriculado";
                            $clr = "primary";
                        }


                        echo ' <div class="card text-bg-' . $clr . ' mb-3" style="max-width: 100%;">
                <div class="card-body">
                    <div class="row justify-content-md-center">
        
                        <div class="col-6">
                            <h5 class="card-title">' . $c['subject'] . '</h5>
                            <p class="card-text"><a href= "#">' . $tr[0]['first_name'] . '</a></p>
                        </div>
        
                        <div class="col-2 ">
                            <h5 class="card-title">Estado</h5>
                            <p class="card-text">' . $stt . '</p>
                        </div>
        
                        <div class="col-2">
                            <h5 class="card-title">Note</h5>
                            <p class="card-tex">' . $nt . '</p>
                        </div>
        
                        <div class="col-2 ">
                            <h5 class="card-title">Calendar</h5>
                            <p class="card-text">' . $hr[0]['description'] . '</p>
                        </div>
        
                    </div>
                </div>
            </div> ';

                    } else {
                        echo '<div class="card text-bg-light mb-3" style="max-width: 100%;">
                    <div class="card-body">
                        <div class="row justify-content-md-center">

                            <div class="col-6">
                                <h5 class="card-title" style= "color: black;">' . $c['subjec'] . '</h5>;
                                <p class="card-text"> No asignado</p>
                            </div>

                            <div class="col-2 ">
                                <h5 class="card-title" style= "color: black;">Estado</h5>
                                <p class="card-text">Pendiente</p>
                            </div>

                            <div class="col-2">
                                <h5 class="card-title" style= "color: black;">Note</h5>
                                <p class="card-tex">    </p>
                            </div>

                            <div class="col-2 ">
                                <h5 class="card-title" style= "color: black;">Calendar</h5>
                                <p class="card-text">En progreso</p>
                            </div>

                        </div>
                    </div>
                </div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <?php
    include '../commons/footers.php';
    ?>

</body>

</html>