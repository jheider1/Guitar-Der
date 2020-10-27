<?php 
include "../conexion.php";
session_start();
// print_r($_POST);
// exit;

if (!empty($_POST)) {

	//extraer datos del producto
	if ($_POST['action'] == 'infoProducto') {
		
		$producto_id = $_POST['producto'];

		$query = mysqli_query($conection, "SELECT Idproductos, nombre, descripcion, valorunitario, cantidad FROM productos WHERE Idproductos = $producto_id");
		mysqli_close($conection);

		$result = mysqli_num_rows($query);
		
		if ($result>0) {
			$data = mysqli_fetch_assoc($query);
			/***MOSTRAR data de idproducto y nombre de producto***/ 
			echo json_encode($data, JSON_UNESCAPED_UNICODE); 
		exit();
		}
		echo "error";
		exit();
	}



	//Agregar datos del producto
	if ($_POST['action'] == 'addProduct') {
	 //echo "Agregar producto";
	if (!empty($_POST['cantidad']) || !empty($_POST['precio']) || !empty($_POST['producto_id'])) {

		$cantidad = $_POST['cantidad'];
		$precio = $_POST['precio'];
		$producto_id = $_POST['producto_id'];

		// $query_insert = mysqli_query($conection, "INSERT INTO productos(Idproductos, cantidad, valorunitario) VALUES($producto_id, $cantidad, $precio)");	

		// if ($query_insert) {
			$query_upd = mysqli_query($conection, "CALL actualizar_precio_producto($cantidad, $precio, $producto_id)");
			$result_pro = mysqli_num_rows($query_upd);
			if ($result_pro > 0) {
				$data = mysqli_fetch_assoc($query_upd);
				$data['producto_id'] = $producto_id;
				echo json_encode($data, JSON_UNESCAPED_UNICODE); 
	        	exit();
			}
			// }else{
				// echo "error";
			// }
			mysqli_close($conection);

		}else{
			echo "error";
		}
		exit();
	}

	//Agregar producto al detalle temporal
	if ($_POST['action'] == 'addProductoDetalle') {
	// print_r($_POST); exit();
		if (empty($_POST['producto']) || empty($_POST['cantidad'])) {
			echo 'error';
		}else{
			$codproducto = $_POST['producto'];
			$cantidad = $_POST['cantidad'];
			$token = md5($_SESSION['idUser']);

			$query_detalle_temp = mysqli_query($conection, "CALL add_detalle_temp($codproducto,$cantidad,'$token')");
			$result = mysqli_num_rows($query_detalle_temp);

			$detalle_tabla = '';
			$subtotal = 0;
			$total = 0;
			$arrayData = array();

			if ($result > 0) {
				
				while ($data = mysqli_fetch_assoc($query_detalle_temp)) {
					$precioTotal = round($data['cantidad'] * $data['precio_venta'], 2);
					$subtotal = round($subtotal + $precioTotal, 2);
					$total = round($total + $precioTotal, 2);

					$detalle_tabla .= '
					<tr>
					<td>'.$data['Productos_idpro'].'</td>
					<td colspan="2">'.$data['descripcion'].'</td>
					<td class="textright">'.$data['cantidad'].'</td>
					<td class="textright">'.$data['precio_venta'].'</td>
					<td class="textright">'.$precioTotal.'</td>
					<td class="">
						<a href="#" class="link_delete" onclick="event.preventDefault(); del_product_detalle('.$data['correlativo'].');"><img width="25px" src="img/trash.png"></a>
					</td>
				</tr>';
				}
				$total = round($subtotal, 2);

				$detalle_totales = '
				
				<tr>
					<td colspan="5">TOTAL</td>
					<td>'.$total.'</td>
				</tr>';

				$arrayData['detalle'] = $detalle_tabla;
				$arrayData['totales'] = $detalle_totales;

				echo json_encode($arrayData, JSON_UNESCAPED_UNICODE); 

			}else{
				echo "error";
				mysqli_close($conection);
			}
		}	
			exit();


	}

	if ($_POST['action'] == 'delProductoDetalle') {
		// print_r($_POST); exit();
		if (empty($_POST['id_detalle'])) {
			echo 'error';
		}else{
			$id_detalle = $_POST['id_detalle'];
			$token = md5($_SESSION['idUser']);

			$query_detalle_temp = mysqli_query($conection, "CALL del_detalle_temp($id_detalle,'$token')");
			$result = mysqli_num_rows($query_detalle_temp);

			$detalle_tabla = '';
			$subtotal = 0;
			$total = 0;
			$arrayData = array();

			if ($result > 0) {
				
				while ($data = mysqli_fetch_assoc($query_detalle_temp)) {
					$precioTotal = round($data['cantidad'] * $data['precio_venta'], 2);
					$subtotal = round($subtotal + $precioTotal, 2);
					$total = round($total + $precioTotal, 2);

					$detalle_tabla .= '
					<tr>
					<td>'.$data['Productos_idpro'].'</td>
					<td colspan="2">'.$data['descripcion'].'</td>
					<td class="textright">'.$data['cantidad'].'</td>
					<td class="textright">'.$data['precio_venta'].'</td>
					<td class="textright">'.$precioTotal.'</td>
					<td class="">
						<a href="#" class="link_delete" onclick="event.preventDefault(); del_product_detalle('.$data['correlativo'].');"><img width="25px" src="img/trash.png"></a>
					</td>
				</tr>';
				}
				$total = round($subtotal, 2);

				$detalle_totales = '
				<tr>
					<td colspan="5">SUBTOTAL</td>
					<td>'.$subtotal.'</td>
				</tr>
				<tr>
					<td colspan="5">TOTAL</td>
					<td>'.$total.'</td>
				</tr>';

				$arrayData['detalle'] = $detalle_tabla;
				$arrayData['totales'] = $detalle_totales;

				echo json_encode($arrayData, JSON_UNESCAPED_UNICODE); 

			}else{
				echo "error";
				mysqli_close($conection);
			}
		}	
		exit();
	}

	//PROCESAR VENTA
	if ($_POST['action'] == 'procesarVenta') {
	//print_r($_POST); exit();

	$token = md5($_SESSION['idUser']);
	$usuario = $_SESSION['idUser'];

	$query = mysqli_query($conection, "SELECT * FROM detalle_temp WHERE token_user = '$token'");
	$result = mysqli_num_rows($query);

	if ($result >0) {
		$query_procesar = mysqli_query($conection, "CALL procesar_venta($usuario, '$token')");
		$result_detalle = mysqli_num_rows($query_procesar);

		if ($result_detalle > 0) {
			$data = mysqli_fetch_assoc($query_procesar);
			echo json_encode($data, JSON_UNESCAPED_UNICODE);
		}else{
			echo "error";
		}
		mysqli_close($conection);
		exit();
	}
	}

	//ELIMINAR datos del producto
	if ($_POST['action'] == 'delProduct') 
	{
		if (empty($_POST['producto_id'])) {
			echo "error";
		}else{
			$idproducto = $_POST['producto_id'];

			$query_delete = mysqli_query($conection, "DELETE FROM productos  WHERE Idproductos = $idproducto");
			mysqli_close($conection);
			if ($query_delete) {
				echo "ok";
			}else{
				echo "error";
			}
		}
		echo "error";
	}
	exit();

	



}
exit();
 ?>