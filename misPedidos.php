<?php session_start(); ?>

<?php 
	$pagina = "misPedidos";
	$titulo = "Mis Pedidos";
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
      <h1 class="display-3">Mis pedidos</h1>
      
    </div>
  </div>

<?php if(empty($_SESSION['usuario'])){
		$mensaje = "No tiene sesión iniciada";
		mostrarMensaje($mensaje);
	}else{
		
	$datosUsuario = seleccionarUsuario($_SESSION['usuario']);
		
					
?>

<div class="container">

<div class="row px-5">
	  <table class="table table-striped">
			<thead>
				<tr>
				
					<th scope="col">ID Pedido</th>
					<th scope="col">ID Usuario</th>
					<th scope="col">Fecha</th>
					<th scope="col">Total</th>
					<th scope="col">Estado</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			
			<?php
			
				$datosPedidos = seleccionarPedidos($datosUsuario['idUsuario']);
				
				foreach($datosPedidos as $pedido){
				
				$idPedido 	= $pedido['idPedido'];
				$idUsuario 	= $pedido['idUsuario'];
				$fecha 		= $pedido['fecha'];
				$total 		= $pedido['total'];
				$estado  	= $pedido['estado'];
				
			?>
			
				<tr>
					<th scope="row"><?php echo $idPedido ?></th>
					<td><?php echo $idUsuario ?></td>
					<td><?php echo $fecha ?></td>
					<td><?php echo $total ?></td>
					<td><?php echo $estado ?></td>
					
					<?php 
						if($estado=="Cancelado"){
					?>
							<td></td>
					<?php
						}else{
					?>
							<td>
								<a class="btn btn-primary btn-lg" href="cancelarPedido.php?idPedido=<?php echo $idPedido ?>" role="button">Cancelar</a>
							</td>	
					<?php 
					}
					?>
				</tr>
				
	<?php 
				}
		} 
	?>
			
			</tbody>
			
			
		</table>
		
		<p><a class="btn btn-primary btn-lg ml-3" href="productos.php" role="button">Volver</a></p>
		
	   </div>

	   </div>
	   
	   
	 </main>
	
<?php
	require_once "inc/pie.php";
?>