<?php

session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once "$root/Academy/commons/db.php";

$code = $_POST["code"];

$s = $db->prepare('SELECT users.id, users.first_name, users.last_name, semester.semester, profession.profession
FROM public.users
JOIN public.student ON student.user_id = users.id and users.usrname = :c
JOIN public.semester ON student.semester_id = semester.id
JOIN public.profession ON profession.id = student.profession_id
ORDER BY users.first_name ASC');

$s->bindValue(':c', $code, PDO::PARAM_INT);


$s->execute();
$student = $s->fetchAll();

echo json_encode($student);

?>