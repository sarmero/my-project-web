<?php
session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/Academy/commons/db.php";


$dep = $_SESSION['department_id'];

// Aquí puedes tener tu lógica para obtener las ciudades del país seleccionado

$x = $db->prepare("SELECT profession.id,  profession.code, profession.profession
FROM public.profession 
JOIN public.department ON department.id = profession.department_id and department.id = :i");

$x->bindValue(':i', $dep, PDO::PARAM_INT);
$x->execute();

$program = $x->fetchAll();

echo json_encode($program);
?>