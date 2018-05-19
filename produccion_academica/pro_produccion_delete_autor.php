<?php
	if (isset($_POST) && isset($_GET['numregistro']) && isset($_GET['nombre'])
		&& isset($_GET['apellidop']) && isset($_GET['apellidom'])){
		$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
		//$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");
		$sql = 'DELETE FROM produccion_autores WHERE numRegistro = '.$_GET['numregistro'].' AND nombre_autor = "'.$_GET['nombre'].'" AND apellidoP_autor = "'.$_GET['apellidop'].'" AND apellidoM_autor = "'.$_GET['apellidom'].'"';

		mysqli_query($conexion, $sql);

		header('Location: pro_produccion_edit.php?id='.$_GET['numregistro']);
	} 
	else {
		header('Location: pro_produccion.php');
	}
?>
