<?php
session_start();
if ($_SESSION['rol'] != 1) {
		header('location: inicio');
	}
	
include('../conexion.php');
	if (!empty($_POST)) {
		$alert = '';
		if (empty($_POST['cedula']) || empty($_POST['nombres']) || empty($_POST['apellidos']) || empty($_POST['correo']) || empty($_POST['celular']) || empty($_POST['genero'])) {
			$alert = '<p class="msg_error">Todos los campos son obligatorios</p>';
		}else{
			include("../conexion.php");
			$idcli = $_POST['idClientes'];
			$cedula = $_POST['cedula'];
			$nombres = $_POST['nombres'];
			$apellidos = $_POST['apellidos'];
			$correo = $_POST['correo'];
			$clave = md5($_POST['clave']);
			$telefono = $_POST['telefono'];
			$celular = $_POST['celular'];
			$direccion = $_POST['direccion'];
			$genero = $_POST['genero'];
			$query = mysqli_query($conection,"SELECT * FROM clientes WHERE (correo='$correo' AND idCliente != $idcli) OR (cedula = '$cedula' AND idCliente != $idcli)");

			$result = mysqli_fetch_array($query);

			if ($result > 0) {
				$alert = '<p class="msg_error">La cedula o el correo ya existe.</p>';
			}else{
				if (empty($_POST['clave'])) {
					$sql_update = mysqli_query($conection, "UPDATE clientes SET cedula='$cedula', nombres='$nombres', apellidos='$apellidos', correo='$correo', telefono='$telefono', celular='$celular', direccion='$direccion', genero='$genero' WHERE idCliente='$idcli'");
				}else{
					$sql_update = mysqli_query($conection, "UPDATE clientes SET cedula='$cedula', nombres='$nombres', apellidos='$apellidos', correo='$correo', clave='$clave', telefono='$telefono', celular='$celular', direccion='$direccion', genero='$genero' WHERE idCliente='$idcli'");
				}
				if ($sql_update) {
					$alert = '<p class="msg_save">Usuario actualizado correctamente.</p>';
				}else{
					$alert = '<p class="msg_error">Error al actualizar usuario.</p>';
				}
			}
		}
	}
	//Mostrar datos 
	if (empty($_GET['id'])) {
		header('location: lista_clientes');
		mysqli_close($conection);
	}
	$idcli = $_GET['id'];
	$sql = mysqli_query($conection,"SELECT * FROM clientes WHERE idCliente = $idcli and status = 1");

	mysqli_close($conection);

	$result_sql = mysqli_num_rows($sql);
	if ($result_sql==0) {
		header('location: lista_clientes');
	}else{
		$option = '';
		while ($data = mysqli_fetch_array($sql)) {
			$idcli = $data['idCliente'];
			$cedula = $data['cedula'];
			$nombres = $data['nombres'];
			$apellidos = $data['apellidos'];
			$correo = $data['correo'];
			$clave = $data['clave'];
			$telefono = $data['telefono'];
			$celular = $data['celular'];
			$direccion = $data['direccion'];
			$genero = $data['genero'];

			if ($genero == 'Masculino') {
				$genero = '<option value="'.$genero.'"select>'.$genero.'</option>';
			}elseif ($genero == 'Femenino') {
				$genero = '<option value="'.$genero.'"select>'.$genero.'</option>';
			}
		}
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Editar cliente - Guitar Der</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('includes/head.php'); ?>
</head>
<body>
	<?php include('includes/nav.php'); ?>
    <!--sidebar end-->

    <div class="content">
      <div class="card">
	<section id="container">
		<div class="form_register">
			<h1>Actualizar cliente</h1>
			<hr>
			<div class="alert"><?php echo isset($alert)? $alert : ''; ?></div>
			<form action="" method="POST">
				<input type="hidden" name="idClientes" value="<?php echo $idcli; ?>">
				<input type="number" name="cedula" id="cedula" placeholder="Cedula" value="<?php echo $cedula; ?>" required>
				<input type="text" name="nombres" id="nombres" placeholder="Nombres" value="<?php echo $nombres; ?>" required>
				<input type="text" name="apellidos" id="apellidos" placeholder="Apellidos" value="<?php echo $apellidos; ?>" required>
				<input type="email" name="correo" id="correo" placeholder="Correo electronico" value="<?php echo $correo; ?>" required>
				<input type="password" name="clave" id="clave" placeholder="Clave" minlength="6">
				<input type="number" name="telefono" id="telefono" placeholder="Telefono" value="<?php echo $telefono; ?>">
				<input type="number" name="celular" id="celular" placeholder="Celular" value="<?php echo $celular; ?>" required>
				<input type="text" name="direccion" id="direccion" placeholder="Direccion" value="<?php echo $direccion; ?>">
				<label for="genero">Genero</label>
				<select name="genero" id="genero">
					<?php echo $genero; ?>
					<option>Masculino</option>
					<option>Femenino</option>
				</select>
				<input type="submit" value="Actualizar cliente" class="btn_save">
				<button class="btn_cancelar"><a href="lista_clientes">Volver</a></button>
			</form>
		</div>
	</section>
	 </div>
    </div>

    <script type="text/javascript">
    $(document).ready(function(){
      $('.nav_btn').click(function(){
        $('.mobile_nav_items').toggleClass('active');
      });
    });
    </script>
</body>
</html>