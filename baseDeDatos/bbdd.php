<?php 
	include "configuracion.php";
?>

<?php 

//Función para conectarnos a la BD

	function conectarBD(){
		
		try{
			$con = new PDO("mysql:host=".HOST.";dbname=".DBNAME.";charset=utf8", USER, PASS);
			
			$con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){	
			
			echo "Error: Error al conectar la BD: ".$e->getMessage();
			
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
			exit;
		}
		
		return $con;
	
	}
	
	//Función para Desconectar BD
function desconectarBD($con){
	$con = NULL;
	return $con;
}



	//Función para Insertar tarea

function insertarTarea($nombre, $descripcion, $prioridad){
	
	$con = conectarBD();
	
	try{
		
		$sql = "INSERT INTO tareas (nombre, descripcion, prioridad) VALUES(:nombre, :descripcion, :prioridad)";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':nombre',$nombre);
		$stmt->bindParam(':descripcion',$descripcion);
		$stmt->bindParam(':prioridad',$prioridad);
		
		$stmt->execute();
		
	}catch(PDOException $e){	
			
			echo "Error: Error al insertar tarea: ".$e->getMessage();
			
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
			exit;
	}
	
	return $con->lastInsertId();
}
/*
//Función para actualizarTarea
function actualizarTarea($idTarea, $nombre, $descripcion, $prioridad){
	
	$con = conectarBD();
	
	try{
		
		
		$sql = "UPDATE tareas SET nombre=:nombre, descripcion=:descripcion, prioridad=:prioridad WHERE idTarea=:idTarea";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':idTarea',$idTarea);
		$stmt->bindParam(':nombre',$nombre);
		$stmt->bindParam(':descripcion',$descripcion);
		$stmt->bindParam(':prioridad',$prioridad);
		
		$stmt->execute();
		
	}catch(PDOException $e){	
			
			echo "Error: Error al actualizar tarea: ".$e->getMessage();
			
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
			exit;
	}
	
	return $stmt->rowCount();
}


//FUNCIÓN BorrarTarea
function borrarTarea($idTarea){
	
	$con = conectarBD();
	
	try{
		
		$sql = "DELETE FROM tareas WHERE idTarea=:idTarea";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':idTarea',$idTarea);
		
		$stmt->execute();
		
	}catch(PDOException $e){	
			
			echo "Error: Error al eliminar tarea: ".$e->getMessage();
			
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
			exit;
	}
	
	return $stmt->rowCount();
	
}

//FUNCIÓN seleccionarTodasTareas

function seleccionarTodasTareas(){
	
	$con = conectarBD();
	
	try{
		
		$sql = "SELECT * FROM tareas";
		
		$stmt = $con->query($sql);
		
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC); 
		
	}catch(PDOException $e){	
			
			echo "Error: Error al seleccionar todas las tareas: ".$e->getMessage();
			
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
			exit;
	}
	
	return $rows;
	
}

//FUNCION seleccionarTarea

function seleccionarTarea($idTarea){
	
	$con = conectarBD();
	
	try{
		
		$sql = "SELECT * FROM tareas WHERE idTarea=:idTarea";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':idTarea',$idTarea);
		
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC); 
		//fetch en el caso que sabemos que devuelve como máx 1 fila, fetchAll cuando puede devolver 1 o más
		
	}catch(PDOException $e){	
			
			echo "Error: Error al seleccionar una tarea: ".$e->getMessage();
			
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
			exit;
	}
	
	return $row;
	
}

function seleccionarTareas($inicio, $tareasPagina){
	
	$con = conectarBD();
	
	try{
		
		$sql = "SELECT * FROM tareas LIMIT :inicio,:tareasPagina";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':inicio',$inicio, PDO::PARAM_INT); /* Si necesitamos que sea un valor entero (INT) 
		$stmt->bindParam(':tareasPagina',$tareasPagina, PDO::PARAM_INT);
		
		$stmt->execute();
		
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC); 
		
	}catch(PDOException $e){	
			
			echo "Error: Error al seleccionar las tareas: ".$e->getMessage();
			
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
			exit;
	}
	
	return $rows;
}
*/

