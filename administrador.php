<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>CURLUM</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style-fuentes.css">
		<link rel="stylesheet" href="css/style-blog.css">
		<link rel="stylesheet" href="css/font-family.css">
		<link rel="icon" href="imagenes/CURLUM.ico">
	</head>

	<?php
	session_start();

	if(isset($_SESSION['username']) && isset($_SESSION['administrador'])){
	?>

		<body>
			<div class="container">
				<header class="blog-header py-3">
					<div class="row flex-nowrap justify-content-between align-items-center">
						<div class="col-4 pt-1">
							<a><?php echo "Administrador: ".$_SESSION['username']; ?> </a>
						</div>
						<div class="col-4 text-center">
							<a class="blog-header-logo text-dark h-font" href="administrador.php">CURLUM</a>
						</div>
					  	<div class="col-4 d-flex justify-content-end align-items-center">
					    	<a class="btn btn-sm btn-outline-secondary" href="logout.php">Cerrar Sesión</a>
					  	</div>
					</div>
				</header>

				<div class="nav-scroller py-1 mb-2 bg-dark">
					<nav class="nav d-flex justify-content-between">
					  	<a class="p-2 text-white p-font" href="administrador/user_profesor.php">Profesores Registrados</a>
					  	<a class="p-2 text-white p-font" href="administrador/user_profesor_add.php">Registrar Nuevo Usuario</a>
					  	<a class="p-2 text-white p-font" href="administrador/administrar_usuarios.php">Modificar Usuario</a>
					  	<a class="p-2 text-white p-font" href="administrador/admin_asignaturas.php">Asignaturas</a>
					  	<a class="p-2 text-white p-font" href="administrador/admin_programaE.php">Programas Educativos</a>
					</nav>
				</div>

				<div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
					<div class="col-md-6 px-0">
						<h1 class="display-4 font-italic h-font">CURLUM - Súper Administrador</h1>
						<p class="lead my-3 p-font">Un Súper administrador tiene las herramientas necesarias para gestionar a los usuarios del sistema CURLUM.</p>
					</div>
				</div>

				<div class="row mb-2">
					<div class="col-md-6">
				  		<div class="card flex-md-row mb-4 box-shadow h-md-250">
			    			<div class="card-body d-flex flex-column align-items-start">
				      			<h3 class="mb-0"> <a class="text-dark h-font">Un Súper Administrador puede:</a></h3>
				      			<p class="card-text mb-auto p-font"> <ul> <li>Agregar nuevos usuarios al sistema.</li><li>Modificarlos usuarios existentes.</li><li>Eliminarlos usuarios.</li> </ul> </p>
				    		</div>
				  		</div>
					</div>
					<div class="col-md-6">
				  		<div class="card flex-md-row mb-4 box-shadow h-md-250">
				   			<div class="card-body d-flex flex-column align-items-start">
				      			<h3 class="mb-0"> <a class="text-dark h-font">Características:</a></h3>
				      			<p class="card-text mb-auto p-font"> <ul> <li>Encargado de sistema.</li><li>Acceso total.</li> </ul> </p>
				    		</div>
				  		</div>
					</div>
				</div>
		    </div>
		    <footer class="blog-footer text-white">
		      	<p>CURLUM<a> Sistema de Curriculums en Línea </a>, by <a> CUCEI's Students </a>.</p>
		      	<p>
		        	<a href="" class="link-color">Volver al Inicio</a>
		      	</p>
		    </footer>

			<script src="js/jquery.js"></script>
	    	<script src="js/bootstrap.min.js"></script>
		</body>
	<?php
	}
	else{
		header('Location: login.php');
	}
	?>
</html>
