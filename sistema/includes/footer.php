<footer>
       
       <div class="footer">
        
            <div class="footer__body">

                <div class="footer__body-columna1">
                    <h2>Mas informacion de la compañia</h2>

                   <p>
                       Nuestra organización nace en septiembre del año 2020 en la ciudad de Cali, con la visión de aportar a la cultura local y nacional, de transmitir a través de los instrumentos musicales una forma en que la sociedad pueda desarrollar la habilidad de integrarse y convivir en armonía a través de la música.
                   </p>
                   <p>
                       Nuestro compromiso es la constante preparación, un constate aprendizaje, y un completo surtido de productos acordes a las necesidades de nuestros clientes. Pensamos en nuestros clientes como una gran familia, donde el vinculo de confianza, el respeto y honestidad son los valores fundamentales  para desarrollar una actividad comercial sana y justa, donde el cliente más que comprar un producto viva una experiencia positivamente memorable..
                   </p>

                </div>

                <div class="footer__body-columna2">

                    <h2>Redes Sociales</h2>

                    <div class="footer__body-columna2-row">
                        <img src="img/facebook.png">
                        <a href="#">Guitar Der</a>
                    </div>
                    <div class="footer__body-columna2-row">
                        <img src="img/twitter.png">
                        <a href="#">@Guitar_Der</a>
                    </div>
                    <div class="footer__body-columna2-row">
                        <img src="img/instagram.png">
                        <a href="#">guitar_der</a>
                    </div>
                    <div class="footer__body-columna2-row">
                        <img src="img/pinterest.png">
                        <a href="#">@GuitarDer</a>
                    </div>


                </div>

                <div class="footer__body-columna3">

                    <h2>Informacion Contactos</h2>

                    <div class="footer__body-columna3-row">
                        <img src="img/home.png">
                        <label>Colombia, Cali - Valle del cauca</label>
                    </div>

                    <div class="footer__body-columna3-row">
                        <img src="img/telefono.png">
                        <label>+1-829-395-2064</label>
                    </div>

                    <div class="footer__body-columna3-row">
                        <img src="img/user.png">
                         <label>jerodriguez113@misena.edu.co</label>
                    </div>
                    <form action="mensaje.php" method="POST">

                        <div class="footer__body-columna3-row">
                            <input class="input-datos" type="text" name="datos" placeholder="Nombres y apellidos">

                        </div>
                      <?php if (!isset($_SESSION['activ'])) {
                        ?>
                                <div class="footer__body-columna3-row">
                                    <input class="email" type="email" name="email" placeholder="Correo electronico">

                                </div>

                      <?php
                      }else{
                        ?>
                           <div class="footer__body-columna3-row">

                            <input class="email" type="email" name="email" value="<?php echo $_SESSION['correo']; ?>" readonly>
                           </div> 

                        <?php
                      }
                        ?>
                    <div class="footer__body-columna3-row">
                        <textarea class="textArea" name="mensaje" placeholder="Mensaje"></textarea>
                    </div>
                    <div class="footer__body-columna3-row">
                        <button type="submit">Enviar</button>
                    </div>
                    </form>

                </div>

            </div>
        
        </div>
        
        <div class="pie">

            <div class="pie__body">

                <div class="pie__body-copyright">
                    © 2020 Todos los Derechos Reservados | <a href="#">GUITAR DER</a>
                </div>

                <div class="pie__body-information">
                    <a href="">Informacion Compañia</a> | <a href="#">Privacion y Politica</a> | <a href="#">Terminos y Condiciones</a>
                </div>

            </div>

        </div>
        
    </footer>