//Función para Insertar usuario 

function insertarUsuario($usuario, $contrasena){
	$contrasena_cifrada=password_hash($contrasena, PASSWORD_DEFAULT, array("cost"=>15));
	
	$con = conectarBD();
	
	try{
		
		$sql = "INSERT INTO usuarios (idUsuario, email, password, nombre, apellidos, direccion, telefono) VALUES(:idUsuario, :email, :password, :nombre, :apellidos, :direccion, :telefono)";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':idUsuario',$idUsuario);
		$stmt->bindParam(':email',$email);
		$stmt->bindParam(':password',$password_cifrada);
		$stmt->bindParam(':nombre',$nombre);
		$stmt->bindParam(':apellidos',$apellidos);
		$stmt->bindParam(':direccion',$direccion);
		$stmt->bindParam(':telefono',$telefono);
		
		
		$stmt->execute();
		
	}catch(PDOException $e){	
			
			echo "Error: Error al insertar usuario: ".$e->getMessage();
			
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
			exit;
	}
	
	return $con->lastInsertId();
}


//FUNCION seleccionarUsuario

function seleccionarUsuario($usuario){
	
	
	$con = conectarBD();
	
	try{
		
		$sql = "SELECT * FROM usuarios WHERE nombre=:usuario";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':usuario',$usuario);
		
		
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC); 
		//fetch en el caso que sabemos que devuelve como máx 1 fila, fetchAll cuando puede devolver 1 o más
		
	}catch(PDOException $e){	
			
			echo "Error: Error al seleccionar usuario: ".$e->getMessage();
			
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
			exit;
	}
	
	return $row;
	
}

//FUNCIÓN BorrarUsuario
function borrarUsuario($usuario){
	
	$con = conectarBD();
	
	try{
		
		$sql = "DELETE FROM usuarios WHERE usuario=:usuario";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':usuario',$usuario);
		
		$stmt->execute();
		
	}catch(PDOException $e){	
			
			echo "Error: Error al eliminar usuario: ".$e->getMessage();
			
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
			exit;
	}
	
	return $stmt->rowCount();
	
}

//FUNCIÓN Seleccionar todos los usuarios

function seleccionarTodoUsuario(){
	
	$con = conectarBD();
	
	try{
		
		$sql = "SELECT * FROM usuarios";
		
		$stmt = $con->query($sql);
		
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC); 
		
	}catch(PDOException $e){	
			
			echo "Error: Error al seleccionar todos los usuarios: ".$e->getMessage();
			
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
			exit;
	}
	
	return $rows;
	
}

//Función para actualizarUsuario
function actualizarUsuario($usuario, $contrasena){
	
	$con = conectarBD();
	
	try{
		
		
		$sql = "UPDATE usuarios SET usuario=:usuario, contrasena=:contrasena WHERE usuario=:usuario";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':usuario',$usuario);
		$stmt->bindParam(':contrasena',$contrasena);
		
		$stmt->execute();
		
	}catch(PDOException $e){	
			
			echo "Error: Error al actualizar el usuario: ".$e->getMessage();
			
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
			exit;
	}
	
	return $stmt->rowCount();
}

function seleccionarUsuarios($inicio, $usuariosPagina){
	
	$con = conectarBD();
	
	try{
		
		$sql = "SELECT * FROM usuarios LIMIT :inicio,:usuariosPagina";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':inicio',$inicio, PDO::PARAM_INT); /* Si necesitamos que sea un valor entero (INT) */
		$stmt->bindParam(':usuariosPagina',$usuariosPagina, PDO::PARAM_INT);
		
		$stmt->execute();
		
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC); 
		
	}catch(PDOException $e){	
			
			echo "Error: Error al seleccionar los usuarios: ".$e->getMessage();
			
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
			exit;
	}
	
	return $rows;
}

//FUNCIÓN Seleccionar todos los productos

function seleccionarTodoProducto(){
	
	$con = conectarBD();
	
	try{
		
		$sql = "SELECT * FROM productos";
		
		$stmt = $con->query($sql);
		
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC); 
		
	}catch(PDOException $e){	
			
			echo "Error: Error al seleccionar todos los productos: ".$e->getMessage();
			
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
			exit;
	}
	
	return $rows;
	
}

