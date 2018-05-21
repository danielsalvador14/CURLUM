<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>USUARIOS REGISTRADOS | CURLUM</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/style-fuentes.css">
		<link rel="stylesheet" href="../css/style-blog.css">
		<link rel="stylesheet" href="../css/style-formulario.css">
		<link rel="icon" href="../imagenes/CURLUM.ico">
	</head>

	<?php 
	session_start();

	function getNivel($nivel) {
		if ($nivel == 1) {
			return "Profesor";
		}
		else{
			return "Súper Administrador";
		}
	}

	function getPassword($pass){
		$tam = strlen (  $pass );
		$cad = "";
		for ($i = 1; $i <= $tam; $i++) {
		    $cad = $cad."*";
		}
		return $cad;
	}

	if(isset($_SESSION['username']) && isset($_SESSION['administrador'])){ 

		$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
        //$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");
		$sql = "SELECT * FROM `usuario`";
		$resultado = mysqli_query($conexion, $sql);
		$reg = mysqli_fetch_array($resultado);
		$usuario = $reg['username'];

		if(isset($_POST['seleccionar'])){
			$sql = "SELECT * FROM usuario";
			$resultado = mysqli_query($conexion, $sql);
			while($reg = mysqli_fetch_array($resultado)){
				if($reg['username'] == $_POST['nombre_usuario']){
					$_SESSION['nombre_usuario'] = $_POST['nombre_usuario'];
					header('Location: editar_usuario.php');
					///REFERENCIA
				}
			}
		}
		else if(isset($_POST['crear'])){
			header('Location: user_profesor_add.php');
		}
		$sql = "SELECT * FROM usuario";
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
			            <a class="blog-header-logo text-dark" href="../administrador.php">CURLUM</a>
			          </div>
			          <div class="col-4 d-flex justify-content-end align-items-center">
			            <a class="btn btn-sm btn-outline-secondary" href="../logout.php">Cerrar Sesión</a>
			          </div>
			        </div>
		      	</header>
		      	<div class="nav-scroller py-1 mb-2 bg-dark">
			        <nav class="nav d-flex justify-content-between">
			          <a class="p-2 text-white" href="user_profesor.php">Profesores Registrados</a>
			          <a class="p-2 text-white" href="user_profesor_add.php">Registrar Nuevo Usuario</a>
			          <a class="p-2 text-white" href="administrar_usuarios.php">Modificar Usuario</a>
			        </nav>
		      	</div>
		      	<div class="py-5 text-center">
		        	<h2>Usuarios Registrados en el Sistema</h2>
		      	</div>
		      	<div class=" container-fluid row">
		        	<div class="container col-xs-12 col-sm-12 col-md-8 col-lg-9">
						<table class="table table-bordered table-hover col-md-8 order-md-1">
							<tr><th>Nombre de Usuario</th><th>Tipo de Usuario</th><th>Contraseña</th></tr>
							<?php 
								while($reg = mysqli_fetch_array($resultado)){
									$sql = "SELECT * FROM usuario";
									$resultado_p = mysqli_query($conexion, $sql);
									echo "<tr><td>".$reg['username']."</td><td>".getNivel($reg['tipo'])."</td><td>".getPassword($reg['contrasena'])."</td></tr>";
								}//Llave del while
							?>
						</table>
					</div>
					<div class="container col-xs-12 col-sm-12 col-md-4 col-lg-3">
						<form method="post">
							<input class="btn btn-lg btn-btn-secondary btn-block" type="submit" name="crear" value="Agregar"><br><br><br><br>
						</form>
						<form method="post">
							<input class="form" type="text" name="nombre_usuario" required>
							<input class="btn btn-lg btn-btn-secondary" type="submit" name="seleccionar" value="Buscar">
							<p class="text">Seleccione un nombre de usuario para operar con ese usuario</p>
						</form>
					</div>
		      	</div>  

		      	<footer class="blog-footer text-white">
			      <p>CURLUM<a> Sistema de Curriculums en Línea </a>, by <a> CUCEI's Students </a>.</p>
			      <p>
			        <a href="../administrador.php">Regresar</a>
			      </p>
			    </footer>
		    </section>
		 </body>
	<?php } ?>
</html>