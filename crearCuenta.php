<?php session_start(); ?>
<?php 
	require_once "admin/inc/bbdd.php";
	require_once "admin/inc/funciones.php";
	require_once "admin/inc/encabezado.php";
?>

<?php
	function imprimirFormulario($usuario, $email, $apellidos, $direccion, $telefono){
?>

<form method="post">

	<div class="form-group">
		<label for="usuario">Nombre</label>
			<input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo "$usuario"; ?>"/>
		
	</div>
	
	<div class="form-group">
		<label for="contrasena">Contraseña</label>
			<input type="password" class="form-control" id="contrasena" name="contrasena" />
		
	</div>
	
	<div class="form-group">
		<label for="contrasena2">Repetir contraseña</label>
			<input type="password" class="form-control" id="contrasena2" name="contrasena2" />
		
	</div>
	
	<div class="form-group">
		<label for="usuario">Email</label>
			<input type="text" class="form-control" id="email" name="email" value="<?php echo "$email"; ?>"/>
		
	</div>
	
	<div class="form-group">
		<label for="usuario">Apellidos</label>
			<input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo "$apellidos"; ?>"/>
		
	</div>
	
	<div class="form-group">
		<label for="usuario">Dirección</label>
			<input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo "$direccion"; ?>"/>
		
	</div>
	
	<div class="form-group">
		<label for="usuario">Teléfono</label>
			<input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo "$telefono"; ?>"/>
		
	</div>
	

	<button type="submit" class="btn btn-primary" name="crear" value="crear">Crear</button>
	
</form>

<?php 
	} 
?>

 
<main role="main" class="container">

<h1 class="mt-5">Crear Cuenta Nueva</h1>


<?php
	if(empty($_REQUEST)){
		
		$usuario="";
		$email="";
		$apellidos="";
		$direccion="";
		$telefono="";
		
		imprimirFormulario($usuario, $email, $apellidos, $direccion, $telefono);
		
	}else{
		$usuario=recoge("usuario");
		$contrasena=recoge("contrasena");
		$contrasena2=recoge("contrasena2");
		$direccion=recoge("direccion");
		$telefono=recoge("telefono");
		$email=recoge("email");
		$apellidos=recoge("apellidos");
		
		
		if($contrasena==$contrasena2){
			$resultado=insertarUsuario($usuario, $contrasena, $email, $apellidos, $direccion, $telefono);
			
				echo "Se ha creado la cuenta.";
		
				$_SESSION["usuario"]="$usuario";  
			
		?> <p><a href='index.php' class='btn btn-primary' role='alert'>Continuar</a></p> <?php
		}else{
			echo "Las contraseñas no coinciden";
			imprimirFormulario($usuario, $email, $apellidos, $direccion, $telefono);
		}
		
		
?>
		
		
		
<?php	
	}
?>


</main>


<?php
	require_once "inc/pie.php";
?>