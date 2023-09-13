<?php

session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once "$root/Academy/commons/db.php";

$program = $_POST["program"];
$region = $_POST["region"];
$semester = $_POST["semester"];
$dep = $_SESSION['department_id'];


$s = $db->prepare('SELECT users.usrname, users.first_name, users.last_name, users.phone, users.email, 
region.region, profession.profession FROM public.users
JOIN public.student ON student.user_id = users.id
JOIN public.semester ON student.semester_id = semester.id and semester.id = :s
JOIN public.profession ON profession.id = student.profession_id and profession.id = :p
JOIN public.department ON department.id =profession.department_id and department.id = :d
JOIN public.region ON region.id =student.region_id and region.id = :r
ORDER BY users.first_name ASC');

$s->bindValue(':p', $program, PDO::PARAM_INT);
$s->bindValue(':d', $dep, PDO::PARAM_INT);
$s->bindValue(':s', $semester, PDO::PARAM_INT);
$s->bindValue(':r', $region, PDO::PARAM_INT);

$s->execute();
$student = $s->fetchAll();

echo json_encode($student);

?>