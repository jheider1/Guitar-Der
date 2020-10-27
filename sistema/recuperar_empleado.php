<?php 
session_start();
	
	include('../conexion.php');
	if ($_SESSION['rol'] != 1) {
		header('location: inicio');
	}

	if (!empty($_POST)) {

		$idUsuario = $_POST['idUsuario'];
		//$query_delete = mysqli_query($conection, "DELETE FROM clientes WHERE idUsuario=$idUsuario");
		$query_delete = mysqli_query($conection, "UPDATE empleados SET status = 1 WHERE idUsuario = $idUsuario");

		mysqli_close($conection);

		if ($query_delete) {
			header('location: lista_empleados');
			mysqli_close($conection);
		}else{
			echo "Error al activar";
		}
	}

		$idUsuario = $_REQUEST['id'];

		$query = mysqli_query($conection, "SELECT * FROM empleados WHERE idUsuario = '$idUsuario'");

		mysqli_close($conection);

		$result = mysqli_num_rows($query);

		if ($result>0) {
			while ($data=mysqli_fetch_array($query)) {
				$idClientes = $data['idUsuario'];
				$cedula = $data['cedula'];
				$nombres = $data['nombres'];
				$apellidos = $data['apellidos'];
				$correo = $data['correo'];
				$rol = $data['rol'];
			}
		}else{
			header('location: lista_empleados');
		}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Activar empleado - Clothes For Me</title>
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
			<h2>¿Desea recuperar el siguiente empleado?</h2>
			<p>Cedula: <span><?php echo $cedula; ?></span></p>
			<p>nombres: <span><?php echo $nombres; ?></span></p>
			<p>Apellidos: <span><?php echo $apellidos; ?></span></p>
			<p>Correo: <span><?php echo $correo; ?></span></p>
			<p>Rol: <span><?php echo $rol; ?> </span></p>
			<form method="post" action="">
				<input type="hidden" name="idUsuario" value="<?php echo $idUsuario ?>">
				<a class="btn_cancel" href="lista_clientes">Cancelar</a>
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