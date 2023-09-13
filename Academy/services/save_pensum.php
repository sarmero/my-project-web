<?php

session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once "$root/Academy/commons/db.php";


$pro = $_POST["program"];
$name = $_POST["name"];

$s = $db->prepare('INSERT INTO public.curriculum (description, profession_id) 
VALUES ( :u,:p)');

$s->bindValue(':u', $name, PDO::PARAM_STR);
$s->bindValue(':p', $pro, PDO::PARAM_INT);


try {
    $s->execute();
    $lr = $s->fetchAll();
    var_dump($lr);
    header("Location: /Academy/pages/pensumx.php");
} catch (Exception $e) {
    header("Location: /Academy/pages/pensum_error.php");
    echo "Error";
}

?>