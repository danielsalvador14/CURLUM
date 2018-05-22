<?php
  if (isset($_GET['query'])) {

    // Crear Registro
    if (isset($_GET['id_profesor']) && isset($_GET['horas']) && isset($_GET['fecha_inicio']) && isset($_GET['fecha_fin']) && $_GET['query'] == 1) {
      $conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
      //$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");
      $sql = 'INSERT INTO tutoria'.'(id_profesor, horas, fecha_inicio, fecha_fin)
      VALUES('.$_GET['id_profesor'].','.$_GET['horas'].',"'.$_GET['fecha_inicio'].'","'.$_GET['fecha_fin'].'")';
      mysqli_query($conexion, $sql);
      echo $sql;
      $rs = mysqli_query($conexion, "SELECT MAX"."(id".")"." AS ide FROM tutoria");
      if(isset($rs)){
        $row = mysqli_fetch_array($rs);
        header('Location: pro_tutoria_register_alumnos.php?id_tutoria='.$row['ide']);
      }
      else {
        echo "No Primero";
        header('Location: ../profesor.php');
      }
    }
    // Crear Registro Alumno
    elseif (isset($_GET['id_tutoria']) && isset($_GET['nombre']) && isset($_GET['apellidop']) && $_GET['query'] == 2) {
      $conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
      //$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");

      if (isset($_GET['apellidom'])) {
        $sql = 'INSERT INTO alumno'.'(id_tutoria, nombre, apellidoP, apellidoM)
        VALUES('.$_GET['id_tutoria'].',"'.$_GET['nombre'].'","'.$_GET['apellidop'].'","'.$_GET['apellidom'].'")';
      }
      else {
        $sql = 'INSERT INTO alumno'.'(id_tutoria, nombre, apellidoP)
        VALUES('.$_GET['id_tutoria'].',"'.$_GET['nombre'].'","'.$_GET['apellidop'].'")';
      }
      mysqli_query($conexion, $sql);
      echo $sql;
      header('Location: pro_tutoria_register_alumnos.php?id_tutoria='.$_GET['id_tutoria']);
    }
    // Actualizar Registro
    elseif (isset($_GET['id']) && isset($_GET['horas']) && isset($_GET['fecha_inicio']) && isset($_GET['fecha_fin']) && $_GET['query'] == 3) {
      $conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
      //$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");
      $sql = 'UPDATE tutoria SET
      horas = '.$_GET['horas'].',
      fecha_inicio = "'.$_GET['fecha_inicio'].'",
      fecha_fin = "'.$_GET['fecha_fin'].'"
      WHERE id = '.$_GET['id'];
      mysqli_query($conexion, $sql);
      echo $sql;
      header('Location: pro_tutoria.php');
    }
    // Actualizar Registro Alumno
    elseif (isset($_GET['id_tutoria']) && isset($_GET['id_alumno']) && isset($_GET['nombre']) && isset($_GET['apellidop']) && $_GET['query'] == 4) {
      $conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
      //$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");
      if (isset($_GET['apellidom'])) {
        $sql = 'UPDATE alumno SET
        nombre = "'.$_GET['nombre'].'",
        apellidoP = "'.$_GET['apellidop'].'",
        apellidoM = "'.$_GET['apellidom'].'"
        WHERE id = '.$_GET['id_alumno'];
      }
      else {
        $sql = 'UPDATE alumno SET
        nombre = "'.$_GET['nombre'].'",
        apellidoP = "'.$_GET['apellidop'].'",
        apellidoM = ""
        WHERE id = '.$_GET['id_alumno'];
      }
      mysqli_query($conexion, $sql);
      echo $sql;
      header('Location: pro_tutoria_edit.php?id='.$_GET['id_tutoria']);
    }
    // Eliminar Registro Alumno
    elseif (isset($_GET['id_alumno']) && isset($_GET['id']) && $_GET['query'] == 5) {
      $conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
      //$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");
      $sql = 'DELETE FROM alumno WHERE id = '.$_GET['id_alumno'];
      mysqli_query($conexion, $sql);
      echo $sql;
      header('Location: pro_tutoria_edit.php?id='.$_GET['id']);
    }
    else {
      echo "Ningun query";
      header('Location: ../profesor.php');
    }
  }
  else {
    echo "INVALIDO";
    header('Location: ../profesor.php');
  }
?>
