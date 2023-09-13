<?php
session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/Academy/commons/db.php";

$pen=$_POST["pensum"];
$pro=$_POST["program"];
$sem=$_POST["semester"];

$x = $db->prepare("SELECT subject.id, subject.subject
FROM public.plan_study
JOIN public.curriculum ON plan_study.curriculum_id = curriculum.id and curriculum.id = :c
JOIN public.profession ON profession.id = curriculum.profession_id and profession.id = :p
JOIN public.semester ON semester.id = plan_study.semester_id and semester.id = :s
JOIN public.subject ON plan_study.subject_id = subject.id");

$x->bindValue(':c', $pen, PDO::PARAM_INT);
$x->bindValue(':p', $pro, PDO::PARAM_INT);
$x->bindValue(':s', $sem, PDO::PARAM_INT);

$x->execute();

$subject = $x->fetchAll();

echo json_encode($subject);
?>