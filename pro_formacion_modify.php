<?php

if (isset($_POST) && $_GET['cedula_profesional']){
  $conexion = mysqli_connect("localhost", "root", "", "bd_curriculum");
	$sql = 'UPDATE grado SET
  nombre="'.$_GET['nombre'].'",
  id_nivel='.$_GET['nivel'].',
  institucion="'.$_GET['institucion'].'",
  fecha_inicio="'.$_GET['fecha_inicio'].'",
  fecha_fin="'.$_GET['fecha_fin'].'",
  fecha_obtencion="'.$_GET['fecha_obtencion'].'"
  WHERE cedula_profesional = "'.$_GET['cedula_profesional'].'"';
	mysqli_query($conexion, $sql);

}

header('Location: pro_formacion.php');

?>
