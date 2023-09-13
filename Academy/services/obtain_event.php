<?php
session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/Academy/commons/db.php";

$eve = $_POST["event"];

$x = $db->prepare("SELECT * FROM public.event where type_event_id = :e
ORDER BY event.event ASC");

$x->bindValue(':e', $eve, PDO::PARAM_INT);
$x->execute();

$subject = $x->fetchAll();

echo json_encode($subject);
?>