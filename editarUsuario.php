<?php session_start(); ?>

<?php 
	$pagina = "editarMisDatos";
	$titulo = "Editar Mis Datos";
?>

<?php 
	require_once "baseDeDatos/bbdd.php";
	require_once "inc/funciones.php";
	require_once "inc/encabezado.php";
?>

<?php
	function imprimirFormulario($idUsuario, $nombre, $email, $apellidos, $direccion, $telefono){
?>

<form method="post">
	<div class="form-group">
		<label for="idTarea">ID</label>
			<input type="text" class="form-control" id="idUsuario" name="idUsuario" value="<?php echo "$idUsuario"; ?>" readonly="readonly"/>
		
	</div>

	<div class="form-group">
		<label for="nombre">Nombre</label>
			<input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo "$nombre"; ?>"/>
		
	</div>
	
	<div class="form-group">
		<label for="apellidos">Apellidos</label>
			<input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo "$apellidos"; ?>"/>
		
	</div>
	
	<div class="form-group">
		<label for="email">Email</label>
			<input type="text" class="form-control" id="email" name="email" value="<?php echo "$email"; ?>"/>
		
	</div>
	
	<div class="form-group">
		<label for="direccion">Dirección</label>
			<input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo "$direccion"; ?>"/>
		
	</div>
	
	<div class="form-group">
		<label for="telefono">Teléfono</label>
			<input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo "$telefono"; ?>"/>
		
	</div>
	
	<button type="submit" class="btn btn-primary" name="guardar" value="guardar">Guardar</button>
</form>

<?php 
	} 
?>

<main role="main" class="container">
	<h1 class="mt-5">Actualizar Datos</h1>
<?php
	if(!isset($_REQUEST['guardar'])){
		
		$usuario=recoge("usuario");
		
		if($usuario==""){
			header("Location: index.php");
			exit(); //se puede usar die();
		}
		
		$datosUsuario = seleccionarUsuario($usuario);
		
		if(empty($datosUsuario)){ //empty porque es un array no una cadena, no es texto
			header("Location: index.php");
			exit();
		}
		
		$idUsuario = $datosUsuario['idUsuario'];
		$nombre = $datosUsuario['nombre'];
		$email = $datosUsuario['email'];
		$apellidos = $datosUsuario['apellidos'];
		$direccion = $datosUsuario['direccion'];
		$telefono = $datosUsuario['telefono'];
		
		imprimirFormulario($idUsuario, $nombre, $email, $apellidos, $direccion, $telefono);
		
			
	}else{
		
		$idUsuario = recoge('idProducto');
		$nombre = recoge('nombre');
		$email = recoge('email');
		$apellidos = recoge('apellidos');
		$direccion = recoge('direccion');
		$telefono = recoge('telefono');
		
		$errores = "";
		
		if($nombre==""){
			$errores = $errores."<li>El campo nombre no puede estar vacío</li>";
		}
		
		if($email==""){
			$errores = $errores."<li>Debes seleccionar una prioridad</li>";
		}
		
		if($apellidos==""){
			$errores = $errores."<li>El campo descripción no puede estar vacío</li>";
		}
		
		if($direccion==""){
			$errores = $errores."<li>El campo imagen no puede estar vacío</li>";
		}
		
		if($telefono==""){
			$errores = $errores."<li>El campo precio no puede estar vacío</li>";
		}
		
		
		if($errores != ""){
			
			echo "<h2>Errores</h2> <ul>$errores</ul>";
			imprimirFormulario($idUsuario, $nombre, $email, $apellidos, $direccion, $telefono);
			
		}else{
			
			$ok = actualizarDatosUsuario($nombre, $email, $apellidos, $direccion, $telefono);
			
			if($ok){
				echo "<div class='alert alert-success' role='alert'> Usuario $idUsuario actualizado correctamente </div>";
				
				echo "<p>
						<a href='misDatos.php' class='btn btn-primary'>Volver</a> </div>
					</p>";
			}else{
				echo "<div class='alert alert-danger' role='alert'>ERROR: Producto NO actualizado</div>";
				imprimirFormulario($idUsuario, $nombre, $email, $apellidos, $direccion, $telefono);
			}
			
		}
	}
?>



</main>



<?php
	require_once "inc/pie.php";
?>