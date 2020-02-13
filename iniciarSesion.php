<?php session_start(); ?>
<?php 
	require_once "baseDeDatos/bbdd.php";
	require_once "inc/funciones.php";
	
	$pagina="iniciarSesion";
	$titulo="Iniciar Sesión";
	
	
	require_once "inc/encabezado.php";
?>

<?php
	function imprimirFormulario($usuario){
?>

<form method="post">

	<div class="form-group">
		<label for="usuario">Usuario</label>
			<input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo "$usuario"; ?>"/>
		
	</div>
	
	<div class="form-group">
		<label for="contrasena">Contraseña</label>
			<input type="password" class="form-control" id="contrasena" name="contrasena" />
		
	</div>
	
	<input type="hidden" name="recaptcha_response" id="recaptchaResponse">

	<button type="submit" class="btn btn-primary" name="iniciar" value="iniciar">Iniciar</button>
	<a href='crearCuenta.php' class='btn btn-primary' role='alert'>Crear cuenta nueva</a>
</form>

<?php 
	} 
?>

 
<main role="main" class="container">

<h1 class="mt-5">Iniciar Sesión</h1>


<?php
	if(empty($_REQUEST)){
		
		if(isset($_SESSION["usuario"])){
			
			header("Location: menu.php");
			
		}else{
			
		$usuario="";
	
		imprimirFormulario($usuario);
		
		}
		
	}else{
		$usuario=recoge("usuario");
		$contrasena=recoge("contrasena");
		$errores = "";
		
			$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify'; 
			$recaptcha_secret = CLAVE_SECRETA; 
			$recaptcha_response = recoge('recaptcha_response'); 
			$recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response); 
			$recaptcha = json_decode($recaptcha); 
			
			if($recaptcha->score < 0.7){
			
				$errores = $errores."Robot";
			
			} else {
			
				$resultado=seleccionarUsuario($usuario);
		
				$userOK=password_verify($contrasena,$resultado['password']);
				
				if($userOK){
					
					$_SESSION["usuario"]=$resultado['nombre'];  
					
					if($usuario=="admin" or $usuario=="Admin"){
						
						header("location:admin/menuAdmin.php");
						
					}else{
						
						header("location:index.php");
						
					}	
		
				}else{
					
					$errores = $errores . "Usuario o contraseña incorrectos";
			
					
				}		
			
			}
		
			if ($errores != ""){
				echo $errores;
				imprimirFormulario($usuario);
			}
		
		}
		
		
		
		
		
		
	
?>


</main>


<?php
	require_once "inc/pie.php";
?>
