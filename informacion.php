<?php 
session_start();
    include('conexion.php');
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Acerca de Nosotros - Guitar Der</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("sistema/includes/head_inicio.php")?>
    <link rel="stylesheet" href="sistema/css/nosotros.css">
  </head>
  <body>

    <?php include('sistema/includes/nav_inicio.php'); ?>

    <div class="content">
    <div class="cardi">
        <h2>MÍSIÓN</h2>
        <p>Suministrar los mejores instrumentos musicales con la más alta calidad y precios accesibles, para satisfacer a nuestros clientes con nuestros productos y servicios.<br><br>
        Brindando un mejor sonido para que tanto niños, jóvenes y adultos tengan acceso a productos que estén a la delantera.</p>
    </div>
    <div class="cardi ">
        <h2>VISIÓN</h2>
        <p>Ser la empresa número uno en venta de instrumentos musicales, lograr un mejor sonido y diseños vanguardistas para lograr una mejor imagen en nuestros instrumentos y así posicionarnos en el consumidor y ser reconocidos por su la calidad de nuestros productos y servicio.</p>
    </div>
    <div class="cardi ">
        <h2>Acerca de nosotros</h2>
        <p class="inf">Nuestra organización nace en septiembre del año 2020 en la ciudad de Cali, con la visión de aportar a la cultura local y nacional, de transmitir a través de los instrumentos musicales una forma en que la sociedad pueda desarrollar la habilidad de integrarse y convivir en armonía a través de la música.<br><br>

        Vemos la música como un sello cultural que nos define como sociedad y que es capaz de desarrollar otras habilidades en las personas desde su infancia. <b>GUITAR DER</b> Tienda Musical se esfuerza constantemente en ofrecer las más completa linea de instrumentos musicales y sistemas de audio, siempre teniendo en cuenta las necesidades cambiantes de nuestros clientes..<br><br>

        Nuestra organización y constancia a través de todos éstos años nos han permitido generar confianza en nuestros clientes quienes nos han permitido ofrecerles todas las ventajas y garantías de nuestros productos..<br><br>

        Nuestro compromiso es la constante preparación, un constate aprendizaje, y un completo surtido de productos acordes a las necesidades de nuestros clientes. Pensamos en nuestros clientes como una gran familia, donde el vinculo de confianza, el respeto y honestidad son los valores fundamentales  para desarrollar una actividad comercial sana y justa, donde el cliente más que comprar un producto viva una experiencia positivamente memorable..<br><br>

        Con lo anterior como base, es como visionamos una empresa a nivel nacional capaz de llevar la música a cada hogar Colombiano..<br><br>

        Gracias por preferirnos!</p>
    </div>
    <div class="cardi ">
        <h2>Área de guitarras</h2>
        <p class="inf">No importa si lo tuyo es el rock, el metal, el jazz o cualquier otro estilo; en nuestra sección especial de guitarras tenemos el instrumento perfecto para ti. Aquí no sólo encontrarás las mejores guitarras acústicas y eléctricas y potentes amplificadores, sino podrás disfrutar de su sonido tocando tu instrumento favorito.</p>
    </div>
    <div class="cardi">
        <h2>Área de bajos</h2>
        <p class="inf">Estamos seguros de que encontrarás el instrumento que necesitas. En esta sección tenemos una infinidad de modelos de bajos y amplificadores de las mejores marcas que se ajustan a tu estilo y presupuesto. Visita nuestra área, prueba y experimenta en tus manos el sonido que buscas.</p>
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