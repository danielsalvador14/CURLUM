<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>DATOS PERSONALES | CURLUM</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/style-fuentes.css">
		<link rel="stylesheet" href="../css/style-blog.css">
		<link rel="stylesheet" href="../css/style-formulario.css">
		<link rel="icon" href="../imagenes/CURLUM.ico">
	</head>

	<?php 
	session_start();
	//$idProfesor = $_SESSION['idProfesor'];
	$username = $_SESSION['username'];

	function nombre($username){
		$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
		//$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");
		$sql = "SELECT * FROM profesor WHERE username = '$username'";
		$resultado = mysqli_query($conexion, $sql);
		$persona = mysqli_fetch_array($resultado);
		echo $persona['nombre']." ".$persona['apellidoP']." ".$persona['apellidoM'];
	}

	if(isset($_SESSION['username']) && isset($_SESSION['administrador'])){
		$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
        //$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");
        $idProfesor = $_SESSION['idProfesor'];
		$sql = "SELECT * FROM profesor WHERE id='$idProfesor'";
		$resultado = mysqli_query($conexion, $sql);
		$profesor = mysqli_fetch_array($resultado);


		//$idProfesor = $profesor['id'];
		$nombre = $profesor['nombre'];
		$apeP = $profesor['apellidoP'];
		$apeM = $profesor['apellidoM'];
		$email = $profesor['email'];
		$calle = $profesor['calle'];
		$numero = $profesor['numero'];
		$colonia = $profesor['colonia'];
		$ciudad = $profesor['ciudad'];
		$telefono = $profesor['telefono'];
		$Profe_usuario = $profesor['username'];

		if(isset($_POST['guardar'])){
			$reg = mysqli_fetch_array($resultado);

			if($_POST['nombre']==""){  $nombre = $profesor['nombre'];	}
			else{	$nombre = $_POST['nombre'];  	}

			if($_POST['apellidoP']==""){	$apeP = $profesor['apellidoP']; 	}
			else{  $apeP = $_POST['apellidoP'];   }

			if($_POST['apellidoM']==""){ $apeM = $profesor['apellidoM'];	}
			else{	$apeM = $_POST['apellidoM'];	}

			if($_POST['email']==""){	$email = $profesor['email'];	}
			else{		$email = $_POST['email'];	}

			if($_POST['calle']==""){	$calle = $profesor['calle'];	}
			else{		$calle = $_POST['calle'];	}

			if($_POST['numero']==""){	$numero = $profesor['numero'];	}
			else{		$numero = $_POST['numero'];	}

			if($_POST['colonia']==""){	$colonia = $profesor['colonia'];	}
			else{		$colonia = $_POST['colonia'];	}

			if($_POST['ciudad']==""){	$ciudad = $profesor['ciudad'];	}
			else{		$ciudad = $_POST['ciudad'];	}

			if($_POST['telefono']==""){ 	$telefono = $profesor['telefono'];	}
			else{	$telefono = $_POST['telefono'];	}

			$sql = "UPDATE profesor SET nombre='$nombre', apellidoP='$apeP', apellidoM='$apeM', email='$email', calle='$calle', numero='$numero', colonia='$colonia', ciudad='$ciudad', telefono='$telefono' WHERE id='$idProfesor'";
			$resultado = mysqli_query($conexion, $sql);

			header('Location: user_profesor.php');

		}//llave if guardar
		else if(isset($_POST['eliminar'])){
			$sql = "DELETE FROM profesor WHERE id='$idProfesor'";
			$resultado = mysqli_query($conexion, $sql);

			$sql = "DELETE FROM usuario WHERE username='$username'";
			$resultado = mysqli_query($conexion, $sql);

			header('Location: ../administrador.php');
		}
		else if(isset($_POST['cancelar'])){
			header('Location: user_profesor.php');
		}
		else if(isset($_POST['vistaProfe'])){
			$idP = $_SESSION['idProfesor'];
			session_destroy();
			session_start();
			$sql = "SELECT * FROM usuario WHERE username='$Profe_usuario'";
        	$resultado = mysqli_query($conexion, $sql);
        	$reg = mysqli_fetch_array($resultado); 
			$_SESSION['nivel'] = $reg['tipo'];
          	$_SESSION['username'] = $reg['username'];
          	$_SESSION['user'] = $reg;
          	$_SESSION['profesor'] = $reg['tipo'];
          	$_SESSION['idProfesor'] = $idP;
			header('Location ../profesor.php');
		}

	?>
	<body class="bg-light">

	    <div class="container">
	    	<!--- CABECERAS -->
	    	<?php
				if(isset($_SESSION['profesor'])){
			?>
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
			          <a class="p-2 text-white" href="#">Modificar Usuario</a>
			        </nav>
		      </div>

			<?php  
				}
				else if(isset($_SESSION['administrador'])){
			?>
				<div class="container">
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
			          <a class="p-2 text-white" href="#">Modificar Usuario</a>
			        </nav>
			      </div>
			<?php
				}
			?>



		    <div class="py-5 text-center">
		        <h2>Modifique los valores que desea Corregir</h2>
		    </div>

			<div class="row">
		        <div class="col-md-4 order-md-2 mb-4">
		          <h4 class="d-flex justify-content-between align-items-center mb-3">
		            <span class="text-muted">Información Adicional</span>
		            <span class="badge badge-secondary badge-pill">!</span>
		          </h4>
		          <ul class="list-group mb-3">
		            <li class="list-group-item d-flex justify-content-between lh-condensed">
		              <div>
		                <h6 class="my-0">Botón "Guardar"</h6>
		                <small class="text-muted">Actualiza los Datos con la nueva Información Ingresada.</small>
		              </div> 
		            </li>
		            <li class="list-group-item d-flex justify-content-between lh-condensed">
		              <div>
		                <h6 class="my-0">Botón "Vista Profesor"</h6>
		                <small class="text-muted">Entrar al sistema como el usuario seleccionado.</small>
		              </div> 
		            </li>
		            <li class="list-group-item d-flex justify-content-between lh-condensed">
		              <div>
		                <h6 class="my-0">Botón "Eliminar"</h6>
		                <small class="text-muted">Elimina del Sistema los datos almacenados del Profesor, y la cuenta de Usuario ligada al mismo.</small>
		              </div>
		            </li>
		            <li class="list-group-item d-flex justify-content-between lh-condensed">
		              <div>
		                <h6 class="my-0">Botón "Cancelar"</h6>
		                <small class="text-muted">Regresa a la Página anterior sin realizar ningún cambio.</small>
		              </div>
		            </li>
		          </ul>

		        </div>
	        
		        <div class="col-md-8 order-md-1">
		          <h4 class="mb-3">Datos Actuales</h4>
		          <form method="post">
			            <div class="row">

			              <div class="col-md-6 mb-3">
			                <label for="nombre">Nombre</label>
			                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="" <?php echo "value='$nombre'" ?>  required>
			                <div class="invalid-feedback">
			                  Se Requiere un Nombre de Usuario Valido.
			                </div>
			              </div>

			              <div class="col-md-6 mb-3">
			                <label for="apeP">Apellido Paterno</label>
			                <input type="text" class="form-control" name="apellidoP" id="apellidoP" placeholder="" <?php echo "value='$apeP'" ?>  required>
			                <div class="invalid-feedback">
			                  Se Requiere un Apellido Valido.
			                </div>
			              </div>

			              <div class="col-md-6 mb-3">
			                <label for="apeM">Apellido Materno</label>
			                <input type="text" class="form-control" name="apellidoM" id="apellidoM" placeholder="" <?php echo "value='$apeM'" ?> >
			              </div>

			              <div class="col-md-6 mb-3">
			                <label for="email">Correo Electrónico</label>
			                <input type="email" class="form-control" name="email" id="email" placeholder="" <?php echo "value='$email'" ?>  required>
			                <div class="invalid-feedback">
			                  Se Requiere de un Correo Electrónico Valido.
			                </div>
			              </div>

			              <div class="col-md-6 mb-3">
			                <label for="calle">Calle</label>
			                <input type="text" class="form-control" name="calle" id="calle" placeholder="" <?php echo "value='$calle'" ?>  required>
			                <div class="invalid-feedback">
			                  Se Requiere una Calle Válida.
			                </div>
			              </div>

			              <div class="col-md-6 mb-3">
			                <label for="numero">Número</label>
			                <input type="number" class="form-control" name="numero" id="numero" placeholder="" <?php echo "value='$numero'" ?>  required>
			                <div class="invalid-feedback">
			                  Se Requiere un Número Valido.
			                </div>
			              </div>

			              <div class="col-md-6 mb-3">
			                <label for="colonia">Colonia</label>
			                <input type="text" class="form-control" name="colonia" id="colonia" placeholder="" <?php echo "value='$colonia'" ?>  required>
			                <div class="invalid-feedback">
			                  Se Requiere una Colonia Válida.
			                </div>
			              </div>

			              <div class="col-md-6 mb-3">
			                <label for="ciudad">Ciudad</label>
			                <input type="text" class="form-control" name="ciudad" id="ciudad" placeholder="" <?php echo "value='$ciudad'" ?>  required>
			                <div class="invalid-feedback">
			                  Se Requiere una Ciudad Válida.
			                </div>
			              </div>

			              <div class="col-md-6 mb-3">
			                <label for="telefono">Teléfono</label>
			                <input type="number" class="form-control" name="telefono" id="telefono" placeholder="" <?php echo "value='$telefono'" ?>  required>
			                <div class="invalid-feedback">
			                  Se Requiere un Teléfono Valido.
			                </div>
			              </div>
			            </div>

						<div class="col-md-12 mb-12" id="botones">
							<tr>
								<td><input class="btn btn-lg btn-secondary" type="submit" value="Guardar" name="guardar"></td>
								<td><input class="btn btn-lg btn-secondary" type="submit" value="Vista Profesor" name="vistaProfe" ></td>
								<td><input class="btn btn-lg btn-secondary" type="submit" value="Eliminar" name="eliminar" ></td>
								<td><input class="btn btn-lg btn-secondary" type="submit" value="Cancelar" name="cancelar"></td>
							</tr>
						</div>
		          	</form>
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
	<?php }
	else{
		header('Location: ../login.php');
	}
	?>
</html>