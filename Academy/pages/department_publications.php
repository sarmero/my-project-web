<?php
session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/Academy/commons/db.php";

$dep = $_SESSION['department_id'];

$x = $db->prepare("SELECT * FROM public.publications where department_id = :d
ORDER BY date ASC");

$x->bindValue(':d', $dep, PDO::PARAM_INT);
$x->execute();

$xr = $x->fetchAll();

$hoy = getdate();
$date = $hoy['mday'] . '-' . $hoy['mon'] . '-' . $hoy['year'];



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
    <link rel="stylesheet" href="../css/offer.css">
    <link rel="stylesheet" href="../css/department.css">

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
                    <div class="col-lg-8 col-lg-offset-2 ">

                        <div class="row">
                            <div class="col-sm-3">
                                <h6><a href="#" onclick="dialogPublication()">Crear Publicacion</a></h6>
                                <h6><a href="#">Crear encuesta</a></h6>
                                <h6><a href="/Academy/pages/department_message.php">Mensajes</a></h6>
                                <h6><a href="#">Agenda</a></h6>

                                <dialog id="miDialogo">
                                    <h4 >Publicacion</h4>
                                    <div contenteditable class="fake-textarea" id="text" required></div>
                                    <br>

                                    <div class="row">
                                        <div class="col-6">
                                            <button class="btn btn-success">Guardar</button>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn btn-secondary" onclick="cerrarDialogo()">Cerrar</button>
                                        </div>
                                    </div>
                                </dialog>

                            </div>

                            <div class="col-sm-9">
                                <div class="justify-content-center ">
                                    <h6 style="border-bottom: 1px solid white; padding-bottom: 5px;">Publicaciones</h6>

                                    <div class="posts scroller" >
                                        <?php
                                        foreach ($xr as $c) {

                                            $s = $db->prepare('SELECT publication_comment.comment FROM public.publication_comment where publication_id = :p');
                                            $s->bindValue(':p', $c['id'], PDO::PARAM_INT);
                                            $s->execute();
                                            $lr = $s->fetchAll();

                                            $count = count($lr);

                                            $x = $db->prepare('SELECT count(*) FROM public.publication_like where publication_id = :p');
                                            $x->bindValue(':p', $c['id'], PDO::PARAM_INT);
                                            $x->execute();
                                            $xr = $x->fetchAll();

                                            $like = $xr[0]['count'];

                                            echo '<div class="post" id="' . $c['id'] . '">
                                                    <div class="row">
                                                        <div class="col-1">
                                                            <img src="../image/udenar.png" class="profile-photo">
                                                        </div>
                                                        <div class="col-11">
                                                            <ul class="list-unstyled">
                                                                <li>' . $_SESSION['departament'] . '</li>
                                                                <li style="color: lightgreen; font-size:70%;">department</li>
                                                            </ul>
                                                            
                                                        </div>
                                                    </div>
                                                    <p>' . $c['publication'] . '</p>

                                                    <div class="child">
                                                        <h6><small>like:' . $like . ' </small></h6>
                                                        <h6><small>comment: ' . $count . '</small></h6>
                                                    </div>

                                                    
                                                    <div class="actions">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <button class="btn btn-sm like-button">👍 Like</button>
                                                            </div>
                                                            <div class="col-6">
                                                                <button class="btn btn-sm comment-button" >💬 Comentar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                            ';
                                        }
                                        ?>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-4 col-lg-offset-2 ">
                        <nav id="sidebar">
                            <div class="">
                                <h6>Comentarios</h6>
                                <ul class="list-unstyled components mb-5">
                                    <div id="comment"></div>
                                </ul>
                            </div>
                        </nav>
                    </div>

                    <?php
                    include '../commons/footers.php';
                    ?>
                </div>

            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../js/department_publication.js"></script>
    <script src="../js/checkout.js"></script>
</body>

</html>