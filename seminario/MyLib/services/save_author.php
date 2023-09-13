<?php

session_start();

$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/mylib/commons/db.php";

$fname = $_POST["first_tname"];
$lname = $_POST["last_name"];
$bdate = $_POST["born_date"];


$s = $db->prepare('INSERT INTO public.author( first_name, last_name, born_date)VALUES (:fn, :ln, :bd);');

$s->bindValue(':fn', $fname, PDO::PARAM_STR);
$s->bindValue(':ln', $lname, PDO::PARAM_STR);
$s->bindValue(':bd', $bdate, PDO::PARAM_STR);

try {
    $s->execute();
    $lr = $s->fetchAll();
    var_dump($lr);
    header("Location: /mylib/pages/author_list.php");
} catch (Exception $e) {
    header("Location: /mylib/pages/author_error.php");
    echo "Error";
}

?>