<?php
session_start();
    
include('conexion.php');
    if (!empty($_POST)) {
        $alert = '';
        if (empty($_POST['cedula']) || empty($_POST['nombres']) || empty($_POST['apellidos']) || empty($_POST['correo']) || empty($_POST['celular']) || empty($_POST['genero'])) {
            $alert = '<p class="msg_error">Todos los campos son obligatorios</p>';
        }else{
            include("conexion.php");
            $idcli = $_POST['idClientes'];
            $cedula = $_POST['cedula'];
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $celular = $_POST['celular'];
            $direccion = $_POST['direccion'];
            $genero = $_POST['genero'];
            $query = mysqli_query($conection,"SELECT * FROM clientes WHERE (correo='$correo' AND idCliente != $idcli) OR (cedula = '$cedula' AND idCliente != $idcli)");

            $result = mysqli_fetch_array($query);

            if ($result > 0) {
                $alert = '<p class="msg_error">La cedula o el correo ya existe.</p>';
            }else{
                    $sql_update = mysqli_query($conection, "UPDATE clientes SET cedula='$cedula', nombres='$nombres', apellidos='$apellidos', correo='$correo', telefono='$telefono', celular='$celular', direccion='$direccion', genero='$genero' WHERE idCliente='$idcli'");
                if ($sql_update) {
                    $alert = '<p class="msg_save">Datos actualizados correctamente.</p>';
                }else{
                    $alert = '<p class="msg_error">Error al actualizar datos.</p>';
                }
            }
        }
    }
    //Mostrar datos 
    if (empty($_GET['id'])) {
        header('location: lista_clientes');
        mysqli_close($conection);
    }
    $idcli = $_GET['id'];
    $sql = mysqli_query($conection,"SELECT * FROM clientes WHERE idCliente = $idcli and status = 1");

    mysqli_close($conection);

    $result_sql = mysqli_num_rows($sql);
    if ($result_sql==0) {
        header('location: lista_clientes');
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
    <link rel="stylesheet" type="text/css" href="sistema/css/editar_info.css">
</head>
<body>
    <!--sidebar end-->
    <div class="titulo">
    
        <h2><i class="fas fa-edit"></i> Actualizar datos personales</h2>

        <hr>

    </div>

    <div class="container">

        <form class="container__form" action="#" method="POST">

            <input type="hidden" name="idClientes" value="<?php echo $idcli; ?>">

            <div class="container__form-control">

            <input class="input" type="number" name="cedula" placeholder="Cedula" value="<?php echo $cedula; ?>" required>

            </div>

            <div class="container__form-control">

                <input class="input" type="text" name="nombres" placeholder="Nombres" value="<?php echo $nombres; ?>" required>

            </div>

            <div class="container__form-control">

                <input class="input" type="text" name="apellidos" id="apellidos" placeholder="Apellidos" value="<?php echo $apellidos; ?>" required>

            </div>

            <div class="container__form-control">

                <input class="input" type="email" name="correo"  placeholder="Correo electronico" value="<?php echo $correo; ?>" required readonly>


            </div>

            <div class="container__form-control">

                <input class="input" type="number" name="telefono"  placeholder="Telefono" value="<?php echo $telefono; ?>">

            </div>

            <div class="container__form-control">

                <input class="input" type="number" name="celular" placeholder="Celular" value="<?php echo $celular; ?>" required>

            </div>

            <div class="container__form-control">

                <input class="input" type="text" name="direccion"  placeholder="Direccion" value="<?php echo $direccion; ?>">

            </div>

            <div class="container__form-control">

                <label for="genero">Genero</label>

                <select name="genero" id="genero">

                    <?php echo $genero; ?>
                    <option>Masculino</option>
                    <option>Femenino</option>

                </select>

            </div>

            <div class="alert-register">

                <?php echo isset($alert)? $alert : ''; ?>

            </div>

            <input type="submit" value="Actualizar datos" class="btn">

            <a class="btn-a" href="configuracion">Volver</a>

        </form>

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