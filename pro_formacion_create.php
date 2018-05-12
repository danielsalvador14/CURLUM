<?php

if (isset($_POST) && $_GET['cedula_profesional']){
  $conexion = mysqli_connect("localhost", "root", "", "bd_curriculum");
	$sql = 'INSERT INTO grado'.'(id_profesor, cedula_profesional, nombre, id_nivel, institucion, fecha_inicio, fecha_fin, fecha_obtencion)
  VALUES('.$_GET['id'].',"
  '.$_GET['cedula_profesional'].'","
  '.$_GET['nombre'].'",
  '.$_GET['nivel'].',"
  '.$_GET['institucion'].'","
  '.$_GET['fecha_inicio'].'","
  '.$_GET['fecha_fin'].'","
  '.$_GET['fecha_obtencion'].'")';
  mysqli_query($conexion, $sql);
}

header('Location: pro_formacion.php');

?>
