<?php

$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/mylib/commons/db.php";

$s = $db->prepare("SELECT id, role FROM public.type_user ORDER BY role");
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
    <div class="row">
        <div class="col-3">
        </div>
        <div class="col-6">
            <br><br><br>
            <form action="/mylib/services/save_partners.php" method="post">
                <div class="mb-3 row">
                    <label for="title" class="col-sm-2 col-form-label">Usuario:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="usr" id="usr">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="desc" class="col-sm-2 col-form-label">Contraseña:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="pwd" id="pwd">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="title" class="col-sm-2 col-form-label">Nombre:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="desc" class="col-sm-2 col-form-label">Apellido:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="last" id="last">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="desc" class="col-sm-2 col-form-label">Genero:</label>
                    <select class="form-select" name="gender" aria-label="Default select example" >
                        <option value="M" selected>Hombre</option>
                        <option value="F" selected>Muger</option>
                    </select>
                </div>
                <div class="mb-3 row">
                    <select class="form-select" name="role" aria-label="Default select example" >
                        <option selected>Escoger rol...</option>
                        <?php
                            foreach($lr as $a){
                                echo '<option value="'.$a["id"].'">'.$a["role"].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Guardar</button>
                </div>
            </form>
        </div>
        <div class="col-3">
        </div>
    </div>

</body>

</html>