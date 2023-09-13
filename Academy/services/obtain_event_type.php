<?php
session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/Academy/commons/db.php";

$x = $db->prepare("SELECT * FROM public.type_event ORDER BY id ASC ");

$x->execute();

$event = $x->fetchAll();

echo json_encode($event);
?>