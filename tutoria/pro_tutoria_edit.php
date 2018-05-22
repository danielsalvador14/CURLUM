<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>CURLUM - Tutoría - Editar</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/style-fuentes.css">
		<link rel="stylesheet" href="../css/style-blog.css">
        <link rel="stylesheet" href="../css/style-pro-tutoria-edit.css">
		<link rel="stylesheet" href="../css/font-family.css">
		<link rel="icon" href="../imagenes/CURLUM.ico">

		<script type="text/javascript">
			function solicitarModificacion(_id_tutoria){
				if (!document.getElementById("horas").value){
					alert("Ingrese Horas!");
				}
				else {
					horas = document.getElementById("horas").value;
					fecha_inicio = document.getElementById("fecha_inicio").value;
					fecha_fin = document.getElementById("fecha_fin").value;

					setTimeout("location.href='pro_tutoria_query.php?id="+_id_tutoria+"&horas="+horas+"&fecha_inicio="+fecha_inicio+"&fecha_fin="+fecha_fin+"&query=3'", 0);
				}
			}

			function solicitarModificacionAlumno(id_tutoria_alumno){
				id_tutoria = id_tutoria_alumno.split('|')[0];
				id_alumno = id_tutoria_alumno.split('|')[1];
				setTimeout("location.href='pro_tutoria_edit_alumno.php?id_tutoria="+id_tutoria+"&id_alumno="+id_alumno+"'", 0);
			}
			function borrarAlumno(id_alumno){
				setTimeout("location.href='pro_tutoria_query.php?id="+id_alumno.split('|')[0]+"&id_alumno="+id_alumno.split('|')[1]+"&query=5'", 0);
			}
			function agregarAlumno(_id_tutoria){
				setTimeout("location.href='pro_tutoria_register_alumnos.php?id_tutoria="+_id_tutoria+"'", 0);
			}
			function cancelar(){
				setTimeout("location.href='pro_tutoria.php'", 0);
			}
		</script>
	</head>

	<?php
		session_start();

		function nombre($username){
			$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
		    //$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");
			$sql = 'SELECT * FROM profesor WHERE username = "'.$username.'"';
			$resultado = mysqli_query($conexion, $sql);
			$persona = mysqli_fetch_array($resultado);
			echo $persona['nombre']." ".$persona['apellidoP']." ".$persona['apellidoM'];
		}

		function getTipo($id_produccion){
			$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
		    //$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");
			$sql = 'SELECT * FROM tipo_produccion WHERE numRegistro = "'.$id_produccion.'"';
			$resultado = mysqli_query($conexion, $sql);
			return mysqli_fetch_array($resultado);
		}

		function alumnos($id_tutoria){
			$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
					//$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");
			$sql = 'SELECT * FROM alumno WHERE id_tutoria = "'.$id_tutoria.'"';
			$resultado = mysqli_query($conexion, $sql);
			while ($alumno = mysqli_fetch_array($resultado)) {
				echo '<tr class="tupla-tabla">';
				if ($alumno['apellidoM']) {
					echo '<td><input id='.$alumno['id'].' class="form-control" type="text" value="'.$alumno['nombre'].'_'.$alumno['apellidoP'].'_'.$alumno['apellidoM'].'" disabled> </td>';
				} else {
					echo '<td><input id='.$alumno['id'].' class="form-control" type="text" value="'.$alumno['nombre'].'_'.$alumno['apellidoP'].'" disabled> </td>';
				}
				echo '
					<td><button class="btn btn-lg btn-secondary btn-block btn-tabla" name="modificar_alumno" value="'.$id_tutoria.'|'.$alumno['id'].'" onclick="solicitarModificacionAlumno(value)">Modificar</button></td>
					<td><button class="btn btn-lg btn-secondary btn-block boton-eliminar btn-tabla" name="eliminar_alumno" value="'.$id_tutoria.'|'.$alumno['id'].'" onclick="borrarAlumno(value)">Eliminar</button></td>
				</tr>
				';
			}
		}

		if(isset($_POST['eliminar_tutoria'])){
			$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
	        //$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");
			$sql = 'DELETE FROM alumno WHERE id_tutoria = '.$_GET['id'];
			mysqli_query($conexion, $sql);
			$sql = 'DELETE FROM tutoria WHERE id = '.$_GET['id'];
			mysqli_query($conexion, $sql);
			header('Location: pro_tutoria.php');
		}

		elseif(isset($_SESSION['username']) && isset($_SESSION['profesor'])){
			if(!$_GET['id']){
				header('Location: ../profesor.php');
		}

		$id_tutoria = $_GET['id'];
		$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
	    //$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");
		$sql = 'SELECT * FROM tutoria WHERE id = "'.$id_tutoria.'"';
		$resultado = mysqli_query($conexion, $sql);
		$tutoria = mysqli_fetch_array($resultado);
?>

<body>
	<div class="container">
		<header class="blog-header py-3">
  		<div class="row flex-nowrap justify-content-between align-items-center">
  			<div class="col-4 pt-1">
        	<a>
						<code>
							<?php
								echo nombre($_SESSION['username']). " | " .$_SESSION['username'];
							?>
						</code>
					</a>
      	</div>
  			<div class="col-4 text-center">
    			<a class="blog-header-logo text-dark h-font" href="../profesor.php">CURLUM</a> <!-- Linea modificada -->
  			</div>
  			<div class="col-4 d-flex justify-content-end align-items-center">
    			<a class="btn btn-sm btn-outline-secondary p-font" href="../logout.php">Cerrar Sesión</a>
  			</div>
  		</div>
		</header>

		<div class="nav-scroller py-1 mb-2 bg-dark">
  		<nav class="nav d-flex justify-content-between">
				<a class="p-2 text-white p-font" href="../datos_personales/pro_datos_personales.php">Datos Personales</a>
				<a class="p-2 text-white p-font" href="../formacion_academica/pro_formacion.php">Formación Académica</a>
				<a class="p-2 text-white p-font" href="../produccion_academica/pro_produccion.php">Producción Académica</a>
				<a class="p-2 text-white p-font" href="#">Carga Acádemica</a>
				<a class="p-2 text-white p-font" href="pro_tutoria.php">Tutorías</a>
				<a class="p-2 text-white p-font" href="#">Configuración</a>
  		</nav>
		</div>

		<div class="py-5 text-center">
			 	<h2 class="h-font">Editar Tutoría</h2>
		</div>

		<div class="row">
  		<div class="col-md-4 order-md-2 mb-4">
  			<h4 class="d-flex justify-content-between align-items-center mb-3 h-font">
    			<span class="text-muted">Información Adicional</span>
    			<span class="badge badge-secondary badge-pill">!</span>
  			</h4>
  			<ul class="list-group mb-3">
    			<li class="list-group-item d-flex justify-content-between lh-condensed">
    				<div>
							<h6 class="my-0 h-font">¿Que pasará cuando se presione sobre "Guardar"?</h6>
      				<small class="text-muted p-font">Los cambios serán guardardos en la base de daros inmediantamente. Sea precavido con los cambios hechos.</small>
      				<h6 class="my-0 h-font">¿Que pasará cuando se presione sobre "Eliminar"?</h6>
      				<small class="text-muted p-font">El registro será inmediantamente eliminado de la base de datos. Por lo cual, se recomienda precaución al solicitar esta acción.</small>
							<h6 class="my-0 h-font">¿Que pasará cuando se presione sobre "Terminar"?</h6>
      				<small class="text-muted p-font">Será dirigido a la página 'Tutorías'.</small>
							<h6 class="my-0 h-font">¿Que pasará cuando se presione sobre "Modificar"?</h6>
      				<small class="text-muted p-font">Será dirigido a la página correspondiente para editar el registro.</small>
							<h6 class="my-0 h-font">¿Que pasará cuando se presione sobre "Añadir"?</h6>
      				<small class="text-muted p-font">Será dirigido a la página donde podrá hacer un nuevo registro.</small>
    				</div>
  				</li>
				</ul>
			</div>

			<div class="col-md-8 order-md-1">
				<h4 class="mb-3 h-font">Datos de la Tutoría</h4>
				<form method="post" class="needs-validation">
	  			<div class="row">
						<div class="col-md-6 mb-3">
							<label for="username" class="p-font">Cantidad de Horas</label>
							<?php echo '<input type="text" maxlength=4 class="form-control" id="horas" value="'.$tutoria['horas'].'" required>' ?>
							<div class="invalid-feedback">
								Campo requerido.
							</div>
						</div>

						<div class="col-md-6 mb-3">
						</div>

						<div class="col-md-6 mb-3">
							<div class="fecha">
								<label for="Cnivel" class="p-font">Fecha de Inicio</label><br>
								<input id="fecha_inicio" type="date" name="fecha-inicio" class="cambiar-cursor" value= <?php echo '"'.$tutoria['fecha_inicio'].'"'; ?>>
							</div>
						</div>

						<div class="col-md-6 mb-3">
							<div class="fecha">
								<label for="Cnivel" class="p-font">Fecha de Fin</label><br>
								<input id="fecha_fin" type="date" name="fecha-fin" class="cambiar-cursor" value= <?php echo '"'.$tutoria['fecha_fin'].'"'; ?>>
							</div>
						</div>

						<div class="col-md-6 mb-3">
							<label for="username" class="p-font">Alumnos registrados</label>
							<table id="tabla-alumnos">
								<?php alumnos($_GET['id']); ?>
								<td><button class="btn btn-lg btn-secondary btn-block btn-tabla" name="eliminar_alumno" value=<?php echo '"'.$id_tutoria.'"'; ?> onclick="agregarAlumno(value)">Añadir</button></td>
							</table>
						</div>

						<div id="botones">
							<table>
								<th><button class="btn btn-lg btn-secondary btn-block" name="guardar_cambios" value=<?php echo $id_tutoria; ?> onclick="solicitarModificacion(value)">Guardar</button></th>
								<th><button class="btn btn-lg btn-secondary btn-block boton-eliminar" name="eliminar_tutoria" value=<?php echo '"'.$id_tutoria.'"'; ?>>Eliminar</button></th>
								<th><button class="btn btn-lg btn-secondary btn-block" onclick="cancelar()">Terminar</button></th>
							</table>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<footer class="blog-footer text-white">
		<p>CURLUM<a> Sistema de Curriculums en Línea </a>, by <a> CUCEI's Students </a>.</p>
  	<p><a href="../profesor.php" class="link-color">Regresar</a></p>
	</footer>
	<script src="../js/jquery.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</body>
<?php
	}
	else if(isset($_SESSION['username']) && isset($_SESSION['administrador'])){
		header('Location: ../administrador.php');
	}
	else{
		header('Location: ../login.php');
	}
?>
</html>
