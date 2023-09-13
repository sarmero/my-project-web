<?php
session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/Academy/commons/db.php";


$dep = $_SESSION['department_id'];
$pro = $_POST['program'];

// Aquí puedes tener tu lógica para obtener las ciudades del país seleccionado

$x = $db->prepare("SELECT curriculum.id, curriculum.code, curriculum.description, profession.profession
FROM public.curriculum
JOIN public.profession ON profession.id = curriculum.profession_id and profession.id = :p
JOIN public.department ON profession.department_id = department.id and  department.id = :i
ORDER BY curriculum.description ASC");

$x->bindValue(':i', $dep, PDO::PARAM_INT);
$x->bindValue(':p', $pro, PDO::PARAM_INT);
$x->execute();

$pensum = $x->fetchAll();

echo json_encode($pensum);
?>