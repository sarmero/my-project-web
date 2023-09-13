<?php

session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once "$root/Academy/commons/db.php";

$name = $_POST["subject"];
$department = $_SESSION['department_id'];

$s = $db->prepare('INSERT INTO public.subject (subject, department_id) 
VALUES ( :u,:p)');

$s->bindValue(':u', $name, PDO::PARAM_STR);
$s->bindValue(':p', $department, PDO::PARAM_INT);

try {
    $s->execute();
    $lr = $s->fetchAll();
    var_dump($lr);
    header("Location: /Academy/pages/subject.php");
} catch (Exception $e) {
    //header("Location: /Academy/pages/subject_error.php");
    echo "Error";
}

?>