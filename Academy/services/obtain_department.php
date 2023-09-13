<?php

session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once "$root/Academy/commons/db.php";

$x = $db->prepare("SELECT department.id, department.departament FROM public.department
ORDER BY department.departament ASC ");

$x->execute();

$department = $x->fetchAll();

echo json_encode($department);

?>