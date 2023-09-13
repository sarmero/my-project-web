<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/mylib/commons/db.php";

$state = true;
//false || true = true
//Select * from user where user = 'valor1' and pws = 'valor2'
//valor1 = ' || '' = '
//valor2 = ' || '' = '
//Select * from user where user = '' || '' = '' and pws = '' || '' = ''


$s = $db->prepare('SELECT initcap(name) as name FROM public.category WHERE state = :st ORDER BY name ASC');

$s->bindValue(':st', $state, PDO::PARAM_BOOL);
$s->execute();
$categries = $s->fetchAll();

?>

<nav class="navbar navbar-dark navbar-expand-lg " style="background-color: #00923f;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">My Lib</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/mylib">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/mylib/pages/books.php">Libros</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Categrías
                    </a>
                    <ul class="dropdown-menu">

                        <?php
                        foreach ($categries as $c) {
                            echo
                                '<li><a class="dropdown-item" href="/mylib/pages/collections.php?col=' .
                                $c['name']
                                . '">' .
                                $c['name']
                                . '</a></li>';
                        }
                        ?>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/mylib/pages/partners_list.php">Socios</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Administrador
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="/mylib/pages/author_list.php">Autores</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/mylib/pages/book_list.php">Libros</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Prestamos</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/mylib/pages/partners_list.php">Socios</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn  btn-light btn-outline-success" type="submit">Search</button>

                <?php
                /*session_start();

                if (isset($_SESSION['login'])) {
                    if ($_SESSION['login'] == true) {
                        echo '<form action="/mylib/services/logout.php">';
                        echo '<button type="submit" class="btn  btn-outline-success">Cerrar secion</button>';
                        echo '</form>';
                    }
                }*/
                ?>
            </form>
        </div>
    </div>
</nav>