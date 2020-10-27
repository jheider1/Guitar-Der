<?php 

	$alert = '';
	session_start();
	
	if (!empty($_SESSION['active'])) {
		header("location: sistema/inicio");
	}else{
	if (!empty($_POST)) {
		if (empty($_POST['correo']) || empty($_POST['clave'])) {
			$alert = 'Ingrese su correo y su clave';
		}else{
			require_once "conexion.php";
			$correo = mysqli_real_escape_string($conection, $_POST['correo']);
			$pass = md5(mysqli_real_escape_string($conection, $_POST['clave']));
			$query = mysqli_query($conection, "SELECT * FROM empleados WHERE correo = '$correo' AND clave = '$pass'");
			mysqli_close($conection);
			$result = mysqli_num_rows($query);
			if ($result > 0) {
				$data = mysqli_fetch_array($query);
				$_SESSION['active'] = true;
				$_SESSION['idUser'] = $data['idUsuario'];
				$_SESSION['cedula'] = $data['cedula'];
				$_SESSION['nombres'] = $data['nombres'];
				$_SESSION['apellidos'] = $data['apellidos'];
				$_SESSION['rol'] = $data['rol'];
				$_SESSION['correo'] = $data['correo'];
				$_SESSION['telefono'] = $data['telefono'];
				$_SESSION['genero'] = $data['genero'];
				header("location: sistema/inicio");
			}else{
				$alert = 'El correo o la clave son incorrectos';
				session_destroy();
			}
		}
	}
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Funcionario - Guitar Der</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('sistema/includes/head_inicio.php'); ?>
	<link rel="stylesheet" type="text/css" href="sistema/css/login.css">
  </head>
  <body>

  <div class="container">

	  <div class="container__img">

		  <img src="img/bg2.svg" alt="pegatina_fondo">

	  </div>
	  
		<div class="container__login">

			<form class="container__login-form" action="#" method="POST">

				<img src="img/avatar2.svg" alt="avatar">

				<h2>Funcionario</h2>

				<div class="container__login-form-input one">
					<div class="i">

						<i class="fas fa-user"></i>

					</div>

					<div class="div">

						<h5>Correo electronico</h5>

						<input class="input" type="text" name="correo">

					</div>
					
				</div>

				<div class="container__login-form-input pass">

					<div class="i">

						<i class="fas fa-lock"></i>

					</div>

					<div class="div">

						<h5>Contraseña</h5>

						<input class="input" type="password" name="clave">

					</div>

				</div>
				
				<div class="alert">

					<?php echo isset($alert)? $alert:''; ?>

				</div>

				<input class="btn" type="submit" value="Iniciar sesion">


				<a class="btn_volver" href="index.php">Inicio</a>

				<div class="loginEnlaces">

					<p>Soy usuario, 
						
						<a class="register" href="login_cliente">

							Iniciar sesión
						
						</a>
					
					</p>
				
				</div>
				

			</form>

		</div>

		
	<script type="text/javascript" src="sistema/js/main.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
      $('.nav_btn').click(function(){
        $('.mobile_nav_items').toggleClass('active');
      });
    });
    </script>


</body>
</html>