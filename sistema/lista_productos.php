<?php 
session_start(); 
include('../conexion.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Lista de productos - Clothes For Me</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('includes/head.php') ?>
    <script src="js/functions.js"></script>
  </head>
  <body>

    <?php include('includes/nav.php') ?>
    <!--sidebar end-->

    <div class="content">
      <div class="card">
	<section id="container">
    <div>
      <h1>Lista de productos</h1>
      <a href="nuevo_producto.php" class="btn_new">Nuevo producto</a>
      <a class="btn_inac" href="productos_eliminados">Productos inactivos</a>
      <a class="btn_desc" href="reporte_productos">Descargar reporte</a>
    </div>
    <form action="buscar_producto.php" method="get" class="form_search">
      <input class="buscar" type="text" name="busqueda" id="busqueda" placeholder="Buscar">
      <input type="submit" value="Buscar" class="btn_search">
    </form>
    <table class="tabla_lista_productos">
      <thead>
        <tr>
          <th>ID</th>
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
      $sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM productos WHERE status = 1 ORDER BY idProductos DESC");

      $result_register = mysqli_fetch_array($sql_registe);
      $total_registro = $result_register['total_registro'];

      $por_pagina = 20;

      if(empty($_GET['pagina']))
      {
        $pagina = 1;
      }else{
        $pagina = $_GET['pagina'];
      }

      $desde = ($pagina-1) * $por_pagina;
      $total_paginas = ceil($total_registro / $por_pagina);

        $query = mysqli_query($conection, "SELECT * FROM productos WHERE status = 1 ORDER BY idProductos DESC LIMIT $desde,$por_pagina" );

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
          <td data-titulo="acción">
            
            <a class="link_edit" href="editar_producto.php?id=<?php echo $data['idProductos']; ?>">Editar</a>
            <?php if ($_SESSION['rol'] == 1) {
             ?>
             <span>|</span>
            <a class="link_delete" href="eliminar_producto.php?id=<?php echo $data['idProductos']; ?>" href="#">Eliminar</a>
          <?php }
           ?>
          </td>
        </tr>
      </tbody>
      <?php
    }
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