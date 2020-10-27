<?php 
session_start();
include('../conexion.php');
if ($_SESSION['rol'] != 1 && $_SESSION['rol'] != 2) {
    header('location: ../');
  }
  
  if (empty($_SESSION['active'])) {
    header("location: ../");
  }else{
  include("../conexion.php");
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inicio - Guitar Der</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style_plantilla.css">
    <?php include('includes/head.php'); ?>
  </head>
  <body>

    <?php 
    include('includes/nav.php'); 

    $query_dash = mysqli_query($conection, "CALL dataDashboard();");
    $result_das = mysqli_num_rows($query_dash);
    if ($result_das > 0) {
      $data_dash = mysqli_fetch_assoc($query_dash);
      mysqli_close($conection);
    }

    ?>

    <div class="content">
      <div class="card">
          <div class="divContainer">
            <div>
              <h1 class="titlePanelControl">Panel de Control</h1>
            </div>
            <div class="dashboard">

              <a href="lista_empleados">
                <i class="fas fa-user"></i>
                <p>
                  <strong>Empleados</strong><br>
                  <span><?= $data_dash['usuarios']; ?></span>
                </p>
              </a>

              <a href="lista_productos">
                <i class="fas fa-cubes"></i>
                <p>
                  <strong>Productos</strong><br>
                  <span><?= $data_dash['producto']; ?></span>
                </p>
              </a>

              <a href="lista_clientes">
                <i class="fas fa-users"></i>
                <p>
                  <strong>Clientes</strong><br>
                  <span><?= $data_dash['cliente']; ?></span>
                </p>
              </a>
              
              <a href="lista_ventas">
                <i class="fas fa-file-alt"></i>
                <p>
                  <strong>Ventas</strong><br>
                  <span><?= $data_dash['ventas']; ?></span>
                </p>
              </a>

            </div>
          </div>
          <br>
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
<?php } ?>