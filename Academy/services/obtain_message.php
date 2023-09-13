<?php

session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once "$root/Academy/commons/db.php";

$id = $_POST["id"];

$s = $db->prepare('SELECT department_messages.* FROM public.department_messages
JOIN public.department_chat ON department_chat.id = department_messages.chat_id and department_chat.id = :c
ORDER BY date,time ASC');

$s->bindValue(':c', $id, PDO::PARAM_INT);

$s->execute();
$chat = $s->fetchAll();

echo json_encode($chat);

?>