<?php 
session_start();

	
	include('../conexion.php');
	if ($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2) {
		header('location: ./');
	}

	if (!empty($_POST)) {

		$idCliente = $_POST['idCliente'];
		//$query_delete = mysqli_query($conection, "DELETE FROM clientes WHERE idCliente=$idDliente");
		$query_delete = mysqli_query($conection, "UPDATE clientes SET status = 1 WHERE idCliente = $idCliente");

		mysqli_close($conection);

		if ($query_delete) {
			//header('location: lista_clientes');
			mysqli_close($conection);
		}else{
			echo "Error al eliminar";
		}
	}

		$idCliente = $_REQUEST['id'];

		$query = mysqli_query($conection, "SELECT * FROM clientes WHERE idCliente = '$idCliente'");

		mysqli_close($conection);

		$result = mysqli_num_rows($query);

		if ($result>0) {
			while ($data=mysqli_fetch_array($query)) {
				$idClientes = $data['idCliente'];
				$cedula = $data['cedula'];
				$nombres = $data['nombres'];
				$apellidos = $data['apellidos'];
				$correo = $data['correo'];
			}
		}else{
			header('location: lista_clientes');
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
			<h2>¿Desea recuperar el siguiente cliente?</h2>
			<p>Cedula: <span><?php echo $cedula; ?></span></p>
			<p>nombres: <span><?php echo $nombres; ?></span></p>
			<p>Apellidos: <span><?php echo $apellidos; ?></span></p>
			<p>Correo: <span><?php echo $correo; ?></span></p>
			<form method="post" action="">
				<input type="hidden" name="idCliente" value="<?php echo $idCliente ?>">
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