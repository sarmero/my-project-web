<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/Academy/commons/db.php";

$dep = $_SESSION['department_id'];
$x = $db->prepare("SELECT * FROM public.publications where department_id = :d
ORDER BY date ASC");

$x->bindValue(':d', $dep, PDO::PARAM_INT);
$x->execute();

$xr = $x->fetchAll();
?>

<!-- Page Content  -->

<div class="wrapper d-flex align-items-stretch">
    <?php include './commons/menu.php'; ?>
    <div class="container">
        <?php include './commons/search.php'; ?>
        <div class="row">
            <div class="col-sm-4">
                

            </div>

            <div class="col-sm-8">
                <div class="justify-content-center ">
                    <h6>Publicaciones</h6>

                    <div class="posts">
                        <?php
                        foreach ($xr as $c) {

                            echo '<div class="post">
                                            <div class="row">
                                                <div class="col-1">
                                                    <img src="../image/udenar.png" class="profile-photo">
                                                </div>
                                                <div class="col-11">
                                                    <ul class="list-unstyled">
                                                        <li>' . $_SESSION['departament'] . '</li>
                                                        <li style="color: lightgreen; font-size:70%;">department</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <p>' . $c['publication'] . '</p>
                                            <div class="actions" id="comment" value="' . $c['id'] . '">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <button class="btn btn-sm">👍 Like</button>
                                                    </div>
                                                    <div class="col-6">
                                                        <button class="btn btn-sm">💬 Comentar</button>
                                                    </div>
                                            </div>
                                            </div>
                                            </div>

                                            ';
                        }
                        ?>



                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="./js/jquery.min.js"></script>
<script src="./js/popper.js"></script>
<script src="./js/main.js"></script>