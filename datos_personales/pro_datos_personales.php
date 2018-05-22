<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>DATOS PERSONALES | CURLUM</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/style-fuentes.css">
		<link rel="stylesheet" href="../css/style-blog.css">
		<link rel="stylesheet" href="../css/font-family.css">
		<link rel="icon" href="../imagenes/CURLUM.ico">
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

	$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
    //$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");
	$username = $_SESSION['username'];
	$sql = "SELECT * FROM profesor WHERE username='$username'";
	$resultado = mysqli_query($conexion, $sql);
	$reg = mysqli_fetch_array($resultado);

	$idProfesor = $reg['id'];

	if(isset($_SESSION['username']) && isset($_SESSION['profesor'])){
	?>
		<body>
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
		          <a class="p-2 text-white p-font" href="pro_datos_personales.php">  Datos Personales</a>
		          <a class="p-2 text-white p-font" href="../formacion_academica/pro_formacion.php">Formación Académica</a>
		          <a class="p-2 text-white p-font" href="../produccion_academica/pro_produccion.php">Producción Académica</a>
		          <a class="p-2 text-white p-font" href="#">Carga Acádemica</a>
		          <a class="p-2 text-white p-font" href="../tutoria/pro_tutoria.php">Tutorías</a>
		          <a class="p-2 text-white p-font" href="#">Configuración</a>
		        </nav>
		      </div>

		      <section class="jumbotron text-white rounded bg-dark">
		      	<br><br><br><br>
					<div class="container-fluid ">
						<div class="row ">

					      	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
								<?php
									$foto = $reg['id'];
									if(!file_exists("../foto_perfil/".$foto.".jpg")){
									?>
										<img src="../foto_perfil/default.png" class="img-responsive img-circle" width="250" height="250"/>
									<?php
									}//Llave de if
									else{
										echo "<img src='../foto_perfil/".$foto.".jpg' width='250' height='250'/>";
									}//Llave del else

									if(isset($_POST['upload'])){
										$carpeta = "../foto_perfil/";
										opendir($carpeta);
										$destino = $carpeta.$_FILES['foto']['name'];
										copy($_FILES['foto']['tmp_name'], $destino);
										rename($carpeta.$_FILES['foto']['name'], $carpeta.$foto.".jpg");
										header('Location: pro_datos_personales.php');
									}
									else if(isset($_POST['borrarimg']) && file_exists("../foto_perfil/".$foto.".jpg")){
										unlink('../foto_perfil/'.$foto.".jpg");
										header('Location: pro_datos_personales.php');
									}

									if(isset($_POST['actualizarimg'])){
									?>
										<form method="post" enctype="multipart/form-data">
											<br>
											<input class="form-control-file" type="file" name="foto" required><br>
											<input class="btn btn-success" type="submit" name="upload" value="Subir">
										</form><br>
										<form method="post">
											<input class="btn btn-success" type="submit" name="cancelarimg" value="Cancelar">
										</form>
									<?php
									}
									else{
									?>
									<form method="post" enctype="multipart/form-data"><br>
										<input class="btn btn-success" type="submit" name="actualizarimg" value="Cambiar">
										<input class="btn btn-success" type="submit" name="borrarimg" value="Eliminar">
									</form>
									<?php
									}
								?>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
								<table class="table table-bordered table-hover p-font">
									<?php
										$sql = "SELECT * FROM profesor WHERE id='$idProfesor'";
										$resultado = mysqli_query($conexion, $sql);
										while($reg = mysqli_fetch_array($resultado)){
										echo "<tr><td>Código Profesor</td><td>".$reg['id']."</td></tr>".
											 "<tr><td>Nombre de Usuario</td><td>".$reg['username']."</td>"."</tr>".
											 "<tr><td>Nombre</td><td>".$reg['nombre']."</td>"."</tr>".
											 "<tr><td>Apellido Paterno</td><td>".$reg['apellidoP']."</td>"."</tr>".
											 "<tr><td>Apellido Materno</td><td>".$reg['apellidoM']."</td>"."</tr>".
											 "<tr><td>Calle</td><td>".$reg['calle']."</td>"."</tr>".
											 "<tr><td>Número</td><td>".$reg['numero']."</td>"."</tr>".
											 "<tr><td>Colonia</td><td>".$reg['colonia']."</td>"."</tr>".
											 "<tr><td>Ciudad</td><td>".$reg['ciudad']."</td>"."</tr>".
											 "<tr><td>Teléfono</td><td>".$reg['telefono']."</td>"."</tr>".
											 "<tr><td>Correo</td><td>".$reg['email']."</td>"."</tr>"
											 ;
										}//Llave del while
									?>
								</table>
								<?php
									if(!isset($_POST['modificar'])){
								?>
										<form method="post">
											<input class="btn btn-success" type="submit" name="modificar" value="Modificar">
										</form>
								<?php
									}
									else{
										header('Location: profesor_data.php');
									}
								?>
					      	</div>
					      	<?php
					      	if(isset($_POST['quita'])){
					      		//$NombreDep =  $_POST['nombre_dep'];
					      		//$ApePDep =  $_POST['apellidoP_dep'];
					      		//$ApeMDep =  $_POST['apellidoM_dep'];
					      		//$sql = "DELETE FROM profesor_dependiente WHERE id_profesor = '$idProfesor' AND nombre_dep = '$NombreDep' AND apellidoP_dep = '$ApePDep' AND apellidoM_dep = '$ApeMDep'";
								//$resultado = mysqli_query($conexion, $sql);
					      	}
					      	?>
					      	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
					      		<p>Dependientes Económicos</p>
								<table class="table table-bordered table-hover p-font">
									<tr><th>Nombres</th><th>Apellido Paterno</th><th>Apellido Materno</th></tr>
									<?php
										$sql = "SELECT * FROM profesor_dependiente WHERE id_profesor ='$idProfesor'";
										$resultado = mysqli_query($conexion, $sql);
										while($reg = mysqli_fetch_array($resultado)){
										echo "<tr><td>".$reg['nombre_dep']."</td>
											  <td>".$reg['apellidoP_dep']."</td>
											  <td>".$reg['apellidoM_dep']."</td></tr>";
											  /*<td> " ?> 
											  <form method="post">
												<input class="btn btn-success" type="submit" name="quita" value="Remover">
											</form>
											  <?php 
											  " </td></tr>";*/
										}//Llave del while
									?>
								</table>
								<?php
									if(!isset($_POST['dependientes'])){
								?>
										<form method="post">
											<input class="btn btn-success" type="submit" name="dependientes" value="Añadir Dependientes">
										</form>
								<?php
									}
									else{
										header('Location: dependientes.php');
									}
								?>
					      	</div>



					  	</div>
					</div>
		  	</section>
		    </div>

		    <footer class="blog-footer text-white pos-food">
		      <p>CURLUM<a> Sistema de Curriculums en Línea </a>, by <a> CUCEI's Students </a>.</p>
		      <p>
		        <a href="../profesor.php" class="link-color">Volver al Inicio</a>
		      </p>
		    </footer>

			<script src="js/jquery.js"></script>
	    	<script src="js/bootstrap.min.js"></script>
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
