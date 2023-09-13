<?php

session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once "$root/Academy/commons/db.php";

$event = $_POST["event"];
$type = $_POST["type"];

$s = $db->prepare('INSERT INTO public.event (event, type_event_id) 
VALUES ( :e,:t)');

$s->bindValue(':t', $type, PDO::PARAM_STR);
$s->bindValue(':e', $event, PDO::PARAM_INT);

try {
    $s->execute();
    $lr = $s->fetchAll();
    var_dump($lr);
} catch (Exception $e) {
    header("Location: /Academy/pages/event_error.php");
    echo "Error";
}

?>