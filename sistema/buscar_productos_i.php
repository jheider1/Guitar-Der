<?php 
session_start();
if ($_SESSION['rol'] != 1 && $_SESSION['rol'] != 2) {
		header('location: ./');
	}
	
	include("../conexion.php");
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Buscar producto - Clothes For Me</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('includes/head.php'); ?>
</head>
<body>
	<?php include('includes/nav.php'); ?>
    <!--sidebar end-->

    <div class="content">
      <div class="card">
	<section id="container">
		<?php 
			$busqueda = strtolower($_REQUEST['busqueda']);
			if (empty($busqueda)) {
				header('location: productos_eliminados');

				mysqli_close($conection);
			}

		 ?>
		<div>
	      <h1>Productos inactivos</h1>
	      <a href="nuevo_producto.php" class="btn_new">Nuevo producto</a>
	      <a class="btn_inac" href="lista_productos">Productos activos</a>
	      <a class="btn_desc" href="reporte_productos_i">Descargar reporte</a>
    	</div>
		<form action="" method="get" class="form_search">
			<input class="buscar" type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda; ?>">
			<input type="submit" value="Buscar" class="btn_search">
		</form>
		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>NOMBRE</th>
					<th>DESCRIPCIÓN</th>
					<th>PRECIO</th>
					<th>EXISTENCIA</th>
					<th>CATEGORIA</th>
					<th>TIPO</th>
					<th>MODELO</th>	
					<th>IMAGEN</th>
					<th>ACCIÓN</th>
				</tr>
			</thead>
			<?php 
			//paginador

			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM productos WHERE (idProductos LIKE '%$busqueda%' OR nombre LIKE '%$busqueda%' OR descripcion LIKE '%$busqueda%' OR precio LIKE '%$busqueda%' OR existencia LIKE '%$busqueda%' OR categoria LIKE '%$busqueda%' OR tipo LIKE '%$busqueda%' OR modelo LIKE '%$busqueda%' OR imagen) AND status = 0");

			$result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];

			$por_pagina = 3;

			if(empty($_GET['pagina']))
			{
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina-1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);

				$query = mysqli_query($conection, "SELECT * FROM productos WHERE (idProductos LIKE '%$busqueda%' OR 
																						   nombre LIKE '%$busqueda%' OR
																						   descripcion LIKE '%$busqueda%' OR 
																						   precio LIKE '%$busqueda%' OR 
																						   existencia LIKE '%$busqueda%' OR 
																						   categoria LIKE '%$busqueda%' OR 
																						   tipo LIKE '%$busqueda%' OR 
																						   modelo LIKE '%$busqueda%' OR
																						   imagen LIKE '%busqueda%') 
																						   AND 
																						   status = 0 ORDER BY idProductos DESC LIMIT $desde,$por_pagina");
				mysqli_close($conection);
				
              $result = mysqli_num_rows($query);
              if ($result>0) {
              	while ($data = mysqli_fetch_array($query)) {
              		
              	?>
			<tbody>
				<tr>
					<td data-titulo="#"><?php echo $data['idProductos']; ?></td>
					<td data-titulo="nombre"><?php echo $data['nombre']; ?></td>
					<td data-titulo="descripcion"><?php echo $data['descripcion']; ?></td>
					<td data-titulo="precio"><?php echo $data['precio']; ?></td>
					<td data-titulo="existencia"><?php echo $data['existencia']; ?></td>
					<td data-titulo="categoria"><?php echo $data['categoria']; ?></td>
					<td data-titulo="tipo"><?php echo $data['tipo']; ?></td>
					<td data-titulo="modelo"><?php echo $data['modelo']; ?></td>
					<?php $foto = 'img/uploads/'.$data['imagen']; ?>
	          		<td data-titulo="imagen" class="img_producto"><img style="height: 80px" src="<?php echo $foto; ?>"></td>
	          		<?php if ($data['idProductos'] != 1 && $data['idProductos'] != 2) {
						 ?>
					<td data-titulo="acción">
						<a class="link_delete" href="recuperar_producto?id=<?php echo $data['idProductos']; ?>">Activar</a>
					</td>
				<?php } ?>
				</tr>
			</tbody>
			<?php
		}
              }
			 ?>
		</table>
		<?php 
			if ($total_registro != 0) {
				
		 ?>
		<div class="paginador">
			<ul>
				<?php 
					if ($pagina != 1) {

				 ?>
				<li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>"><<</a></li>

				<?php 
			}
					for ($i=1; $i <= $total_paginas; $i++) { 
						if ($i == $pagina) {
							echo '<li class="pageselected">'.$i.'</li>';
						}else{
							echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
						}
					}

					if ($pagina != $total_paginas) {
					
				 ?>

				<li><a href="?pagina=<?php echo $pagina+1; ?>">>></a></li>
				<li><a href="?pagina=<?php echo $total_paginas; ?>">>>|</a></li>
			</ul>
		<?php } ?>
		</div>
	<?php } ?>
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