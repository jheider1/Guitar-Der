<?php 

    session_start();
    include ('conexion.php');

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Detalle de venta - Guitar Der</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('sistema/includes/head_inicio.php'); ?>
    <link rel="stylesheet" href="sistema/css/historial_de_compras.css">

  </head>
  <body>

    <?php include('sistema/includes/nav_inicio.php'); ?>

    <div class="content">
    <div class="card">
        <section id="container">
            <div class="titulo">
              <h2>Detalle de compra</h2>
              <hr>
            </div>
            <table class="tabla_lista_productos">
              <thead>
                <tr>
                  <th>#</th>
                  <th>PRODUCTO</th>
                  <th>CANTIDAD</th>
                  <th>PRECIO UNITARIO</th>
                </tr>
              </thead>
              <?php 
              $idfactuta = $_REQUEST['id'];
              //paginador
              $sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM detallefactura WHERE noFactura = $idfactuta ORDER BY idProducto DESC");

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

                $query = mysqli_query($conection, "SELECT d.noFactura, d.cantidad, d.precioUnitario, p.nombre FROM detallefactura d INNER JOIN productos p ON d.idProducto = p.idProductos WHERE noFactura = $idfactuta ORDER BY correlativo LIMIT $desde,$por_pagina");

              mysqli_close($conection);
              
                      $result = mysqli_num_rows($query);
                      if ($result>0) {
                        while ($data = mysqli_fetch_array($query)) {
                          
                        ?>
              <tbody>
                <tr>
                  <td data-titulo="#"><?php echo $data['noFactura']; ?></td>
                  <td data-titulo="PRODUCTO"><?php echo $data['nombre']; ?></td>
                  <td data-titulo="CANTIDAD"><?php echo $data['cantidad']; ?></td>
                  <td data-titulo="PRECIO UNITARIO"><?php echo $data['precioUnitario']; ?></td>
                </tr>
              </tbody>
              <?php
            }
                      }
               ?>
            </table>

            <div class="btn_volver">
              <a href="historial_de_compras.php">Volver</a>
            </div>

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