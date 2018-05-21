<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>CURLUM - Producción Académica - Editar</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/style-fuentes.css">
		<link rel="stylesheet" href="../css/style-blog.css">
        <link rel="stylesheet" href="../css/style-pro-produccion-edit.css">
		<link rel="stylesheet" href="../css/font-family.css">
		<link rel="icon" href="../imagenes/CURLUM.ico">

		<script type="text/javascript">
			function solicitarModificacion(_id_produccion){
				if (document.getElementById("titulo").value == ""){
					alert("Ingrese Titulo!");
				}
				else if (document.getElementById("institucion").value == ""){
					alert("Ingrese Institucion!");
				}
				else if (!document.getElementById("fecha_produccion").value){
					alert("Ingrese Fecha!");
				}
				else {
					titulo = document.getElementById("titulo").value;
					tipo = document.getElementById("tipo").value;
					institucion = document.getElementById("institucion").value;
					fecha = document.getElementById("fecha_produccion").value;

					/*
					er = /^[A-Za-z0-9]+(\s[A-Za-z0-9]+)*$/;
					if (!er.test(titulo)){
						alert("Titulo No Válido!");
						return;
					}
					if (!er.test(institucion)){
						alert("Institución No Válida!");
						return;
					}
					*/

					setTimeout("location.href='pro_produccion_modify.php?id="+_id_produccion+"&titulo="+titulo+"&tipo="+tipo+"&institucion="+institucion+"&fecha="+fecha+"'", 0);
				}
			}

			function solicitarModificacionAutor(numRegistro_tupla){
				numRegistro = numRegistro_tupla.split("|")[0];
				tupla = numRegistro_tupla.split("|")[1];
				autor = document.getElementById("autor_"+tupla).value;
				nombre = autor.split("_")[0];
				apellidoP = autor.split("_")[1];
				if (autor.split("_")[2]) {
					apellidoM = autor.split("_")[2];
					setTimeout("location.href='pro_produccion_edit_autor.php?numregistro="+numRegistro+"&nombre="+nombre+"&apellidop="+apellidoP+"&apellidom="+apellidoM+"'", 0);
				}
				else {
					setTimeout("location.href='pro_produccion_edit_autor.php?numregistro="+numRegistro+"&nombre="+nombre+"&apellidop="+apellidoP+"'", 0);
				}
			}
			function borrarAutor(numRegistro_tupla){
				numRegistro = numRegistro_tupla.split("|")[0];
				tupla = numRegistro_tupla.split("|")[1];
				autor = document.getElementById("autor_"+tupla).value;
				nombre = autor.split("_")[0];
				apellidoP = autor.split("_")[1];
				if (autor.split("_")[2]) {
					apellidoM = autor.split("_")[2];
					setTimeout("location.href='pro_produccion_delete_autor.php?numregistro="+numRegistro+"&nombre="+nombre+"&apellidop="+apellidoP+"&apellidom="+apellidoM+"'", 0);
				}
				else {
					apellidoM = null;
					setTimeout("location.href='pro_produccion_delete_autor.php?numregistro="+numRegistro+"&nombre="+nombre+"&apellidop="+apellidoP+"&apellidom="+apellidoM+"'", 0);
				}
			}
			function agregarAutor(_numRegistro_titulo){
				numRegistro = _numRegistro_titulo.split('|')[0];
				titulo = _numRegistro_titulo.split('|')[1];
				setTimeout("location.href='pro_produccion_register_autores.php?numregistro="+numRegistro+"&titulo="+titulo+"'", 0);
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

	function getTipo($id_produccion){
		$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
	    //$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");
		$sql = 'SELECT * FROM tipo_produccion WHERE numRegistro = "'.$id_produccion.'"';
		$resultado = mysqli_query($conexion, $sql);
		return mysqli_fetch_array($resultado);
	}

	function autores($num){
		$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
        //$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");
		$sql = 'SELECT * FROM produccion_autores WHERE numRegistro = "'.$num.'"';
		$resultado = mysqli_query($conexion, $sql);
		$cont = 1;
		while ($autor = mysqli_fetch_array($resultado)) {
			echo '<tr class="tupla-tabla">';
			if ($autor['apellidoM_autor']) {
				echo '<td><input id="autor_'.$cont.'" class="form-control" type="text" value="'.$autor['nombre_autor'].'_'.$autor['apellidoP_autor'].'_'.$autor['apellidoM_autor'].'" disabled> </td>';
			} else {
				echo '<td><input id="autor_'.$cont.'" class="form-control" type="text" value="'.$autor['nombre_autor'].'_'.$autor['apellidoP_autor'].'" disabled> </td>';
			}
			echo '
				<td><button class="btn btn-lg btn-secondary btn-block btn-tabla" name="modificar_autor" value="'.$num.'|'.$cont.'" onclick="solicitarModificacionAutor(value)">Modificar</button></td>
				<td><button class="btn btn-lg btn-secondary btn-block boton-eliminar btn-tabla" name="eliminar_autor" value="'.$num.'|'.$cont.'" onclick="borrarAutor(value)">Eliminar</button></td>
			</tr>
			';
			$cont += 1;
		}
	}

	if(isset($_POST['eliminar_produccion'])){
		$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
        //$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");
		$sql = 'DELETE FROM produccion_autores WHERE numRegistro = '.$_GET['id'];
		mysqli_query($conexion, $sql);
		$sql = 'DELETE FROM produccion WHERE numRegistro = '.$_GET['id'];
		mysqli_query($conexion, $sql);
		header('Location: pro_produccion.php');
	}

	elseif(isset($_SESSION['username']) && isset($_SESSION['profesor'])){
		if(!$_GET['id']){
			header('Location: pro_produccion.php');
	}

	$id_produccion = $_GET['id'];
	$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
    //$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");
	$sql = 'SELECT * FROM produccion WHERE numRegistro = "'.$id_produccion.'"';
	$resultado = mysqli_query($conexion, $sql);
	$produccion = mysqli_fetch_array($resultado);
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
							<a class="p-2 text-white p-font" href="#">Tutorías</a>
							<a class="p-2 text-white p-font" href="#">Configuración</a>
        		</nav>
      		</div>

    		<div class="py-5 text-center">
       			 <h2 class="h-font">Editar Producción Académica</h2>
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
                				<small class="text-muted p-font">Los cambios serán guardardos en la base de daros inmediantamente. Sea precavido con los cambios hechos.</small>
                				<h6 class="my-0 h-font">¿Que pasará cuando se presione sobre "Eliminar"?</h6>
                				<small class="text-muted p-font">El registro será inmediantamente eliminado de la base de datos. Por lo cual, se recomienda precaución al solicitar esta acción.</small>
												<h6 class="my-0 h-font">¿Que pasará cuando se presione sobre "Cancelar"?</h6>
                				<small class="text-muted p-font">Será dirigido a la página 'Producción Académica'.</small>
												<h6 class="my-0 h-font">¿Que pasará cuando se presione sobre "Modificar"?</h6>
                				<small class="text-muted p-font">Será dirigido a la página correspondiente para editar el registro.</small>
												<h6 class="my-0 h-font">¿Que pasará cuando se presione sobre "Añadir"?</h6>
                				<small class="text-muted p-font">Será dirigido a la página donde podrá hacer un nuevo registro.</small>
              				</div>
            			</li>
      				</ul>
    			</div>

        		<div class="col-md-8 order-md-1">
          			<h4 class="mb-3 h-font">Datos de la Producción Académica</h4>
          			<form method="post" class="needs-validation">
            			<div class="row">
              				<div class="col-md-6 mb-3">
								<label for="username" class="p-font">Título de Producción</label>
								<?php echo '<input type="text" maxlength=99 class="form-control" id="titulo" value="'.$produccion['titulo'].'" required>' ?>
                				<div class="invalid-feedback">
                  					Campo requerido.
                				</div>
              				</div>

							<div class="col-md-6 mb-3">
                				<label for="Cnivel" class="p-font">Tipo de Producción</label>
                					<select class="custom-select d-block w-100" name="tipo" id="tipo" onChange="mostrar(this.value);" required>
										<option value="1" <?php if ($produccion['tipo'] == 1) echo "selected";?> >Libro</option>
                  						<option value="2" <?php if ($produccion['tipo'] == 2) echo "selected";?> >Capítulo de Libro</option>
										<option value="3" <?php if ($produccion['tipo'] == 3) echo "selected";?> >Artículo</option>
										<option value="4" <?php if ($produccion['tipo'] == 4) echo "selected";?> >Informe</option>
										<option value="5" <?php if ($produccion['tipo'] == 5) echo "selected";?> >Desarrollo de Software</option>
                					</select>
              				</div>

							<div class="col-md-6 mb-3">
                				<label for="username" class="p-font">Nombre de Institucion</label>
								<?php echo '<input type="text" maxlength=49 class="form-control" id="institucion" value="'.$produccion['institucion'].'" required>' ?>
                				<div class="invalid-feedback">
                 					 Campo requerido.
                				</div>
              				</div>

              				<div id="fecha-inicio" class="fechas">
								<div class="fecha">
									<label for="Cnivel" class="p-font">Fecha</label><br>
									<input id="fecha_produccion" type="date" name="fecha-obtencion" class="cambiar-cursor" value= <?php echo '"'.$produccion['fecha'].'"'; ?>>
								</div>
              				</div>

							<div class="col-md-6 mb-3">
        				<label for="username" class="p-font">Autores</label>
								<table id="tabla-autores">
									<?php autores($id_produccion) ?>
									<td><button class="btn btn-lg btn-secondary btn-block btn-tabla" name="eliminar_autor" value=<?php echo '"'.$id_produccion.'|'.$produccion['titulo'].'"'; ?> onclick="agregarAutor(value)">Añadir</button></td>
								</table>
      				</div>

							<div id="botones">
								<table>
									<th><button class="btn btn-lg btn-secondary btn-block" name="guardar_cambios" value=<?php echo '"'.$id_produccion.'"'; ?> onclick="solicitarModificacion(value)">Guardar</button></th>
									<th><button class="btn btn-lg btn-secondary btn-block boton-eliminar" name="eliminar_produccion" value=<?php echo '"'.$id_produccion.'"'; ?>>Eliminar</button></th>
									<th><button class="btn btn-lg btn-secondary btn-block" onclick="cancelar()">Cancelar</button></th>
								</table>
							</div>
						</div>
					</form>
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
		header('Location: ../administrador.php');
	}
	else{
		header('Location: ../login.php');
	}
	?>
</html>
