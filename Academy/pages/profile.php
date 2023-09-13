<?php

session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/Academy/commons/db.php";
$idd = $_SESSION['id'];

if ($_SESSION['rolle'] == 1) {
    $s = $db->prepare("SELECT profession.profession,faculty.faculty,semester.semester,region.region,states.state,
    formation.formation
    FROM public.users 
    JOIN public.student ON users.id = student.user_id and users.id = :i
    JOIN public.region ON student.region_id = region.id
    JOIN public.states ON states.id = region.state_id 
    JOIN public.semester ON student.semester_id = semester.id 
    JOIN public.profession ON student.profession_id = profession.id
    JOIN public.formation ON profession.formation_id = formation.id  
    JOIN public.department ON profession.department_id = department.id 
    JOIN public.faculty ON department.faculty_id = faculty.id");
} elseif ($_SESSION['rolle'] >= 2) {
    $s = $db->prepare("SELECT profession.profession,faculty.faculty,semester.semester,region.region,states.state,
    formation.formation
    FROM public.users 
    JOIN public.student ON users.id = student.user_id and users.id = :i
    JOIN public.region ON student.region_id = region.id
    JOIN public.states ON states.id = region.state_id 
    JOIN public.semester ON student.semester_id = semester.id 
    JOIN public.profession ON student.profession_id = profession.id
    JOIN public.formation ON profession.formation_id = formation.id  
    JOIN public.department ON profession.department_id = department.id 
    JOIN public.faculty ON department.faculty_id = faculty.id");
}

$a = $db->prepare("SELECT type_achievements.achievements
    FROM public.users
    JOIN public.achievements ON users.id = achievements.user_id and users.id = :i
    JOIN public.type_achievements ON type_achievements.id = achievements.achievements_id");

$x = $db->prepare("SELECT type_courses.courses
    FROM public.users
    JOIN public.courses ON users.id = courses.user_id and users.id = :i
    JOIN public.type_courses ON type_courses.id = courses.courses_id");

$e = $db->prepare("SELECT type_event.event
    FROM public.users
    JOIN public.event ON users.id = event.user_id and users.id = :i
    JOIN public.type_event ON type_event.id = event.event_id");

$b = $db->prepare("SELECT biography.description
    FROM public.users
    JOIN public.biography ON biography.user_id = users.id and users.id = :i");

$s->bindValue(':i', $idd, PDO::PARAM_INT);
$a->bindValue(':i', $idd, PDO::PARAM_INT);
$b->bindValue(':i', $idd, PDO::PARAM_INT);
$x->bindValue(':i', $idd, PDO::PARAM_INT);
$e->bindValue(':i', $idd, PDO::PARAM_INT);

//var_dump($s->fetchAll());
$s->execute();
$a->execute();
$b->execute();
$x->execute();
$e->execute();

$lr = $s->fetchAll();
$ar = $a->fetchAll();
$br = $b->fetchAll();
$xr = $x->fetchAll();
$er = $e->fetchAll();

?>

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
            <?php include '../commons/search.php'; ?>
            <div class="row jumbotron jumbotron-fluid justify-content-md-center">

                <div class="col-md-3 text-center">
                    <img src="/Academy/image/profile/avatar.png" class="profile-photo">
                </div>

                <div class="col-md-6 text-left">

                    <?php
                    echo '<h1 class="display-6 fst-italic">' . $_SESSION['first_name'] . '</h1>';
                    echo '<h1 class="display-6 fst-italic">' . $_SESSION['last_name'] . '</h1>';
                    ?>

                    <div class="row align-items-left">

                        <div class="col-sm-4 px-1">
                            <?php
                            echo '<p><a class="fst-italic" href="#">' . $lr[0]['faculty'] . ' </a></p>';
                            ?>
                        </div>
                        <div class="col-sm-4 px-1">
                            <?php
                            echo '<p><a class="fst-italic" href="#">' . $lr[0]['profession'] . '</a></p>';
                            ?>
                        </div>
                        <div class="col-sm-2 px-1">
                            <?php
                            echo '<h2 class="fst-italic">' . $lr[0]['semester'] . '</h2>';
                            ?>
                        </div>

                    </div>

                </div>
                <div class="col-md-3 text-center">
                    <img src="/Academy/image/cover/cover.png" class="profile-cover">
                </div>
            </div>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <br>
                        <fieldset class="border rounded-3 p-3">
                            <legend class="float-none w-auto px-3">Biografia</legend>
                            <article class=" blog-post">

                                <?php
                                foreach ($br as $c) {
                                    echo '<p>' . $c['description'] . '</p>';
                                }
                                ?>

                            </article>
                        </fieldset>
                    </div>

                    <div class="col-md-4">
                        <br>
                        <fieldset class="border rounded-3 p-3">
                            <legend class="float-none w-auto px-3">Contacto</legend>

                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <h3 class="">Region:</h3>
                                    <h3 class="">Telefono:</h3>
                                    <h3 class="">Correo:</h3>
                                </div>
                                <div class="col-md-8">
                                    <?php
                                    echo '<h3 class="fst-italic">' . $lr[0]['state'] . ' - ' . $lr[0]['region'] . '</h3>';
                                    echo '<h3 class="fst-italic">' . $_SESSION['phone'] . '</h3>';
                                    echo '<h3 class="fst-italic">' . $_SESSION['email'] . '</h3>';
                                    ?>
                                </div>
                            </div>

                        </fieldset>

                        <fieldset class="border rounded-3 p-3">
                            <legend class="float-none w-auto px-3">Detalle</legend>

                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <h3 class="">Formacion:</h3>
                                    <h3 class="">Rol:</h3>
                                </div>
                                <div class="col-md-8">
                                    <?php
                                    echo '<h3 class="fst-italic">' . $lr[0]['formation'] . '</h3>';
                                    echo '<h3 class="fst-italic">' . $_SESSION['rolle_type'] . '</h3>';
                                    ?>
                                </div>
                            </div>

                            <br>
                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <h3 class="">achievements:</h3>
                                </div>
                                <div class="col-md-8">
                                    <?php
                                    foreach ($ar as $c) {
                                        echo '<h3>' . $c['achievements'] . '</h3>';
                                    }
                                    ?>
                                </div>
                            </div>

                            <br>
                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <h3 class="">Courses:</h3>
                                </div>
                                <div class="col-md-8">
                                    <?php
                                    foreach ($xr as $c) {
                                        echo '<h3>' . $c['courses'] . '</h3>';
                                    }
                                    ?>
                                </div>
                            </div>

                            <br>
                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <h3 class="">event:</h3>
                                </div>
                                <div class="col-md-8">
                                    <?php
                                    foreach ($er as $c) {
                                        echo '<h3>' . $c['event'] . '</h3>';
                                    }
                                    ?>
                                </div>
                            </div>

                        </fieldset>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include '../commons/footers.php';
    ?>

</body>

</html>