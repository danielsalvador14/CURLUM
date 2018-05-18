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
				} else if (!document.getElementById("apellidop").value){
					alert("Ingrese Apellido!");
				} else {
					nombre = document.getElementById("nombre").value;
					apellidoP = document.getElementById("apellidop").value;
					titulo = document.getElementById("titulo").value;

					if (document.getElementById("apellidom").value) {
						apellidoM = document.getElementById("apellidom").value;
						setTimeout("location.href='pro_produccion_create_autor.php?numregistro="+_numregistro+"&titulo="+titulo+"&nombre="+nombre+"&apellidop="+apellidoP+"&apellidom="+apellidoM+"'", 0);
					} else {
						setTimeout("location.href='pro_produccion_create_autor.php?numregistro="+_numregistro+"&titulo="+titulo+"&nombre="+nombre+"&apellidop="+apellidoP+"'", 0);
					}
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
		if(!$_GET['titulo'] || !$_GET['numregistro']){
			header('Location: pro_produccion.php');
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
	            <a class="btn btn-sm btn-outline-secondary p-font" href="../index.php">Cerrar Sesión</a>
	          </div>
	        </div>
	      </header>

	      <div class="nav-scroller py-1 mb-2 bg-dark">
	        <nav class="nav d-flex justify-content-between">
	          <a class="p-2 text-white p-font" href="pro_produccion.php">Continuar</a>
	        </nav>
	      </div>

        <div class="py-5 text-center">
	        <h2 class="h-font">Agregar Autor de Producción</h2>
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
	          <h4 class="mb-3 h-font"><?php echo $_GET['titulo']; ?></h4>
	          <form method="post" class="needs-validation">
	            <div class="row">
	              <div class="col-md-6 mb-3">
	                <label for="username" class="p-font">Nombre de autor</label>
									<?php echo '<input type="text" class="form-control" id="nombre" required>' ?>
	                <div class="invalid-feedback">
	                  Campo requerido.
	                </div>
	              </div>

								<div class="col-md-6 mb-3">
	                <label for="username" class="p-font">Apellido Paterno</label>
									<?php echo '<input type="text" class="form-control" id="apellidop" required>' ?>
	                <div class="invalid-feedback">
	                  Campo requerido.
	                </div>
	              </div>

								<div class="col-md-6 mb-3">
	                <label for="username" class="p-font">Apellido Materno</label>
									<?php echo '<input type="text" class="form-control" id="apellidom" placeholder="No requerido">' ?>
	              </div>

	              <div id="fecha" class="fecha">
									<div id="botones">
										<table>
											<th><button class="btn btn-lg btn-secondary btn-block" name="guardar_cambios" value=<?php echo '"'.$_GET['numregistro'].'"'; ?> onclick="guardarAutor(value)">Guardar</button></th>
										</table>
									</div>
	              </div>
							</form>
						</div>
	        </div>
	      </div>
	  	</div>
			<input id="titulo" type="hidden" value=<?php echo '"'.$_GET['titulo'].'"' ?>>
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
