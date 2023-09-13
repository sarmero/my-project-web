<?php

session_start();

$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/Academy/commons/db.php";

$_POST["rolle"] = 1;
include_once "./save_user.php";
$user = $_POST["usr"];

// academico iformacion;
$program = $_POST["program"];
$pensum = $_POST["pensum"];
$region = $_POST["region"];
$semester = $_POST["semester"];

$d = $db->prepare('select id from public.users where users.usrname = :u');
$d->bindValue(':u', $user, PDO::PARAM_INT);

$d->execute();
$dr = $d->fetchAll();
$id = $dr[0]['id'];

$s = $db->prepare('INSERT INTO public.student(user_id, profession_id, curriculum_id, semester_id, region_id) 
VALUES ( :u,:p, :f, :l, :g)');

$s->bindValue(':u', $id, PDO::PARAM_INT);
$s->bindValue(':p', $program, PDO::PARAM_INT);
$s->bindValue(':f', $pensum, PDO::PARAM_INT);
$s->bindValue(':l', $semester, PDO::PARAM_INT);
$s->bindValue(':g', $region, PDO::PARAM_INT);


try {
    $s->execute();
    $lr = $s->fetchAll();
    var_dump($s);
    header("Location: /Academy/pages/student_list.php");
} catch (Exception $e) {
    header("Location: /Academy/pages/student_error.php");
    echo "Error";
}

?>