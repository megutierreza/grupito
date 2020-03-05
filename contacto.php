<?php session_start(); ?>
<?php require_once("baseDeDatos/bbdd.php") ?>
<?php require_once("inc/funciones.php") ?>
<?php require_once("enviarMail.php") ?>

<?php 	
		$pagina = "contacto"; 
		$titulo = "Contacta con nosotros";
?>
<?php require_once("inc/encabezado.php") ?>

			

<main role="main">

<?php
				function imprimirFormulario($asunto,$contenido,$correo){
			?>
			
			<form method="post">
			
				<div class="form-group">
					<label for="correo">Correo del emisor</label>
						<input type="text" class="form-control" id="correo" name="correo" value="<?php echo "$correo" ?>" />
					
				</div>
			
				<div class="form-group">
					<label for="asunto">Asunto</label>
						<input type="text" class="form-control" id="asunto" name="asunto" value="<?php echo "$asunto"; ?>"/>
					
				</div>
				
				<div class="form-group">
					<label for="contenido">Contenido</label>
						<input type="text" class="form-control" id="contenido" name="contenido" value="<?php echo "$contenido" ?>" />
					
				</div>
				
				<input type="hidden" name="recaptcha_response" id="recaptchaResponse">
			
				<button type="submit" class="btn btn-primary" name="enviar" value="enviar">Enviar</button>
				
			</form>
			
			<?php 
				} 
			?>

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Contacto</h1>
      <p>
	  
		<?php
		if(empty($_REQUEST)){
			
		$asunto="";
		$contenido="";
		
		if(isset($_SESSION["usuario"])){
			
			$datosUsuario=seleccionarUsuario($_SESSION["usuario"]);
			
			$correo=$datosUsuario['email'];
			
		}else{
			
			$correo="";
			
		}
		
		imprimirFormulario($asunto,$contenido,$correo);
		
		
		
	}else{
		$asunto=recoge("asunto");
		$contenido=recoge("contenido");
		$correo=recoge("correo");
		
					/*
					$url="enviarMail.php?asunto=$asunto&contenido=$contenido&correo=$correo";
					
					?>

					<a href='enviarMail.php?asunto=<?php echo $asunto ?>&contenido=<?php echo $contenido ?>&correo=<?php echo $correo ?>' class='btn btn-primary' role='alert'>Confirmar</a>

					<?php
					//header("Location: ".$url);
					*/
					
					enviarCorreo($asunto,$contenido,$correo);
		
		}
		
		?>
		
	  </p>
      
    </div>
  </div>
  
</main>

<?php require_once("inc/pie.php") ?>