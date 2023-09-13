<?php
session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once "$root/Academy/commons/db.php";

$dep = $_SESSION['department_id'];

$x = $db->prepare("SELECT department_chat.id, users.first_name, users.usrname
FROM public.department_chat 
JOIN public.users ON users.id = department_chat.user_id 
JOIN public.department ON department.id = department_chat.department_id and department.id = :d
ORDER BY department_chat.date ASC, department_chat.time DESC");

$x->bindValue(':d', $dep, PDO::PARAM_INT);
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
    <script src="../js/calendar.js"></script>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/offer.css">
    <link rel="stylesheet" href="../css/department_message.css">



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
                                <h6><a href="#">Publicaciones</a></h6>
                            </div>

                            <div class="col-sm-9">
                                <div class="justify-content-center ">
                                    <h6>Messages</h6>
                                    <div id="name"></div>
                                    <ul class="list-unstyled components mb-5">
                                        <div id="message"></div>
                                    </ul>

                                </div>

                                <div id="response-chat" class="response">

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-4 col-lg-offset-2 ">
                        <nav id="sidebar">
                            <div class="">
                                <h6>Chat</h6>
                                <div style="display:flex; justify-content:center; gap: 5px;">
                                    <input type="numeric" class="search" id="search" name="sch" placeholder="Buscar...">
                                </div>
                                <br>
                                <ul class="list-unstyled components mb-5">

                                    <div id="chat" class="scroller-chat">
                                        <?php
                                        foreach ($xr as $c) {

                                            echo '<div class="user" onclick="openChat(' . $c['id'] . ')">
                                            <div class="row">
                                                <div class="col-2">
                                                    <img src="../image/udenar.png" class="profile-photo">
                                                </div>
                                                <div class="col-10">
                                                    <ul class="list-unstyled">
                                                        <li>' . $c['first_name'] . '</li>
                                                        <li style="color: lightgreen; font-size:70%;">' . $c['usrname'] . '</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>';
                                        }
                                        ?>

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
    <script src="../js/jquery.min.js"></script>
    <script src="../js/department.js"></script>
    <script src="../js/checkout.js"></script>
</body>

</html>