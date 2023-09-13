<?php

$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/mylib/commons/db.php";

$s = $db->prepare("SELECT id, first_name, last_name FROM public.author ORDER BY first_name, last_name");
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
            <form action="/mylib/services/save_book.php" method="post">
                <div class="mb-3 row">
                    <label for="title" class="col-sm-2 col-form-label">Título:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="title" id="title">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="desc" class="col-sm-2 col-form-label">Descripción:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="desc" id="desc">
                    </div>
                </div>
                <div class="mb-3 row">
                    <select class="form-select" name="author" aria-label="Default select example" >
                        <option selected>Escoger autor...</option>
                        <?php
                            foreach($lr as $a){
                                echo '<option value="'.$a["id"].'">'.$a["first_name"].' '.$a["last_name"].'</option>';
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