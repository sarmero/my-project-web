<?php
session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/Academy/commons/db.php";

$dpt=$_SESSION["department_id"];

$x = $db->prepare("SELECT subject.code, subject.subject FROM public.subject
JOIN public.department ON subject.department_id = department.id and department.id = :i");

$x->bindValue(':i', $dpt, PDO::PARAM_INT);
$x->execute();

$subject = $x->fetchAll();

echo json_encode($subject);
?>