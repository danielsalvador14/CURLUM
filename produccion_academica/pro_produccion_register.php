<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>CURLUM - Producción Académica - Registrar</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/style-fuentes.css">
		<link rel="stylesheet" href="../css/style-blog.css">
    <link rel="stylesheet" href="../css/style-pro-produccion-edit.css">
		<link rel="stylesheet" href="../css/font-family.css">
		<link rel="icon" href="../imagenes/CURLUM.ico">

		<script type="text/javascript">
			function solicitarModificacion(_id_prof){
				if (document.getElementById("titulo").value == ""){
					alert("Ingrese Titulo!");
				} else if (document.getElementById("institucion").value == ""){
					alert("Ingrese Institucion!");
				} else if (!document.getElementById("fecha_produccion").value){
					alert("Ingrese Fecha!");
				} else {
					titulo = document.getElementById("titulo").value;
					tipo = document.getElementById("tipo").value;
					institucion = document.getElementById("institucion").value;
					fecha = document.getElementById("fecha_produccion").value;
					setTimeout("location.href='pro_produccion_create.php?id_profesor="+_id_prof+"&titulo="+titulo+"&tipo="+tipo+"&institucion="+institucion+"&fecha="+fecha+"'", 0);
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
	            <a class="blog-header-logo text-dark h-font" href="../profesor.php">CURLUM</a> <!-- Linea modificada -->
	          </div>
	          <div class="col-4 d-flex justify-content-end align-items-center">
	            <a class="btn btn-sm btn-outline-secondary p-font" href="../index.php">Cerrar Sesión</a>
	          </div>
	        </div>
	      </header>

	      <div class="nav-scroller py-1 mb-2 bg-dark">
	        <nav class="nav d-flex justify-content-between">
	          <a class="p-2 text-white p-font" href="pro_produccion.php">Regresar</a>
	        </nav>
	      </div>

        <div class="py-5 text-center">
	        <h2 class="h-font">Editar Producción Académico</h2>
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
	                <h6 class="my-0 h-font">¿Que pasará cuando haga clic sobre "Guardar"?</h6>
	                <small class="text-muted p-font">Tal como dice, guardará inmediatamente los datos en un nuevo registro, por lo cual, recomendamos la verificación del contenido ingresado.</small>
	              </div>
	            </li>
	          </ul>
	        </div>

	        <div class="col-md-8 order-md-1">
	          <h4 class="mb-3 h-font">Nueva Producción Académico</h4>
	          <form method="post" class="needs-validation">
	            <div class="row">
	              <div class="col-md-6 mb-3">
	                <label for="username" class="p-font">Título de Producción</label>
									<?php echo '<input type="text" class="form-control" id="titulo" required>' ?>
	                <div class="invalid-feedback">
	                  Campo requerido.
	                </div>
	              </div>

								<div class="col-md-6 mb-3">
	                <label for="Cnivel" class="p-font">Tipo de Producción</label>
	                <select class="custom-select d-block w-100" name="tipo" id="tipo" onChange="mostrar(this.value);" required>
	                  <option value="1" selected>Libro</option>
	                  <option value="2">Capítulo de Libro</option>
										<option value="3">Artículo</option>
										<option value="4">Informe</option>
										<option value="5">Desarrollo de Software</option>
	                </select>
	              </div>

								<div class="col-md-6 mb-3">
	                <label for="username" class="p-font">Nombre de Institucion</label>
									<?php echo '<input type="text" class="form-control" id="institucion" required>' ?>
	                <div class="invalid-feedback">
	                  Campo requerido.
	                </div>
	              </div>

	              <div id="fecha" class="fecha">
									<div class="fecha">
										<label for="Cnivel" class="p-font">Fecha de Inicio</label><br>
										<input id="fecha_produccion" type="date" name="fecha" class="cambiar-cursor">
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
		      <p><a href="pro_formacion.php" class="link-color">Regresar</a></p>
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
