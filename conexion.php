<?php
	$server = 'localhost';
	$user = 'root';
	$password = '';
	$database = 'guitar_der';	

	$conection = @mysqli_connect($server, $user, $password, $database);

	if(!$conection) {
	echo "Error en la conexion ";
	}
?>
