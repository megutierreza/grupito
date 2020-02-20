<?php session_start(); ?>

<?php 
	$pagina = "misDatos";
	$titulo = "Mis Datos";
?>

<?php 
	require_once "baseDeDatos/bbdd.php";
	require_once "inc/funciones.php";
	require_once "inc/encabezado.php";
?>

<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Mis datos</h1>
      
    </div>
  </div>

<?php if(empty($_SESSION['usuario'])){
		$mensaje = "No tiene sesión iniciada";
		mostrarMensaje($mensaje);
	}else{
		
	
?>

<div class="container">

<div class="row px-5">
	  <table class="table table-striped">
			<thead>
				<tr>
				<th scope="col">ID</th>
				<th scope="col">Email</th>
				<th scope="col">Nombre</th>
				<th scope="col">Apellidos</th>
				<th scope="col">Dirección</th>
				<th scope="col">Teléfono</th>
				
				</tr>
			</thead>
			<tbody>
			
			<?php 
				$datosUsuario = seleccionarUsuario($_SESSION['usuario']);
				
				$id= $datosUsuario['idUsuario'];
				$email = $datosUsuario['email'];
				$nombre = $datosUsuario['nombre'];
				$apellidos = $datosUsuario['apellidos'];
				$direccion  = $datosUsuario['direccion'];
				$telefono = $datosUsuario['telefono'];
				
			?>
			
				<tr>
					<th scope="row"><?php echo $id ?></th>
					<td><?php echo $email ?></td>
					<td><?php echo $nombre ?></td>
					<td><?php echo $apellidos ?></td>
					<td><?php echo $direccion ?></td>
					<td><?php echo $telefono ?></td>
				</tr>
				
			<?php } ?>
			
			</tbody>
			
			
		</table>
		<p><a class="btn btn-primary btn-lg" href="editarUsuario.php?usuario=<?php echo $nombre ?>" role="button">Editar</a></p> 
		<p><a class="btn btn-primary btn-lg ml-3" href="productos.php" role="button">Volver</a></p>
		
	   </div>

	   </div>
	   
	   
	 </main>
	
<?php
	require_once "inc/pie.php";
?>