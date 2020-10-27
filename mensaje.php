<?php

if (!empty($_POST["datos"]) && !empty($_POST["email"]) && !empty($_POST["mensaje"])) {

	  //$nombre = $_POST["datos"];
	  //$email = $_POST["email"];
	  //$mensaje = $_POST["mensaje"];
	  //$asunto = "Nuevo mensaje de: ".$nombre;
	  //$header = "From: jhonerom0711@gmail.com" . "\r\n";
	  //$header.= "Reply-To: jhonerom0711@gmail.com" . "\r\n";
	  //$header.= "X-Mailer: PHP/".phpversion();
	  //$mail = mail($email, $asunto, $header);
	  //if ($mail) {
	  //	echo "mensaje enviado";
	  //}

	  $nombre = $_POST["datos"];
	  $email = $_POST["email"];
	  $mensaje = $_POST["mensaje"];

	  $para = "jerodriguez113@misena.edu.co";
	  $asunto = "Nuevo mensaje de: ".$nombre;

	  $mensaje = "
	    De: ".$nombre."
	    Correo: ".$email."
	    Mensaje: ".$mensaje."
	  ";

	  $mail = @mail($para,$asunto,utf8_decode($mensaje));

	  //if ($mail) {
	  //	echo "Correo enviado";
	  //}else{
	  //	echo "Error";
	  //}

	  header ("location: index");

	}else{
		header('location: index');
	}


 ?>