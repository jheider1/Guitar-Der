<?php 
    include('conexion.php');
    include('config.php');
    include('conex.php');
    include('carrito.php');
  //Mostrar datos 
  if (empty($_GET['id'])) {
    header('location: index');
    mysqli_close($conection);
  }
  if (empty($_REQUEST['id'])) {
    header('location: index');
  }else{
    $id_producto = $_REQUEST['id'];
    
    if (!is_numeric($id_producto)) {
      header('location: index');
    }

    $query_producto = mysqli_query($conection, "SELECT * FROM productos WHERE idProductos = '$id_producto' AND status = 1");

    $resul_producto = mysqli_num_rows($query_producto);

    $foto = '';

    if ($resul_producto  > 0) {
      $data_producto = mysqli_fetch_assoc($query_producto);

    }else{
      header('location: index');
    }
  } 
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Descripción - Guitar Der</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('sistema/includes/head_inicio.php'); ?>
    <link rel="stylesheet" href="sistema/css/descripcion-producto.css">
  </head>
  <body>

        <?php include('sistema/includes/nav_inicio.php'); ?>

        <div class="content">

            <div class="card">
                                                   
                <?php if ($mensaje!="") { ?>

                <div class="alertPostAgregado text-center">
                    <a href="mostrarCarrito">
                        <?php echo $mensaje; ?>
                    </a>
                </div>
                
                <?php } ?>


                    <?php

                    $id_producto = $_REQUEST['id'];

                    $sentencia = $pdo -> prepare("SELECT * FROM `productos` WHERE idProductos = $id_producto and status = 1 ORDER BY idProductos DESC");

                    $sentencia -> execute();

                    $listaProductos = $sentencia -> fetchAll(PDO::FETCH_ASSOC);
                    foreach ($listaProductos as $producto) { ?>

                      <?php $foto = 'sistema/img/uploads/'.$producto['imagen']; ?>
                    
                    <div class="descripcionpro">
                            
                        <div class="descripcionpro__columna">

                            <!--FOTO-->
                        
                            <a href="descripcion?id=<?php echo $producto['idProductos']; ?>">

                                <img class="descripcionpro__columna-img" src="<?php echo $foto; ?>"> 
                            
                             </a>
                    
                            
                        </div>

                        <div class="descripcionpro__columna">

                        <!--NOMBRE-->
                        <div class="descripcionpro__columna-nombre">
                                <?php echo $producto['nombre']; ?>
                            <hr>

                            </div>
                                
                            
                            <!--DESCRIPCION-->

                            <div class="descripcionpro__columna-descrip">
                                <?php echo $producto['descripcion']; ?>
                            </div>

                            
                        
                            <div class="descripcionpro__columna-categoria">
                                <!--CATEGORIA-->
                                <?php echo "Categoria: " . $producto['categoria']; ?>

                            </div>

                            <div class="descripcionpro__columna-tipo">

                                <!--TIPO-->

                                <?php echo "Producto: " . $producto['tipo']; ?>
                            
                            </div>

                            <div class="descripcionpro__columna-modelo">

                                <!--MODELO-->

                                <?php echo "Modelo: " . $producto['modelo']; ?>

                            </div>

                            <div class="descripcionpro__columna-precio">

                                <!--PRECIO-->

                                <?php echo '$ '.$producto['precio'].' CO'; ?>

                            </div>

                        <?php //if ($producto['existencia'] >=6 ) { ?>
    
                        <!--<div class="proinicio__columna-existencia">

                        <?php //echo "Disponible"; ?>

                        </div>-->

                        <!--BOTON-->

                        <form  action="" method="post">

                            <input type="hidden" name="id" id="idProductos" value="<?php echo openssl_encrypt($producto['idProductos'], COD, KEY); ?>">

                            <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['nombre'], COD, KEY); ?>">

                            <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['precio'], COD, KEY); ?>">

                            <input type="hidden" name="modelo" id="modelo" value="<?php echo openssl_encrypt($producto['modelo'], COD, KEY); ?>">

                            <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1, COD, KEY); ?>">

                            <button class="descripcionpro__columna-btn" name="btnAccion" type="submit" value="Agregar">
        
                                Añadir <i class="fas fa-shopping-cart"></i>
    
                            </button>
    
                            <?php //} else  { ?>

                             <!--<div class="proinicio__columna-agotado">
                            <?php //echo "Agotado"; ?>    
                            </div>
   
                            <div class="proinicio__columna-noexistencia">
                            <?php //echo "No disponible"; ?>
                            </div>-->
        
                            <?php //} ?>

                        </form>
                        
                        </div>
                    </div>
                        


                    <?php } ?>


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