<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Academy</title>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/checkout.js"></script>
  <script src="../js/calendar.js"></script>
  <link rel="stylesheet" href="../css/prueba.css">
</head>

<body>
  <!-- Botón para abrir la ventana de diálogo -->
  <button onclick="mostrarDialogo()">Abrir ventana de diálogo</button>

  <!-- Definición de la ventana de diálogo -->

  <dialog id="miDialogo">
    <h2>¡Hola! Esta es una ventana de diálogo simple.</h2>
    <p>Puedes personalizar su contenido como desees.</p>
    <button onclick="cerrarDialogo()">Cerrar</button>
  </dialog>

  <script src="../js/prueba.js"></script>
</body>

</html>