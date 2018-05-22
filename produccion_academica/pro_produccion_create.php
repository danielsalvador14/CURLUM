<?php

  if (isset($_POST) && isset($_GET['titulo']) && isset($_GET['id_profesor']) && isset($_GET['tipo'])
    && isset($_GET['institucion']) && isset($_GET['fecha'])){
    $conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
    //$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");
    $sql = 'INSERT INTO produccion'.'(id_profesor, titulo, tipo, institucion, fecha)
    VALUES('.$_GET['id_profesor'].',"'.$_GET['titulo'].'",'.$_GET['tipo'].',"'.$_GET['institucion'].'","'.$_GET['fecha'].'")';
    mysqli_query($conexion, $sql);
    $rs = mysqli_query($conexion, "SELECT MAX"."(numRegistro".")"." AS num FROM produccion");
    if(isset($rs)){
      $sql = 'SELECT * FROM profesor WHERE id = '.$_GET['id_profesor'];
      $resultado = mysqli_query($conexion, $sql);
      $profesor = mysqli_fetch_array($resultado);

      $row = mysqli_fetch_array($rs);
      if (isset($profesor)) {
        if ($profesor['apellidoM']) {
          header('Location: pro_produccion_create_autor.php?numregistro='.$row['num']."&titulo=".$_GET['titulo']."&nombre=".$profesor['nombre']."&apellidop=".$profesor['apellidoP']."&apellidom=".$profesor['apellidoM']);
        }
        else {
          header('Location: pro_produccion_create_autor.php?numregistro='.$row['num']."&titulo=".$_GET['titulo']."&nombre=".$profesor['nombre']."&apellidop=".$profesor['apellidoP']);
        }
      }
      else {
        header('Location: pro_produccion_register_autores.php?numregistro='.$row['num'].'&titulo='.$_GET['titulo']);
      }
    }
    else {
      header('Location: ../profesor.php');
    }
  }
  else {
    header('Location: ../profesor.php');
  }
?>
