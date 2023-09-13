<?php
$response = array();

session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once "$root/Academy/commons/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados por AJAX
    $dayWeek = $_POST['dayWeek'];
    $date = $_POST['date'];
    $star = $_POST['star'];
    $end = $_POST['end'];
    $offer = $_POST['offer'];

    $x = $db->prepare("SELECT programming.id FROM public.programming 
    JOIN public.offer ON offer.id = programming.offer_id and offer.id = :i");

    $x->bindValue(':i', $offer, PDO::PARAM_INT);
    $x->execute();

    $lr = $x->fetchAll();

    if (count($lr) > 0) {
        $pro = $lr[0]['id'];

        $s = $db->prepare('INSERT INTO public.timetable(date, programming_id, day_week_id, star_time, end_time ) 
        VALUES ( :dt, :p, :dw, :st, :et)');

        $s->bindValue(':dt', $date, PDO::PARAM_STR);
        $s->bindValue(':p', $pro, PDO::PARAM_INT);
        $s->bindValue(':dw', $dayWeek, PDO::PARAM_INT);
        $s->bindValue(':st', $star, PDO::PARAM_STR);
        $s->bindValue(':et', $end,  PDO::PARAM_STR);



        // Responder al cliente con un mensaje de éxito
        $response['success'] = true;
        $response['message'] = 'Los datos se han guardado correctamente';

        try {
            $s->execute();
            $lr = $s->fetchAll();
            $response['success'] = true;
            //header("Location: /Academy/pages/admin_list.php");
            echo json_encode($response);
        } catch (Exception $e) {
            //header("Location: /Academy/pages/calendar_error.php");
            $response['success'] = false;
            echo json_encode($response);
            echo "Error";
        }

    } else {
        $response['success'] = false;
        $response['message'] = 'Error la asignatura ya se encuentra programada';
        echo json_encode($response);
    }

} 

// Devolver la respuesta como JSON
//header('Content-Type: application/json');



?>