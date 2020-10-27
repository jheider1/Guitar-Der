<?php 
session_start();
	include('../conexion.php');

	if (!empty($_POST)) {

		$idproducto = $_POST['idProductos'];
		//$query_delete = mysqli_query($conection, "DELETE FROM productos WHERE idProductos=$idproducto");
		$query_delete = mysqli_query($conection, "UPDATE productos SET status = 1 WHERE idProductos= $idproducto");

		mysqli_close($conection);

		if ($query_delete) {
			header('location: lista_productos');
			mysqli_close($conection);
		}else{
			echo "Error al activar";
		}

	}
		$idproducto = $_REQUEST['id'];

		$query = mysqli_query($conection, "SELECT * FROM productos WHERE idProductos = '$idproducto'");

		mysqli_close($conection);

		$result = mysqli_num_rows($query);

		if ($result>0) {
			while ($data=mysqli_fetch_array($query)) {
				$idProducto = $data['idProductos'];
				$nombre = $data['nombre'];
				$precio = $data['precio'];
				$modelo = $data['modelo'];
				$existencia = $data['existencia'];

				$foto = 'img/uploads/'.$data['imagen']; ?>
          <?php
			}
		}else{
			header('location: lista_productos');
		}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Clothes For Me - Activar producto</title>
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
			<h2>¿Estas seguro de activar el siguiente producto?</h2>
			<p>Nombre: <span><?php echo $nombre; ?></span></p>
			<p>precio: <span><?php echo $precio; ?></span></p>
			<p>Modelo: <span><?php echo $modelo; ?></span></p>
			<p>Existencia: <span><?php echo $existencia; ?></span></p>
			<p>Imagen: <br><span><img style="height: 100px" src="<?php echo $foto; ?>"></td></span></p>
			<form method="post" action="">
				<input type="hidden" name="idProductos" value="<?php echo $idProducto ?>">
				<a class="btn_cancel" href="lista_productos">Cancelar</a>
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