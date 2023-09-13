<?php

session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once "$root/Academy/commons/db.php";

$cod = $_POST["code"];
$sta = $_POST["subject"];
$response = array();

$s = $db->prepare('UPDATE public.subject SET subject = :st where subject.code = :c');
$s->bindValue(':c', $cod, PDO::PARAM_INT);
$s->bindValue(':st', $sta, PDO::PARAM_STR);

try {
    $s->execute();
    $lr = $s->fetchAll();
    $response['success'] = true;
    $response['message'] = 'Los datos se han modificado correctamente';
    echo json_encode($response);
    //header("Location: /Academy/pages/teacher_list.php");
} catch (Exception $e) {
    //header("Location: /Academy/pages/offer_error.php");
    echo "Error";
    $response['success'] = false;
    $response['message'] = 'Solicitud inválida';
    echo json_encode($response);
}

?>