//FUNCIÓN Seleccionar productos

function seleccionarProductos($inicio, $productosPagina){
	
	$con = conectarBD();
	
	try{
		
		$sql = "SELECT * FROM productos LIMIT :inicio,:productosPagina";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':inicio',$inicio, PDO::PARAM_INT); /* Si necesitamos que sea un valor entero (INT) */
		$stmt->bindParam(':productosPagina',$productosPagina, PDO::PARAM_INT);
		
		$stmt->execute();
		
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC); 
		
	}catch(PDOException $e){	
			
			echo "Error: Error al seleccionar los productos: ".$e->getMessage();
			
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
			exit;
	}
	
	return $rows;
}

/* ---------------------------------------------------------------------------------------------------------------------------------------------- */

function seleccionarTodasOfertas(){
	
	$con = conectarBD();
	
	try{
		
		$sql = "SELECT * FROM productos";
		
		$stmt = $con->prepare($sql);
		
		$stmt->execute();
		
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC); 
		
	}catch(PDOException $e){	
			
			echo "Error: Error al seleccionar todos los productos: ".$e->getMessage();
			
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
			exit;
	}
	
	return $rows;
	
}

////////////////////////////////////////////////////////////////
 function seleccionarOfertasPortada($numOfertas){
	
	$con = conectarBD();
	
	try{
		
		$sql = "SELECT * FROM productos LIMIT :numOfertas";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':numOfertas',$numOfertas, PDO::PARAM_INT);
		
		$stmt->execute();
		
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC); 
		
	}catch(PDOException $e){	
			
			echo "Error: Error al seleccionar los productos: ".$e->getMessage();
			
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
			exit;
	}
	
	return $rows;
	
} 

//////////////////////////////////////////

function seleccionarProducto($idProducto){
		
	$con = conectarBD();
	
	try{
		
		$sql = "SELECT * FROM productos WHERE idProducto=:idProducto";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':idProducto',$idProducto, PDO::PARAM_INT);
		
		$stmt->execute();
		
		$rows = $stmt->fetch(PDO::FETCH_ASSOC); //fech en vez de fetchAll porque devuelve solo 1 o ninguna
		
	}catch(PDOException $e){	
			
			echo "Error: Error al seleccionar los datos del producto: ".$e->getMessage();
			
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
			exit;
	}
	
	return $rows;
	
}

//Function InsertarPedido

function insertarPedido($idUsuario,$detallePedido,$total){
	
	$con = conectarBD();
	
	try{
		
		//para hacer que se meta todo o nada:
		$conexion -> beginTransaction();
		
		$sql = "INSERT INTO pedidos (idUsuario, total) VALUES (:idUsuario, :total)";
		
		$sentencia =  $conexion -> prepare($sql);
		
		$sentencia -> bindparam(":idUsuario", $idUsuario);
		$sentencia -> bindparam(":total", $total);
		
		$sentencia -> execute();
		
		$idPedido = $conexion->lastInsertId();
		
		foreach($detallePedido as $idProducto => $cantidad){
			$producto = seleccionarProducto($idProducto);
			$precio = $producto[precioOferta];
			
			$sql2 = "INSERT INTO detallePedido (idPedido, idProducto, cantidad, precio) VALUES (:idPedido, :idProducto, :cantidad, :precio)";
			$sentencia =  $conexion -> prepare($sql2);
		
			$sentencia -> bindparam(":idPedido", $idPedido);
			$sentencia -> bindparam(":idProducto", $idProducto);
			$sentencia -> bindparam(":cantidad", $cantidad);
			$sentencia -> bindparam(":precio", $precio);
		
			$sentencia -> execute();
		}
		
		$conexion -> commit();
		
	}catch(PDOException $e){	
			
			$conexion -> rollback();
			
			echo "Error: Error al seleccionar los datos del producto: ".$e->getMessage();
			
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
			exit;
	}
	
	return $idPedido;
	
}



















?>