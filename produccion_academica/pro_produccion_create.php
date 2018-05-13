<?php

if (isset($_POST) && isset($_GET['titulo'])){
  $conexion = mysqli_connect("localhost", "root", "", "bd_curriculum");
	$sql = 'INSERT INTO produccion'.'(id_profesor, titulo, tipo, institucion, fecha)
  VALUES('.$_GET['id_profesor'].',"
  '.$_GET['titulo'].'",
  '.$_GET['tipo'].',"
  '.$_GET['institucion'].'","
  '.$_GET['fecha'].'")';
  mysqli_query($conexion, $sql);

  echo $sql;

  $rs = mysqli_query($conexion, "SELECT MAX"."(numRegistro".")"." AS numRegistro FROM produccion");

  if(isset($rs))
  {
      $row = mysqli_fetch_array($rs);
      header('Location: pro_produccion_register_autores.php?numregistro='.$row['numRegistro'].'&titulo='.$_GET['titulo']);
  }

}

header('Location: pro_produccion.php');

?>
