<?php 
session_start();
if ($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2) {
		header('location: inicio');
	}
include "../conexion.php";
if (!empty($_POST)) 
{
	// print_r($_FILES);
	// exit(); //VER DATOS ARRAY
	$alert = '';
	if (empty($_POST['nombre']) || empty($_POST['descripcion']) || empty($_POST['precio']) || empty($_POST['existencia']) || empty($_POST['categoria']) || empty($_POST['tipo']) || empty($_POST['modelo']) || empty($_POST['id']) || empty($_POST['foto_actual']) || empty($_POST['foto_remove'])) {
		$alert = '<p class="msg_error">Todos los campos son obligatorios</p>';
	}else{
		$idproducto = $_POST['id'];
		$nombre = $_POST['nombre'];
			$descripcion = $_POST['descripcion'];
			$precio = $_POST['precio'];
			$existencia = md5($_POST['existencia']);
			$categoria = $_POST['categoria'];
			$tipo = $_POST['tipo'];
			$modelo = $_POST['modelo'];
		$imgProducto = $_POST['foto_actual'];
		$imgRemove = $_POST['foto_remove'];

		$foto = $_FILES['foto'];
		$nombre_foto = $foto['name'];
		$type = $foto['type'];
		$url_tmp_name = $foto['tmp_name'];

		$upd = '';

		if ($nombre_foto != '') 
		{
			$destino = 'img/uploads/';
			$img_nombre = 'img_'.md5(date('d-m-Y H:m:s'));
			$imgProducto = $img_nombre.'.jpg';
			$src = $destino.$imgProducto;
		}else{
			if($_POST['foto_actual'] != $_POST['foto_remove']){
				$imgProducto = 'img_producto.jpg';
			}
		}

		$query_update = mysqli_query($conection, "UPDATE productos SET nombre ='$nombre', descripcion ='$descripcion', precio ='$precio', existencia ='$existencia', categoria ='$categoria', tipo ='$tipo', modelo ='$modelo', imagen='$imgProducto' WHERE idProductos ='$idproducto'");

			if ($query_update) {

				if (($nombre_foto != '' && ($_POST['foto_actual'] != 'img_producto.jpg')) || ($_POST['foto_actual'] != $_POST['foto_remove']))
				{
					unlink('img/uploads/'.$_POST['foto_actual']);
				}

				if ($nombre_foto != '') 
				{
					move_uploaded_file($url_tmp_name, $src);
				}
				$alert = '<p class="msg_save">Producto ACTUALIZADO exitosamente</p>';
			}else{
				$alert ='<p class="msg_error">Error al Actualizar Producto</p>';
				//echo mysqli_error($conection);

			}
		}

	}



	//Mostrar datos 
	if (empty($_GET['id'])) {
		header('location: lista_productos');
		mysqli_close($conection);
	}
	$idpro = $_GET['id'];
	$sql = mysqli_query($conection,"SELECT * FROM productos WHERE idProductos = $idpro and status = 1");

	mysqli_close($conection);

	$result_sql = mysqli_num_rows($sql);
	if ($result_sql==0) {
		header('location: lista_productos');
	}else{
		$option = '';
		while ($data = mysqli_fetch_array($sql)) {
			$idpro = $data['idProductos'];
			$nombre = $data['nombre'];
			$descripcion = $data['descripcion'];
			$precio = $data['precio'];
			$existencia = $data['existencia'];
			$categoria = $data['categoria'];
			$tipo = $data['tipo'];
			$modelo = $data['modelo'];
			$foto = $data['imagen'];

			if ($tipo == 'Guitarras acusticas') {
				$tipo = '<option value="'.$tipo.'"select>'.$tipo.'</option>';
			}elseif ($tipo == 'Guitarras electricas') {
				$tipo = '<option value="'.$tipo.'"select>'.$tipo.'</option>';
			}elseif ($tipo == 'Guitarras electroacusticas') {
				$tipo = '<option value="'.$tipo.'"select>'.$tipo.'</option>';
			}elseif ($tipo == 'Amplificadores para guitarra') {
				$tipo = '<option value="'.$tipo.'"select>'.$tipo.'</option>';
			}elseif ($tipo == 'Pedales para guitarra') {
				$tipo = '<option value="'.$tipo.'"select>'.$tipo.'</option>';
			}elseif ($tipo == 'Accesorios para guitarra') {
				$tipotipo = '<option value="'.$tipo.'"select>'.$tipo.'</option>';
			}elseif ($tipo == 'Bajos electricos') {
				$tipo = '<option value="'.$tipo.'"select>'.$tipo.'</option>';
			}elseif ($tipo == 'Amplificadiores para bajo') {
				$tipo = '<option value="'.$tipo.'"select>'.$tipo.'</option>';
			}elseif ($tipo == 'Pedales para bajo') {
				$tipo = '<option value="'.$tipo.'"select>'.$tipo.'</option>';
			}elseif ($tipo == 'Accesorios para bajo') {
				$tipo = '<option value="'.$tipo.'"select>'.$tipo.'</option>';
			}
			if ($categoria == 'Guitarras') {
				$categoria = '<option value="'.$categoria.'"select>'.$categoria.'</option>';
			}elseif ($categoria == 'Bajos') {
				$categoria = '<option value="'.$categoria.'"select>'.$categoria.'</option>';
			}
			if ($data['imagen'] != 'img_producto.jpg') {
				$classRemove = '';
				$foto = '<img id="img" src="img/uploads/'.$data['imagen'].'">';
			}
		}
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Editar producto - Guitar Der</title>
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
			<h1>Actualizar producto</h1>
			<hr>
			<div class="alert"><?php echo isset($alert)? $alert : ''; ?></div>
			<form action="" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $idpro ?>">
				<input type="hidden" id="foto_actual" name="foto_actual" value="<?php echo $data['imagen']; ?>">
				<input type="hidden" id="foto_remove" name="foto_remove" value="<?php echo $data['imagen']; ?>">

				<input type="text" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo $nombre ?>" required>
				<textarea wrap="hard" type="text" name="descripcion" id="descripcion" placeholder="Descripción" required><?php echo $descripcion; ?></textarea>
				<input type="number" name="precio" id="precio" placeholder="Precio" value="<?php echo $precio ?>" required>

				<input type="number" name="existencia" id="existencia" placeholder="Existencia" value="<?php echo $existencia ?>" required>

				<label for="categoria">Categoria</label>
				<select name="categoria" id="categoria" required>
					<?php echo $categoria; ?>
					<option>Guitarras</option>
					<option>Bajos</option>
				</select>
				<label for="tipo">Tipo</label>
				<select name="tipo" id="tipo" required>
					<?php echo $tipo; ?>
					<option>Guitarras electricas</option>
					<option>Guitarras electroacusticas</option>
					<option>Amplificadores para guitarra</option>
					<option>Pedales para guitarra</option>
					<option>Accesorios para guitarra</option>
					<option>Bajos electricos</option>
					<option>Amplificadiores para bajo</option>
					<option>Pedales para bajo</option>
					<option>Accesorios para bajo</option>
				</select>
					<input type="text" name="modelo" value="<?php echo $modelo ?>" placeholder="Modelo">
				<label for="foto">Foto</label>
						        <div class="prevPhoto">
						        <span class="delPhoto <?php echo $classRemove; ?>">X</span>
						        <label for="foto"></label>
						        <?php echo $foto; ?>
						        </div>
						        <div class="upimg">
						        <input type="file" name="foto" id="foto">
						        </div>
						        <div id="form_alert"></div>
				<input type="submit" value="Actualizar producto" class="btn_save">
				<button class="btn_cancelar"><a href="lista_productos">Volver</a></button>
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