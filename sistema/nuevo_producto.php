<?php
	session_start();
	if ($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2) {
		header('location: ./');
	}
			include("../conexion.php");

	if (!empty($_POST)) {
		$alert = '';
		if (empty($_POST['nombre']) || empty($_POST['descripcion']) || empty($_POST['precio']) || empty($_POST['existencia']) || empty($_POST['categoria']) || empty($_POST['tipo']) || empty($_POST['modelo']) || empty($_FILES['imagen'])) {
			$alert = '<p class="msg_error">Todos los campos son obligatorios</p>';
		}else{
			$nombre = $_POST['nombre'];
			$descripcion = $_POST['descripcion'];
			$precio = $_POST['precio'];
			$existencia = $_POST['existencia'];;
			$categoria = $_POST['categoria'];
			$tipo = $_POST['tipo'];
			$modelo = $_POST['modelo']; 

			$fecha = date('d_m_Y - H_m_s - ');
			$nombre_pro = $fecha . "_" . $_FILES['imagen']['name'];
			$guardado = $_FILES['imagen']['tmp_name'];
			move_uploaded_file($guardado, 'img/uploads/' . $nombre_pro);

			$query = mysqli_query($conection,"SELECT * FROM productos WHERE nombre='$nombre'");

			$result = mysqli_fetch_array($query);

			if ($result > 0) {
				$alert = '<p class="msg_error">El producto ya existe, lo puede actualizar.</p>';

			}else{

				$new = mysqli_query($conection, "INSERT INTO productos (nombre, descripcion, precio, existencia, categoria, tipo, modelo, imagen) VALUES ('$nombre', '$descripcion', '$precio', '$existencia', '$categoria', '$tipo', '$modelo', '$nombre_pro')");

				if ($new) {
					$alert = '<p class="msg_save">Producto guardado correctamente.</p>';
				}else{
					$alert = '<p class="msg_error">Error al guardar producto.</p>';
					echo mysqli_error($conection);
				}
			}
		}
	}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Nuevo producto - Clothes For Me</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('includes/head.php'); ?>
  </head>
  <body>
  	<!--INICIO DEL NAVEGADOR-->
  	<?php include('includes/nav.php'); ?>
    <!--FIN DEL NAVEGADOR-->

    <div class="content">
    <div class="card">
	<section id="container">
		<div class="form_register">
			<h1>Registro producto</h1>
			<hr class="linea">
			<div class="alert"><?php echo isset($alert)? $alert : ''; ?></div>
			<form action="" method="POST" enctype="multipart/form-data">
				<input type="text" name="nombre" id="nombre" placeholder="Nombre" required>
				<textarea wrap="hard" type="text" name="descripcion" id="descripcion" placeholder="Descripción" required></textarea>
				<input type="number" name="precio" id="precio" placeholder="Precio" required>
				<input type="number" name="existencia" id="existencia" placeholder="Existencia" required>
				<label for="categoria">Categoria</label>
				<select name="categoria" id="categoria" required>
					<option></option>
					<option>Guitarras</option>
					<option>Bajos</option>
				</select>
				<label for="tipo">Tipo</label>
				<select name="tipo" id="tipo" required>
					<option></option>
					<option>Guitarras acusticas</option>
					<option>Guitarras electricas</option>
					<option>Guitarras electroacusticas</option>
					<option>Amplificadores para guitarra</option>
					<option>Pedales para guitarra</option>
					<option>Accesorios para guitarra</option>
					<option>Bajos electricos</option>
					<option>Amplificadiores para bajo</option>
					<option>Pedales para bajo</option>
					<option>Accesorios para bajo</option>
					<input type="text" name="modelo" placeholder="Modelo">
				<label for="foto">Imagen del producto</label>
                    <div class="prevPhoto">
                    <span class="delPhoto notBlock">X</span>
                    <label for="foto"></label>
                    </div>
                    <div class="upimg">
                    <input type="file" name="imagen" id="foto">
                    </div>
                    <div id="form_alert"></div>
				<input type="submit" value="Guardar producto" class="btn_save">
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