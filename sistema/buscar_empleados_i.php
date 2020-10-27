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
	<title>Buscar empleado - Guitar Der</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('includes/nav.php'); ?>
</head>
<body>
	<?php include('includes/head.php'); ?>
    <!--sidebar end-->
    <div class="content">
      <div class="card">
	<section id="container">
		<?php 
			$busqueda = strtolower($_REQUEST['busqueda']);
			if (empty($busqueda)) {
				header('location: empleados_eliminados');

				mysqli_close($conection);
			}

		 ?>
		<div>
			<h1>Empleados inactivos</h1>
			<a href="nuevo_empleado" class="btn_new">Nuevo empleado</a>
			<a class="btn_inac" href="lista_empleados" >Empleados activos</a>
			<a class="btn_desc" href="reporte_empleados_i"  data-titulo="">Descargar reporte</a>
		</div>
		<form action="" method="get" class="form_search">
			<input class="buscar" type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda; ?>">
			<input type="submit" value="Buscar" class="btn_search">
		</form>
		<table>
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
					<th>ACCIÓN</th>
				</tr>
			</thead>
			<?php 
			//paginador
			$rol = '';
			if ($busqueda == 'Administrador') {
				$rol = "OR rol LIKE '%1%'";
			}elseif ($busqueda == 'Empleado') {
				$rol = "OR rol LIKE '%2%'";
			}elseif ($busqueda == 'Cliente') {
				$rol = "OR rol LIKE '%3%'";
			}

			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM empleados WHERE (idUsuario LIKE '%$busqueda%' OR cedula LIKE '%$busqueda%' OR nombres LIKE '%$busqueda%' OR apellidos LIKE '%$busqueda%' OR correo LIKE '%$busqueda%' OR telefono LIKE '%$busqueda%' OR genero LIKE '%$busqueda%' $rol) AND status = 0");

			$result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];

			$por_pagina = 7;

			if(empty($_GET['pagina']))
			{
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina-1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);

				$query = mysqli_query($conection, "SELECT u.idUsuario, u.cedula, u.nombres, u.apellidos, u.correo, u.telefono, u.genero, r.rol FROM empleados u INNER JOIN roles r ON u.rol = r.idRoles 
																					WHERE (u.idUsuario LIKE '%$busqueda%' OR 
																						   u.cedula LIKE '%$busqueda%' OR
																						   u.nombres LIKE '%$busqueda%' OR 
																						   u.apellidos LIKE '%$busqueda%' OR 
																						   u.correo LIKE '%$busqueda%' OR 
																						   u.telefono LIKE '%$busqueda%' OR 
																						   u.genero LIKE '%$busqueda%' OR 
																						   r.rol LIKE '%$busqueda%' ) 
																						   AND 
																						   status = 0 ORDER BY u.idUsuario DESC LIMIT $desde,$por_pagina");
				mysqli_close($conection);
				
              $result = mysqli_num_rows($query);
              if ($result>0) {
              	while ($data = mysqli_fetch_array($query)) {
              		
              	?>
			<tbody>
				<tr>
					<td data-titulo="#"><?php echo $data['idUsuario']; ?></td>
					<td data-titulo="cedula"><?php echo $data['cedula']; ?></td>
					<td data-titulo="nombres"><?php echo $data['nombres']; ?></td>
					<td data-titulo="apellidos"><?php echo $data['apellidos']; ?></td>
					<td data-titulo="rol"><?php echo $data['rol']; ?></td>
					<td data-titulo="correo"><?php echo $data['correo']; ?></td>
					<td data-titulo="telefono"><?php echo $data['telefono']; ?></td>
					<td data-titulo="genero"><?php echo $data['genero']; ?></td>
					<td data-titulo="acción">
						<a class="link_act" href="recuperar_empleado?id=<?php echo $data['idUsuario']; ?>">Activar</a>
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