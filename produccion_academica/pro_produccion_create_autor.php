<?php

if (isset($_POST) && $_GET['numregistro']){
  $conexion = mysqli_connect("localhost", "root", "", "bd_curriculum");

  if ($_GET['apellidom']) {
    $sql = 'INSERT INTO produccion_autores'.'(numRegistro, nombre_autor, apellidoP_autor, apellidoM_autor)
    VALUES('.$_GET['numregistro'].',"
    '.$_GET['nombre'].'","
    '.$_GET['apellidop'].'","
    '.$_GET['apellidom'].'")';
  } else {
    $sql = 'INSERT INTO produccion_autores'.'(numRegistro, nombre_autor, apellidoP_autor)
    VALUES('.$_GET['numregistro'].',"
    '.$_GET['nombre'].'","
    '.$_GET['apellidop'].'")';
  }

  mysqli_query($conexion, $sql);

  header('Location: pro_produccion.php');
}

header('Location: pro_produccion.php');

?>
