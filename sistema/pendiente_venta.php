<?php 
session_start();
if ($_SESSION['rol'] != 1) {
		header('location: inicio');
	}
	
	include('../conexion.php');

	if (!empty($_POST)) {

		$idfac = $_POST['noFactura'];
		//$query_delete = mysqli_query($conection, "DELETE FROM factura WHERE noFactura=$idfac");
		$query_delete = mysqli_query($conection, "UPDATE factura SET status = 'Pendiente' WHERE noFactura= $idfac");

		mysqli_close($conection);

		if ($query_delete) {
			header('location: lista_ventas');
			mysqli_close($conection);
		}else{
			echo "Error al Modificar";
		}

	}
		$nofac = $_REQUEST['id'];

		$query = mysqli_query($conection, "SELECT * FROM factura WHERE noFactura = '$nofac'");

		mysqli_close($conection);

		$result = mysqli_num_rows($query);

		if ($result>0) {
			while ($data=mysqli_fetch_array($query)) {
				$noFactura = $data['noFactura'];
				$fecha = $data['fecha'];
				$idCliente = $data['idCliente'];
				$correoCliente = $data['correoCliente'];
				$totalFactura = $data['totalFactura'];
			}
		}else{
			//header('location: lista_ventas');
		}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Confirmar entrega - Guitar Der</title>
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
			<h2>Una vez confirme, la venta regresara a su estado actual</h2>
			<p>No Factura: <span><?php echo $noFactura; ?></span></p>
			<p>Fecha: <span><?php echo $fecha; ?></span></p>
			<p>Id cliente: <span><?php echo $idCliente; ?></span></p>
			<p>Email del cliente: <span><?php echo $correoCliente; ?></span></p>
			<p>Total de la factura: <span><?php echo $totalFactura; ?></span></p>
			<form method="post" action="">
				<input type="hidden" name="noFactura" value="<?php echo $noFactura ?>">
				<a class="btn_cancelar" href="lista_ventas">Cancelar</a>
				<input style="margin: 10px;" class="btn_save" type="submit" value="Aceptar">
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