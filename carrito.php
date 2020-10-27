<?php 
session_start();

$mensaje = "";

	if (isset($_POST['btnAccion'])) {

		switch ($_POST['btnAccion']) {

			case 'Agregar':
				
				if (is_numeric(openssl_decrypt($_POST['id'],COD,KEY))) {
					$ID = openssl_decrypt($_POST['id'],COD,KEY);
					$mensaje.="OK ID correcto".$ID."<br/>";
				}else{
					$mensaje.= "Ups... ID incorrecto ".$ID; 
				}



				if (is_string(openssl_decrypt($_POST['nombre'],COD,KEY))) {
					$NOMBRE = openssl_decrypt($_POST['nombre'],COD,KEY);
					$mensaje.="OK NOMBRE correcto".$NOMBRE."<br/>";
				}else{
					$mensaje.="Ups... NOMBRE incorrecto ".$NOMBRE; break;
				}

				if (is_numeric(openssl_decrypt($_POST['precio'],COD,KEY))) {
					$PRECIO = openssl_decrypt($_POST['precio'],COD,KEY);
					$mensaje.="OK PRECIO correcto".$PRECIO."<br/>";
				}else{
					$mensaje.="Ups... PRECIO incorrecto ".$PRECIO; break;
				}

				if (is_string(openssl_decrypt($_POST['modelo'],COD,KEY))) {
					$MODELO = openssl_decrypt($_POST['modelo'],COD,KEY);
					$mensaje.="OK MODELO correcto".$MODELO."<br/>";
				}else{
					$mensaje.="Ups... MODELO incorrecto ".$MODELO; break;
				}

				if (is_numeric(openssl_decrypt($_POST['cantidad'],COD,KEY))) {
					$CANTIDAD = openssl_decrypt($_POST['cantidad'],COD,KEY);
					$mensaje.="OK CANTIDAD correcta".$CANTIDAD."<br/>";
				}else{
					$mensaje.="Ups... CANTIDAD incorrecto ".$CANTIDAD; break;
				}

				if (!isset($_SESSION['CARRITO'])) {
					$producto=array(
						'ID'=>$ID,
						'NOMBRE'=>$NOMBRE,
						'PRECIO'=>$PRECIO,
						'MODELO'=>$MODELO,
						'CANTIDAD'=>$CANTIDAD
					);
					$_SESSION['CARRITO'][0]=$producto;
				$mensaje= "Ver carrito";
				}else{

					$idProductos=array_column($_SESSION['CARRITO'],"ID");

					if (in_array($ID,$idProductos)) {
						echo "<script>alert('Accion invalida: Ya se encuentra agregado al carrito.');</script>";
						$mensaje="";
					}else{

					$NumeroProductos=count($_SESSION['CARRITO']);
						$producto=array(
						'ID'=>$ID,
						'NOMBRE'=>$NOMBRE,
						'PRECIO'=>$PRECIO,
						'MODELO'=>$MODELO,
						'CANTIDAD'=>$CANTIDAD
					);
					
					//echo "<script>alert('Se ha agregado correctamente.');</script>";
						$mensaje="";

					$_SESSION['CARRITO'][$NumeroProductos]=$producto;
					$mensaje= "Ver carrito";
					}
				}
				//$mensaje= print_r($_SESSION,true);

				break;	

				case 'Eliminar':
					if (is_numeric(openssl_decrypt($_POST['id'],COD,KEY))) {
					$ID = openssl_decrypt($_POST['id'],COD,KEY);

					foreach ($_SESSION['CARRITO'] as $indice => $producto) {
						if ($producto['ID']==$ID) {
							unset($_SESSION['CARRITO'][$indice]);
						}
					}

				}else{
					$mensaje.= "Ups... ID incorrecto ".$ID; 
				}

					break;
		}
	}

 ?>