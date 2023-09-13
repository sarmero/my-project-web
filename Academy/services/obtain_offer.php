<?php
session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/Academy/commons/db.php";

$cal = $_POST["calendar"];
$reg = $_POST["region"];
$pen = $_POST["pensum"];
$sem = $_POST["semester"];

$x = $db->prepare("SELECT subject.id, subject.subject, state_offer.state,offer.code
FROM public.offer
JOIN public.calendar ON offer.calendar_id = calendar.id and calendar.id = :c
JOIN public.state_offer ON state_offer.id = offer.state_id 
JOIN public.region ON region.id = offer.region_id and region.id = :r
JOIN public.plan_study ON plan_study.id = offer.plan_study_id
JOIN public.curriculum ON curriculum.id = plan_study.curriculum_id and curriculum.id = :p
JOIN public.semester ON semester.id = plan_study.semester_id and semester.id = :s
JOIN public.subject ON plan_study.subject_id = subject.id");

$x->bindValue(':c', $cal, PDO::PARAM_INT);
$x->bindValue(':r', $reg, PDO::PARAM_INT);
$x->bindValue(':p', $pen, PDO::PARAM_INT);
$x->bindValue(':s', $sem, PDO::PARAM_INT);


$x->execute();

$offer = $x->fetchAll();

echo json_encode($offer);
?>