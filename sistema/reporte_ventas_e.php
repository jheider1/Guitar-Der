<?php
 include('../conexion.php');
 $fecha = date('d_m_Y - H_i_s');
 header('Content-type: application/vnd.ms-excel;charset=utf-8');
 header("Content-Disposition: attachment; filename=Reporte ventas entregadas_$fecha.xls");

?>
<table border="1">
      <tr>
        <th colspan="7"><h3>Ventas entregadas</h3></th>
      </tr>
        <tr>
          <th>#</th>
          <th>FECHA</th>
          <th># CLIENTE</th>
          <th>CORREO CLIENTE</th>
          <th>METODO PAGO</th>
          <th>TOTAL FACTURA</th>
          <th>STATUS</th>
        </tr>
      <?php
        $query = mysqli_query($conection, "SELECT * FROM factura WHERE status = 'Entregado' ORDER BY noFactura DESC" );
      
              $result = mysqli_num_rows($query);
              if ($result>0) {
                while ($data = mysqli_fetch_array($query)) {
                  
                ?>
        <tr>
          <td><?php echo $data['noFactura']; ?></td>
          <td><?php echo $data['fecha']; ?></td>
          <td><?php echo $data['idCliente']; ?></td>
          <td><?php echo $data['correoCliente']; ?></td>
          <td><?php echo $data['metodoPago']; ?></td>
          <td><?php echo $data['totalFactura']; ?></td>
          <td><?php echo $data['status']; ?></td>
        </tr>
      <?php
    }
  }

  echo mysqli_error($conection);
  mysqli_close($conection);
       ?>
    </table>