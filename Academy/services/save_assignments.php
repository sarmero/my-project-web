<?php
$response = array();
session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once "$root/Academy/commons/db.php";


$event = $_POST["event"];
$id = $_POST["id"];

$s = $db->prepare('INSERT INTO public.achievements (user_id, event_id) 
VALUES ( :i,:e)');

$s->bindValue(':i', $id, PDO::PARAM_INT);
$s->bindValue(':e', $event, PDO::PARAM_INT);


try {
    $s->execute();
    $response['success'] = true;
    $response['message'] = 'Los datos se han guardado correctamente';

} catch (Exception $e) {
    $response['success'] = false;
    $response['message'] = 'Error al guardar';
    //echo "Error";
}

echo json_encode($response);
?>