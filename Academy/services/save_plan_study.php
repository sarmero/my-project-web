<?php

session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once "$root/Academy/commons/db.php";

$pen=$_POST["pensum"];
$sem=$_POST["semester"];
$sub=$_POST["subject"];

$name = $_POST["name"];
$department = $_SESSION['department_id'];

$s = $db->prepare('INSERT INTO public.plan_study (subject_id, semester_id, curriculum_id) 
VALUES ( :u,:p,:f)');

$s->bindValue(':u', $sub, PDO::PARAM_STR);
$s->bindValue(':p', $sem, PDO::PARAM_INT);
$s->bindValue(':f', $pen, PDO::PARAM_INT);

try {
    $s->execute();
    $lr = $s->fetchAll();
    var_dump($lr);
    header("Location: /Academy/pages/plan_study_list.php");
} catch (Exception $e) {
    header("Location: /Academy/pages/plan_study_error.php");
    echo "Error";
}

?>