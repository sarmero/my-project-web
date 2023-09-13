<?php
session_start();

$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/mylib/commons/db.php";

$s = $db->prepare('SELECT * FROM public.author');
$s->execute();
$lr = $s->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Lib</title>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body>
    <?php include '../commons/menu.php'; ?>
    <br><br>

    <div class="row">
        <div class="col-1">
        </div>
        <div class="col-8">
            <h1>Lista de autores</h1>
        </div>
        <div class="col-3">
            <form action="/mylib/pages/author.php">
                <button type="submit" class="btn btn-primary mb-3">+</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-1">
        </div>
        <div class="col-10">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre del autor</th>
                        <th scope="col">Fecha de nacimiento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($lr as $a) {

                        echo '<tr><th scope="row">' . $a["id"] .
                            '</th><td>' . $a["first_name"] . ' ' . $a["last_name"] . '</td><td>' .
                            $a["born_date"] . '</td></tr>';
                    }
                    ?>
                </tbody>
            </table>

        </div>
        <div class="col-1">
        </div>
    </div>

</body>

</html>