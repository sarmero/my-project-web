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
            <form action="/mylib/services/save_author.php" method="post">
                <div class="mb-3 row">
                    <label for="firs_tname" class="col-sm-2 col-form-label">Nombres:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="first_tname" id="firs_tname">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="last_name" class="col-sm-2 col-form-label">Apellidos:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="last_name" id="last_name">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="born_date" class="col-sm-2 col-form-label">Fecha de nacimiento:</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="born_date" id="born_date">
                    </div>
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