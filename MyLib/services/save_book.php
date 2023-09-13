<?php

session_start();

$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/mylib/commons/db.php";

$title = $_POST["title"];
$desc = $_POST["desc"];
$author = $_POST["author"];




$s = $db->prepare('INSERT INTO public.book(id_author, title, description, state) VALUES ( :ida, :t, :d, true)');

$s->bindValue(':ida', $author, PDO::PARAM_INT);
$s->bindValue(':t', $title, PDO::PARAM_STR);
$s->bindValue(':d', $desc, PDO::PARAM_STR);



try {
    $s->execute();
    $lr = $s->fetchAll();
    var_dump($s);
    header("Location: /mylib/pages/book_list.php");
} catch (Exception $e) {
    header("Location: /mylib/pages/book_error.php");
    echo "Error";
}

?>