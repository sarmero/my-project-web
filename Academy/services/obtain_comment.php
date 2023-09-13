<?php

session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once "$root/Academy/commons/db.php";

$pub = $_POST["publication"];
$dep = $_SESSION['department_id'];

$s = $db->prepare('SELECT publication_comment.id, publication_comment.comment, publication_comment.response, users.first_name
FROM public.publication_comment 
JOIN public.users ON users.id = publication_comment.user_id 
JOIN public.publications ON publications.id = publication_comment.publication_id and publications.id = :c
JOIN public.department ON department.id = publications.department_id and department.id = :d
ORDER BY publication_comment.date, publication_comment.time ASC');

$s->bindValue(':c', $pub, PDO::PARAM_INT);
$s->bindValue(':d', $dep, PDO::PARAM_INT);

$s->execute();
$comment = $s->fetchAll();

echo json_encode($comment);

?>