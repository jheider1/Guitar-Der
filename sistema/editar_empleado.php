<?php
session_start();
if ($_SESSION['rol'] != 1) {
		header('location: inicio');
	}
	
include('../conexion.php');
	if (!empty($_POST)) {
		$alert = '';
		if (empty($_POST['cedula']) || empty($_POST['nombres']) || empty($_POST['apellidos']) || empty($_POST['rol']) || empty($_POST['correo']) || empty($_POST['telefono']) || empty($_POST['genero'])) {
			$alert = '<p class="msg_error">Todos los campos son obligatorios</p>';
		}else{
			include("../conexion.php");
			$idUsuario = $_POST['idUsuario'];
			$cedula = $_POST['cedula'];
			$nombres = $_POST['nombres'];
			$apellidos = $_POST['apellidos'];
			$clave = md5($_POST['clave']);
			$rol = $_POST['rol'];
			$correo = $_POST['correo'];
			$telefono = $_POST['telefono'];
			$genero = $_POST['genero'];
			$query = mysqli_query($conection,"SELECT * FROM empleados WHERE (correo='$correo' AND idUsuario != $idUsuario) OR (cedula = '$cedula' AND idUsuario != $idUsuario)");

			$result = mysqli_fetch_array($query);

			if ($result > 0) {
				$alert = '<p class="msg_error">La cedula o el correo ya existe.</p>';
			}else{
				if (empty($_POST['clave'])) {
					$sql_update = mysqli_query($conection, "UPDATE empleados SET cedula='$cedula', nombres='$nombres', apellidos='$apellidos', rol='$rol', correo='$correo', telefono='$telefono', genero='$genero' WHERE idUsuario='$idUsuario'");
				}else{
					$sql_update = mysqli_query($conection, "UPDATE empleados SET cedula='$cedula', nombres='$nombres', apellidos='$apellidos', clave='$clave', rol='$rol', correo='$correo', telefono='$telefono', genero='$genero' WHERE idUsuario='$idUsuario'");
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
		header('location: lista_empleados');
		mysqli_close($conection);
	}
	$iduser = $_GET['id'];
	$sql = mysqli_query($conection,"SELECT u.idUsuario, u.cedula, u.nombres, u.apellidos, u.rol, u.correo, u.telefono, u.genero, (u.rol) as idRoles, (r.rol) as rol FROM empleados u INNER JOIN roles r on u.rol = r.idRoles WHERE idUsuario = $iduser and status = 1");

	mysqli_close($conection);

	$result_sql = mysqli_num_rows($sql);
	if ($result_sql==0) {
		header('location: lista_empleados');
	}else{
		$option = '';
		while ($data = mysqli_fetch_array($sql)) {
			$iduser = $data['idUsuario'];
			$cedula = $data['cedula'];
			$nombres = $data['nombres'];
			$apellidos = $data['apellidos'];
			$idrol = $data['idRoles'];
			$rol = $data['rol'];
			$correo = $data['correo'];
			$telefono = $data['telefono'];
			$genero = $data['genero'];

			if ($idrol == 1) {
				$option = '<option value="'.$idrol.'"select>'.$rol.'</option>';
			}elseif ($idrol == 2) {
				$option = '<option value="'.$idrol.'"select>'.$rol.'</option>';
			}elseif ($idrol == 3) {
				$option = '<option value="'.$idrol.'"select>'.$rol.'</option>';
			}
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
	<title>Editar empleado - Guitar Der</title>
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
			<h1>Actualizar usuario</h1>
			<hr>
			<div class="alert"><?php echo isset($alert)? $alert : ''; ?></div>
			<form action="" method="POST">
				<input type="hidden" name="idUsuario" value="<?php echo $iduser; ?>">
				<label for="cedula">Cedula</label>
				<input type="number" name="cedula" id="cedula" value="<?php echo $cedula; ?>" required>
				<label for="nombres">Nombres</label>
				<input type="text" name="nombres" id="nombres" value="<?php echo $nombres; ?>" required>
				<label for="apellidos">Apellidos</label>
				<input type="text" name="apellidos" id="apellidos" value="<?php echo $apellidos; ?>" required>
				<label for="clave">Clave</label>
				<input type="text" name="clave" id="clave" placeholder="Clave" minlength="6">
				<label for="rol">Tipo de usuario</label>
				<select name="rol" id="rol" class="notitemone">
					<?php 
						include("../conexion.php");
                $query_rol = mysqli_query($conection, "SELECT * FROM roles");
                $result_rol = mysqli_num_rows($query_rol);

                mysqli_close($conection);
             ?>
                 <?php 
                 echo $option;
                    if ($result_rol>0) {
                        while ($rol=mysqli_fetch_array($query_rol)) { ?>
                        	<option value="<?php echo $rol['idRoles']; ?>"><?php echo $rol['rol']; ?></option>
                    <?php
                        }
                    }
                  ?>
				</select>
				<label for="correo">Email</label>
				<input type="email" name="correo" id="correo" value="<?php echo $correo; ?>" required>
				<label for="telefono">Teléfono</label>
				<input type="number" name="telefono" id="telefono" value="<?php echo $telefono; ?>" required>
				<label for="genero">Genero</label>
				<select name="genero" id="genero">
					<?php echo $genero; ?>
					<option>Masculino</option>
					<option>Femenino</option>
				</select>
				<input type="submit" value="Actualizar usuario" class="btn_save">
				<button class="btn_cancelar"><a href="lista_empleados.php">Volver</a></button>
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