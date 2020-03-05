<?php session_start(); ?>

<?php 
	$pagina = "Carrito";
	$titulo = "Tu compra";
?>

<?php 
	require_once "baseDeDatos/bbdd.php";
	require_once "inc/funciones.php";
	require_once "inc/encabezado.php";
	if(isset($_SESSION['carrito'])){
		if(isset($_SESSION['usuario'])){
			
?>	
			<div class="jumbotron">
				<div class="container">
	
					<h1 class="display-3">Su pedido ha sido realizado correctamente</h1><br />
<?php 
					$datosUsuario = seleccionarUsuario($_SESSION['usuario']);
					$estado="En proceso";
					insertarPedido($datosUsuario['idUsuario'],$_SESSION['carrito'],$_SESSION['total'],$estado);
					unset($_SESSION['carrito']);
					unset($_SESSION['total']);
?>
					<p>
							<a class="btn btn-primary btn-lg" href="index.php" role="button">Volver a la página principal</a>
					</p>
	  
				</div>
			</div>
		
<?php 		
		}else{
?>
			<div class="jumbotron">
				<div class="container">
			
					<h1 class="display-3">Para poder realizar una compra es necesario tener una cuenta e iniciar sesión</h1><br />
				
				<p>
					<a class="btn btn-primary btn-lg" href="iniciarSesion.php" role="button">Iniciar sesión</a>
					<a class="btn btn-primary btn-lg" href="crearCuenta.php" role="button">Crear cuenta nueva</a>
				</p>
			
				</div>
			</div>
 <?php

		}
	}else{
?>
	<div class="jumbotron">
			<div class="container">
	
			<h1 class="display-3">No tienes nada en el carrito</h1><br />
     
			<p>
				<a class="btn btn-primary btn-lg" href="index.php" role="button">Volver a la página principal</a>
			</p>
	  
		</div>
	</div>
			
<?php	
	}

//Si no hay sesión iniciada, decir que se inicie. Si hay, insertar
//vaciar el carrito cuando se confirme.
?>

