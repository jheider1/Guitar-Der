<?php
 include('../conexion.php');
 $fecha = date('d_m_Y - H_i_s');
 header('Content-type: application/vnd.ms-excel;charset=utf-8');
 header("Content-Disposition: attachment; filename=Reporte clientes inactivos_$fecha.xls");

?>
<table border="1">
      <tr>
        <th colspan="9"><h3>Clientes inactivos</h3></th>
      </tr>
      <tr>
        <th>#</th>
        <th>CEDULA</th>
        <th>NOMBRES</th>
        <th>APELLIDOS</th>
        <th>CORREO</th>
        <th>TELEFONO</th>
        <th>CELULAR</th>
        <th>DIRECCION</th>
        <th>GENERO</th>
      </tr>
      <?php 
        $query = mysqli_query($conection, "SELECT * FROM `clientes` WHERE status=0 ORDER BY idCliente DESC");
      
              $result = mysqli_num_rows($query);
              if ($result>0) {
                while ($data = mysqli_fetch_array($query)) {
                  
                ?>
      <tr>
        <td><?php echo $data['idCliente']; ?></td>
        <td><?php echo $data['cedula']; ?></td>
        <td><?php echo $data['nombres']; ?></td>
        <td><?php echo $data['apellidos']; ?></td>
        <td><?php echo $data['correo']; ?></td>
        <td><?php echo $data['telefono']; ?></td>
        <td><?php echo $data['celular']; ?></td>
        <td><?php echo $data['direccion']; ?></td>
        <td><?php echo $data['genero']; ?></td>
      </tr>
      <?php
    }
  }

echo mysqli_error($conection);
mysqli_close($conection);
       ?>
    </table>