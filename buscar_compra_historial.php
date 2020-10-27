<?php 
	session_start();
	include("conexion.php");
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Historial de compras - Guitar Der</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('sistema/includes/head_inicio.php'); ?>
  </head>
  <body>

    <?php include('sistema/includes/nav_inicio.php'); ?>
    <!--sidebar end-->

    <div class="content">
    <div class="card">
			<section id="container">
				<?php 
					$busqueda = strtolower($_REQUEST['busqueda']);
					if ($_REQUEST['busqueda'] == "") {
					}

				 ?>
				<div>
		      		<h1><i class="fas fa-history"></i> Mi historial de ventas</h1>
		    	</div>
				<form action="" method="get" class="form_search">
					<input class="buscar" type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda; ?>">
					<input type="submit" value="Buscar" class="btn_search">
				</form>
				<table>
					<thead>
						<tr>
		                  <th>#</th>
		                  <th>FECHA</th>
		                  <th>METODO PAGO</th>
		                  <th>TOTAL FACTURA</th>
		                  <th>ACCIÓN</th>
                		</tr>
					</thead>
					<?php 
					//paginador

					$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM factura WHERE (noFactura LIKE '%$busqueda%' OR fecha LIKE '%$busqueda%' OR metodoPago LIKE '%$busqueda%' OR totalFactura)");

					$result_register = mysqli_fetch_array($sql_registe);
					$total_registro = $result_register['total_registro'];

					$por_pagina = 10;

					if(empty($_GET['pagina']))
					{
						$pagina = 1;
					}else{
						$pagina = $_GET['pagina'];
					}

					$desde = ($pagina-1) * $por_pagina;
					$total_paginas = ceil($total_registro / $por_pagina);

						$query = mysqli_query($conection, "SELECT * FROM factura WHERE (noFactura LIKE '%$busqueda%' OR 
																						fecha LIKE '%$busqueda%' OR  
																						metodoPago LIKE '%$busqueda%' OR 
																						totalFactura LIKE '%$busqueda%')  
																						ORDER BY noFactura DESC LIMIT $desde,$por_pagina");
						mysqli_close($conection);
						
		              $result = mysqli_num_rows($query);
		              if ($result>0) {
		              	while ($data = mysqli_fetch_array($query)) {
		              		
		              	?>
					<tbody>
						<tr>
							<td data-titulo="#"><?php echo $data['noFactura']; ?></td>
							<td data-titulo="FECHA"><?php echo $data['fecha']; ?></td>
							<td data-titulo="METODO PAGO"><?php echo $data['metodoPago']; ?></td>
							<td data-titulo="TOTAL FACTURA"><?php echo $data['totalFactura']; ?></td>
							<td>
                      			<a class="link_detalle" href="detalle_venta?id=<?php echo $data['noFactura']; ?>">Ver detalle</a>
                  			</td>
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