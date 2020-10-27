<?php 
session_start();
if ($_SESSION['rol'] != 1) {
		header('location: ./');
	}
	
	include('../conexion.php');

	if (!empty($_POST)) {
		
		if ($_POST['idUsuario'] == 1) {
			header('location: lista_empleados');
			mysqli_close($conection);
			exit;
		}

		$idusuario = $_POST['idUsuario'];
		//$query_delete = mysqli_query($conection, "DELETE FROM empleados WHERE idUsuario=$idusuario");
		$query_delete = mysqli_query($conection, "UPDATE empleados SET status = 0 WHERE idUsuario= $idusuario");

		mysqli_close($conection);

		if ($query_delete) {
			header('location: lista_empleados.php');
			mysqli_close($conection);
		}else{
			echo "Error al eliminar";
		}

	}

	if (empty($_REQUEST['id']) || $_REQUEST['id'] == 1) {
		header('location: lista_empleados');
	}else{
		$idusuario = $_REQUEST['id'];

		$query = mysqli_query($conection, "SELECT u.cedula, u.nombres, u.apellidos, u.correo, r.rol FROM empleados u INNER JOIN roles r ON u.rol = r.idRoles WHERE u.idUsuario = '$idusuario'");

		mysqli_close($conection);

		$result = mysqli_num_rows($query);

		if ($result>0) {
			while ($data=mysqli_fetch_array($query)) {
				$cedula = $data['cedula'];
				$nombres = $data['nombres'];
				$apellidos = $data['apellidos'];
				$correo = $data['correo'];
				$rol = $data['rol'];
			}
		}else{
			header('location: lista_empleados');
		}
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Eliminar empleado - Clothes For Me</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('includes/head.php'); ?>
</head>
<body>
	
    <?php include('includes/nav.php'); ?>
    <!--sidebar end-->

    <div class="content">
      <div class="card">
	<section id="container">
		<div class="data_delete">
			<h2>¿Estas seguro de eliminar el siguiente registro?</h2>
			<p>Cedula: <span><?php echo $cedula; ?></span></p>
			<p>nombres: <span><?php echo $nombres; ?></span></p>
			<p>Apellidos: <span><?php echo $apellidos; ?></span></p>
			<p>Correo: <span><?php echo $correo; ?></span></p>
			<p>Rol: <span><?php echo $rol; ?></span></p>
			<form method="post" action="">
				<input type="hidden" name="idUsuario" value="<?php echo $idusuario ?>">
				<a class="btn_cancel" href="lista_empleados">Cancelar</a>
				<input class="btn_ok" type="submit" value="Aceptar">
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