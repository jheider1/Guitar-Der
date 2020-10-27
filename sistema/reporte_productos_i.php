<?php
include('../conexion.php');
$fecha = date('d_m_Y - H_i_s');
 header('Content-type: application/vnd.ms-excel;charset=utf-8');
 header("Content-Disposition: attachment; filename=reporte productos inactivos_$fecha.xls");

?>
<table border="1">
      <tr>
        <th colspan="8"><h3>Productos inactivos</h3></th>
      </tr>
      <tr>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>DESCRIPCION</th>
        <th>PRECIO</th>
        <th>EXISTENCIA</th>
        <th>CATEGORIA</th>
        <th>TIPO</th>
        <th>MODELO</th>
      </tr>
      <?php 
        $query = mysqli_query($conection, "SELECT * FROM productos p WHERE status = 0 ORDER BY idProductos DESC" );
      
              $result = mysqli_num_rows($query);
              if ($result>0) {
                while ($data = mysqli_fetch_array($query)) {
                  
                ?>
      <tr>
        <td><?php echo $data['idProductos']; ?></td>
        <td><?php echo $data['nombre']; ?></td>
        <td><?php echo $data['descripcion']; ?></td>
        <td><?php echo $data['precio']; ?></td>
        <td><?php echo $data['existencia']; ?></td>
        <td><?php echo $data['categoria']; ?></td>
        <td><?php echo $data['tipo']; ?></td>
        <td><?php echo $data['modelo']; ?></td>
      </tr>
      <?php
    }
              }
echo mysqli_error($conection);
mysqli_close($conection);
       ?>
    </table>