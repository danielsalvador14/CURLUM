<?php

  if (isset($_POST) && isset($_GET['numregistro']) && isset($_GET['titulo']) && isset($_GET['nombre']) && isset($_GET['apellidop'])){
      $conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
      //$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");

      if (isset($_GET['apellidom'])) {
        $sql = 'INSERT INTO produccion_autores'.'(numRegistro, nombre_autor, apellidoP_autor, apellidoM_autor)
        VALUES('.$_GET['numregistro'].',"'.$_GET['nombre'].'","'.$_GET['apellidop'].'","'.$_GET['apellidom'].'")';
      }
      else {
        $sql = 'INSERT INTO produccion_autores'.'(numRegistro, nombre_autor, apellidoP_autor)
        VALUES('.$_GET['numregistro'].',"'.$_GET['nombre'].'","'.$_GET['apellidop'].'")';
      }
      mysqli_query($conexion, $sql);
      header('Location: pro_produccion_register_autores.php?numregistro='.$_GET['numregistro'].'&titulo='.$_GET['titulo']);
  }
  else {
    header('Location: ../profesor.php');
  }
?>
