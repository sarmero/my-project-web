<?php

session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once "$root/Academy/commons/db.php";

$state = $_POST['state'];


$x = $db->prepare("SELECT region.id, region.region
FROM public.region
JOIN public.states ON states.id = region.state_id and states.id = :i
ORDER BY region.region ASC");

$x->bindValue(':i', $state, PDO::PARAM_INT);
$x->execute();

$region = $x->fetchAll();

echo json_encode($region);

?>