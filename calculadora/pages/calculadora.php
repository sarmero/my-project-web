<?php
	$op1 = $_GET['espacio1'];
	$op2 = $_GET['espacio2'];
	$op3 = $_GET['espacio3'];

	if($op3 == '+'){
		$respuesta = $op1 + $op2;
	}else if($op3 == '-'){
		$respuesta = $op1 - $op2;
	}else if($op3 == '*'){
		$respuesta = $op1 * $op2;
	}else if($op3 == '/'){
        if ($op2 > 0) {
            $respuesta = $op1 / $op2;
    
        } else {
            $respuesta = "No es posible realizar una division entre cero";
        }
	}
	echo "La operacion que solicitas es: $op1 $op3 $op2 y la solucion es: ".$respuesta."<br/>";

    echo '<rd><a href="../">regresar</a></rd>';
?>