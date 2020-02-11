<?php session_start(); ?>

<?php 
	$pagina = "Carrito";
	$titulo = "Tu compra";
?>

<?php require_once("baseDeDatos/bbdd.php") ?>
<?php require_once("inc/funciones.php") ?>
<?php require_once("inc/encabezado.php"); ?>

<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Tu carrito de la compra</h1>
	  
	  
      
      <p><a class="btn btn-primary btn-lg" href="productos.php" role="button">Seguir comprando</a></p>
    </div>
  </div>

<?php if(empty($_SESSION['carrito'])){
		$mensaje = "Carrito vacío";
		mostrarMensaje($mensaje);
	}else{
		
	
?>

<div class="container">

<div class="row px-5">
	  <table class="table table-striped">
			<thead>
				<tr>
				<th scope="col">Producto</th>
				<th scope="col">Cantidad</th>
				<th scope="col">Precio</th>
				<th scope="col">Subtotal</th>
				
				</tr>
			</thead>
			<tbody>
			
			<?php 
			$total=0;
				foreach($_SESSION['carrito'] as $id => $cantidad){ 
				$producto = seleccionarProducto($id);
				
				$nombre = $producto['nombre'];
				$precio = $producto['precioOferta'];
				$subtotal = $precio*$cantidad;
				$total=$total+$subtotal;
				
			?>
			
				<tr>
					<th scope="row"><a href="producto.php?id=<?php echo $id ?>"><?php echo $nombre ?></a></th>
					<td><a href="procesarCarrito.php?id=<?php echo $id; ?>&op=remove"><i class="fas fa-minus-square"></i></a> <?php echo $cantidad?> <a href="procesarCarrito.php?id=<?php echo $id; ?>&op=add"><i class="fas fa-plus-square"></i></a></td>
					<td><?php echo $precio?></td>
					<td><?php echo $subtotal?></td>
				</tr>
				
			<?php } ?>
			
			</tbody>
			
			<tfoot>
				<tr>
					<th scope="row" colspan="3" class="text-right">Total</th>
					<td><?php echo $total ?></td>
				</tr>
			</tfoot>
			
		</table>
		
		<p><a href="procesarCarrito.php?id=<?php echo $id; ?>&op=empty" class="btn btn-danger" >Vaciar carrito</a></p>
		<p><a href="confirmarPedido.php" class="btn btn-success" >Confirmar pedido</a></p>
		
	   </div>
<?php
	$_SESSION['total']=$total;
	} 
?>
	   </div>
	   
	   
	 </main>
	
<?php
	require_once "inc/pie.php";
?>