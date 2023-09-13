<?php
session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/Academy/commons/db.php";

$dep = $_SESSION['department_id'];
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
                            <div class="col-sm-4">
                                <h6><a href="#">Crear Publicacion</a></h6>
                                <h6><a href="#">Agenda</a></h6>
                                <h6><a href="#">Mensajes</a></h6>
                            </div>

                            <div class="col-sm-8">
                                <div class="justify-content-center ">
                                    <h6>Publicaciones</h6>

                                    <div class="posts">
                                        <div class="post">
                                            <p>Contenido de la publicación...</p>
                                            <div class="actions">
                                                <button>👍 Like</button>
                                                <button>💬 Comentar</button>
                                            </div>
                                        </div>
                                        <div class="post">
                                            <p>Otra publicación...</p>
                                            <div class="actions">
                                                <button>👍 Like</button>
                                                <button>💬 Comentar</button>
                                            </div>
                                        </div>
                                        <!-- Puedes agregar más publicaciones aquí -->
                                    </div>

                                </div>
                            </div>



                        </div>

                    </div>

                    <div class="col-lg-4 col-lg-offset-2 ">
                        <nav id="sidebar">
                            <div class="">
                                <h6>Notifications</h6>
                                <ul class="list-unstyled components mb-5">
                                    <div id="notifications">
                                        <div class="user" onclick="openChat('user1')">
                                            <div class="row">
                                                <div class="col-2">
                                                    <img src="../image/udenar.png" class="profile-photo">
                                                </div>
                                                <div class="col-10">
                                                    <ul class="list-unstyled">
                                                        <li>Juan David sandobal martinez</li>
                                                        <li style="color: lightgreen; font-size:70%;">218151001</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="user" onclick="openChat('user2')">Usuario 2</div>
                                        <div class="user" onclick="openChat('user3')">Usuario 3</div>
                                        <!-- Agrega más usuarios aquí -->
                                    </div>
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
    <script src="../js/department.js"></script>
    <script src="../js/checkout.js"></script>
</body>

</html>