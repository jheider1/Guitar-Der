<?php 
session_start(); 
include('../conexion.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Lista de ventas - Guitar Der</title>
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
      <h1>Ventas entregadas</h1>
      <a href="ventas_anuladas" class="btn_inac">Ventas anuladas</a>
      <a href="lista_ventas" class="btn_inac">Ventas pendientes</a>
      <a href="reporte_ventas_e" class="btn_desc">Descargar reporte</a>
    </div>
    <form action="buscar_venta_e" method="get" class="form_search">
      <input class="buscar" type="text" name="busqueda" id="busqueda" placeholder="Buscar">
      <input type="submit" value="Buscar" class="btn_search">
    </form>
    <table class="tabla_lista_productos">
      <thead>
        <tr>
          <th>#</th>
          <th>FECHA</th>
          <th># CLIENTE</th>
          <th>CORREO CLIENTE</th>
          <th>METODO PAGO</th>
          <th>TOTAL FACTURA</th>
          <th>ACCIÓN</th>
        </tr>
      </thead>
      <?php 
      //paginador
      $sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM factura WHERE status = 'Entregado' ORDER BY noFactura DESC");

      $result_register = mysqli_fetch_array($sql_registe);
      $total_registro = $result_register['total_registro'];

      $por_pagina = 6;

      if(empty($_GET['pagina']))
      {
        $pagina = 1;
      }else{
        $pagina = $_GET['pagina'];
      }

      $desde = ($pagina-1) * $por_pagina;
      $total_paginas = ceil($total_registro / $por_pagina);

        $query = mysqli_query($conection, "SELECT * FROM factura WHERE status = 'Entregado' ORDER BY noFactura DESC LIMIT $desde,$por_pagina" );

      mysqli_close($conection);
      
              $result = mysqli_num_rows($query);
              if ($result>0) {
                while ($data = mysqli_fetch_array($query)) {
                  
                ?>
      <tbody>
        <tr>
          <td data-titulo="#"><?php echo $data['noFactura']; ?></td>
          <td data-titulo="FECHA"><?php echo $data['fecha']; ?></td>
          <td data-titulo="# CLIENTE"><?php echo $data['idCliente']; ?></td>
          <td data-titulo="CORREO CLIENTE"><?php echo $data['correoCliente']; ?></td>
          <td data-titulo="METODO PAGO"><?php echo $data['metodoPago']; ?></td>
          <td data-titulo="TOTAL FACTURA"><?php echo $data['totalFactura']; ?></td>

          <td data-titulo="ACCIÓN">
            <a class="link_edit" href="pendiente_venta?id=<?php echo $data['noFactura']; ?>">Pendiente </a>
            <span> | </span>
            <a class="link_delete" href="anular_venta?id=<?php echo $data['noFactura']; ?>">Anular </a>
            <?php if ($_SESSION['rol'] == 1) {
             ?>
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