<?php session_start(); ?>
<?php require_once("baseDeDatos/bbdd.php") ?>
<?php require_once("inc/funciones.php") ?>
<?php require_once("admin/inc/encabezado.php"); ?>


<main role="main" class="container">
   
	  
<?php
		if(isset($_SESSION["usuario"])){
?>
		<h1 class="display-3">Se ha cerrado la sesión.</h1>
<?php
			unset($_SESSION["usuario"]);
?>
			
			<a href="index.php" class='btn btn-primary' role='alert'>Volver</a><p>
     
<?php 
		}else{

		header("index.php");

		}
?>
</main>

<?php
	require_once "inc/pie.php";
?>