<?php
session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once "$root/Academy/commons/db.php";

$hoy = getdate();

$publication = $_POST['publication'];
$date = $hoy['year'].'-'.$hoy['mon'].'-'. $hoy['mday'];
$dep = $_SESSION['department_id'];

$response = array();

$s = $db->prepare('INSERT INTO public.publications (department_id, publication, date) VALUES ( :d,:p,:f)');

$s->bindValue(':d', $dep, PDO::PARAM_INT);
$s->bindValue(':p', $publication, PDO::PARAM_STR);
$s->bindValue(':f', $date, PDO::PARAM_STR);


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