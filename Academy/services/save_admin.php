<?php

session_start();

$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/Academy/commons/db.php";

$_POST["rolle"] = 4;

include_once "./save_user.php";

$user = $_POST["usr"];
$department = $_SESSION['department_id'];

$d = $db->prepare('select id from public.users where users.usrname = :u');
$d->bindValue(':u', $user, PDO::PARAM_INT);

$d->execute();
$dr = $d->fetchAll();
$id = $dr[0]['id'];

$s = $db->prepare('INSERT INTO public.adminn(user_id, department_id) 
VALUES ( :u,:p)');

$s->bindValue(':u', $id, PDO::PARAM_INT);
$s->bindValue(':p', $department, PDO::PARAM_INT);

try {
    $s->execute();
    $lr = $s->fetchAll();
    var_dump($lr);
    header("Location: /Academy/pages/admin_list.php");
} catch (Exception $e) {
    header("Location: /Academy/pages/admin_error.php");
    echo "Error";
}

?>