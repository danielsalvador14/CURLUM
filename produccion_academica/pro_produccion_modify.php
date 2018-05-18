<?php

if (isset($_POST) && $_GET['id']){
  $conexion = mysqli_connect("localhost", "root", "", "bd_curriculum");
	$sql = 'UPDATE produccion SET titulo="'.$_GET['titulo'].'",tipo='.$_GET['tipo'].',institucion="'.$_GET['institucion'].'",fecha="'.$_GET['fecha'].'" WHERE numRegistro = '.$_GET['id'];
	mysqli_query($conexion, $sql);
  echo $sql;
}

header('Location: pro_produccion.php');

?>
