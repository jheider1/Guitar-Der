<?php
session_start();
					include "conexion.php";
					//Agrego la variable de sesion al arreglo
					$arreglo=$_SESSION['carrito'];
					//Recorro el arreglo 
					for($i=0;$i<count($arreglo);$i++){
						//Consulto la cantidad en stcck dependiendo del Id que baya el ciclo For
						$re=mysqli_query($conection, "SELECT stock FROM productos where idProductos=".$arreglo[$i]['Id'])or die(mysql_error());
						while ($f=mysql_fetch_array($re)) {
							//hago el calculo de cuantos van a quedar en Stock
							$x=$f['stock']-$arreglo[$i]['Cantidad'];
							//Actualizo el registro stock de la BD
							mysqli_query($conection, "UPDATE productos SET stock=".$x." where idProductos=".$arreglo[$i]['Id'])or die(mysql_error());
						}
						
					}
					
		//Imprimimos una tabla recorriendo el arreglo.
		$total=0;
		$tabla='<table border="1"><tr>
		<th>Nombre</th>
		<th>Cantidad</th>
		<th>Precio</th>
		<th>Subtotal</th></tr>';
		for($i=0;$i<count($arreglo);$i++){
			
			$tabla=$tabla.'<tr>
			<td>'.$arreglo[$i]['Nombre'].'</td>
			<td>'.$arreglo[$i]['Cantidad'].'</td>
			<td>'.$arreglo[$i]['Precio'].'</td>
			<td>'.$arreglo[$i]['Cantidad'] * $arreglo[$i]['Precio'].'</td>
			</tr>';
			$total=$total+($arreglo[$i]['Cantidad'] * $arreglo[$i]['Precio']);			
		}
		$tabla.'</table>';
		
		/* A Continuacion comenzarémos a crear la esctructura de nuestro Email.*/

		$nombre="Luis Alberto";
        $fecha=date("d-m-Y");
        $hora=date("H:i:s");      
        $asunto='Compra en x dominio';
        $desde="www.tupagina.com";
        /*Debes de indicar los estilos css aqui mismo en la variable  y si quieres incluir imagenes,estas tendran que 
        estar en un servidor yo tome la de google */
       $comentario='
        <div style="
	        border: 1px solid #d6d2d2;
	        border-radius: 5px;
	        box-shadow: 5px 5px 10px rgba(57,29,150,0.5);
	        color:#9378f0;
	        paddin:10px;
	        width:800px%;
	        heigth:400px;
        ">
        <center>
        <img src="http://www.ideasmx.com.mx/blog/wp-content/uploads/2008/12/google_mexico_logo.jpg" width="400" heigth="250">
        <h1><em>Muchas Gracias por tu compra</em></h1></center>

            <hr width="90%">

            <p>Hola '.$nombre.' muchas gracias por  comprar en nuestro sitio a continuación te mostramos los detalles de tu compra.</p>
            Cantidad de articulos: '.count($arreglo).'<br>
            Lista de Articulos: <br>
            '.$tabla.'<br>
            Total: '.$total.'';


        //para el envío en formato HTML 
        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "Content-type: text/html; charset=utf8\r\n"; 

        //dirección del remitente 
        $headers .= "From: Remitente\r\n"; 
        //Direccion del remitente

        $correo="grijalvaromero@gmail.com"
        //FUNCION PARA ENVIAR EL EMAIL
        mail($_POST['correo'],$asunto,$comentario,$headers);
		/*
		POR SI QUIERES REDIRECCIONAR
		header("Location: ./?registro=true&correo=".$_POST['correo']);*/
					
		
?>