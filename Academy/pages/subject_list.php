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

$x = $db->prepare("SELECT * FROM public.calendar ORDER BY id ASC");

$x->execute();
$xr = $x->fetchAll();


$b = $db->prepare("SELECT subject.id,subject.subject,calendar.description
FROM public.users
JOIN public.student ON users.id = student.user_id and users.id = :i
JOIN public.inscription ON inscription.student_id = student.id
JOIN public.offer ON offer.id = inscription.offer_id
JOIN public.calendar ON calendar.id = offer.calendar_id and calendar.id = :c
JOIN public.plan_study ON plan_study.id = offer.plan_study_id
JOIN public.subject ON subject.id = plan_study.subject_id");

$b->bindValue(':i', $idd, PDO::PARAM_INT);
$b->bindValue(':c', $cal, PDO::PARAM_INT);

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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/main-profile.css">
</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <?php include '../commons/menu.php'; ?>
        <div class="container">
            <br><br>
            <div class="row g-5">
                <div class="col-md-1">
                </div>

                <div class="col-md-10">

                    <div class="row g-5 ">
                        <div class="col-md-8 ">
                            <?php
                            if (count($br) > 0) {
                                echo '<h3 class="mb-3"> Calendario :' . $br[0]['description'] . '</h3>';
                            } else {
                                foreach ($xr as $c) {
                                    if ($c['id'] == $cal) {
                                        echo '<h3 class="mb-3"> Calendario :' . $c['description'] . '</h3>';
                                    }
                                }
                            }
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
                                        echo '<li><a class="dropdown-item"  href="/Academy/pages/subject.php?col=' . $c['id'] . '" > ' . $c['description'] . '</a></li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>



                    <div class=" accordion " id="accordionExample">

                        <?php
                        if (count($br) > 0) {
                            echo '<h4 class="mb-3 text-center">Asignarutas Matriculadas</h4>';
                            foreach ($br as $c) {
                                echo '
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                ' . $c['subject'] . '
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" >
                            <div class="row d-flex gap-2 justify-content-center">
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-10">
                                    <div class=" accordion" id="accordionExample0">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTow">
                                                    Notas
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse show" >';

                                $sub = $c['id'];

                                $s = $db->prepare("SELECT theme.theme,type_evaluation.type_evaluation, note.note,note.percentage
                                                FROM public.users
                                                JOIN public.student ON users.id = student.user_id and users.id = :i
                                                JOIN public.inscription ON inscription.student_id = student.id
                                                JOIN public.offer ON offer.id = inscription.offer_id
                                                JOIN public.calendar ON calendar.id = offer.calendar_id and calendar.id = :c
                                                JOIN public.plan_study ON plan_study.id = offer.plan_study_id
                                                JOIN public.subject ON subject.id = plan_study.subject_id and subject.id = :g
                                                JOIN public.theme ON theme.subject_id = subject.id
                                                JOIN public.evaluation ON evaluation.theme_id = theme.id
                                                JOIN public.type_evaluation ON evaluation.type_evaluation_id = type_evaluation.id
                                                JOIN public.note ON note.evaluation_id = evaluation.id");

                                $s->bindValue(':i', $idd, PDO::PARAM_INT);
                                $s->bindValue(':c', $cal, PDO::PARAM_INT);
                                $s->bindValue(':g', $sub, PDO::PARAM_INT);

                                $s->execute();
                                $lr = $s->fetchAll();

                                echo '
                                                        <div class="row g-6 ">
                                                        
                                                                <div class="col-md-6">
                                                                    <h3 class="mb-3 text-center my-3">Theme</h3>
                                                                </div>

                                                                <div class="col-md-6 ">
                                                                
                                                                    <div class="row g-5">

                                                                        <div class="col-md-4">
                                                                            <h3 class="mb-3 text-left my-3">Type</h3>
                                                                        </div>

                                                                        <div class="col-md-3">
                                                                            <h3 class="mb-3 text-left my-3">Note</h3>
                                                                        </div>

                                                                        <div class="col-md-2">
                                                                            <h3 class="mb-3 text-center my-3">%</h3>
                                                                        </div>

                                                                        <div class="col-md-3">
                                                                            <h3 class="mb-3 text-left my-3">NF</h3>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        
                                                            </div>
                                                <div class="accordion-body">';
                                $nf = 0;
                                foreach ($lr as $a) {
                                    if ($a['note'] > -1) {
                                        $n = ($a['percentage'] / 100) * $a['note'];
                                        $nf = $nf + $n;


                                        echo '
                                                            <div class="row g-5">
                                                                <div class="col-md-6">
                                                                <h3 class="mb-3 text-left">' . $a['theme'] . '</h3>
                                                                
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="row g-5">

                                                                        <div class="col-md-4">
                                                                            ' . $a['type_evaluation'] . '
                                                                        </div>

                                                                        <div class="col-sm-3">
                                                                        <h3 class="mb-3 text-center">' . $a['note'] . '</h3>
                                                                        </div>

                                                                        <div class="col-sm-2">
                                                                            <h3 class="mb-3 text-center">' . $a['percentage'] . '</h3>
                                                                        </div>

                                                                        <div class="col-sm-3">
                                                                            <h3 class="mb-3 text-center">' . $n . '</h3>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        
                                                            </div>
                                                        ';
                                    }
                                }
                                echo '</div>
                                                <h3 class="mb-3 text-center"> Note end: ' . $nf . '</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row d-flex gap-2 justify-content-center">
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-10">
                                    <div class=" accordion " id="accordionExample1">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    Actividades
                                                </button>
                                            </h2>
                                            <div id="collapseThree" class="accordion-collapse collapse " >';

                                $sub = $c['id'];

                                $s = $db->prepare("SELECT theme.theme,type_evaluation.type_evaluation, note.note,note.percentage, evaluation.date,evaluation.state
                                                FROM public.users
                                                JOIN public.student ON users.id = student.user_id and users.id = :i
                                                JOIN public.inscription ON inscription.student_id = student.id
                                                JOIN public.offer ON offer.id = inscription.offer_id
                                                JOIN public.calendar ON calendar.id = offer.calendar_id and calendar.id = :c
                                                JOIN public.plan_study ON plan_study.id = offer.plan_study_id
                                                JOIN public.subject ON subject.id = plan_study.subject_id and subject.id = :g
                                                JOIN public.theme ON theme.subject_id = subject.id
                                                JOIN public.evaluation ON evaluation.theme_id = theme.id
                                                JOIN public.type_evaluation ON evaluation.type_evaluation_id = type_evaluation.id
                                                JOIN public.note ON note.evaluation_id = evaluation.id");

                                $s->bindValue(':i', $idd, PDO::PARAM_INT);
                                $s->bindValue(':c', $cal, PDO::PARAM_INT);
                                $s->bindValue(':g', $sub, PDO::PARAM_INT);

                                $s->execute();
                                $lr = $s->fetchAll();

                                echo '<div class="row g-5">
                                                                <div class="col-md-5">
                                                                    <h3 class="mb-3 text-center my-3">Theme</h3>
                                                                </div>

                                                                <div class="col-md-7">
                                                                    <div class="row g-5">

                                                                        <div class="col-md-3">
                                                                            <h3 class="mb-3 text-left my-3">Type</h3>
                                                                        </div>

                                                                        <div class="col-md-2">
                                                                            <h3 class="mb-3 text-center my-3">%</h3>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <h3 class="mb-3 text-left my-3">Date</h3>
                                                                        </div>

                                                                        <div class="col-md-3">
                                                                            <h3 class="mb-3 text-left my-3">State</h3>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        
                                                            </div>
                                                            
                                                <div class="accordion-body">';

                                foreach ($lr as $a) {
                                    if ($a['state'] == 'C') {
                                        $n = 'Culminado';
                                    } else if ($a['state'] == 'P') {
                                        $n = 'Pendiente';
                                    }

                                    echo '
                                                            <div class="row g-5">
                                                                <div class="col-md-5">
                                                                <h3 class="mb-3 text-left">' . $a['theme'] . '</h3>
                                                                
                                                                </div>

                                                                <div class="col-md-7">
                                                                    <div class="row g-5">

                                                                        <div class="col-sm-3">
                                                                            ' . $a['type_evaluation'] . '
                                                                        </div>

                                                                        <div class="col-sm-2">
                                                                            <h3 class="mb-3 text-center">' . $a['percentage'] . '</h3>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <h3 class="mb-3 text-center">' . $a['date'] . '</h3>
                                                                        </div>

                                                                        <div class="col-sm-3">
                                                                            <h3 class="mb-3 text-left">' . $n . '</h3>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                        
                                                            </div>
                                                    ';
                                }
                                echo '</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row d-flex gap-2 justify-content-center">
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-10">
                                    <div class=" accordion " id="accordionExample1">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                                                    Material
                                                </button>
                                            </h2>
                                            <div id="collapseFour" class="accordion-collapse collapse " >';

                                $sub = $c['id'];

                                $s = $db->prepare("SELECT type_material.material,link_material
                                                FROM public.users
                                                JOIN public.student ON users.id = student.user_id and users.id = :i
                                                JOIN public.inscription ON inscription.student_id = student.id
                                                JOIN public.offer ON offer.id = inscription.offer_id
                                                JOIN public.calendar ON calendar.id = offer.calendar_id and calendar.id = :c
                                                JOIN public.plan_study ON plan_study.id = offer.plan_study_id
                                                JOIN public.subject ON subject.id = plan_study.subject_id and subject.id = :g
                                                JOIN public.programming ON programming.offer_id = offer.id
                                                JOIN public.teacher ON programming.teacher_id = teacher.id
                                                JOIN public.type_material ON teacher.id = type_material.teacher_id
                                                JOIN public.material ON material.type_material_id = type_material.id");

                                $s->bindValue(':i', $idd, PDO::PARAM_INT);
                                $s->bindValue(':c', $cal, PDO::PARAM_INT);
                                $s->bindValue(':g', $sub, PDO::PARAM_INT);

                                $s->execute();
                                $lr = $s->fetchAll();

                                echo '<div class="row g-5">
                                                        <div class="col-md-5">
                                                            <h3 class="mb-3 text-center my-3">Theme</h3>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <h3 class="mb-3 text-center my-3">link</h3>
                                                        </div>
                                                        
                                                    </div>
                                                            
                                                <div class="accordion-body hr">';

                                foreach ($lr as $a) {

                                    echo '
                                                            <div class="row g-5">
                                                                <div class="col-md-6">
                                                                    <h3 class="mb-3 text-left">' . $a['material'] . '</h3>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <h3 class="mb-3 text-left">' . $a['link_material'] . '</h3>
                                                                </div>
                                                        
                                                            </div>
                                                    ';
                                }
                                echo '</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row d-flex gap-2 justify-content-center">
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-10">
                                    <div class=" accordion " id="accordionExample1">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                    Observation
                                                </button>
                                            </h2>
                                            <div id="collapseFive" class="accordion-collapse collapse " >';

                                $sub = $c['id'];

                                $s = $db->prepare("SELECT observation.title, observation.observation
                                                FROM public.users
                                                JOIN public.student ON users.id = student.user_id and users.id = :i
                                                JOIN public.inscription ON inscription.student_id = student.id
                                                JOIN public.offer ON offer.id = inscription.offer_id
                                                JOIN public.calendar ON calendar.id = offer.calendar_id and calendar.id = :c
                                                JOIN public.plan_study ON plan_study.id = offer.plan_study_id
                                                JOIN public.subject ON subject.id = plan_study.subject_id and subject.id = :g
                                                JOIN public.observation ON observation.offer_id = offer.id");

                                $s->bindValue(':i', $idd, PDO::PARAM_INT);
                                $s->bindValue(':c', $cal, PDO::PARAM_INT);
                                $s->bindValue(':g', $sub, PDO::PARAM_INT);

                                $s->execute();
                                $lr = $s->fetchAll();

                                echo '<div class="accordion-body">';

                                foreach ($lr as $a) {
                                    echo '
                                                    <p class="fs-2">' . $a['title'] . '</p>
                                                    <p class="lh-sm">' . $a['observation'] . '</p>';
                                }
                                echo '</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>';
                            }
                        } else {
                            echo '<h3 class="mb-3 text-center">No se encontraron registros</h3>';
                        }
                        ?>
                    </div>
                </div>

                <div class="col-md-1">
                </div>
            </div>
        </div>
    </div>
    <br><br>

    <?php
    include '../commons/footers.php';
    ?>
</body>

</html>