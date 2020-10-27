<?php
session_start();
    require 'src/Exception.php';
    require 'src/PHPMailer.php';
    require 'src/SMTP.php';

     $correo = $_POST["email"];
     $total = $_POST['total'];
     $nombres = $_POST['nombres'];
     $apellidos = $_POST['apellidos'];
     // $correo = $_GET["email"];
     //$mensaje = $_POST["mensaje"];
 
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to
    
        
        //https://support.google.com/mail/answer/185833?hl=es-419 POR ACA INGRESAN PARA CREAR LA CLAVE DE LA APP
        $mail->Username   = 'jhonerom0711@gmail.com';                     // SMTP username
        $mail->Password   = 'gifdaxilzabqmrgj';                               // SMTP password
  
        //Recipients
        $mail->setFrom('jhonerom0711@gmail.com', 'Guitar Der'); 
        
        //La siguiente linea, se repite N cantidad de veces como destinarios tenga
        $mail->addAddress($correo, $correo);     // Add a recipient
   
        
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Confirmacion de compra en Guitar Der';
        //$mail->Body    = $mensaje;
        $mail->Body  = "<p style='color: grey; font-size:12pt'><strong> Señor(a) ".$nombres.' '.$apellidos.", <br>Su compra ha sido finalizada con exito! </strong><br>  Con un valor de: ".$total."<br>Modo de pago: PayPal</p><hr><p style='color: #697ab7; font-size:14pt;'>Gracias por elegirnos.</p><br>";
        $mail->send();

        session_destroy();
        header('location: index.php');

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    
?>