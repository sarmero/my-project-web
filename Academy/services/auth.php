<?php

session_start();

$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/Academy/commons/db.php";

$user = $_POST["usr"];
$pass = $_POST["pwd"];


//$s = $db->prepare('SELECT * FROM public.users WHERE usrname = :usr AND password = md5(md5(:pwd))');
$s = $db->prepare('SELECT users.*, rolle.type_rolle FROM public.users, public.rolle WHERE usrname = :usr AND password = :pwd and rolle.id = users.rolle_id');


$s->bindValue(':usr', $user, PDO::PARAM_INT);
$s->bindValue(':pwd', $pass, PDO::PARAM_STR);

$s->execute();
//var_dump($s->fetchAll());
$lr = $s->fetchAll();

if (count($lr) > 0) {
    $_SESSION['login'] = true;
    $_SESSION['user_name'] = $lr[0]['first_name'] . " " . $lr[0]['last_name'];
    $_SESSION['first_name'] = $lr[0]['first_name'];
    $_SESSION['last_name'] = $lr[0]['last_name'];
    $_SESSION['id'] = $lr[0]['id'];
    $_SESSION['rolle'] = $lr[0]['rolle_id'];
    $_SESSION['rolle_type'] = $lr[0]['type_rolle'];
    $_SESSION['phone'] = $lr[0]['phone'];
    $_SESSION['email'] = $lr[0]['email'];
    $_SESSION['gender'] = $lr[0]['gender'];

    if ($_SESSION['rolle'] == 1) {
        $x = $db->prepare("SELECT department.id, department.departament
        FROM public.users
        JOIN public.student ON users.id = student.user_id and users.id = :i
        JOIN public.profession ON profession.id = student.profession_id
        JOIN public.department ON department.id = profession.department_id");

    } else if ($_SESSION['rolle'] == 2) {

        $x = $db->prepare("SELECT department.id, department.departament 
        FROM public.users
        JOIN public.teacher ON teacher.user_id = users.id and users.id = :i
        JOIN public.department ON department.id = teacher.department_id");

    } else {

        $x = $db->prepare("SELECT department.id, department.departament 
        FROM public.users
        JOIN public.adminn ON adminn.user_id = users.id and users.id =  :i
        JOIN public.department ON department.id = adminn.department_id");
    }

    $x->bindValue(':i', $_SESSION['id'], PDO::PARAM_INT);

    $x->execute();
    $xr = $x->fetchAll();

    var_dump($xr);

    $_SESSION['departament'] = $xr[0]['departament'];
    $_SESSION['department_id'] = $xr[0]['id'];


} else {
    $_SESSION['login'] = false;
}

header("Location: http://localhost/Academy/");

?>