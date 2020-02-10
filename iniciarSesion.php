<?php session_start(); ?>
<?php 
	require_once "admin/inc/bbdd.php";
	require_once "admin/inc/funciones.php";
	require_once "admin/inc/encabezado.php";
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
		
		$resultado=seleccionarUsuario($usuario);
		
		$userOK=password_verify($contrasena,$resultado['password']);
		
		if($userOK){
			
			$_SESSION["usuario"]="$resultado[usuario]";  
			
			if($usuario=="admin" or $usuario=="Admin"){
				
				header("location:admin/menuAdmin.php");
				
			}else{
				
				header("location:index.php");
				
			}
			
			
		
		
		
		?>
		
		
		<?php
		
		}else{
			echo "Usuario o contraseña incorrectos";
	
			imprimirFormulario($usuario);
		}
		
		
	}
?>


</main>


<?php
	require_once "inc/pie.php";
?>
