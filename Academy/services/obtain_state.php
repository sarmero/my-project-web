<?php
session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/Academy/commons/db.php";

$d = $db->prepare("SELECT * FROM public.states ORDER BY state ASC");
$d->execute();

$state = $d->fetchAll();

echo json_encode($state);
?>