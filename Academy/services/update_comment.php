<?php

session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once "$root/Academy/commons/db.php";

$id = $_POST["id"];
$res = $_POST["response"];
$response = array();

$s = $db->prepare('UPDATE public.publication_comment SET response = :st where publication_comment.id = :i');
$s->bindValue(':i', $id, PDO::PARAM_INT);
$s->bindValue(':st', $res, PDO::PARAM_STR);

try {
    $s->execute();
    $lr = $s->fetchAll();
    $response['success'] = true;
    $response['message'] = 'Los datos se han modificado correctamente';

} catch (Exception $e) {
    echo "Error";
    $response['success'] = false;
    $response['message'] = 'Solicitud inválida';
}

echo json_encode($response);

?>