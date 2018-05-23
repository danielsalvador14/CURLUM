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
		<script src="../js/jspdf.min.js"></script>
		<script src="../js/jquery.min.js"></script>
		<script src="../js/FileSaver.js"></script>
		<script src="../jquery.wordexport.js"></script>

	</head>

	<script>
	    function pruebaDivAPdf() {
	        var pdf = new jsPDF('p', 'pt', 'letter');
	        source = $('#imprimir')[0];

	        specialElementHandlers = {
	            '#bypassme': function (element, renderer) {
	                return true
	            }
	        };
	        margins = {
	            top: 80,
	            bottom: 60,
	            left: 40,
	            width: 522
	        };

	        pdf.fromHTML(
	            source,
	            margins.left, // x coord
	            margins.top, { // y coord
	                'width': margins.width,
	                'elementHandlers': specialElementHandlers
	            },

	            function (dispose) {
	                pdf.save('Prueba.pdf');
	            }, margins
	        );
	    }

	    function pruebaDivAWord() {
	    	alert("Entra");
	    	jQuery(document).ready(function($) {
				$("a.word-export").click(function(event) {
					$("#imprimir").wordExport();
				});
			});
	    }
	</script>
	<?php
	session_start();



	function nombre($username){
		$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
		//$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");
		$sql = "SELECT * FROM profesor WHERE username = '$username'";
		$resultado = mysqli_query($conexion, $sql);
		$persona = mysqli_fetch_array($resultado);
		return $persona['nombre']." ".$persona['apellidoP']." ".$persona['apellidoM'];
	}
	///---Formacion Academica---///
	function getProfesor($username){
		$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
		//$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");

		$sql = "SELECT * FROM profesor WHERE username = '$username'";
		$resultado = mysqli_query($conexion, $sql);
		return mysqli_fetch_array($resultado);
	}
	function getNivel($idnivel){
		$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
		//$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");

		$sql = "SELECT * FROM nivel WHERE id = '$idnivel'";
		$resultado = mysqli_query($conexion, $sql);
		return mysqli_fetch_array($resultado);
	}
	function grados($persona){
		$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
		//$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");

		$sql = "SELECT * FROM grado WHERE id_profesor = ".$persona['id'];
		$resultado = mysqli_query($conexion, $sql);
		if ($resultado) {
			$cont = 0;
			while($grados = mysqli_fetch_array($resultado)){
				if ($cont == 0) {
					echo '<div class="row mb-2">';
				}
				echo '
				<div class="col-md-6">
					<div class="card flex-md-row mb-4 box-shadow h-md-250">
						<div class="card-body d-flex flex-column align-items-start" style="color:black">
							<h3 class="mb-0 h-font">
								<a class="text-dark">'.getNivel($grados['id_nivel'])['nombre'].' '.$grados['nombre'].'</a>
							</h3>
							<h4>
								<a class="text-dark h-font"><span class="p-font">Institución: </span>'.$grados['institucion'].'</a>
							</h4>
							<p class="card-text mb-auto p-font">Cédula Profesional: '.$grados['cedula_profesional'].'</p>
							<p>
								<ul class="lista-grado">
									<li>Fehca de inicio de carrera: '.$grados['fecha_inicio'].'</li>
									<li>Fecha de fin de carrera: '.$grados['fecha_fin'].'</li>
									<li>Fecha de obtenido de título: '.$grados['fecha_obtencion'].'</li>
								</ul>
							</p>
						</div>
					</div>
				</div>
				';
				if ($cont == 1) {
					echo "</div>";
					$cont = 0;
				}
				else {
					$cont += 1;
				}
			}
			if ($cont == 1) {
				echo "</div>";
			}
		}
		else {
			echo "<tr><th colspan=".'"7"'."><center> NO HAY REGISTROS </center></th></tr>";
		}
	}
	function getTipo($idtipo){
			$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
	        //$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");
			$sql = "SELECT * FROM tipo_produccion WHERE id = '$idtipo'";
			$resultado = mysqli_query($conexion, $sql);
			return mysqli_fetch_array($resultado);
		}
	function getAutores($registro){
		$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
        //$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");
		$sql = "SELECT * FROM produccion_autores WHERE numRegistro = '$registro'";
		return mysqli_query($conexion, $sql);
	}
	function autores($autores){
		echo '<ul id="lista-autores" class="lista-grado">';
		while ($autor = mysqli_fetch_array($autores)) {
			echo "<li>".$autor['nombre_autor']." ".$autor['apellidoP_autor']." ";
			if ($autor['apellidoM_autor']) {
				echo $autor['apellidoM_autor'];
			}
			echo "</li>";
		}
		echo "</ul>";
	}
	function getAlumnos($idtutoria){
		$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
			//$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");
		$sql = "SELECT * FROM alumno WHERE id_tutoria = '$idtutoria'";
		return mysqli_query($conexion, $sql);
	}
	function alumnos($alumnos){
		echo '<ul id="lista-alumnos" class="lista-tutoria">';
		$cont = 0;
		while ($alumno = mysqli_fetch_array($alumnos)) {
			echo "<li>".$alumno['nombre']." ".$alumno['apellidoP']." ";
			if ($alumno['apellidoM']) {
				echo $alumno['apellidoM'];
			}
			echo "</li>";
			$cont += 1;
			if ($cont == 3) {
				echo "<li>...</li>";
				break;
			}
		}
		echo "</ul>";
	}
	function producciones($persona){
		$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
        //$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");
		$sql = "SELECT * FROM produccion WHERE id_profesor = ".$persona['id'];
		$resultado = mysqli_query($conexion, $sql);
		if ($resultado) {
			$cont = 0;
			while($produccion = mysqli_fetch_array($resultado)){
				if ($cont == 0) {
					echo '<div class="row mb-2">';
				}
				echo '
				<div class="col-md-6">
					<div class="card flex-md-row mb-4 box-shadow h-md-250">
						<div class="card-body d-flex flex-column align-items-start" style="color:black">
							<h3 class="mb-0 h-font">
								<a class="text-dark">'.$produccion['titulo'].'</a>
							</h3>
              				<p class="text-dark h-font"><span class="p-font">Tipo: </span>'.getTipo($produccion['tipo'])['nombre'].'</p>
							<p id="institucion" class="text-dark h-font"><span class="p-font">Institución: </span>'.$produccion['institucion'].'</p>
							<p id="fecha" class="text-dark h-font"><span class="p-font">Fecha de ~lanzado~: </span>'.$produccion['fecha'].'</p>
							<p id="autores" class="text-dark h-font"><span class="p-font">Autores:</p>
							<p>';?><?php autores(getAutores($produccion['numRegistro'])) ?>
							<?php echo '
							</p>
						</div>
					</div>
				</div>
				';
				if ($cont == 1) {
					echo "</div>";
					$cont = 0;
				}
				else {
					$cont += 1;
				}
			}
		}
		else {
			echo "<tr><th colspan=".'"7"'."><center> NO HAY REGISTROS </center></th></tr>";
		}
	}
	function getIdProfesor($username){
		$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
		//$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");
		$sql = "SELECT * FROM profesor WHERE username = '$username'";
		$resultado = mysqli_query($conexion, $sql);
		$persona = mysqli_fetch_array($resultado);
		return $persona['id'];
	}
	function tutorias($persona){
		$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
				//$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");
		$sql = "SELECT * FROM tutoria WHERE id_profesor = ".$persona['id'];
		$resultado = mysqli_query($conexion, $sql);
		if ($resultado) {
			$cont = 0;
			while($tutoria = mysqli_fetch_array($resultado)){
				if ($cont == 0) {
					echo '<div class="row mb-2">';
				}
				echo '
				<div class="col-md-6">
					<div class="card flex-md-row mb-4 box-shadow h-md-250">
						<div class="card-body d-flex flex-column align-items-start" style="color:black">
							<h3 class="mb-0 h-font">
								<a class="text-dark">'.$tutoria['fecha_inicio'].'</a> -> <a class="text-dark">'.$tutoria['fecha_fin'].'</a>
							</h3>
							<h4 class="text-dark h-font"><span class="p-font">Horas: </span>'.$tutoria['horas'].'</h4>
							<p id="alumnos" class="text-dark h-font"><span class="p-font">Alumnos:</p>
							<p>';?><?php alumnos(getAlumnos($tutoria['id'])) ?>
							<?php echo '
							</p>
						</div>
					</div>
				</div>
				';
				if ($cont == 1) {
					echo "</div>";
					$cont = 0;
				}
				else {
					$cont += 1;
				}
			}
		}
		else {
			echo '<p class="p-font"><center> NO HAY REGISTROS </center></p>';
		}
	}
	///--- ---///

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
          <a class="p-2 text-white p-font" href="../datos_personales/pro_datos_personales.php">  Datos Personales</a>
          <a class="p-2 text-white p-font" href="../formacion_academica/pro_formacion.php">Formación Académica</a>
          <a class="p-2 text-white p-font" href="../produccion_academica/pro_produccion.php">Producción Académica</a>
          <a class="p-2 text-white p-font" href="../carga_academica/carga_academica.php">Carga Acádemica</a>
          <a class="p-2 text-white p-font" href="../tutoria/pro_tutoria.php">Tutorías</a>
          <a class="p-2 text-white p-font" href="configuracion.php">Configuración</a>
        </nav>
      </div>
      <div>
      	<a href="javascript:pruebaDivAPdf()" class="button">Pasar a PDF</a>
      	<br>
				<a href="toword.php">Pasar a Word</a>
				<!--a class="word-export" href="javascript:void(0)"> Pasar a .doc </a>
				<a href="javascript:pruebaDivAWord()" class="word-export">Pasar a Word</a-->
      </div>

      <div class="jumbotron text-white rounded bg-dark" id="imprimir">
      	<br><br><br><br>
				<div class="container-fluid ">
					<h1 class="display-4 font-italic h-font">Datos Personales</h1>
					<div class="row ">
		      	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
							<?php
							if(!file_exists("../datos_personales/foto_perfil/".$idProfesor.".jpg")){
							?>
								<img src="../datos_personales/foto_perfil/default.png" class="img-responsive img-circle" width="250" height="250"/>
							<?php
							}//Llave de if
							else{
								echo "<img src='../datos_personales/foto_perfil/".$idProfesor.".jpg' width='250' height='250'/>";
							}//Llave del else
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
		      	</div>
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
									}//Llave del while
									?>
							</table>
		      	</div>
			  	</div>
				</div>
				<div id="grados-registros" class="div-grados">
					<h1 class="display-4 font-italic h-font">Formación Académica</h1>
					<?php grados(getProfesor($_SESSION['username'])); ?>
				</div>
  			<div id="producciones-registros" class="div-producciones">
  				<h1 class="display-4 font-italic h-font">Producción Académica</h1>
					<?php producciones(getProfesor($_SESSION['username'])); ?>
				</div>

				<div class="col-md-12 ">
					<h1 class="display-4 font-italic h-font">Carga Académica</h1>
        		<div class="card flex-md-row mb-4 box-shadow ">
          		<div class="card-body d-flex flex-column align-items-start">
          			<h3 class="mb-0 h-font">

          			</h3>
          			<p>
        				<?php
        				$idProf = getIdProfesor($_SESSION['username']);

								$sql = "SELECT * FROM imparte WHERE id_profesor = $idProf";
								$resultado = mysqli_query($conexion, $sql);

        				while($reg = mysqli_fetch_array($resultado)){

    							$idAsig = $reg['id_asignatura'];
									$sql = "SELECT * FROM asignatura WHERE id = $idAsig";
									$resultado_a = mysqli_query($conexion, $sql);
									while($asig = mysqli_fetch_array($resultado_a)){
									?>
			          		<div class="box-shadow">
			            		<div class="card-body d-flex flex-column align-items-start col-md-12">
			            			<h3 class=" h-font ">
		              				<a class="text-primary" ><?php echo $asig['nombre'];?></a>
			            			</h3>
			            			<p class="text-dark">
			            				<a md-9> <?php echo $asig['horas']." horas por Semana";?> </a><br>
			            				<a> <?php echo "Fecha de Inicio: ".$asig['fecha_inicio'];?> </a><br>
			            				<a> <?php echo "Fecha de Fin: ".$asig['fecha_fin'];?> </a><br>
			            				<a> <?php echo "Programa Educativo: ".$asig['id_programaE'];?> </a><br>
			            			</p>
			          			</div>
			          		</div>

										<?php
										}
									}
          				?>
          				</p>
          			</div>
          		</div>
	        	</div>
						<div class="col-md-12 ">
							<h1 class="display-4 font-italic h-font">Tutorías</h1>
		        		<div class="card flex-md-row mb-4 box-shadow ">
		          		<div class="card-body d-flex flex-column align-items-start">
										<div id="tutorias-registros" class="div-tutorias">
											<?php tutorias(getProfesor($_SESSION['username'])); ?>
										</div>
	          			</div>
	          		</div>
		        	</div>
		  		</div>
		    </div>
    <footer class="blog-footer text-white pos-food">
      <p>CURLUM<a> Sistema de Curriculums en Línea </a>, by <a> CUCEI's Students </a>.</p>
    </footer>

		<script src="../js/jquery.js"></script>
  	<script src="../js/bootstrap.min.js"></script>
  	<script src="../js/jspdf.min"></script>
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
