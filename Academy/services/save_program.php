<?php

session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once "$root/Academy/commons/db.php";


$form = $_POST["formation"];
$name = $_POST["name"];
$department = $_SESSION['department_id'];

$s = $db->prepare('INSERT INTO public.profession (profession, department_id, formation_id) 
VALUES ( :u,:p,:f)');

$s->bindValue(':u', $name, PDO::PARAM_STR);
$s->bindValue(':p', $department, PDO::PARAM_INT);
$s->bindValue(':f', $form, PDO::PARAM_INT);

try {
    $s->execute();
    $lr = $s->fetchAll();
    var_dump($lr);
    header("Location: /Academy/pages/program.php");
} catch (Exception $e) {
    header("Location: /Academy/pages/program_error.php");
    echo "Error";
}

?>