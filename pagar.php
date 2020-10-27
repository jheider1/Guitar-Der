<?php 
    include('config.php');
    include('conex.php');
    include('carrito.php');
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Finalizar compra - Guitar Der</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('sistema/includes/head_inicio.php'); ?>
    <link rel="stylesheet" href="sistema/css/pagar.css">
  </head>
  <body>

    <?php include('sistema/includes/nav_inicio.php'); ?>

    <div class="content">
    <div class="card">
    
    <div class="titulo">
                    <h2>Paga tus productos</h2>
                    <hr>
                </div>

    <?php if ($_POST) {
        $total=0;
        $SID=session_id();
        $correoCliente=$_POST['email'];
        $metodoPago="PayPal";
        $idcli=$_SESSION['idCliente'];

        foreach ($_SESSION['CARRITO'] as $indice => $producto) {

            $total=$total+($producto['PRECIO']*$producto['CANTIDAD']);
        }

        $sentencia=$pdo->prepare("INSERT INTO `factura` 
            (`noFactura`, `fecha`, `usuario`, `idCliente`, `correoCliente`, `metodoPago`, `totalFactura`, `status`) 
            VALUES 
            (NULL, NOW(), '1',:idCliente,:correoCliente,:metodoPago,:totalFactura, 'Pendiente');");

            $sentencia->bindParam(":idCliente",$idcli);
            $sentencia->bindParam(":correoCliente",$correoCliente);
            $sentencia->bindParam(":metodoPago",$metodoPago);
            $sentencia->bindParam(":totalFactura",$total);
            $sentencia->bindParam(":totalFactura",$total);

            $sentencia->execute();
            $idVenta=$pdo->lastInsertId();


            foreach ($_SESSION['CARRITO'] as $indice => $producto) {

            $sentencia=$pdo->prepare("INSERT INTO 
                `detallefactura` (`correlativo`, `noFactura`, `idProducto`, `cantidad`, `precioUnitario`, `descargado`) 
                VALUES (NULL,:noFactura,:idProducto,:cantidad,:precioUnitario, '0');");

            $sentencia->bindParam(":noFactura",$idVenta);
            $sentencia->bindParam(":idProducto",$producto['ID']);
            $sentencia->bindParam(":cantidad",$producto['CANTIDAD']);
            $sentencia->bindParam(":precioUnitario",$producto['PRECIO']);
            $sentencia->execute();

            }

        // echo "<h1>".$total."</h1>";

    } ?>
    <div class="parrafo">
        <h1>¡Ultimo paso para completar tu compra!</h1>
        <p>Estas a punto de pagar tu compra por la cantidad de: <i>$ <?php echo number_format($total,2).' CO'; ?></i>  </p>
            
            <p>Los productos serán enviados a tu dirección una vez que se realice el pago, si no estas seguro de tus datos personales puede editarlos en ajustes.. </p>

            <p>Cualquier inquietud: jerodriguez113@misena.edu.co</p>
    </div>
    <div class="parrafo">
        <p>TOTAL: <?php echo $total; ?>, </p> 
        <p>MONEDA: CO.</p>
        <p> DESCRIPCIÓN: Compra de productos a Guitar Der: $ <?php echo number_format($total,2); ?></p>
        <p>PERSONALIZADO: <?php echo $SID . openssl_decrypt($idVenta, COD, KEY); ?></p>
         
        
        
    </div>

    <div class="form">
        <form method="POST" action="confirmaCompra.php">
        <div class="alert_finalizarcompra">
            <input type="hidden" name="id" value="<?php echo $_SESSION['idCliente']; ?>">
            <input class="form__emailcompra" type="email" name="email" value="<?php echo $_SESSION['correo']; ?>">
            <input type="hidden" name="nombres" value="<?php echo $_SESSION['nombres']; ?>">
            <input type="hidden" name="apellidos" value="<?php echo $_SESSION['apellidos']; ?>">
            <input type="hidden" name="total" value="<?php echo number_format($total,2); ?>">
            <div class="btn_finalizarcompra">

            <button type="submit">Finalizar compra</button>

            </div>
        </div>
            
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