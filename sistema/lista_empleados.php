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
	<link rel="stylesheet" href="../css/grid.css">
	<title>Lista de empleados - Guitar Der</title><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('includes/head.php'); ?>
</head>
<body>
	<?php include('includes/nav.php'); ?>
    <!--mobile navigation bar end-->
    
    <!--sidebar end-->

    <div class="content">
      <div class="card">
	<section id="container">

		 <!--SECCION UNO-->

		<div>
			<h1>Lista de empleados</h1>
			<a class="btn_new" href="nuevo_empleado">Nuevo empleado</a>
			<a class="btn_inac" href="empleados_eliminados" >Empleados inactivos</a>
			<a class="btn_desc" href="reporte_empleados"  data-titulo="">Descargar reporte</a>
		</div>

		<!--SECCION dos-->

		<div>
			<form action="buscar_empleado" method="get" class="form_search">
				<input class="buscar" type="text" name="busqueda" id="busqueda" placeholder="Buscar">
				<input type="submit" value="Buscar" class="btn_search">
			</form>
		</div>

		<!--SECCION TRES-->

		<table class="tabla_lista_empleados">
			<thead>
				<tr>
					<th>ID</th>
					<th>CEDULA</th>
					<th>NOMBRES</th>
					<th>APELLIDOS</th>
					<th>ROL</th>
					<th>CORREO</th>
					<th>TELEFONO</th>
					<th>GENERO</th>
					<?php if ($_SESSION['rol'] == 1) {
             ?>
					<th>ACCIÓN</th>
				<?php } ?>
				</tr>
			</thead>
			<?php 
			//paginador
			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM empleados WHERE status = 1 ");

			$result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];

			$por_pagina = 9;

			if(empty($_GET['pagina']))
			{
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina-1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);

				$query = mysqli_query($conection, "SELECT u.idUsuario, u.cedula, u.nombres, u.apellidos, u.correo, u.telefono, u.genero, r.rol FROM empleados u INNER JOIN roles r ON u.rol = r.idRoles WHERE status = 1 ORDER BY u.idUsuario LIMIT $desde,$por_pagina");

			mysqli_close($conection);
			
              $result = mysqli_num_rows($query);
              if ($result>0) {
              	while ($data = mysqli_fetch_array($query)) {
              		
              	?>
			<tbody>
				<tr>
					<td data-titulo="id"><?php echo $data['idUsuario']; ?></td>
					<td data-titulo="cedula"><?php echo $data['cedula']; ?></td>
					<td data-titulo="nombres"><?php echo $data['nombres']; ?></td>
					<td data-titulo="apellidos"><?php echo $data['apellidos']; ?></td>
					<td data-titulo="rol"><?php echo $data['rol']; ?></td>
					<td data-titulo="correo"><?php echo $data['correo']; ?></td>
					<td data-titulo="telefono"><?php echo $data['telefono']; ?></td>
					<td data-titulo="genero"><?php echo $data['genero']; ?></td>
					<?php if ($_SESSION['rol'] == 1) {
						 ?>
					<td data-titulo="acción">
						<a class="link_edit" href="editar_empleado?id=<?php echo $data['idUsuario']; ?>">Editar</a>
						
						 <span>|</span>
						<a class="link_delete" href="eliminar_empleado?id=<?php echo $data['idUsuario']; ?>">Eliminar</a>
					</td>
				<?php }
				 ?>
				</tr>
			</tbody>
			<?php
		}
              }else{
              	header('location: inicio');
              }
			 ?>
		</table>
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