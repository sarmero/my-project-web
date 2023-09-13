<?php
session_start();

$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/mylib/commons/db.php";

$s = $db->prepare("SELECT users.id, users.first_name, users.last_name, type_user.role FROM public.users JOIN public.type_user ON type_user.id = users.id_user_type");
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
            <h1>Lista de Socios</h1>
        </div>
        <div class="col-3">
            <form action="/mylib/pages/partners.php">
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
                        <th scope="col">Nombre</th>
                        <th scope="col">Rol</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($lr as $l) {

                        echo '<tr>'.
                             '<th scope="row">' . $l["id"] .'</th>'.
                            '<td>' . $l["first_name"] . ' ' . $l["last_name"] . '</td>'.
                            '<td>' .$l["role"] . '</td>'.
                            '</tr>';
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