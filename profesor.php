<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>CURLUM</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style-fuentes.css">
		<link rel="stylesheet" href="css/style-blog.css">
		<link rel="icon" href="imagenes/CURLUM.ico">
	</head>

	<?php 
	session_start();

	function nombre($username){
						$conexion = mysqli_connect("localhost", "root", "", "bd_curriculum");
						$sql = "SELECT * FROM profesor WHERE username = '$username'";
						$resultado = mysqli_query($conexion, $sql);
						$persona = mysqli_fetch_array($resultado);
						echo $persona['nombre']." ".$persona['apellidoP']." ".$persona['apellidoM'];
					}
	function getIdProfesor($username){
						$conexion = mysqli_connect("localhost", "root", "", "bd_curriculum");
						$sql = "SELECT * FROM profesor WHERE username = '$username'";
						$resultado = mysqli_query($conexion, $sql);
						$persona = mysqli_fetch_array($resultado);
						echo $persona['id'];
					}

	if(isset($_SESSION['username']) && isset($_SESSION['profesor'])){ 
	?>

		<body>
			<div class="container">
		      <header class="blog-header py-3">
		        <div class="row flex-nowrap justify-content-between align-items-center">
		          <div class="col-4 pt-1">
		          	<a><?php echo nombre($_SESSION['username']). " | " .$_SESSION['username']; ?> </a>
		            <!--<a class="text-muted" href="index.php">Index</a> -->
		          </div>
		          <div class="col-4 text-center">
		            <a class="blog-header-logo text-dark" href="#">CURLUM</a>
		          </div>
		          <div class="col-4 d-flex justify-content-end align-items-center">

		            <a class="btn btn-sm btn-outline-secondary" href="index.php">Cerrar Sesión</a>
		          </div>
		        </div>
		      </header>

		      <div class="nav-scroller py-1 mb-2 bg-dark">
		        <nav class="nav d-flex justify-content-between">
		          <a class="p-2 text-white" href="pro_datos_personales.php">Datos Personales</a>
		          <a class="p-2 text-white" href="#">Formación Académica</a>
		          <a class="p-2 text-white" href="#">Producción Académica</a>
		          <a class="p-2 text-white" href="#">Carga Acádemica</a>
		          <a class="p-2 text-white" href="#">Tutorías</a>
		          <a class="p-2 text-white" href="#">Configuración</a>
		        </nav>
		      </div>

		      <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
		        <div class="col-md-6 px-0">
		          <h1 class="display-4 font-italic">CURLUM</h1>
		          <p class="lead my-3">A través de una interfaz amigable con el usuario CURLUM permite gestionar la información de los profesores y generar, a partir de esta, un curriculum vitae personalizado, además provee la función de exportar su currículum en distintos formatos.</p>
		        </div>
		      </div>

		      <div class="row mb-2">
		        <div class="col-md-6">
		          <div class="card flex-md-row mb-4 box-shadow h-md-250">
		            <div class="card-body d-flex flex-column align-items-start">
		              <h3 class="mb-0">
		                <a class="text-dark">Características de CURLUM</a>
		              </h3><p class="card-text mb-auto">Con CURLUM usted podrá Registrar: </p>
		              <p> <ul>
		              	<li>Datos Personales.</li> <li>Formación Académica.</li> <li>Producción Académica.</li> <li>Carga Académica. </li><li>Tutorías</li></ul></p>
		            </div>
		            <!-- <img class="card-img-right flex-auto d-none d-lg-block" data-src="holder.js/200x250?theme=thumb" alt="Card image cap"> -->
		          </div>
		        </div>
		        <div class="col-md-6">
		          <div class="card flex-md-row mb-4 box-shadow h-md-250">
		            <div class="card-body d-flex flex-column align-items-start">
		              <h3 class="mb-0">
		                <a class="text-dark" >Usos de CURLUM</a>
		              </h3>
		              <p class="card-text mb-auto"><ul>
		              <li>Gestione su información de manera rápida y sencilla.</li><li>Actualice sus últimos logros y actividades<li>Lleve consigo su experiencia laboral en el curriculum vitae.</li></ul></p>

		            </div>
		            <!--<img class="card-img-right flex-auto d-none d-lg-block" data-src="holder.js/200x250?theme=thumb" alt="Card image cap"> -->
		          </div>
		        </div>
		      </div>
		    </div>

		    <footer class="blog-footer text-white">
		      <p>CURLUM<a> Sistema de Curriculums en Línea </a>, by <a> CUCEI's Students </a>.</p>
		      <p>
		        <a href="#">Volver al Inicio</a>
		      </p>
		    </footer>

			<script src="js/jquery.js"></script>
	    	<script src="js/bootstrap.min.js"></script>
		</body>
	<?php 
	}
	else if(isset($_SESSION['username']) && isset($_SESSION['administrador'])){
		header('Location: administrador.php');
	}
	else{
		header('Location: login.php');
	}
	?>
</html>