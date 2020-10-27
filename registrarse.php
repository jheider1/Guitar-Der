<?php
	session_start();
	include("conexion.php");

	if (!empty($_POST)) {
		$alert = '';
		if (empty($_POST['cedula']) || empty($_POST['nombres']) || empty($_POST['apellidos']) || empty($_POST['correo']) || empty($_POST['clave']) || empty($_POST['celular']) || empty($_POST['direccion']) || empty($_POST['genero'])) {
			$alert = '<p class="msg_error">Todos los campos son obligatorios</p>';
		}else{
			$cedula = $_POST['cedula'];
			$nombres = $_POST['nombres'];
			$apellidos = $_POST['apellidos'];
			$correo = $_POST['correo'];
			$clave = md5($_POST['clave']);
			$telefono = $_POST['telefono'];
			$celular = $_POST['celular'];
			$direccion = $_POST['direccion'];
			$genero = $_POST['genero'];
			$query = mysqli_query($conection,"SELECT * FROM clientes WHERE correo='$correo' OR cedula = '$cedula'");

			$result = mysqli_fetch_array($query);

			if ($result > 0) {
				$alert = '<p class="msg_error">La cedula o el correo ya existe.</p>';

			}else{
				$query_insert = mysqli_query($conection, "INSERT INTO clientes (cedula, nombres, apellidos, correo, clave, telefono, celular, direccion, genero) VALUES ('$cedula', '$nombres', '$apellidos', '$correo', '$clave', '$telefono' ,'$celular', '$direccion', '$genero')");

				if ($query_insert) {
					$alert = '<p class="msg_save">Usuario creado correctamente.</p>';
				}else{
					$alert = '<p class="msg_error">Error al crear el usuario.</p>';
				}
			}
		}
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="css/style_login.css">
	<meta charset="UTF-8">
	<title>Registrarse - Guitar Der</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="sistema/css/register.css">
</head>
<body>

	<div class="titulo">
        <h2>REGISTRARSE</h2>
        <hr>
    </div>
	
	<div class="container">

		<form class="container__form" action="#" method="POST">

			<div class="container__form-control">

				<input class="input" type="number" name="cedula" placeholder="N. Documento" required>

			</div>

			<div class="container__form-control">

				<input class="input" type="text" name="nombres" placeholder="Nombres" required>

			</div>

			<div class="container__form-control">

				<input class="input" type="text" name="apellidos" placeholder="Apellidos" required>

			</div>

			<div class="container__form-control">

				<input class="input" type="email" name="correo" placeholder="Correo" required>

			</div>

			<div class="container__form-control">

				<input class="input" type="password" name="clave" placeholder="Contraseña" required>

			</div>

			<div class="container__form-control">

				<input class="input" type="number" name="telefono" placeholder="Telefono">

			</div>

			<div class="container__form-control">

				<input class="input" type="number" name="celular" placeholder="Celular" required>

			</div>

			<div class="container__form-control">

				<input class="input" type="text" name="direccion" placeholder="Direccion" required>

			</div>

			<div class="container__form-control">
				<label for="genero">Genero</label>
				<select name="genero" id="genero" required>

					<option></option>
					<option>Femenino</option>
					<option>Masculino</option>

				</select>

			</div>

			<div class="alert-register">
		
				<?php echo isset($alert)? $alert : ''; ?>
		
			</div>
		
				<input class="btn" type="submit" value="Registrarme">

			
				<a class="btn-a" href="index">Inicio</a>


			<div class="container__form-footer">

				<p>

					¿Ya tienes cuenta?,

					<a href="login_cliente">

						Inicia sesion

					</a>

				</p>

			</div>

		</form>

	</div>

	

	
</body>
</html>