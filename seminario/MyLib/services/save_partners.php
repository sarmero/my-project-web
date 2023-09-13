<?php

session_start();

$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/mylib/commons/db.php";

$user = $_POST["usr"];
$password = $_POST["pwd"];
$name = $_POST["name"];
$last = $_POST["last"];
$gender = $_POST["gender"];
$role = $_POST["role"];


print($gender);


$s = $db->prepare('INSERT INTO public.users(usrname, password, first_name, last_name, gender, id_user_type) VALUES ( :u, md5(md5(:p)), :f, :l, :g, :idt)');

$s->bindValue(':u', $user, PDO::PARAM_STR);
$s->bindValue(':p', $password, PDO::PARAM_STR);
$s->bindValue(':f', $name, PDO::PARAM_STR);
$s->bindValue(':l', $last, PDO::PARAM_STR);
$s->bindValue(':g', $gender, PDO::PARAM_STR);
$s->bindValue(':idt',$role, PDO::PARAM_INT);



try {
    $s->execute();
    $lr = $s->fetchAll();
    var_dump($s);
    header("Location: /mylib/pages/partners_list.php");
} catch (Exception $e) {
    header("Location: /mylib/pages/partners_error.php");
    echo "Error";
}

?>