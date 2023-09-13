<?php

session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once "$root/Academy/commons/db.php";

$cal = $_POST['calendar'];
$dep = $_SESSION['department_id'];
$pen = $_POST["pensum"];
$sem = $_POST["semester"];
$reg = $_POST["region"];


$x = $db->prepare("SELECT subject.subject, timetable.date,
users.first_name, timetable.star_time, timetable.end_time, timetable.day_week_id
FROM public.offer
JOIN public.region ON offer.region_id = region.id and region.id = :r
JOIN public.calendar ON calendar.id = offer.calendar_id and calendar.id = :c
JOIN public.plan_study ON plan_study.id = offer.plan_study_id
JOIN public.curriculum ON plan_study.curriculum_id = curriculum.id and curriculum.id = :p
JOIN public.subject ON subject.id = plan_study.subject_id
JOIN public.department ON subject.department_id = department.id and department.id = :d
JOIN public.programming ON programming.offer_id = offer.id
JOIN public.timetable ON timetable.programming_id = programming.id
JOIN public.teacher ON teacher.id = programming.teacher_id
JOIN public.semester ON plan_study.semester_id = semester.id and semester.id = :s
JOIN public.users ON teacher.user_id =users.id ORDER BY  timetable.date, timetable.star_time, 
timetable.day_week_id ASC");

$x->bindValue(':r', $reg, PDO::PARAM_INT);
$x->bindValue(':c', $cal, PDO::PARAM_INT);
$x->bindValue(':p', $pen, PDO::PARAM_INT);
$x->bindValue(':d', $dep, PDO::PARAM_INT);
$x->bindValue(':s', $sem, PDO::PARAM_INT);

$x->execute();
$calendar = $x->fetchAll();

echo json_encode($calendar);

?>