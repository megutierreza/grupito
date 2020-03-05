<?php require_once("inc/funciones.php") ?>


	
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\SMTP;
//use PHPMailer\PHPMailer\Exception;

////////////////////////////////////////////////////////////////////////////////

// Load Composer's autoloader
//require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions


function enviarCorreo($asunto,$contenido,$correo){



$mail = new PHPMailer(true);

		$asunto=recoge("asunto");
		$contenido=recoge("contenido");
		$correo=recoge("correo");

try {
    //Server settings
    $mail->SMTPDebug = 0; 		//SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();          


	// Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                   			   // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   		   // Enable SMTP authentication
    $mail->Username   = 'm.e.gutierrezamarista@gmail.com';                     	   // SMTP username
    $mail->Password   = 'vzmkzomauynqblvj';                               		   // SMTP password
    $mail->SMTPSecure = 'tls';	//PHPMailer::ENCRYPTION_STARTTLS;          // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                   			   // TCP port to connect to

    //Recipients
	$asunto=recoge("asunto");
	$contenido=recoge("contenido");
	$correo=recoge("correo");
	
    $mail->setFrom( $correo, 'Miguel Gutiérrez');
    $mail->addAddress('m.e.gutierrezamarista@gmail.com', 'Miguel Gutiérrez');     // Add a recipient
    // $mail->addAddress('carballo.crespo.samuel@gmail.com');               // Name is optional
 
	/*
	$mail->addReplyTo('info@example.com', 'Information');
	
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');

    // Attachments
    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	*/
	
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $asunto;
    $mail->Body    = $contenido;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Mensaje enviado correctamente';
	?>
	<br />
	<a href='index.php' class='btn btn-primary' role='alert'>Continuar</a>
	
	<?php
	
} catch (Exception $e) {
    echo "El mensaje no se pudo enviar: {$mail->ErrorInfo}";
}
}