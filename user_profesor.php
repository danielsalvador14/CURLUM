<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>PROFESORES REGISTRADOS | CURLUM</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style-fuentes.css">
		<link rel="stylesheet" href="css/style-blog.css">
		<link rel="stylesheet" href="css/style-formulario.css">
		<link rel="icon" href="imagenes/CURLUM.ico">
	</head>

	<?php 
	session_start();

	if(isset($_SESSION['username']) && isset($_SESSION['administrador'])){ 

		$conexion = mysqli_connect("localhost", "root", "", "bd_curriculum");
		$sql = "SELECT * FROM `profesor`";
		$resultado = mysqli_query($conexion, $sql);
		$reg = mysqli_fetch_array($resultado);
		$profesores = $reg['id'];

		if(isset($_POST['seleccionar'])){
			$sql = "SELECT * FROM profesor";
			$resultado = mysqli_query($conexion, $sql);
			while($reg = mysqli_fetch_array($resultado)){
				if($reg['id'] == $_POST['codigo']){
					$_SESSION['idProfesor'] = $_POST['codigo'];
					header('Location: user_profesor_data.php');
				}
			}
		}
		else if(isset($_POST['crear'])){
			header('Location: user_profesor_add.php');
		}
		$sql = "SELECT * FROM profesor";
		$resultado = mysqli_query($conexion, $sql);
	?>

	<body class="bg-light">

	    <section id='banner' class="container" >

	    	<header class="blog-header py-3">
		        <div class="row flex-nowrap justify-content-between align-items-center">
		          <div class="col-4 pt-1">
		          	<a><?php echo "Administrador: ".$_SESSION['username']; ?> </a>
		            <!--<a class="text-muted" href="index.php">Index</a> -->
		          </div>
		          <div class="col-4 text-center">
		            <a class="blog-header-logo text-dark" href="administrador.php">CURLUM</a>
		          </div>
		          <div class="col-4 d-flex justify-content-end align-items-center">

		            <a class="btn btn-sm btn-outline-secondary" href="index.php">Cerrar Sesión</a>
		          </div>
		        </div>
		      </header>

		      <div class="nav-scroller py-1 mb-2 bg-dark">
		        <nav class="nav d-flex justify-content-between">
		          <a class="p-2 text-white" href="user_profesor.php">Profesores Registrados</a>
		          <a class="p-2 text-white" href="user_profesor_add.php">Registrar Nuevo Usuario</a>
		          <a class="p-2 text-white" href="#">Modificar Usuario</a>
		        </nav>
		      </div>



	      <div class="py-5 text-center">
	        <h2>Profesores Registrados en el Sistema</h2>
	      </div>
	      <div class=" container-fluid row">
	        <div class="container col-xs-12 col-sm-12 col-md-8 col-lg-9">
				<table class="table table-bordered table-hover col-md-8 order-md-1">
					<tr><th>Código</th><th>Nombre del Profesor</th><th>Nombre de usuario</th></tr>
					<?php 
						while($reg = mysqli_fetch_array($resultado)){
							$sql = "SELECT * FROM profesor";
							$resultado_p = mysqli_query($conexion, $sql);
							echo "<tr><td>".$reg['id']."</td><td>".$reg['nombre']." ".$reg['apellidoP']." ".$reg['apellidoM']."</td><td>".$reg['username']."</td></tr>";
						}//Llave del while
					?>
				</table>
			</div>
			<div class="container col-xs-12 col-sm-12 col-md-4 col-lg-3">
					<form method="post">
						<input class="btn btn-lg btn-btn-secondary btn-block" type="submit" name="crear" value="Agregar"><br><br><br><br>
					</form>
					<form method="post">
						<input class="form" type="text" name="codigo" required>
						<input class="btn btn-lg btn-btn-secondary" type="submit" name="seleccionar" value="Buscar">
						<p class="text">Seleccione un código para operar con ese Profesor</p>
					</form>
				</div>
	      </div>  

	      <footer class="blog-footer text-white">
		      <p>CURLUM<a> Sistema de Curriculums en Línea </a>, by <a> CUCEI's Students </a>.</p>
		      <p>
		        <a href="administrador.php">Regresar</a>
		      </p>
		    </footer>
	    </section>
	 </body>

	<?php } ?>
</html>