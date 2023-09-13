<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $pais = $_POST['pais'];
  // Aquí puedes tener tu lógica para obtener las ciudades del país seleccionado
  $ciudades = array();
  //var_dump($pais);

  if ($pais === 'es') {
    $ciudades = array('Madrid', 'Barcelona', 'Sevilla');
  } elseif ($pais === 'fr') {
    $ciudades = array('París', 'Marsella', 'Lyon');
  } elseif ($pais === 'uk') {
    $ciudades = array('Londres', 'Manchester', 'Birmingham');
  }

  echo json_encode($ciudades);
}

?>