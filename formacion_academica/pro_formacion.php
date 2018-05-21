<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>CURLUM - Formación Académica</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/style-fuentes.css">
		<link rel="stylesheet" href="../css/style-blog.css">
    <link rel="stylesheet" href="../css/style-pro-formacion.css">
		<link rel="stylesheet" href="../css/font-family.css">
		<link rel="icon" href="../imagenes/CURLUM.ico">

		<script type="text/javascript">

			function editarGrado(_cedula){
				console.log("Modificar Grado!");
				setTimeout("location.href='pro_formacion_edit.php?cedula_profesional="+_cedula+"'", 0);
			}

		</script>
	</head>

	<?php
	session_start();

	function nombre($username){
		$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
		//$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");

		$sql = "SELECT * FROM profesor WHERE username = '$username'";
		$resultado = mysqli_query($conexion, $sql);
		$persona = mysqli_fetch_array($resultado);
		echo $persona['nombre']." ".$persona['apellidoP']." ".$persona['apellidoM'];
	}
	function getProfesor($username){
		$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
		//$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");

		$sql = "SELECT * FROM profesor WHERE username = '$username'";
		$resultado = mysqli_query($conexion, $sql);
		return mysqli_fetch_array($resultado);
	}
	function getNivel($idnivel){
		$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
		//$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");

		$sql = "SELECT * FROM nivel WHERE id = '$idnivel'";
		$resultado = mysqli_query($conexion, $sql);
		return mysqli_fetch_array($resultado);
	}
	function grados($persona){
		$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
		//$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");

		$sql = "SELECT * FROM grado WHERE id_profesor = ".$persona['id'];
		$resultado = mysqli_query($conexion, $sql);
		if ($resultado) {
			$cont = 0;
			while($grados = mysqli_fetch_array($resultado)){
				if ($cont == 0) {
					echo '<div class="row mb-2">';
				}
				echo '
				<div class="col-md-6">
					<div class="card flex-md-row mb-4 box-shadow h-md-250">
						<div class="card-body d-flex flex-column align-items-start">
							<h3 class="mb-0 h-font">
								<a class="text-dark">'.getNivel($grados['id_nivel'])['nombre'].' '.$grados['nombre'].'</a>
							</h3>
							<h4>
								<a class="text-dark h-font"><span class="p-font">Institución: </span>'.$grados['institucion'].'</a>
							</h4>
							<p class="card-text mb-auto p-font">Cédula Profesional: '.$grados['cedula_profesional'].'</p>
							<p>
								<ul class="lista-grado">
									<li>Fehca de inicio de carrera: '.$grados['fecha_inicio'].'</li>
									<li>Fecha de fin de carrera: '.$grados['fecha_fin'].'</li>
									<li>Fecha de obtenido de título: '.$grados['fecha_obtencion'].'</li>
								</ul>
								<div class="boton-editar">
									<button class="btn btn-lg btn-secondary btn-block" name="eliminar" onclick="editarGrado('."'".$grados['cedula_profesional']."'".')">Editar</button>
								</div>
							</p>
						</div>
					</div>
				</div>
				';
				if ($cont == 1) {
					echo "</div>";
					$cont = 0;
				}
				else {
					$cont += 1;
				}
			}
			if ($cont == 1) {
				echo "</div>";
			}
		}
		else {
			echo "<tr><th colspan=".'"7"'."><center> NO HAY REGISTROS </center></th></tr>";
		}
	}

	if(isset($_SESSION['username']) && isset($_SESSION['profesor'])){
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
          <a class="p-2 text-white p-font">Formación Académica</a>
          <a class="p-2 text-white p-font" href="../produccion_academica/pro_produccion.php">Producción Académica</a>
          <a class="p-2 text-white p-font" href="#">Carga Acádemica</a>
          <a class="p-2 text-white p-font" href="#">Tutorías</a>
          <a class="p-2 text-white p-font" href="#">Configuración</a>
        </nav>
      </div>

			<div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
				<div class="col-md-6 px-0">
					<h1 class="display-4 font-italic h-font">Formación Académica</h1>
					<p class="lead my-3">En este módulo encontrará los registros de los niveles académicos que ha obtenido. Puede agregar, modificar o incluso eliminar un registro.</p>
				</div>
			</div>

      <div>
				<div class="div-boton-crear">
					<a href="pro_formacion_register.php"><button class="btn btn-lg btn-secondary btn-block" name="crear" type="submit">Registrar</button></a>
					<br><br><br>
				</div>
        <div id="grados-registros" class="div-grados">
					<?php grados(getProfesor($_SESSION['username'])); ?>
        </div>
      </div>
		</div>

    <footer class="blog-footer text-white pos-food">
      <p>CURLUM<a> Sistema de Curriculums en Línea </a>, by <a> CUCEI's Students </a>.</p>
      <p>
        <a href="../profesor.php" class="link-color">Volver al Inicio</a>
      </p>
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
