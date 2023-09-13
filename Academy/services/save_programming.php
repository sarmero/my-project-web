<?php
session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once "$root/Academy/commons/db.php";

$offer = $_POST['offer'];
$teacher = $_POST['teacher'];

$response = array();

$s = $db->prepare('INSERT INTO public.programming (offer_id, teacher_id) VALUES ( :o,:t)');

$s->bindValue(':o', $offer, PDO::PARAM_INT);
$s->bindValue(':t', $teacher, PDO::PARAM_INT);

try {
    $s->execute();
    $lr = $s->fetchAll();
    $response['success'] = true;
    $response['message'] = 'Los datos se han guardado correctamente';
    $response['response'] = 2;
    echo json_encode($response);
    //header("Location: /Academy/pages/teacher_list.php");
} catch (Exception $e) {
    //header("Location: /Academy/pages/admin_error.php");
    echo "Error";
    $response['success'] = false;
    $response['message'] = 'Solicitud inválida';
    $response['response'] = -1;
    echo json_encode($response);
}


?>