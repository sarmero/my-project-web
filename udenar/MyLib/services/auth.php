<?php

session_start();

$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/mylib/commons/db.php";

$user = $_POST["usr"];
$pass = $_POST["pwd"];


$s = $db->prepare('SELECT * FROM public.users WHERE usrname = :usr AND password = md5(md5(:pwd))');
//$s = $db->prepare('SELECT * FROM public.users WHERE usrname = :usr AND password = :pwd');

$s->bindValue(':usr', $user, PDO::PARAM_STR);
$s->bindValue(':pwd', $pass, PDO::PARAM_STR);

$s->execute();
//var_dump($s->fetchAll());
$lr = $s->fetchAll();

if (count($lr) > 0) {
    $_SESSION['login'] = true;
    $_SESSION['user_name'] = $lr[0]['first_name'] . " " . $lr[0]['last_name'];
    $_SESSION['gender'] = $lr[0]['gender'];
} else {
    $_SESSION['login'] = false;
}

header("Location: http://localhost/mylib/");

?>