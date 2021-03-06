<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>EDICIÓN DE USUARIO | CURLUM</title>
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
	$nombre_usuario = $_SESSION['nombre_usuario'];

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
	$sql = "SELECT * FROM usuario WHERE username='$nombre_usuario'";
	$resultado = mysqli_query($conexion, $sql);
	$usuario = mysqli_fetch_array($resultado);

	$contrasena = $usuario['contrasena'];
	$nivel = $usuario['tipo'];
	$nombre_usuario = $usuario['username'];

	if(isset($_SESSION['username']) && isset($_SESSION['administrador'])){

		if(isset($_POST['guardar'])){

			if( $contrasena != $_POST['Pcontrasena'] ){
				$Ncontrasena = $_POST['Pcontrasena'];
				$sql = "UPDATE usuario SET contrasena='$Ncontrasena' WHERE username='$nombre_usuario'";
				$resultado = mysqli_query($conexion, $sql);
			}

			if( $nombre_usuario != $_POST['Pusername'] ){
				///Comprobar que el Usuario NO este repetido ///
				$Repetido = 1;
				$sql = "SELECT * FROM usuario";
				$resultado = mysqli_query($conexion, $sql);
				while($reg = mysqli_fetch_array($resultado)){
					if($reg['username'] == $_POST['Pusername']){
						$Repetido = "2"; //Usuario Repetido
					}
				}
				if( $nivel == 1 ){

					if($Repetido == 1 ){
						$Nnombre_usuario = $_POST['Pusername'];
						$Ncontrasena = $_POST['Pcontrasena'];
						$sql = "INSERT INTO usuario(username, contrasena, tipo) VALUES('$Nnombre_usuario', '$Ncontrasena', '$nivel')";
						$resultado = mysqli_query($conexion, $sql);

						$sql = "UPDATE profesor SET username='$Nnombre_usuario' WHERE username='$nombre_usuario'";
						$resultado = mysqli_query($conexion, $sql);

						$sql = "DELETE FROM usuario WHERE username='$nombre_usuario'";
						$resultado = mysqli_query($conexion, $sql);
					}
					else{
						echo '<script language="JavaScript"> alert("El Nombre de Usuario esta en Uso"); </script>';
					}
				}
				else{
					if($Repetido == 1 ){
						$Nnombre_usuario = $_POST['Pusername'];
						$sql = "UPDATE usuario SET username='$Nnombre_usuario' WHERE username='$nombre_usuario'";
						$resultado = mysqli_query($conexion, $sql);
					}
					else{
						echo '<script language="JavaScript"> alert("El Nombre de Usuario esta en Uso"); </script>';
					}
				}
			}
			echo '<script language="JavaScript">
				  window.location.href="administrar_usuarios.php";
				  </script>';
		}//llave if guardar
		else if(isset($_POST['eliminar'])){
			if($nivel == 1 ){
				$sql = "DELETE FROM profesor WHERE username='$nombre_usuario'";
				$resultado = mysqli_query($conexion, $sql);
			}
			$sql = "DELETE FROM usuario WHERE username='$nombre_usuario'";
			$resultado = mysqli_query($conexion, $sql);

			echo '<script language="JavaScript">
				  window.location.href="administrar_usuarios.php";
				  </script>';
		}
		else if(isset($_POST['cancelar'])){
			header('Location: administrar_usuarios.php');
		}

	?>


	<body class="bg-light">

	    <div class="container">
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
		          <a class="p-2 text-white" href="administrar_usuarios.php">Modificar Usuario</a>
		          <a class="p-2 text-white p-font" href="admin_asignaturas.php">Asignaturas</a>
				  <a class="p-2 text-white p-font" href="admin_programaE.php">Programas Educativos</a>
		        </nav>
		      </div>

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
			                <label for="nombre">Nombre de Usuario</label>
			                <input type="text" class="form-control" name="Pusername" id="Pusername" placeholder="" <?php echo "value='$nombre_usuario'" ?>  >
			                <div class="invalid-feedback">
			                  Se Requiere un Nombre de Usuario Válido.
			                </div>
			              </div>

			              <div class="col-md-6 mb-3">
			                <label for="apeP">Contraseña</label>
			                <input type="password" class="form-control" name="Pcontrasena" id="Pcontrasena" placeholder="" <?php echo "value='$contrasena'" ?>  >
			                <div class="invalid-feedback">
			                  Se Requiere una Contraseña Válida.
			                </div>
			              </div>
			            </div>

						<div class="col-md-12 mb-12" id="botones">
							<tr>
								<td><input class="btn btn-lg btn-secondary" type="submit" value="Guardar" name="guardar"></td>
								<td><input class="btn btn-lg btn-secondary boton-eliminar" type="submit" value="Eliminar" name="eliminar" ></td>
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
		    <a href="../administrador.php" class="link-color">Volver al Inicio</a>
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
