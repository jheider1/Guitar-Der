<?php
	session_start();
	if ($_SESSION['rol'] != 1 && $_SESSION['rol'] != 2) {
		header('location: ../index');
	}
			include("../conexion.php");

	if (!empty($_POST)) {
		$alert = '';
		if (empty($_POST['cedula']) || empty($_POST['nombres']) || empty($_POST['apellidos']) || empty($_POST['correo']) || empty($_POST['clave']) || empty($_POST['telefono']) || empty($_POST['celular']) || empty($_POST['direccion']) || empty($_POST['genero'])) {
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
				$query_insert = mysqli_query($conection, "INSERT INTO clientes (cedula, nombres, apellidos, correo, clave, telefono, celular, direccion, genero) VALUES ('$cedula', '$nombres', '$apellidos', '$correo', '$clave', '$telefono', '$celular', '$direccion', '$genero')");

				if ($query_insert) {
					$alert = '<p class="msg_save">Usuario creado correctamente.</p>';
				}else{
					$alert = '<p class="msg_error">Error al crear el usuario.</p>';
				}
			}
			mysqli_close($conection);
		}
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Nueva venta - Guitar Der</title>
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
			<h1>Registro venta</h1>
			<hr>
			<div class="alert"><?php echo isset($alert)? $alert : ''; ?></div>
			<form action="" method="POST">
      <label for="empleado">Empleado</label>
      <select name="empleado" id="empleado">
					<?php 
						include("../conexion.php");
                $query_empleado = mysqli_query($conection, "SELECT * FROM empleados");
                mysqli_close($conection);

                $result_empleado = mysqli_num_rows($query_empleado);
             ?>
                 <?php 
                    if ($result_empleado>0) {
                        while ($empleado=mysqli_fetch_array($query_empleado)) { ?>
                        	<option value="<?php echo $empleado['idRoles']; ?>"><?php echo $empleado['nombres'] . " " . $empleado['apellidos']; ?></option>
                    <?php
                        }
                    }
                  ?>
				</select>
				<input type="text" name="nombrecompleto" id="nombres" placeholder="Nombre completo" required>
        <label for="producto">Producto</label>
        <select name="producto" id="producto">
					<?php 
						include("../conexion.php");
                $query_producto = mysqli_query($conection, "SELECT * FROM productos");
                mysqli_close($conection);

                $result_producto = mysqli_num_rows($query_producto);
             ?>
                 <?php 
                    if ($result_producto>0) {
                        while ($producto=mysqli_fetch_array($query_producto)) { ?>
                        	<option value="<?php echo $producto['idRoles']; ?>"><?php echo $producto['nombres'] . " " . $producto['apellidos']; ?></option>
                    <?php
                        }
                    }
                  ?>
				</select>
				<input type="email" name="correo" id="correo" placeholder="Correo electronico" required>
        <input type="text" name="metodoPago" value="Paypal" readonly>
        <input type="hidden" name="totalapagar" placeholder="Total a pagar" tequired>
        <input type="text" names="telefono" placeholder="Telefono" required>
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