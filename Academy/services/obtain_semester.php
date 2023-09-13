<?php
session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/Academy/commons/db.php";

$dep = $_SESSION['department_id'];

$x = $db->prepare("SELECT semester.id, semester.semester
FROM public.semester ORDER BY id ASC");

//$x->bindValue(':i', $dep, PDO::PARAM_INT);
$x->execute();

$semester = $x->fetchAll();

echo json_encode($semester);
?>