Ajustes<input type="checkbox" id="check">
    <!--header area start-->
    <header>
      <label for="check">
        <i class="fas fa-bars" id="sidebar_btn"></i>
      </label>
      <div class="left_area">
        <a href="index"><h3>Guitar <span>Der</span></h3></a>
      </div>
      <?php if (isset($_SESSION['activ'])) {
        ?>
        <div class="right_area">
          <a href="sistema/salir" class="logout_btn"><i class="fas fa-power-off"></i></a>
          <a href="mostrarCarrito" class="cart_btn cart1"><i class="fas fa-shopping-cart"></i> (<?php echo (empty($_SESSION['CARRITO']))?0:count($_SESSION['CARRITO']); ?>)</a>
          <a href="mostrarCarrito" class="cart_btn cart2"><i class="fas fa-shopping-cart"> (<?php echo (empty($_SESSION['CARRITO']))?0:count($_SESSION['CARRITO']); ?>)</i></a>
      </div>
      <?php
      }else{
        ?>
        <div class="right_area">
        <a href="login_cliente" class="login_btn">Iniciar sesión</a>
        <a href="mostrarCarrito" class="cart_btn cart1"><i class="fas fa-shopping-cart"></i> (<?php echo (empty($_SESSION['CARRITO']))?0:count($_SESSION['CARRITO']); ?>)</a>
        <a href="mostrarCarrito" class="cart_btn cart2"><i class="fas fa-shopping-cart"> (<?php echo (empty($_SESSION['CARRITO']))?0:count($_SESSION['CARRITO']); ?>)</i></a>
      </div>
      <?php
      }
      ?>

    </header>
    <!--header area end-->
    <!--mobile navigation bar start-->
    <div class="mobile_nav">
      <div class="nav_bar">
        <?php 
        //$datos = mysqli_query($conection, "SELECT u.idUsuario, u.apellidos, u.rol FROM empleados u INNER JOIN roles r ON u.rol = r.idRoles");

          //$resultado = mysqli_num_rows($datos);
          //$file = mysqli_fetch_array($datos);
         ?>
              <i class="fa fa-bars nav_btn"></i>
      
      </div>
      <div class="mobile_nav_items">
        <a href="index"><i class="fas fa-home"></i><span>Inicio</span></a>
        <hr>
        <a href="guitarraselec"><i class="fas fa-guitar"></i><span>Guitarras Electricas</span></a>

        <a href="guitarrasacus"><i class="fas fa-guitar"></i><span>Guitarras Acústicas</span></a>

        <a href="bajos"><i class="fas fa-hand-spock"></i><span>Bajos Eléctricos</span></a>

        <a href="amplificadoresguitar"><i class="fas fa-volume-up"></i><span>Amplificador Guitarras</span></a>

        <a href="amplificadoresbajos"><i class="fas fa-volume-up"></i><span>Amplificador Bajos</span></a>

        <a href="pedalesguitar"><i class="fas fa-hdd"></i><span>Pedales Guitarras</span></a>

        <a href="pedalesbajos"><i class="fas fa-hdd"></i><span>Pedales Bajos</span></a>

        <hr>
        <a href="informacion"><i class="fas fa-info-circle"></i><span>Nosotros</span></a>
        
        <?php if (isset($_SESSION['activ'])) {
        echo '<a href="configuracion"><i class="fas fa-sliders-h"></i><span>Mi perfil</span></a>';
        echo '<a href="historial_de_compras"><i class="fas fa-history"></i><span>Mi historial</span></a>';
        echo '<a href="sistema/salir"><i class="fas fa-power-off"></i><span>Salir</span></a>';
      } ?>
      </div>
    </div>
    <!--mobile navigation bar end-->
    <!--sidebar start-->
    <div class="sidebar">
      <div class="profile_info">
        
        <?php 
        //$datos = mysqli_query($conection, "SELECT u.idUsuario, u.apellidos, u.rol FROM empleados u INNER JOIN roles r ON u.rol = r.idRoles");

          //$resultado = mysqli_num_rows($datos);
          //$file = mysqli_fetch_array($datos);
         ?>
      </div>
      <a href="index"><i class="fas fa-home"></i><span>Inicio</span></a>
      <hr>
      <a href="guitarraselec"><i class="fas fa-guitar"></i><span>Guitarras Eléctricas</span></a>
      <a href="guitarrasacus"><i class="fas fa-guitar"></i><span>Guitarras Acústicas</span></a>
      <a href="bajos"><i class="fas fa-hand-spock"></i><span>Bajos Eléctricos</span></a>
      <a href="amplificadoresguitar"><i class="fas fa-volume-up"></i><span>Amplificador Guitarras</span></a>
      <a href="amplificadoresbajos"><i class="fas fa-volume-up"></i><span>Amplificador Bajos</span></a>
      <a href="pedalesguitar"><i class="fas fa-hdd"></i><span>Pedales Guitarras</span></a>
      <a href="pedalesbajos"><i class="fas fa-hdd"></i><span>Pedales Bajos</span></a>
      <hr>
      <a href="informacion"><i class="fas fa-info-circle"></i><span>Nosotros</span></a>
      <?php if (isset($_SESSION['activ'])) {
      echo '<a href="configuracion"><i class="fas fa-sliders-h"></i><span>Mi perfil</span></a>';
        echo '<a href="historial_de_compras"><i class="fas fa-history"></i><span>Mi historial</span></a>';
        echo '<a href="sistema/salir"><i class="fas fa-power-off"></i><span>Salir</span></a>';
      } ?>
    </div>
    <!--sidebar end-->