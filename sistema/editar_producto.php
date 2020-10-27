<?php
session_start();
if ($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2) {
		header('location: inicio');
	}
	
include('../conexion.php');
	if (!empty($_POST)) {
		$alert = '';
		if (empty($_POST['nombre']) || empty($_POST['descripcion']) || empty($_POST['precio']) || empty($_POST['existencia']) || empty($_POST['categoria']) || empty($_POST['tipo']) || empty($_POST['modelo']) || empty($_FILES['imagen'])) {
			$alert = '<p class="msg_error">Todos los campos son obligatorios</p>';
		}else{
			include("../conexion.php");
			$idProducto = $_POST['idProducto'];
			$nombre = $_POST['nombre'];
			$descripcion = $_POST['descripcion'];
			$precio = $_POST['precio'];
			$existencia = $_POST['existencia'];
			$categoria = $_POST['categoria'];
			$tipo = $_POST['tipo'];
			$modelo = $_POST['modelo'];

			$fecha = date('d_m_Y - H_m_s - ');
			$nombre_pro = $fecha . "_" . $_FILES['imagen']['name'];
			$guardado = $_FILES['imagen']['tmp_name'];
			move_uploaded_file($guardado, 'img/uploads/' . $nombre_pro);

			$query = mysqli_query($conection,"SELECT * FROM productos WHERE (nombre='$nombre' AND idProductos != $idProducto) OR (descripcion = '$descripcion' AND idProductos != $idProducto)");

			$result = mysqli_fetch_array($query);

				if (empty($_FILES['imagen'])) {
					$sql_update = mysqli_query($conection, "UPDATE productos SET nombre ='$nombre', descripcion ='$descripcion', precio ='$precio', existencia ='$existencia', categoria ='$categoria', tipo ='$tipo', modelo ='$modelo' WHERE idProductos ='$idProducto'");
				}else{
					$sql_update = mysqli_query($conection, "UPDATE productos SET nombre ='$nombre', descripcion ='$descripcion', precio ='$precio', existencia ='$existencia', categoria ='$categoria', tipo ='$tipo', modelo ='$modelo', imagen='$nombre_pro' WHERE idProductos ='$idProducto'");
				}
				if ($sql_update) {
					$alert = '<p class="msg_save">Producto actualizado correctamente.</p>';
				}else{
					$alert = '<p class="msg_error">Error al actualizar producto.</p>';
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
				<input type="hidden" name="idProducto" value="<?php echo $idpro ?>">
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
				<input type="file" name="imagen">
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