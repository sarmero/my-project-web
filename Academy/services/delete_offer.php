<?php

session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once "$root/Academy/commons/db.php";

$cod = $_POST["code"];
$response = array();

$s = $db->prepare('DELETE FROM public.offer where offer.code = :c');
$s->bindValue(':c', $cod, PDO::PARAM_INT);

try {
    $s->execute();
    $lr = $s->fetchAll();
    $response['success'] = true;
    $response['message'] = 'Los datos se han eliminado correctamente';
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