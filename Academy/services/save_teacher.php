<?php

session_start();

$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/Academy/commons/db.php";

$_POST["rolle"] = 2;

include_once "./save_user.php";

$user = $_POST["usr"];
$type = $_POST["type"];
$department = $_SESSION['department_id'];

$d = $db->prepare('select id from public.users where users.usrname = :u');
$d->bindValue(':u', $user, PDO::PARAM_INT);

$d->execute();
$dr = $d->fetchAll();
$id = $dr[0]['id'];

$s = $db->prepare('INSERT INTO public.teacher(user_id, department_id, type_teacher_id) 
VALUES ( :u,:p,:f)');

$s->bindValue(':u', $id, PDO::PARAM_INT);
$s->bindValue(':p', $department, PDO::PARAM_INT);
$s->bindValue(':f', $type, PDO::PARAM_INT);

try {
    $s->execute();
    $lr = $s->fetchAll();
    var_dump($lr);
    header("Location: /Academy/pages/teacher_list.php");
} catch (Exception $e) {
    header("Location: /Academy/pages/teacher_error.php");
    echo "Error";
}

?>