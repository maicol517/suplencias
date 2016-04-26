<?php
////////////////////////////////////////////// WS VIEJA FORMA  ////////////////////////////////////
require('lib/nusoap.php');
include ("db_link/conex.php");
extract($_POST);

$cedula =  $_GET['valor'];

//$cliente = new nusoap_client('http://ws.mp.gob.ve/ws.php?wsdl','wsdl');
$cliente = new nusoap_client('http://prueba-servicios.mp.gob.ve/ws/ws.php?wsdl','wsdl');
//$parametro=array('cedula'=>$_POST["cedula"]);
$parametro=array('cedula'=>$cedula);
//$respuesta=$cliente->call('consultarTrabajador',$parametro);
//$respuesta=$cliente->call('consultarPersona',$parametro);
$respuesta=$cliente->call('consultarTrabajador',$parametro);





	 	   echo $respuesta[0]['nombres'].'|'.$respuesta[0]['apellidos'].'|'.$respuesta[0]['cargo'].'|'.$respuesta[0]['dependencia'].'|'.$respuesta[0]['cargo_id'].'|'.$respuesta[0]['dependencia_id'].'|'.$respuesta[0]['trabajador_id'];
	  
?>
