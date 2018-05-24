<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>ADMINISTRACIÓN DE PROGRAMAS EDUCATIVOS | CURLUM</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/style-fuentes.css">
		<link rel="stylesheet" href="../css/style-blog.css">
		<link rel="stylesheet" href="../css/font-family.css">
		<link rel="icon" href="../imagenes/CURLUM.ico">
	</head>

	<?php
	session_start();
	$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
	//$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");

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
							<a class="blog-header-logo text-dark h-font" href="../administrador.php">CURLUM</a>
						</div>
					  	<div class="col-4 d-flex justify-content-end align-items-center">
					    	<a class="btn btn-sm btn-outline-secondary" href="../logout.php">Cerrar Sesión</a>
					  	</div>
					</div>
				</header>

				<div class="nav-scroller py-1 mb-2 bg-dark">
					<nav class="nav d-flex justify-content-between">
					  	<a class="p-2 text-white p-font" href="user_profesor.php">Profesores Registrados</a>
					  	<a class="p-2 text-white p-font" href="user_profesor_add.php">Registrar Nuevo Usuario</a>
					  	<a class="p-2 text-white p-font" href="administrar_usuarios.php">Modificar Usuario</a>
					  	<a class="p-2 text-white p-font" href="admin_asignaturas.php">Asignaturas</a>
						<a class="p-2 text-white p-font" href="admin_programaE.php">Programas Educativos</a>
					</nav>
				</div>

				<div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
					<div class="col-md-6 px-0">
						<h1 class="display-4 font-italic h-font">Administración de Programas Educativos</h1>
					</div>
				</div>

				<?php
			      	if(isset($_POST['quita'])){
			      		$idDep =  $_POST['idUnico'];
			      		$sql = "DELETE FROM programae WHERE id = '$idDep' ";
						$resultado = mysqli_query($conexion, $sql);
			      	}
		      	?>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		      		<p>Administración de Asignaturas</p>
					<table class="table table-bordered table-hover p-font text-center">
						<tr><th>Nombre del Programa Educativo</th><th>Acción</th></tr>
						<?php
							$sql = "SELECT * FROM programaE";
							$resultado = mysqli_query($conexion, $sql);
							while($reg = mysqli_fetch_array($resultado)){
								$idunico = $reg['id'];

								echo "<tr><td>".$reg['nombre']."</td>
									  <td>"
									  ?> 
									  	<form method="post">
		                			 		<input type="text" id="idUnico" name="idUnico"  <?php echo "value='$idunico'" ?> style="display: none;">
									  	
											<input class="btn btn-success" type="submit" name="quita" value="Remover">
									  	</form>
							  		  <?php 
								  	 " </td></tr>";
							}//Llave del while
						?>
					</table>
					<?php
						if(!isset($_POST['nuevo_programa'])){
					?>
							<form method="post">
								<input class="btn btn-success" type="submit" name="nuevo_programa" value="Añadir Programa Educativo">
							</form>
					<?php
						}
						else{
							header('Location: nuevo_programa.php');
						}
					?>
		      	</div>
		      	<br><br>
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
