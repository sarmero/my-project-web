<?php
session_start();
if (isset($_SESSION['login'])) {
    if ($_SESSION['login'] == true) {
        echo '<form action="/Academy/services/logout.php">';
        echo '<button type="submit" class="btn btn-light btn-outline-success">Cerrar sesión</button>';
        echo '</form>';
    }
}
?>