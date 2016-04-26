
<?php  
require('lib/nusoap.php');
include ("db_link/conex.php");
//extract($_POST);
//$cliente = new nusoap_client('http://ws.mp.gob.ve/ws.php?wsdl','wsdl');
$cliente = new nusoap_client('http://prueba-servicios.mp.gob.ve/ws/ws.php?wsdl','wsdl');

$parametro=array('cedula'=>$_GET["cedula_postulado"]);
$parametro2=array('cedula'=>$_GET["cedula_postulado"], 'nacionalidad'=>$_GET["nacionalidad"]);



switch ($_GET["tipo"]) {

// CASO #1 SERVICIO consultarTrabajador  
case 1:	
	
$respuesta=$cliente->call('consultarTrabajador',$parametro);  


  echo $_GET["tipo"].'|'.$respuesta[0]['nombres'].'|'.$respuesta[0]['apellidos'].'|'.$respuesta[0]['dependencia'].'|'.$respuesta[0]['trabajador_id'];

	
		
break;	

//CASO #2 SERVICIO consultarNacionalidad 
	
case 2:	

$respuesta2=$cliente->call('consultarNacionalidad',$parametro2);

     echo $_GET["tipo"].'|'.$respuesta2[0]['nombres'].'|'.$respuesta2[0]['apellidos'];
		
break;	


	}
?>

