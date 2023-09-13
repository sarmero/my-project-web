<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academy</title>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/offer.css">
    <link rel="stylesheet" href="../css/department.css">

</head>

<body>
    <? //php include './commons/menu1.php'; ?>
    <div class="text-left">
        <?php

        session_start();

        if (isset($_SESSION['login'])) {
            if ($_SESSION['login'] == true) {
                include './pages/home.php';
            } else {
                include './pages/login.php';
            }
        } else {
            include './pages/login.php';
        }
        ?>
   
</body>

</html>