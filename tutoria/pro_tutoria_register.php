<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>CURLUM - Tutorías - Registrar</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/style-fuentes.css">
		<link rel="stylesheet" href="../css/style-blog.css">
    <link rel="stylesheet" href="../css/style-pro-formacion-edit.css">
		<link rel="stylesheet" href="../css/font-family.css">
		<link rel="icon" href="../imagenes/CURLUM.ico">

		<script type="text/javascript">
			function solicitarModificacion(_id_profesor){
				if (!document.getElementById("horas").value){
					alert("Ingrese Horas!");
				} else if (!document.getElementById("fecha_inicio").value){
					alert("Ingrese Fecha Inicio!");
				} else if (!document.getElementById("fecha_fin").value){
					alert("Ingrese Fecha Fin!");
				} else {
					horas = document.getElementById("horas").value;
					fech_i = document.getElementById("fecha_inicio").value;
					fech_f = document.getElementById("fecha_fin").value;
					er = /^[0-9]+$/;
					if (!er.test(horas)){
						alert("Cantidad de Horas No Válida!");
						return;
					}

					setTimeout("location.href='pro_tutoria_query.php?id_profesor="+_id_profesor+"&horas="+horas+"&fecha_inicio="+fech_i+"&fecha_fin="+fech_f+"&query=1"+"'", 0);
				}
			}
			function cancelar(){
				setTimeout("location.href='pro_tutoria.php'", 0);
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
	            <a class="blog-header-logo text-dark h-font" href="../profesor.php">CURLUM</a>
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
	          <a class="p-2 text-white p-font" href="../produccion_academica/pro_produccion.php">Producción Académica</a>
	          <a class="p-2 text-white p-font" href="#">Carga Acádemica</a>
	          <a class="p-2 text-white p-font" href="pro_tutoria.php">Tutorías</a>
	          <a class="p-2 text-white p-font" href="#">Configuración</a>
	        </nav>
	      </div>

        <div class="py-5 text-center">
	        <h2 class="h-font">Editar Tutoría</h2>
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
	                <h6 class="my-0 h-font">¿Que pasará cuando se presione sobre "Guardar"?</h6>
	                <small class="text-muted p-font">Tal como dice, guardará inmediatamente los datos en un nuevo registro, por lo cual, recomendamos la verificación del contenido ingresado.</small>
									<h6 class="my-0 h-font">¿Que pasará cuando se presione sobre "Cancelar"?</h6>
	                <small class="text-muted p-font">Regresará a la página "Tutorías".</small>
	              </div>
	            </li>
	          </ul>
	        </div>

	        <div class="col-md-8 order-md-1">
	          <h4 class="mb-3 h-font">Nueva Tutoría</h4>
	          <form method="post" class="needs-validation">
	            <div class="row">
	              <div class="col-md-6 mb-3">
	                <label for="username" class="p-font">Cantidad de Horas</label>
									<?php echo '<input type="text" maxlength=4 class="form-control" id="horas" required>' ?>
	                <div class="invalid-feedback">
	                  Campo requerido.
	                </div>
	              </div>

								<div class="col-md-6 mb-3">
	              </div>

								<div class="col-md-6 mb-3">
									<div class="fecha">
										<label for="Cnivel" class="p-font">Fecha de Inicio</label><br>
										<input id="fecha_inicio" type="date" name="fecha-inicio" class="cambiar-cursor">
									</div>
	              </div>

								<div class="col-md-6 mb-3">
									<div class="fecha">
										<label for="Cnivel" class="p-font">Fecha de Fin</label><br>
										<input id="fecha_fin" type="date" name="fecha-fin" class="cambiar-cursor">
									</div>
	              </div>

								<div id="botones">
									<table>
										<th><button class="btn btn-lg btn-secondary btn-block" name="guardar_cambios" onclick="solicitarModificacion(<?php echo getIdPersona($_SESSION['username']); ?>)">Guardar</button></th>
										<th><button class="btn btn-lg btn-secondary btn-block" onclick="cancelar()">Cancelar</button></th>
									</table>
								</div>
							</form>
						</div>
	        </div>
	      </div>
	  	</div>
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
			header('Location: administrador.php');
		}
		else{
			header('Location: login.php');
		}
	?>
</html>
