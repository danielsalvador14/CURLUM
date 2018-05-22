<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>CURLUM</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/style-fuentes.css">
		<link rel="stylesheet" href="../css/style-blog.css">
		<link rel="stylesheet" href="../css/font-family.css">
		<link rel="icon" href="../imagenes/CURLUM.ico">
	</head>

	

	<?php
	session_start();
	$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
    //$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");

	function nombre($username){
		$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
		//$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");
		$sql = "SELECT * FROM profesor WHERE username = '$username'";
		$resultado = mysqli_query($conexion, $sql);
		$persona = mysqli_fetch_array($resultado);
		echo $persona['nombre']." ".$persona['apellidoP']." ".$persona['apellidoM'];
	}
	function getIdProfesor($username){
		$conexion = mysqli_connect("localhost", "root", "", "b14_22049034_curriculum");
		//$conexion = mysqli_connect("sql306.byethost.com", "b14_22049034", "kvr1vm", "b14_22049034_curriculum");
		$sql = "SELECT * FROM profesor WHERE username = '$username'";
		$resultado = mysqli_query($conexion, $sql);
		$persona = mysqli_fetch_array($resultado);
		return $persona['id'];
	}

	function editarAsignatura($idProf){
		$sql = "SELECT * FROM imparte WHERE id_profesor = $idProf";
		$resultado = mysqli_query($conexion, $sql);
		header('Location: carga_academica.php');
	}

	
	
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
			          <a class="p-2 text-white p-font" href="../datos_personales/pro_datos_personales.php">Datos Personales</a>
			          <a class="p-2 text-white p-font" href="../formacion_academica/pro_formacion.php">Formación Académica</a>
			          <a class="p-2 text-white p-font" href="../produccion_academica/pro_produccion.php">Producción Académica</a>
			          <a class="p-2 text-white p-font" href="carga_academica.php">Carga Acádemica</a>
			          <a class="p-2 text-white p-font" href="#">Tutorías</a>
			          <a class="p-2 text-white p-font" href="#">Configuración</a>
		        	</nav>
		      	</div>
		      	<div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
		        	<div class="col-md-6 px-0">
		        		<h1 class="display-4 font-italic h-font">Carga Académica</h1>
		        		<p class="lead my-3">En esta sección de gestionan todas las asignaturas impartidas.</p>
		        	</div>
		      	</div>

		      	<div class="row mb-6">
		      		<?php 
	      			if(isset($_POST['agregar'])){
	      				$asig = $_POST['Pasignatura'];
						$idProf = getIdProfesor($_SESSION['username']);
						$sql = "SELECT * FROM imparte WHERE id_profesor = '$idProf' AND id_asignatura = '$asig'";
						$resultado = mysqli_query($conexion, $sql);
						$existe = ($resultado -> num_rows);

						if($existe == 0){
							$sql = "INSERT INTO imparte (id_profesor, id_asignatura) VALUES ('$idProf', '$asig')";
							$resultado = mysqli_query($conexion, $sql);
						}
					}

					if(isset($_POST['quitar'])){
						$asig = $_POST['Pasignatura'];
						$idProf = getIdProfesor($_SESSION['username']);
						$sql = "DELETE FROM imparte WHERE id_profesor = '$idProf' AND id_asignatura = '$asig'";
						$resultado = mysqli_query($conexion, $sql);
					}
				?>
		      		<div class=" container col-md-12 ">
		      			<form method="post">
							<table class="table-dark table table-hover table-stripped">
								<th><td colspan="2">Nombre de Asignatura: </td> 
									<td colspan="4">
										<select class="form-control custom-select" type="select" name="Pasignatura" id="Pasignatura" required>
											<?php 
												$sql = "SELECT * FROM asignatura ";
												$resultado_a = mysqli_query($conexion, $sql);
												while ($asig = mysqli_fetch_array($resultado_a)){
													$idAsig = $asig['id'];
													$nombre = $asig['nombre'];
													$horas = $asig['horas'];
													$fechaInicio =$asig['fecha_inicio'];
													$fechaFin = $asig['fecha_fin'];
													$idProgE = $asig['id_programaE'];
													?>
														<!-- <option <?php //echo "value = '$idAsig'";?> > <?php //echo "Nombre: ".$nombre." Horas por Semana: ".$horas." Fecha de Inicio: ".$fechaInicio." ".$fechaFin; ?></option> -->
														<option <?php echo "value = $idAsig";?> > <?php echo $nombre; ?></option>
													<?php
												}
											?>
										</select>
									</td>
									<td colspan="1">
										<div class="btn-group d-inline-block">
											<input type="submit" id="agregar" name="agregar" class="btn btn-outline-info" value="Agregar">
											<input type="submit" id="quitar"  name="quitar" class="btn btn-outline-info" value="Eliminar">
										</div>
									</td>	
								</th>
							</table>
						</form>
		      		</div>
		        	<div class="col-md-12 ">
		          		<div class="card flex-md-row mb-4 box-shadow ">
		            		<div class="card-body d-flex flex-column align-items-start">
		            			<h3 class="mb-0 h-font">
		              				<a class="text-dark ">Carga Académica Actual</a>
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
								            			<p> 
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
		      	</div>
		    </div>
		    <footer class="blog-footer text-white">
		      <p>CURLUM<a> Sistema de Curriculums en Línea </a>, by <a> CUCEI's Students </a>.</p>
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
