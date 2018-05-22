<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>CURLUM - Producción Académica - Registrar</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/style-fuentes.css">
		<link rel="stylesheet" href="../css/style-blog.css">
    <link rel="stylesheet" href="../css/style-pro-produccion-autor.css">
		<link rel="stylesheet" href="../css/font-family.css">
		<link rel="icon" href="../imagenes/CURLUM.ico">

		<script type="text/javascript">
			function guardarAutor(_numregistro){
				if (!document.getElementById("nombre").value){
					alert("Ingrese Nombre!");
				}
				else if (!document.getElementById("apellidop").value){
					alert("Ingrese Apellido!");
				}
				else {
					nombre = document.getElementById("nombre").value;
					apellidoP = document.getElementById("apellidop").value;
					nombre_o = document.getElementById("nombre_original").value;
					apellidoP_o = document.getElementById("apellidop_original").value;
					apellidoM_o = document.getElementById("apellidom_original").value;

					er = /^([A-ZÁÉÍÓÚÑÜ][a-záéíóúñü]*)+(\s[A-ZÁÉÍÓÚÑÜ][a-záéíóúñü]*)*$/;
					if (!er.test(nombre)){
						alert("Nombre No Válido!");
						return;
					}
					if (!er.test(apellidoP)){
						alert("Apellido Paterno No Válido!");
						return;
					}

					if (apellidoM_o == "") {
						apellidoM_o = null;
					}

					if (document.getElementById("apellidom").value) {
						apellidoM = document.getElementById("apellidom").value;
						if (!er.test(apellidoM)){
							alert("Apellido Materno No Válido!");
							return;
						}
						setTimeout("location.href='pro_produccion_modify_autor.php?numregistro="+_numregistro+"&nombre_original="+nombre_o+"&apellidop_original="+apellidoP_o+"&apellidom_original="+apellidoM_o+"&nombre="+nombre+"&apellidop="+apellidoP+"&apellidom="+apellidoM+"'", 0);
					}
					else {
						apellidoM = null;
						setTimeout("location.href='pro_produccion_modify_autor.php?numregistro="+_numregistro+"&nombre_original="+nombre_o+"&apellidop_original="+apellidoP_o+"&apellidom_original="+apellidoM_o+"&nombre="+nombre+"&apellidop="+apellidoP+"&apellidom="+apellidoM+"'", 0);
					}
				}
			}
			function cancelar(){
				setTimeout("location.href='pro_produccion.php'", 0);
			}
		</script>
	</head>

	<?php
	session_start();

	function nombre($username){
		$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
	    //$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");
		$sql = 'SELECT * FROM profesor WHERE username = "'.$username.'"';
		$resultado = mysqli_query($conexion, $sql);
		$persona = mysqli_fetch_array($resultado);
		echo $persona['nombre']." ".$persona['apellidoP']." ".$persona['apellidoM'];
	}

	function getIdPersona($username){
		$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
	    //$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");
		$sql = 'SELECT * FROM profesor WHERE username = "'.$username.'"';
	    $resultado = mysqli_query($conexion, $sql);
	    $persona = mysqli_fetch_array($resultado);
		return $persona['id'];
	}

	if(isset($_SESSION['username']) && isset($_SESSION['profesor'])){
		if(!$_GET['nombre'] || !$_GET['numregistro'] || !$_GET['apellidop']){
			header('Location: pro_produccion.php');
		}
		$am = false;
		if (isset($_GET['apellidom'])) {
			$am = true;
			$apeM = $_GET['apellidom'];
		}
	?>

		<body>
			<div class="container">
	      		<header class="blog-header py-3">
        			<div class="row flex-nowrap justify-content-between align-items-center">
	          			<div class="col-4 pt-1">
	          				<a>
								<code>
									<?php
										echo nombre($_SESSION['username']). " | " .$_SESSION['username'];
									?>
								</code>
							</a>
	          			</div>
	          			<div class="col-4 text-center">
	            			<a class="blog-header-logo text-dark h-font" href="../profesor.php">CURLUM</a> <!-- Linea modificada -->
	          			</div>
	          			<div class="col-4 d-flex justify-content-end align-items-center">
	            			<a class="btn btn-sm btn-outline-secondary p-font" href="../logout.php">Cerrar Sesión</a>
	          			</div>
	        		</div>
	      		</header>

	      		<div class="nav-scroller py-1 mb-2 bg-dark">
	        		<nav class="nav d-flex justify-content-between">
								<a class="p-2 text-white p-font" href="../datos_personales/pro_datos_personales.php">Datos Personales</a>
			          <a class="p-2 text-white p-font" href="../formacion_academica/pro_formacion.php">Formación Académica</a>
			          <a class="p-2 text-white p-font" href="pro_produccion.php">Producción Académica</a>
			          <a class="p-2 text-white p-font" href="#">Carga Acádemica</a>
			          <a class="p-2 text-white p-font" href="../tutoria/pro_tutoria.php">Tutorías</a>
			          <a class="p-2 text-white p-font" href="#">Configuración</a>
	        		</nav>
	      		</div>

        		<div class="py-5 text-center">
	        		<h2 class="h-font">Modificar Autor de Producción</h2>
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
	                				<h6 class="my-0 h-font">¿Que pasará cuando haga clic sobre "Guardar" y "Terminar"?</h6>
	                				<small class="text-muted p-font">El autor será guardado en la base de datos inmediatamente. Usted puede volver a las producciones al hacer clic en "Continuar".</small>
	              				</div>
	            			</li>
	          			</ul>
	        		</div>

	        		<div class="col-md-8 order-md-1">
	          			<form method="post" class="needs-validation">
	            			<div class="row">
	              				<div class="col-md-6 mb-3">
	                					<label for="username" class="p-font">Nombre de autor</label>
										<?php echo '<input type="text" maxlength=29 class="form-control" id="nombre" value='.$_GET['nombre'].' required>' ?>
	                					<div class="invalid-feedback">
	                  						Campo requerido.
	                					</div>
	              				</div>

								<div class="col-md-6 mb-3">
	                				<label for="username" class="p-font">Apellido Paterno</label>
									<?php echo '<input type="text" maxlength=19 class="form-control" id="apellidop" value='.$_GET['apellidop'].' required>' ?>
	                				<div class="invalid-feedback">
	                  					Campo requerido.
	                				</div>
	              				</div>

								<div class="col-md-6 mb-3">
	                				<label for="username" class="p-font">Apellido Materno</label>
									<?php
									if ($am) {
										echo '<input type="text" maxlength=19 class="form-control" id="apellidom" placeholder="No requerido" value='.$apeM.'>';
									}
									else {
										echo '<input type="text" maxlength=19 class="form-control" id="apellidom" placeholder="No requerido">';
									}
									?>
	              				</div>

	              				<div id="fecha" class="fecha">
									<div id="botones">
										<table>
											<th><button class="btn btn-lg btn-secondary btn-block" name="guardar_cambios" value=<?php echo '"'.$_GET['numregistro'].'"'; ?> onclick="guardarAutor(value)">Guardar</button></th>
											<th><button class="btn btn-lg btn-secondary btn-block" onclick="cancelar()">Cancelar</button></th>
										</table>
									</div>
	              				</div>
	              			</div>
						</form>
					</div>
	        	</div>
	      	</div>
			<input id="nombre_original" type="hidden" value=<?php echo '"'.$_GET['nombre'].'"' ?>>
			<input id="apellidop_original" type="hidden" value=<?php echo '"'.$_GET['apellidop'].'"' ?>>
			<?php if ($am) {
					echo '<input id="apellidom_original" type="hidden" value="'.$apeM.'">';
				}
				else {
					echo '<input id="apellidom_original" type="hidden" value="">';
				} ?>
	      	<footer class="blog-footer text-white">
		      	<p>CURLUM<a> Sistema de Curriculums en Línea </a>, by <a> CUCEI's Students </a>.</p>
		      	<p><a href="../profesor.php" class="link-color">Regresar</a></p>
		    </footer>
	    	<script src="../js/jquery.js"></script>
	    	<script src="../js/bootstrap.min.js"></script>
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
