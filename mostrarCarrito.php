<?php 
    include('config.php');
    include('carrito.php');
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Mi carrito - Guitar Der</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('sistema/includes/head_inicio.php'); ?>
    <link rel="stylesheet" href="sistema/css/carrito.css">

  </head>
  <body>

    <?php include('sistema/includes/nav_inicio.php'); ?>

    <div class="content">
    <div class="card">
    
    <div class="titulo">
                    <h2>Lista de productos agregados hasta el momento</h2>
                    <hr>
                </div>

    <?php if (!empty($_SESSION['CARRITO'])) { ?>
    </div>

    <table>

        <thead>

            <tr>

                <th>NOMBRE</th>
                <th>PRECIO</th>
                <th>MODELO</th>
                <th>CANTIDAD</th>
                <th>TOTAL</th>
                <th>ACCIÓN</th>

            </tr>

        </thead>

        <tbody>

            <?php $total=0; ?>
            <?php foreach ($_SESSION['CARRITO'] as $indice => $producto) {
            ?>

            <tr>
                <td><?php echo $producto['NOMBRE']; ?></td>
                <td><?php echo $producto['PRECIO']; ?></td>
                <td><?php echo $producto['MODELO']; ?></td>
                <td><?php echo $producto['CANTIDAD']; ?></td>
                <td><?php echo number_format($producto['PRECIO']*$producto['CANTIDAD'],2); ?></td>   
                <td>
                    <form action="#" method="POST">

                        <input type="hidden" name="id" value="<?php echo openssl_encrypt($producto['ID'], COD, KEY); ?>">
                        <div class="btn_papelera">
                            <button 
                            type="submit"
                            name="btnAccion" 
                            value="Eliminar" 
                            ><i 
                            class="fas fa-trash papelera"
                            ></i></button>
                        </div>


                    </form>

                </td>

            </tr>

            <?php $total=$total+($producto['PRECIO']*$producto['CANTIDAD']) ?>
            <?php } ?>

            <tr>
                
                <td colspan="3">TOTAL: </td>
                <td align="right"><h3>$ <?php echo number_format($total,2); ?></h3></td>
                <td></td>
            
            </tr>
            
            <tr>

                <td colspan="6">

                    <form action="pagar" method="post">

                        <div class="alert_compra">

                            <div class="form">
                                <?php if (isset($_SESSION['activ'])) { ?>

                                <input class="form__emailcompra" name="email" type="email" value="<?php echo $_SESSION['correo']; ?>" readonly>
                                <?php }else{ ?>
                                <a class="form-iniciarsesion" href="login_cliente">Iniciar Sesión</a>
                                <?php } ?>
                                <!--<select name="metodopago">
                                    <option value="Targeta de credito">Targeta de credito</option>
                                    <option value="Paypal">Paypal</option>
                                    <option value="Amazon Pay">Amazon Pay</option>
                                    <option value="Google Pay">Google Pay</option>
                                </select>-->
                            </div>

                        <?php if (isset($_SESSION['activ'])) {
                        ?>

                        <div class="label_confirmacion">

                            <label  >
                                La compra sera confirmada en este Correo.
                            </label>

                        </div>
                            

                        </div>
                        <div class="btn_finalizarcompra">
                        <button 
                        type="submit" 
                        name="btnAccion" 
                        value="proceder">Comprar
                    </button>
                        </div>
                        
                        <?php } ?>

                    </form>
                    
                </td>
            </tr>
        </tbody>
    </table>

    <?php }else{ ?>

        <div class="alertnoproductos">
           <a href="index.php">¡No hay productos en el Carrito!</a>
        </div>
    
    <?php
    } ?>
    
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