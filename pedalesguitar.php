<?php 
    include('config.php');
    include('conex.php');
    include('carrito.php');
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Pedales para GUITARRAS - Guitar Der</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('sistema/includes/head_inicio.php'); ?>
  </head>
  <body>

    <?php include('sistema/includes/nav_inicio.php'); ?>

    <div class="content">
    <div class="card">
    
    <div class="titulo">
                    <h2>Pedales para guitarras</h2>
                    <hr>
                </div>

    <?php if ($mensaje!="") { ?>

        <!--<div class="alertPostAgregado text-center">
                    <a href="mostrarCarrito">
                    <?php echo $mensaje; ?>
                    </a>
                </div>
                -->
    
    <?php } ?>

    <section class="proinicio flex text-center" >

        <?php

        $sentencia = $pdo -> prepare("SELECT * FROM `productos` WHERE status = 1 and tipo = 'Pedales para guitarra'");
        $sentencia -> execute();
        $listaProductos = $sentencia -> fetchAll(PDO::FETCH_ASSOC);
         
            foreach ($listaProductos as $producto) { ?>
                
                <?php $foto = 'sistema/img/uploads/'.$producto['imagen']; ?>

                <div class="proinicio__columna">
                    <!--FOTO-->
                    <a href="descripcion?id=<?php echo $producto['idProductos']; ?>"> 
                        <img class="proinicio__columna-img" src="<?php echo $foto; ?>"> 
                    </a>
                    <!--NOMBRE-->
                    <a class="proinicio__columna-anombre" href="descripcion?id=<?php echo $producto['idProductos']; ?>"> 
                    <?php echo $producto['nombre']; ?>
                    </a>
                    <!--PRECIO-->
                    <div class="proinicio__columna-precio">
                        <?php echo '$ '.$producto['precio'].' CO'; ?>

                    </div>

                    <?php // if ($producto['existencia'] >=6 ) { ?>

                    <div class="proinicio__columna-existencia">

                        <?php // echo "Disponible"; ?>

                    </div>

                    <!--BOTON-->

                    <form action="#" method="post">
                        
                        <input type="hidden" name="id" id="idProductos" value="<?php echo openssl_encrypt($producto['idProductos'], COD, KEY); ?>">

                        <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['nombre'], COD, KEY); ?>">

                        <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['precio'], COD, KEY); ?>">

                        <input type="hidden" name="modelo" id="modelo" value="<?php echo openssl_encrypt($producto['modelo'], COD, KEY); ?>">

                        <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1, COD, KEY); ?>">

                       <button class="proinicio__columna-carrito" name="btnAccion" type="submit" value="Agregar">
                        Añadir <i class="fas fa-shopping-cart"></i>
                        </button>

                        <?php //} else  { ?>

                        <!--<div class="proinicio__columna-agotado">
                            <? //php echo "Agotado"; ?>    
                            </div>

                        <div class="proinicio__columna-noexistencia">
                            <?//php echo "No disponible"; ?>
                        </div> -->
    
                        <?php //} ?>

                    </form>
                </div>

            <?php } ?>

    </section>

    <?php include("sistema/includes/footer.php");?>

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