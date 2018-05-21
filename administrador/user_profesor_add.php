<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>CREAR NUEVO PROFESOR | CURLUM</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/style-fuentes.css">
		<link rel="stylesheet" href="../css/style-blog.css">
		<link rel="stylesheet" href="../css/style-formulario.css">
		<link rel="icon" href="../imagenes/CURLUM.ico">

		<script type="text/javascript">	
			function mostrar(nivel) {
				if (nivel == "Profesor") {
					$("#codigoP").show();
					$("#botones").show();
				}
				else if(nivel == "Súper Administrador"){
					$("#codigoP").hide();
					$("#botones").show();
					$("#codigoP :input").prop('required',null);
				}
				else{
					$("#codigoP").hide();
					$("#botones").hide();
				}
			}
		</script>
	</head>

	<?php 
	session_start();

	if(isset($_SESSION['username']) && isset($_SESSION['administrador'])){

		$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
        //$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");
		$usuario = $_SESSION['username'];

		if(isset($_POST['agregar'])){
			$username =  $_POST['username'];
			$password =  $_POST['password'];
			$idProfesor =  $_POST['idProfesor'];
			$vacio = " ";

			if($_POST['Cnivel'] == "Profesor"){	$nivel = "1";  }
			else{ 	$nivel = "2"; 	}

			$Nuevo="1"; //Variable de control, si es 1 el usuario es nuevo, y valido
			$recupera = "SELECT * FROM usuario";
			$resultado = mysqli_query($conexion, $recupera);

			while($reg = mysqli_fetch_array($resultado)){
				if($reg['username'] == $username){
					$Nuevo = "2"; //Usuario Repetido
				}
			}
			if($Nuevo=="1"){
				$recupera = "SELECT * FROM profesor";
				$resultado = mysqli_query($conexion, $recupera);
				while($reg = mysqli_fetch_array($resultado) AND $nivel=="1"){
					if($reg['idProfesor'] == $idProfesor){
						$Nuevo = "2";
					}
				}
			}

			if($Nuevo=="1"){

				$sql = "INSERT INTO usuario(username, contrasena, tipo) VALUES('$username', '$password', '$nivel')";
				$resultado = mysqli_query($conexion, $sql);

				if($nivel=="1"){
					$sql = "INSERT INTO profesor(id, nombre, apellidoP, apellidoM, email, calle, numero, colonia, ciudad, telefono, username) VALUES('$idProfesor', '$vacio','$vacio','$vacio','$vacio','$vacio','$vacio','$vacio','$vacio','$vacio', '$username')";
					$resultado = mysqli_query($conexion, $sql);
				}
				header('Location: user_profesor.php');
			}

			else{
				echo '<script language="JavaScript"> alert("El Username ya esta Registrado"); </script>'; 
			}
		}
	?>

		<body class="bg-light">
		    <div class="container">
		    	<header class="blog-header py-3">
			        <div class="row flex-nowrap justify-content-between align-items-center">
			          <div class="col-4 pt-1">
			          	<a><?php echo "Administrador: ".$_SESSION['username']; ?> </a>
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
		        	<h2>Ingrese los Datos de Usuario del Nuevo Profesor</h2>
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
		                			<h6 class="my-0">¿Que pasará cuando se presione sobre "Guardar"?</h6>
		                			<small class="text-muted">Se registrará al nuevo Usuario en el Sistema, las nuevas credenciales servirán para que el Profesor pueda registrar sus datos en el sistema y participar de la experiencia CURLUM</small>
		              			</div>
		            		</li>
		          		</ul>
		        	</div>
		        
		        	<div class="col-md-8 order-md-1">
		          		<h4 class="mb-3">Datos del Nuevo Usuario</h4>
	          			<form method="post" class="needs-validation">
            				<div class="row">
         					 	<div class="col-md-6 mb-3">
           						 	<label for="username">Nombre de Usuario</label>
        						 	<input type="text" class="form-control" name="username" id="username" placeholder="" value="" required>
            					 	<div class="invalid-feedback">
                  						Se Requiere un Nombre de Usuario Valido.
        						 	</div>
          						</div>

              					<div class="col-md-6 mb-3">
                					<label for="password">Contraseña</label>
               						<input type="password" class="form-control" name="password" id="password" placeholder="" value="" required>
                					<div class="invalid-feedback" style="width: 100%;">
                  						Se Requiere de una Contraseña Valida.
                					</div>
              					</div>

              					<div class="col-md-6 mb-3">
                					<label for="Cnivel">Nivel de Usuario</label>
	                				<select class="custom-select d-block w-100" name="Cnivel" id="Cnivel" onChange="mostrar(this.value);" required>
	                  					<option value="">Elija un Nivel</option>
	                  					<option>Profesor</option>
	                  					<option>Súper Administrador</option>
	                				</select>
                					<div class="invalid-feedback">
                  						Debe Seleccionar un Nivel para el Usuario
                					</div>
              					</div>

              					<div class="col-md-6 mb-3" id="codigoP" style="display: none;">
	             					<label for="idProfesor">Código del Profesor</label>
	                				<input type="number" class="form-control" id="idProfesor" name="idProfesor" placeholder="" value="" required>
	                				<div class="invalid-feedback">
				    					Se Requiere un Codigo de Profesor Valido.
	                				</div>
           	  					</div>
							</div>
							<div class="col-md-6 mb-3" id="botones" style="display: none;">
								<tr>
									<td><input class="btn btn-lg btn-secondary" type="reset" name=""></td>
									<td><input class="btn btn-lg btn-secondary" value="Guardar" type="submit" name="agregar"></td>
								</tr>
							</div>
	          			</form>
		        	</div>
		      	</div>
		  	</div>
	      	<footer class="blog-footer text-white">
		      	<p>CURLUM<a> Sistema de Curriculums en Línea </a>, by <a> CUCEI's Students </a>.</p>
		      	<p>
		        	<a href="user_profesor.php">Regresar</a>
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