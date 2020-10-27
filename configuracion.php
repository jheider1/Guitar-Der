<?php
session_start();
  
include('conexion.php');

$_SESSION['nombres'];
$alert = '';
$idcli = $_SESSION['idCliente'];
  if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['clave1']) || empty($_POST['clave2'])) {
      $alert = '<p class="msg_error">Todos los campos son obligatorios</p>';
    }else{
      include("conexion.php");
      $clave1 = md5($_POST['clave1']);
      $clave2 = md5($_POST['clave2']);
      
        if ($clave1 == $clave2) {
        $sql_update = mysqli_query($conection, "UPDATE clientes SET clave='$clave2' WHERE idCliente='$idcli'");
        $alert = '<p class="msg_save">Clave actualizada correctamente</p>';
        }else{
          $alert = '<p class="msg_error">Las claves no coinciden</p>';
        }
      }
    }
    $idcli = $_SESSION['idCliente'];
    $sql = mysqli_query($conection,"SELECT * FROM clientes WHERE idCliente = $idcli and status = 1");
    mysqli_close($conection);

    $result_sql = mysqli_num_rows($sql);
    if ($result_sql==0) {
      header('location: index');
    }else{
        $option = '';
        while ($data = mysqli_fetch_array($sql)) {
            $idcli = $data['idCliente'];
            $cedula = $data['cedula'];
            $nombres = $data['nombres'];
            $apellidos = $data['apellidos'];
            $correo = $data['correo'];
            $telefono = $data['telefono'];
            $celular = $data['celular'];
            $direccion = $data['direccion'];
            $genero = $data['genero'];

            if ($genero == 'Masculino') {
                $genero = '<option value="'.$genero.'"select>'.$genero.'</option>';
            }elseif ($genero == 'Femenino') {
                $genero = '<option value="'.$genero.'"select>'.$genero.'</option>';
            }
        }
    }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Configuración - Guitar Der</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('sistema/includes/head_inicio.php'); ?>
    <link rel="stylesheet" href="css/configuracion.css">
</head>
<body>

    <?php include('sistema/includes/nav_inicio.php'); ?>
      <!--sidebar end-->

    <div class="content">
      
        <div class="card">

            <div class="titulo">
                <h2><i class="fas fa-user"></i> Mis datos personales</h2>

                <hr>
            </div>
            
            <div class="configuracion">

                <h2>Datos</h2>

                <table>

                    <thead>

                        <tr>
                            <th>#</th>
                            <td><?php echo $idcli; ?></td>
                        </tr>

                        <tr>
                            <th>CEDULA</th>
                            <td><?php echo $cedula; ?></td>
                        </tr>

                        <tr>
                            <th>NOMBRES</th>
                            <td><?php echo $nombres; ?></td>
                        </tr>

                        <tr>
                            <th>APELLIDOS</th>
                            <td><?php echo $apellidos; ?></td>
                        </tr>

                        <tr>
                            <th>CORREO</th>
                            <td><?php echo $correo; ?></td>
                        </tr>

                        <tr>
                            <th>TELÉFONO</th>
                            <td><?php echo $telefono; ?></td>
                        </tr>

                        <tr>
                            <th>CELULAR</th>
                            <td><?php echo $celular; ?></td>
                        </tr>

                        <tr>
                            <th>DIRECCIÓN</th>
                            <td><?php echo $direccion; ?></td>
                        </tr>

                        <tr>
                            <th>GENERO</th>
                            <td><?php echo $genero; ?></td>
                        </tr>
  
                    </thead>

                </table>

                <a class="btn" href="editar_info?id=<?php echo $_SESSION['idCliente']; ?>">Editar datos personales</a>

                

                

                <form class="form_register" action="" method="POST">

                    <h2>Actualizar clave</h2>

                    <input type="hidden" name="idCliente" value="<?php echo $_SESSION['idCliente']; ?>">

                    <input type="password" name="clave1" id="clave1" placeholder="Nueva Clave" minlength="6">

                    <input type="password" name="clave2" id="clave2" placeholder="Confirmar Clave" minlength="6">

                    <div class="alert">
              
                        <?php echo isset($alert)? $alert : ''; ?>
              
                    </div>

                    <input type="submit" value="Actualizar" class="btn_save">

                    <a class="btn-volver" href="index.php">Inicio</a>

                </form>
                
            </div>

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