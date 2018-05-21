<?php

if (isset($_POST) && isset($_GET['cedula_profesional']) && isset($_GET['nombre'])
&& isset($_GET['nivel']) && isset($_GET['institucion']) && isset($_GET['fecha_inicio'])
&& isset($_GET['fecha_fin']) && isset($_GET['fecha_obtencion'])){
  $conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
  //$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");

	$sql = 'UPDATE grado SET
  nombre = "'.$_GET['nombre'].'",
  id_nivel = '.$_GET['nivel'].',
  institucion = "'.$_GET['institucion'].'",
  fecha_inicio = "'.$_GET['fecha_inicio'].'",
  fecha_fin = "'.$_GET['fecha_fin'].'",
  fecha_obtencion = "'.$_GET['fecha_obtencion'].'"
  WHERE cedula_profesional = "'.$_GET['cedula_profesional'].'"';
	mysqli_query($conexion, $sql);
  header('Location: pro_formacion.php');
}
else {
  header('Location: ../profesor.php');
}

?>
