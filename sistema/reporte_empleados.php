<?php
 include('../conexion.php');
 $fecha = date('d_m_Y - H_i_s');
 header('Content-type: application/vnd.ms-excel;charset=utf-8');
 header("Content-Disposition: attachment; filename=Reporte empleados_$fecha.xls");

?>
<table border="1">
      <tr>
        <th colspan="8"><h3>Empleados activos</h3></th>
      </tr>
      <tr>
        <th>ID</th>
        <th>CEDULA</th>
        <th>NOMBRES</th>
        <th>APELLIDOS</th>
        <th>ROL</th>
        <th>CORREO</th>
        <th>TELEFONO</th>
        <th>GENERO</th>
      </tr>
      <?php
        $sql = mysqli_query($conection, "SELECT u.idUsuario, u.cedula, u.nombres, u.apellidos, u.correo, u.telefono, u.genero, r.rol FROM empleados u INNER JOIN roles r ON u.rol = r.idRoles WHERE status = 1 ORDER BY u.idUsuario DESC");
      
              $result = mysqli_num_rows($sql);
              if ($result>0) {
                while ($data = mysqli_fetch_array($sql)) {
                  
                ?>
      <tr>
        <td><?php echo $data['idUsuario']; ?></td>
        <td><?php echo $data['cedula']; ?></td>
        <td><?php echo $data['nombres']; ?></td>
        <td><?php echo $data['apellidos']; ?></td>
        <td><?php echo $data['rol']; ?></td>
        <td><?php echo $data['correo']; ?></td>
        <td><?php echo $data['telefono']; ?></td>
        <td><?php echo $data['genero']; ?></td>
        <?php }
         ?>
      </tr>
      <?php
    }
    echo mysqli_error($conection);
    mysqli_close($conection);
       ?>
    </table>