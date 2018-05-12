<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>CURLUM - Formación Académica - Registrar</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style-fuentes.css">
		<link rel="stylesheet" href="css/style-blog.css">
    <link rel="stylesheet" href="css/style-pro-formacion-edit.css">
		<link rel="stylesheet" href="css/font-family.css"> <!-- Linea agregada -->
		<link rel="icon" href="imagenes/CURLUM.ico">

		<script type="text/javascript">
			function solicitarModificacion(_id){
				if ($("#nombre").val() == ""){
					alert("Ingrese Nombre!");
				} else if ($("#institucion").val() == ""){
					alert("Ingrese Institucion!");
				} else if ($("#cedula_profesional").val() == ""){
					alert("Ingrese Cédula Profesional!");
				} else if ($("#fecha_inicio").val() == "" ||
										$("#fecha_fin").val() == "" ||
										$("#fecha_obtencion").val() == ""){
					alert("Ingrese Fecha!");
				} else {
					nombre = document.getElementById("nombre").value;
					nivel = document.getElementById("nivel").value;
					institucion = document.getElementById("institucion").value;
					cedula_profesional = document.getElementById("cedula_profesional").value;
					fech_i = document.getElementById("fecha_inicio").value;
					fech_f = document.getElementById("fecha_fin").value;
					fech_o = document.getElementById("fecha_obtencion").value;
					setTimeout("location.href='pro_formacion_create.php?id="+_id+"&cedula_profesional="+cedula_profesional+"&nombre="+nombre+"&nivel="+nivel+"&institucion="+institucion+"&fecha_inicio="+fech_i+"&fecha_fin="+fech_f+"&fecha_obtencion="+fech_o+"'", 0);
				}
			}
		</script>
	</head>

	<?php
	session_start();

  function nombre($username){
		$conexion = mysqli_connect("localhost", "root", "", "bd_curriculum");
		$sql = 'SELECT * FROM profesor WHERE username = "'.$username.'"';
    $resultado = mysqli_query($conexion, $sql);
    $persona = mysqli_fetch_array($resultado);
    echo $persona['nombre']." ".$persona['apellidoP']." ".$persona['apellidoM'];
  }

	function getIdPersona($username){
		$conexion = mysqli_connect("localhost", "root", "", "bd_curriculum");
		$sql = 'SELECT * FROM profesor WHERE username = "'.$username.'"';
    $resultado = mysqli_query($conexion, $sql);
    $persona = mysqli_fetch_array($resultado);
		return $persona['id'];
	}

	if(isset($_SESSION['username']) && isset($_SESSION['profesor'])){
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
	            <a class="blog-header-logo text-dark h1-font" href="profesor.php">CURLUM</a> <!-- Linea modificada -->
	          </div>
	          <div class="col-4 d-flex justify-content-end align-items-center">
	            <a class="btn btn-sm btn-outline-secondary p-font" href="index.php">Cerrar Sesión</a>
	          </div>
	        </div>
	      </header>

	      <div class="nav-scroller py-1 mb-2 bg-dark">
	        <nav class="nav d-flex justify-content-between"> <!-- Lista modificada -->
	          <a class="p-2 text-white p-font" href="pro_formacion.php">Regresar</a>
	        </nav>
	      </div>

        <div class="py-5 text-center">
	        <h2>Editar Grado Académico</h2>
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
	                <small class="text-muted">Tal como dice, guardará inmediatamente los datos en un nuevo registro, por lo cual, recomendamos la verificación del contenido ingresado.</small>
	              </div>
	            </li>
	          </ul>
	        </div>

	        <div class="col-md-8 order-md-1">
	          <h4 class="mb-3">Nuevo Grado Académico</h4>
	          <form method="post" class="needs-validation">
	            <div class="row">
	              <div class="col-md-6 mb-3">
	                <label for="username">Nombre de Carrea</label>
									<?php echo '<input type="text" class="form-control" id="nombre" required>' ?>
	                <div class="invalid-feedback">
	                  Campo requerido.
	                </div>
	              </div>

								<div class="col-md-6 mb-3">
	                <label for="Cnivel">Nivel de Carredo</label>
	                <select class="custom-select d-block w-100" name="nivel" id="nivel" onChange="mostrar(this.value);" required>
	                  <option value="1" selected>Licenciatura</option>
	                  <option value="2">Especialidad</option>
										<option value="3">Maestria</option>
										<option value="4">Doctorado</option>
	                </select>
	              </div>

								<div class="col-md-6 mb-3">
	                <label for="username">Nombre de Institucion</label>
									<?php echo '<input type="text" class="form-control" id="institucion" required>' ?>
	                <div class="invalid-feedback">
	                  Campo requerido.
	                </div>
	              </div>

								<div class="col-md-6 mb-3">
	                <label for="username">Cédula Profesional</label>
									<?php echo '<input type="text" class="form-control" id="cedula_profesional" required>' ?>
	                <div class="invalid-feedback">
	                  Campo requerido.
	                </div>
	              </div>

	              <div id="fecha-inicio" class="fechas">
									<div class="fecha">
										<label for="Cnivel">Fecha de Inicio</label><br>
										<input id="fecha_inicio" type="date" name="fecha-inicio">
									</div>
									<div id="fecha-fin" class="fecha">
										<label for="Cnivel">Fecha de Fin</label><br>
										<input id="fecha_fin" type="date" name="fecha-fin">
									</div>
									<div id="fecha-obtencion" class="fecha">
										<label for="Cnivel">Fecha de Obtención</label><br>
										<input id="fecha_obtencion" type="date" name="fecha-obtencion">
									</div>

									<div id="botones">
										<table>
											<th><button class="btn btn-lg btn-secondary btn-block" name="guardar_cambios" value=<?php echo '"'.getIdPersona($_SESSION['username']).'"'; ?> onclick="solicitarModificacion(value)">Guardar</button></th>
										</table>
									</div>
	              </div>
							</form>
						</div>
	        </div>
	      </div>
	  	</div>
	      <footer class="blog-footer text-white">
		      <p>CURLUM<a> Sistema de Curriculums en Línea </a>, by <a> CUCEI's Students </a>.</p>
		      <p><a href="user_profesor.php">Regresar</a></p>
		    </footer>
	    <script src="js/jquery.js"></script>
	    <script src="js/bootstrap.min.js"></script>
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
