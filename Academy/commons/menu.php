<?php

?>

<nav id="sidebar">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <div class="position-sticky" style="top: 0rem;">
        <div class="custom-menu ">
            <button type="button" id="sidebarCollapse" class="btn btn-primary">
            </button>
        </div>
        <div class="img bg-wrap text-center py-4" style="background-image: url(/Academy/image/bg_1.jpg);">
            <div class="user-logo">
                <div class="img" style="background-image: url(images/logo.jpg);"></div>
                <?php echo '<h3>' . $_SESSION['user_name'] . '</h3>'; ?>

            </div>
        </div>
        <ul class="list-unstyled  components mb-5">
            <li class="active">
                <a href="/Academy/"><span class="fa fa-home mr-3"></span> Home</a>
            </li>

            <li class="active">
                <a href="/Academy/pages/profile.php"><span class="fa fa-user mr-3"></span> Perfil</a>
            </li>

            

            <?php
            if ($_SESSION['rolle'] == 1) {
                echo '<li class="active">
                            <a href="/Academy/pages/subject_list.php"><span class="fa fa-book mr-3"></span> Asignaturas</a>
                        </li>';
            } else if ($_SESSION['rolle'] == 2) {
                echo '<li class="active">
                            <a href="#"><span class="fa fa-user mr-3"></span> Asignaturas</a>
                        </li>';
            }
            ?>

            <li>
                <a href="#"><span class="fa fa-envelope mr-3 notif"><small
                            class="d-flex align-items-center justify-content-center">5</small></span> >Mensajes</a>
            </li>

            <?php
            if ($_SESSION['rolle'] == 3) {
                echo '<li class="active">
                            <a href="/Academy/pages/department_publications.php"><span class="fa fa-user mr-3"></span> Administracion </a>
                        </li>';
            }
            ?>

            <li>
                <a href="/Academy/pages/calendar_list.php"><span class="fa fa-calendar mr-3"></span> Calendario</a>
            </li>
            <li>
                <a href="/Academy/pages/syllabus.php"><span class="fa fa-support mr-3"></span>Syllabus</a>
            </li>
            <li>
                <a href="/Academy/services/logout.php"><span class="fa fa-sign-out mr-3"></span> Cerrar Sesion</a>
            </li>
            <li>
                <a href="/Academy/pages/prueba.php"><span class="fa fa-sign-out mr-3"></span>prueba</a>
            </li>

        </ul>




    </div>

</nav>




<script src="../js/jquery.min.js"></script>
<script src="../js/popper.js"></script>
<script src="../js/main.js"></script>