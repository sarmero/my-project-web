<!-- Sidebar -->

<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css'>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.4/css/tether.min.css'>
<link rel='stylesheet' href='../css/menu_admin.css'>

<div class="overlay"></div>

<nav class="navbar navbar-inverse fixed-top" id="sidebar-wrapper" role="navigation">

    <ul class="nav sidebar-nav">
        <div class="sidebar-header">
            <div class="sidebar-brand">
                <?php
                echo '<a href="#">' . $_SESSION['departament'] . '</a>';
                ?>
            </div>
        </div>
        <!-- 
        
        <li><a href="/Academy/pages/others.php">others</a></li>
        <li><a href="#about">Publications</a></li> -->
        <li><a href="/Academy/pages/department_publications.php">Publicaciones</a></li>
        <li><a href="/Academy/pages/program.php">Programs</a></li>
        <li><a href="/Academy/pages/subject.php">Asignaturas</a></li>
        <li><a href="/Academy/pages/pensum.php">Pensum</a></li>
        <li><a href="/Academy/pages/offer.php">offer</a></li>
        <li><a href="/Academy/pages/inscription.php">Incription</a></li>

        <li class="dropdown">
            <a href="#works" class="dropdown-toggle" data-toggle="dropdown">Calendar<span class="caret"></span></a>
            <ul class="dropdown-menu animated fadeInLeft" role="menu">
                <li><a href="/Academy/pages/calendar_list.php">Calendar</a></li>
                <li><a href="/Academy/pages/calendar.php">Register</a></li>
            </ul>
        </li>

        <li class="dropdown">
            <a href="#works" class="dropdown-toggle" data-toggle="dropdown">Estudent <span class="caret"></span></a>
            <ul class="dropdown-menu animated fadeInLeft" role="menu">
                <li><a href="/Academy/pages/student_list.php">Estudent</a></li>
                <li><a href="/Academy/pages/assignments.php">Asignaciones</a></li>
                <li><a href="/Academy/pages/student.php">Register</a></li>

            </ul>
        </li>

        <li class="dropdown">
            <a href="#works" class="dropdown-toggle" data-toggle="dropdown">Teaching <span class="caret"></span></a>
            <ul class="dropdown-menu animated fadeInLeft" role="menu">
                <li><a href="/Academy/pages/teacher_list.php">Teacher</a></li>
                <li><a href="/Academy/pages/teacher.php">Register</a></li>
            </ul>
        </li>

        <li class="dropdown">
            <a href="#works" class="dropdown-toggle" data-toggle="dropdown">Admin<span class="caret"></span></a>
            <ul class="dropdown-menu animated fadeInLeft" role="menu">
                <li><a href="/Academy/pages/admin_list.php">Admin</a></li>
                <li><a href="/Academy/pages/admin.php">Register</a></li>
            </ul>
        </li>

        <li class="dropdown">
            <a href="#works" class="dropdown-toggle" data-toggle="dropdown">Plan of study<span class="caret"></span></a>
            <ul class="dropdown-menu animated fadeInLeft" role="menu">
                <li><a href="/Academy/pages/plan_study_list.php">Plan</a></li>
                <li><a href="/Academy/pages/plan_study.php">Register</a></li>
            </ul>
        </li>

        
        <li><a href="/Academy/">Return</a></li>
    </ul>
</nav>
<!-- /#sidebar-wrapper -->

<!-- Page Content -->
<!-- /#page-content-wrapper -->

<!-- /#wrapper -->
<!-- partial -->
<script src='https://code.jquery.com/jquery-3.3.1.slim.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.4/js/tether.min.js'></script>
<script src="../js/menu.js"></script>





<!-- /#wrapper -->