<!DOCTYPE html>
<html lang="es">
  <head>
  	<meta charset="utf-8">
  	<title>Login en CURLUM</title>
  	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
  	<link rel="stylesheet" href="css/bootstrap.min.css">
  	<link rel="stylesheet" href="css/style-login.css">
    <link rel="stylesheet" href="css/font-family.css">
  	<link rel="icon" href="imagenes/CURLUM.ico">
  </head>
	
  <body class="text-center">

    <?php 
      //Inicio de secion
      session_start();
      //Conexion a BD
      $conexion = mysqli_connect("localhost", "root", "", "bd_curriculum");

      //iniciar variables
      $usuario = "";
      $pwd = "";
      $error = "";

      //Procedimiento al presionar "Ingresar"
      if($_POST){

        //Recepción de variables ingresadas
        $usuario = $_POST['username'];
        $pwd = $_POST['password'];

        //Consulta a la base de datos
        $sql = "SELECT * FROM usuario WHERE username='$usuario' AND contrasena='$pwd'";
        $resultado = mysqli_query($conexion, $sql);
        $reg = mysqli_fetch_array($resultado); 

        //Si la consulta coincide, cargará la Página correspondiente
        // 1 Para Profesor
        // 2 Para Súper Administrador
        if(mysqli_num_rows($resultado) == 1){

          $_SESSION['nivel'] = $reg['tipo'];
          $_SESSION['username'] = $reg['username'];
          $_SESSION['user'] = $reg;

          if($reg['tipo'] == 1){
            //$_SESSION['nivel'] = $reg['tipo'];
            $_SESSION['profesor'] = $reg['tipo'];
            header('Location: profesor.php');
          }
          else if($reg['tipo'] == 2){
            $_SESSION['administrador'] = $reg['tipo'];
            header('Location: administrador.php');
          }

          $sql = "SELECT * FROM profesor WHERE username = $usuario";
          $resultado = mysqli_query($conexion, $sql);
          $reg = mysqli_fetch_array($resultado);
          $_SESSION['id'] = $reg['id'];

        }
        else{
          echo '<script language="JavaScript"> alert("Datos Incorrectos"); </script>'; 
        }
      }
    ?>
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
      <form class="form-signin" method="post" >
        <h1 class="h1-font">CURLUM</h1>
        <label for="inputUsuario" class="sr-only">Nombre de Usuario</label>
        <input type="text" id="inputUsuario" class="form-control" name="username" placeholder="Nombre de Usuario" required autofocus>
        <label for="inputPassword" class="sr-only">Contraseña</label>
        <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Contaseña" required>

        <button class="btn btn-lg btn-secondary btn-block" name="Buscar" type="submit">Iniciar Sesión</button>
        <p class="mt-5 mb-3 text-muted"> <a href="index.php"> Regresar</a></p>
        
      </form>
      <footer class="blog-footer text-white">
          <p>CURLUM<a> Sistema de Curriculums en Línea </a>, by <a> CUCEI's Students </a>.</p>
      </footer>

    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>