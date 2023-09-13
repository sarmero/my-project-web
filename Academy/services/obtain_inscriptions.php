<?php
session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/Academy/commons/db.php";

$pen = $_POST["pensum"];
$sem = $_POST["semester"];
$reg = $_POST["region"];
$sub = $_POST["subject"];
$cal = $_POST["calendar"];

$x = $db->prepare("SELECT users.usrname,users.first_name, users.last_name
FROM public.users
JOIN public.student ON student.user_id = users.id 
JOIN public.inscription ON inscription.student_id = student.id 
JOIN public.offer ON inscription.offer_id = offer.id
JOIN public.calendar ON offer.calendar_id = calendar.id and calendar.id = :c
JOIN public.region ON offer.region_id = region.id and region.id = :r
JOIN public.plan_study ON plan_study.id = offer.plan_study_id 
JOIN public.curriculum ON curriculum.id = plan_study.curriculum_id and curriculum.id = :p
JOIN public.subject ON subject.id = plan_study.subject_id and subject.id = :a
JOIN public.semester ON semester.id = plan_study.semester_id  and semester.id = :s");

$x->bindValue(':s', $sem, PDO::PARAM_INT);
$x->bindValue(':p', $pen, PDO::PARAM_INT);
$x->bindValue(':r', $reg, PDO::PARAM_INT);
$x->bindValue(':c', $cal, PDO::PARAM_INT);
$x->bindValue(':a', $sub, PDO::PARAM_INT);

$x->execute();

$subject = $x->fetchAll();

echo json_encode($subject);
?>

SELECT users.usrname,users.first_name, users.last_name
FROM public.users
JOIN public.student ON student.user_id = users.id 
JOIN public.inscription ON inscription.student_id = student.id 
JOIN public.offer ON inscription.offer_id = offer.id
JOIN public.calendar ON offer.calendar_id = calendar.id and calendar.id = 1
JOIN public.region ON offer.region_id = region.id and region.id = :r
JOIN public.plan_study ON plan_study.id = offer.plan_study_id 
JOIN public.curriculum ON curriculum.id = plan_study.curriculum_id and curriculum.id = 2
JOIN public.subject ON subject.id = plan_study.subject_id and subject.id = 3
JOIN public.semester ON semester.id = plan_study.semester_id  and semester.id = 4