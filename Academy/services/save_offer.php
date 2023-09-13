<?php

session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once "$root/Academy/commons/db.php";


$cal = $_POST["calendar"];
$reg = $_POST["region"];
$pen = $_POST["pensum"];
$sub = $_POST["subject"];
$sem = $_POST["semester"];
$sta = 1;
$response = array();


$x = $db->prepare("SELECT plan_study.id
FROM public.plan_study
JOIN public.curriculum ON plan_study.curriculum_id = curriculum.id and curriculum.id = :c
JOIN public.semester ON semester.id = plan_study.semester_id and semester.id = :s
JOIN public.subject ON plan_study.subject_id = subject.id and subject.id = :a");

$x->bindValue(':c', $pen, PDO::PARAM_INT);
$x->bindValue(':a', $sub, PDO::PARAM_INT);
$x->bindValue(':s', $sem, PDO::PARAM_INT);

$x->execute();

$pla = $x->fetchAll();

$s = $db->prepare('INSERT INTO public.offer (plan_study_id, calendar_id, region_id, state_id) 
VALUES ( :pl,:c,:r,:s)');

$s->bindValue(':pl', $pla[0][0], PDO::PARAM_INT);
$s->bindValue(':c', $cal, PDO::PARAM_INT);
$s->bindValue(':r', $reg, PDO::PARAM_INT);
$s->bindValue(':s', $sta, PDO::PARAM_INT);


try {
    $s->execute();
    $lr = $s->fetchAll();
    $response['success'] = true;
    $response['message'] = 'Los datos se han guardado correctamente';
    echo json_encode($response);
    //header("Location: /Academy/pages/teacher_list.php");
} catch (Exception $e) {
    //header("Location: /Academy/pages/offer_error.php");
    echo "Error";
    $response['success'] = false;
    $response['message'] = 'Solicitud inválida';
    echo json_encode($response);
}

?>