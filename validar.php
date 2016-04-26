<?php
session_start(); // inicia la sesión

include ("db_link/conex.php");//conexion con la base de datos

  $usuario=$_POST['login'];
 
$result_salt = pg_query($link, "Select salt from open_id.users WHERE login='$usuario'");

if(pg_num_rows($result_salt)>0){	//si existe funcionario



		$arreglo = pg_fetch_row($result_salt);
		
		
		   $clave=sha1('--'.$arreglo[0].'--'.$_POST['password'].'--');
	


$result = pg_query($link, "Select trabajadores.id as id_trabajador, open_id.users.login, open_id.users.cedula,  usuarios.rol_aprobacion_id, trabajadores.apellidos, 
	trabajadores.nombres, usuarios.dependencia_id, d.descripcion, trabajadores.cargo_id, trabajadores.cargo, 
	d.estado_descripcion, rol_aprobacion.descripcion as rol,  d.estado_id, usuarios.id as usu_id
from open_id.users
join trabajadores on trabajadores.cedula=open_id.users.cedula
join usuarios on usuarios.trabajador_id=trabajadores.id
join rol_aprobacion on rol_aprobacion.id=usuarios.rol_aprobacion_id
join dependencias d on d.id=usuarios.dependencia_id
WHERE open_id.users.crypted_password='$clave' and open_id.users.login='$usuario' and open_id.users.suspended='FALSE' and usuarios.estatus='TRUE' limit 1
");

	if(pg_num_rows($result)>0){	//si existe funcionario
			$row = pg_fetch_row($result);
			$_SESSION['usu_id_trabajador']=$row[0]; // asigna valor cedula a variable de sesion
			$_SESSION['usu_login']=$row[1];
			$_SESSION['usu_cedula']=$row[2];
			$_SESSION['usu_rol_aprobacion']=$row[3];
			$_SESSION['usu_apellidos']=$row[4];
			$_SESSION['usu_nombres']=$row[5];
			$_SESSION['usu_dependencia_id']=$row[6];
			$_SESSION['usu_dependencia']=$row[7];
			$_SESSION['usu_cargo_id']=$row[8];
			$_SESSION['usu_cargo']=$row[9];
			$_SESSION['usu_estado']=$row[10];
			$_SESSION['usu_rol_aprobacion_descripcion']=$row[11];
			$_SESSION['usu_estado_id']=$row[12];
			$_SESSION['usu_id']=$row[13];
			$_SESSION["autenticado"] = 'si';
			//echo pg_num_rows($result);
	  header("Location: template.php");


     } else{
		pg_close($link); // cierra conexion de base de datos
	    header("Location: index.php?error=7"); // pagina pppal con mensaje de error 
	 }
}else{
	pg_close($link); // cierra conexion de base de datos
	header("Location: index.php?error=7"); // pagina pppal con mensaje de error

	}






















/*

$result = pg_query($link, "SELECT id, usuario, nombre
  FROM usuarios where usuario = '".$_POST['usuario']."' and clave='".$_POST['clave']."' and status = 't'");
	if(pg_num_rows($result)>0){	//si existe funcionario
			$row = pg_fetch_row($result);
			$_SESSION['id_usu']=$row[0]; // asigna valor cedula a variable de sesion
			$_SESSION['usuario_usu']=$row[1];
			$_SESSION['nombre_usu']=$row[2];
			
			$_SESSION["autenticado"] = 'si';
			echo pg_num_rows($result);
	  header("Location: template.php");
}
	else // sino existe funcionario en base de datos  
{	
		   pg_close($link); // cierra conexion de base de datos
	       header("Location: index.php"); // pagina pppal con mensaje de error
}*/
?>
