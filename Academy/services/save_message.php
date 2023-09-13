<?php
session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once "$root/Academy/commons/db.php";

$hoy = getdate();

$message = $_POST['message'];
$type = $_POST['type'];
$id = $_POST['id'];
$date = $hoy['year'].'-'.$hoy['mon'].'-'. $hoy['mday'];
$time = $hoy['hours'].':'.$hoy['minutes'].':'. $hoy['seconds'];

$response = array();

$s = $db->prepare('INSERT INTO public.department_messages (message, type, date, time, chat_id) VALUES ( :m,:t,:d,:tm,:c)');

$s->bindValue(':m', $message, PDO::PARAM_STR);
$s->bindValue(':t', $type, PDO::PARAM_STR);
$s->bindValue(':d', $date, PDO::PARAM_STR);
$s->bindValue(':tm', $time, PDO::PARAM_STR);
$s->bindValue(':c', $id, PDO::PARAM_INT);


try {
    $s->execute();
    $lr = $s->fetchAll();
    $response['success'] = true;
    $response['message'] = 'Los datos se han guardado correctamente';

} catch (Exception $e) {
    echo "Error";
    $response['success'] = false;
    $response['message'] = 'Solicitud inválida';
    
}

echo json_encode($response);
?>