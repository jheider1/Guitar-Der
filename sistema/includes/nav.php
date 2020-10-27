<?php include('../conexion.php'); ?>
<input type="checkbox" id="check">
    <!--header area start-->
    <header>
      <label for="check">
        <i class="fas fa-bars" id="sidebar_btn"></i>
      </label>
      <div class="left_area">
        <h3>Guitar <span>Der</span></h3>
      </div>
      <div class="right_area">
        <div class="right_area">
        <a href="salir.php" class="logout_btn"><i style="font-size: 25px" class="fa fa-power-off"></i></a>
      </div>
    </header>
    <!--header area end-->
    <!--mobile navigation bar start-->
    <div class="mobile_nav">
      <div class="nav_bar">
        <?php 
        $datos = mysqli_query($conection, "SELECT u.idUsuario, u.apellidos, u.rol FROM empleados u INNER JOIN roles r ON u.rol = r.idRoles");

          $resultado = mysqli_num_rows($datos);
          $file = mysqli_fetch_array($datos);
         ?>
         <h4><?php echo $_SESSION['nombres'].'<br>'.$_SESSION['apellidos']; ?></h4>
        <i class="fa fa-bars nav_btn"></i>
      </div>
      <div class="mobile_nav_items">
        <a href="inicio"><i class="fas fa-home"></i><span>Inicio</span></a>
        <hr>
        <a href="lista_empleados"><i class="fas fa-users"></i><span>Usuarios</span></a>
        <a href="lista_productos"><i class="fas fa-cubes"></i><span>Productos</span></a>
        <a href="lista_clientes"><i class="fas fa-users"></i><span>Clientes</span></a>
        <a href="lista_ventas"><i class="fas fa-th"></i><span>Ventas</span></a>
        <!--<a href="#"><i class="fas fa-info-circle"></i><span>Información</span></a>
        <a href="configuracion.php"><i class="fas fa-sliders-h"></i><span>Configuración</span></a>-->
        <hr>
        <a href="salir"><i class="fas fa-power-off"></i><span>Salir</span></a>
      </div>
    </div>
    <!--mobile navigation bar end-->
    <!--sidebar start-->
    <div class="sidebar">
      <div class="profile_info">
        
        <?php 
        $datos = mysqli_query($conection, "SELECT u.idUsuario, u.apellidos, u.rol FROM empleados u INNER JOIN roles r ON u.rol = r.idRoles");

          $resultado = mysqli_num_rows($datos);
          $file = mysqli_fetch_array($datos);
         ?>
         <h4><?php echo $_SESSION['nombres'].'<br>'.$_SESSION['apellidos']; ?></h4>
      </div>
      <hr>
      <a href="inicio"><i class="fas fa-home"></i><span>Inicio</span></a>
      <hr>
      <a href="lista_empleados"><i class="fas fa-user"></i><span>Usuarios</span></a>
      <a href="lista_productos"><i class="fas fa-cubes"></i><span>Productos</span></a>
      <a href="lista_clientes"><i class="fas fa-users"></i><span>Clientes</span></a>
      <a href="lista_ventas"><i class="fas fa-th"></i><span>Ventas</span></a>
      <!--<a href="#"><i class="fas fa-info-circle"></i><span>Información</span></a>
      <a href="#"><i class="fas fa-sliders-h"></i><span>Configuración</span></a>-->
      <hr>
      <a href="salir"><i class="fas fa-power-off"></i><span>Salir</span></a>
    </div>
    <!--sidebar end-->