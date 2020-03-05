<?php session_start(); ?>

<?php 
	$pagina = "cancelarPedido";
	$titulo = "Cancelar Pedido";
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
      <h1 class="display-3">Su pedido ha sido cancelado</h1>
      
    </div>
  </div>

	<?php 
	
	if(empty($_SESSION['usuario'])){
		$mensaje = "No tiene sesión iniciada";
		mostrarMensaje($mensaje);
	}else{
		
	$datosUsuario = seleccionarUsuario($_SESSION['usuario']);
	
	$idUsuario=$datosUsuario['idUsuario'];
	$idPedido=recoge('idPedido');
	$estado="Cancelado";
	
	actualizarEstadoPedido($idPedido,$estado);
	
	}	
	
	?>	
		<div class="container">
			<p><a class="btn btn-primary btn-lg ml-3" href="misPedidos.php" role="button">Volver</a></p>
		</div>

</main>
	
<?php
	require_once "inc/pie.php";
?>