<?php



$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/Academy/commons/db.php";

$user = $_POST["usr"];
$password = 1234;
$name = $_POST["name"];
$last = $_POST["last"];
$gender = $_POST["gender"];
$role = $_POST["rolle"];
$email = $_POST["email"];
$phone = $_POST["phone"];

$s = $db->prepare('INSERT INTO public.users(usrname, password, first_name, last_name, gender, rolle_id, email, phone) 
VALUES ( :u,:p, :f, :l, :g, :idt, :e, :ph)');

$s->bindValue(':u', $user, PDO::PARAM_INT);
$s->bindValue(':p', $password, PDO::PARAM_STR);
$s->bindValue(':f', $name, PDO::PARAM_STR);
$s->bindValue(':l', $last, PDO::PARAM_STR);
$s->bindValue(':g', $gender, PDO::PARAM_STR);
$s->bindValue(':idt',$role, PDO::PARAM_INT);
$s->bindValue(':e',$email, PDO::PARAM_STR);
$s->bindValue(':ph',$phone, PDO::PARAM_INT);


try {
    $s->execute();
    $lr = $s->fetchAll();
    //var_dump($s);
    //header("Location: /Academy/pages/teacher_list.php");
} catch (Exception $e) {
    header("Location: /Academy/pages/user_error.php");
    echo "Error";
}

?>