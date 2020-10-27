	<?php
	session_start();
	if ($_SESSION['rol'] != 1 && $_SESSION['rol'] != 2) {
		header('location: ./');
	}
			include("../conexion.php");

	if (!empty($_POST)) {
		$alert = '';
		if (empty($_POST['cedula']) || empty($_POST['nombres']) || empty($_POST['apellidos']) || empty($_POST['clave']) || empty($_POST['rol']) || empty($_POST['correo']) || empty($_POST['telefono']) || empty($_POST['genero'])) {
			$alert = '<p class="msg_error">Todos los campos son obligatorios</p>';
		}else{
			$cedula = $_POST['cedula'];
			$nombres = $_POST['nombres'];
			$apellidos = $_POST['apellidos'];
			$clave = md5($_POST['clave']);
			$rol = $_POST['rol'];
			$correo = $_POST['correo'];
			$telefono = $_POST['telefono'];
			$genero = $_POST['genero'];
			$query = mysqli_query($conection,"SELECT * FROM empleados WHERE correo='$correo' OR cedula = '$cedula'");

			$result = mysqli_fetch_array($query);

			if ($result > 0) {
				$alert = '<p class="msg_error">La cedula o el correo ya existe.</p>';

			}else{
				$query_insert = mysqli_query($conection, "INSERT INTO empleados (cedula, nombres, apellidos, clave, rol, correo, telefono, genero) VALUES ('$cedula', '$nombres', '$apellidos', '$clave', '$rol' ,'$correo', '$telefono', '$genero')");

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
	<meta charset="UTF-8">
	<title>Nuevo empleado - Guitar Der</title>
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
			<h1>Registro empleado</h1>
			<hr>
			<div class="alert"><?php echo isset($alert)? $alert : ''; ?></div>
			<form action="" method="POST">
				<input type="number" name="cedula" id="cedula" placeholder="Cedula" required>
				<input type="text" name="nombres" id="nombres" placeholder="Nombres" required>
				<input type="text" name="apellidos" id="apellidos" placeholder="Apellidos" required>
				<input type="password" name="clave" id="clave" placeholder="Clave" minlength="6" required>
				<label for="rol">Tipo de usuario</label>
				<select name="rol" id="rol">
					<?php 
						include("../conexion.php");
                $query_rol = mysqli_query($conection, "SELECT * FROM roles");
                mysqli_close($conection);

                $result_rol = mysqli_num_rows($query_rol);
             ?>
                 <?php 
                    if ($result_rol>0) {
                        while ($rol=mysqli_fetch_array($query_rol)) { ?>
                        	<option value="<?php echo $rol['idRoles']; ?>"><?php echo $rol['rol']; ?></option>
                    <?php
                        }
                    }
                  ?>
				</select>
				<input type="email" name="correo" id="correo" placeholder="Correo electronico" required>
				<input type="number" name="telefono" id="telefono" placeholder="Teléfono" required>
				<label for="genero">Genero</label>
				<select name="genero" id="genero">
					<option>Masculino</option>
					<option>Femenino</option>
				</select>
				<input type="submit" value="Crear usuario" class="btn_save">
				<button class="btn_cancelar"><a href="lista_empleados">Volver</a></button>
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