<?php
session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/Academy/commons/db.php";

$data = json_decode($_POST["data"]);

foreach ($data as $c) {
    $pensum = $c -> pensum;
    $semester = $c ->semester;
    $region = $c ->region;
}



$x = $db->prepare("SELECT offer.id, subject.subject
FROM public.offer
JOIN public.region ON offer.region_id = region.id and region.id = :r
JOIN public.plan_study ON plan_study.id = offer.plan_study_id 
JOIN public.curriculum ON curriculum.id = plan_study.curriculum_id and curriculum.id = :p
JOIN public.subject ON subject.id = plan_study.subject_id 
JOIN public.semester ON semester.id = plan_study.semester_id  and semester.id = :i
and offer.id Not in(SELECT programming.offer_id from public.programming ) ");

$x->bindValue(':i', $semester, PDO::PARAM_INT);
$x->bindValue(':p', $pensum, PDO::PARAM_INT);
$x->bindValue(':r', $region, PDO::PARAM_INT);
$x->execute();

$subject = $x->fetchAll();

echo json_encode($subject);
?>