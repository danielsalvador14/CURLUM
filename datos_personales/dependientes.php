<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>DEPENDIENTES ECONÓMICOS | CURLUM</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/style-fuentes.css">
		<link rel="stylesheet" href="../css/style-blog.css">
		<link rel="stylesheet" href="../css/style-formulario.css">
		<link rel="stylesheet" href="../css/font-family.css">
		<link rel="icon" href="../imagenes/CURLUM.ico">
	</head>

	<?php
	session_start();
	$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
    //$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");

	function nombre($username){
		$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
		//$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");
		$sql = "SELECT * FROM profesor WHERE username = '$username'";
		$resultado = mysqli_query($conexion, $sql);
		$persona = mysqli_fetch_array($resultado);
		echo $persona['nombre']." ".$persona['apellidoP']." ".$persona['apellidoM'];
	}

	function getIdProfesor($username){
		$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
		//$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");
		$sql = "SELECT * FROM profesor WHERE username = '$username'";
		$resultado = mysqli_query($conexion, $sql);
		$persona = mysqli_fetch_array($resultado);
		return $persona['id'];
	}

	if(isset($_SESSION['username']) && isset($_SESSION['profesor'])){
		$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
	    //$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");

		if(isset($_POST['guardar'])){

			$idProf = getIdProfesor($_SESSION['username']);
			$nombre = $_POST['nombre'];
			$apeP = $_POST['apellidoP'];
			$apeM = $_POST['apellidoM'];

			$sql = "INSERT INTO profesor_dependiente (id_profesor, nombre_dep, apellidoP_dep, apellidoM_dep) VALUES($idProf, '$nombre', '$apeP', '$apeM' )";
			$resultado = mysqli_query($conexion, $sql);

			header('Location: pro_datos_personales.php');

		}//llave if guardar

		else if(isset($_POST['cancelar'])){
			header('Location: pro_datos_personales.php');
		}
	?>
	<body class="bg-light">
	    <div class="container">
			<header class="blog-header py-3">
		        <div class="row flex-nowrap justify-content-between align-items-center">
		          <div class="col-4 pt-1">
		          	<a><?php echo nombre($_SESSION['username']). " | " .$_SESSION['username']; ?> </a>
		          </div>
		          <div class="col-4 text-center">
		            <a class="blog-header-logo text-dark h-font" href="../profesor.php">CURLUM</a>
		          </div>
		          <div class="col-4 d-flex justify-content-end align-items-center">

		            <a class="btn btn-sm btn-outline-secondary" href="../logout.php">Cerrar Sesión</a>
		          </div>
		        </div>
		    </header>

		     <div class="nav-scroller py-1 mb-2 bg-dark">
		        <nav class="nav d-flex justify-content-between">
		          <a class="p-2 text-white p-font" href="pro_datos_personales.php">Datos Personales</a>
		          <a class="p-2 text-white p-font" href="../formacion_academica/pro_formacion.php">Formación Académica</a>
		          <a class="p-2 text-white p-font" href="../produccion_academica/pro_produccion.php">Producción Académica</a>
		          <a class="p-2 text-white p-font" href="../carga_academica_carga_academica.php">Carga Acádemica</a>
		          <a class="p-2 text-white p-font" href="#">Tutorías</a>
		          <a class="p-2 text-white p-font" href="#">Configuración</a>
		        </nav>
		      </div>

		    <div class="py-5 text-center">
		        <h2 class="h-font">Ingrese los valores del nuevo Dependiente Económico</h2>
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
		                <h6 class="my-0 h-font">Botón "Guardar"</h6>
		                <small class="text-muted p-font">Guarda el Registro con la Información Ingresada.</small>
		              </div>
		            </li>
		            <li class="list-group-item d-flex justify-content-between lh-condensed">
		              <div>
		                <h6 class="my-0 h-font">Botón "Cancelar"</h6>
		                <small class="text-muted p-font">Regresa a la Página anterior.</small>
		              </div>
		            </li>
		          </ul>

		        </div>

		        <div class="col-md-8 order-md-1">
		          <h4 class="mb-3 h-font">Dependiente Económico</h4>
		          <form method="post">
			            <div class="row">

			              <div class="col-md-6 mb-3 p-font">
			                <label for="nombre">Nombre</label>
			                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required>
			                <div class="invalid-feedback">
			                  Se Requiere un Nombre Valido.
			                </div>
			              </div>

			              <div class="col-md-6 mb-3 p-font">
			                <label for="apeP">Apellido Paterno</label>
			                <input type="text" class="form-control" name="apellidoP" id="apellidoP" placeholder="Apellido Paterno" required>
			                <div class="invalid-feedback">
			                  Se Requiere un Apellido Valido.
			                </div>
			              </div>

			              <div class="col-md-6 mb-3 p-font">
			                <label for="apeM">Apellido Materno</label>
			                <input type="text" class="form-control" name="apellidoM" id="apellidoM" placeholder="Apellido Materno"  >
			              </div>
			            </div>

						<div class="col-md-12 mb-12" id="botones">
							<tr>
								<td><input class="btn btn-lg btn-secondary" type="submit" value="Guardar" name="guardar"></td>
								<td><input class="btn btn-lg btn-secondary" type="submit" value="Cancelar" name="cancelar"></td>
							</tr>
						</div>
		          	</form>
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
	<?php }
	else{
		header('Location: ../login.php');
	}
	?>
</html>
