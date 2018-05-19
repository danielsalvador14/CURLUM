<?php

	if (isset($_POST) && $_GET['id']){
		$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
	    //$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");
		$sql = 'UPDATE produccion SET titulo="'.$_GET['titulo'].'",tipo='.$_GET['tipo'].',institucion="'.$_GET['institucion'].'",fecha="'.$_GET['fecha'].'" WHERE numRegistro = '.$_GET['id'];
		mysqli_query($conexion, $sql);
	  	echo $sql;
	}

	header('Location: pro_produccion.php');

?>
