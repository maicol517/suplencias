
<?php  
require('lib/nusoap.php');
include ("db_link/conex.php");
//extract($_POST);
//$cliente = new nusoap_client('http://ws.mp.gob.ve/ws.php?wsdl','wsdl');
$cliente = new nusoap_client('http://prueba-servicios.mp.gob.ve/ws/ws.php?wsdl','wsdl');

$parametro=array('cedula'=>$_POST["cedula_postulado"]);
$parametro2=array('cedula'=>$_POST["cedula_postulado"], 'nacionalidad'=>$_POST["nacionalidad"]);

	
switch ($_POST["tipo"]) {

/************************** CASO #1 SERVICIO consultarTrabajador  ************/
case '1':	
	
$respuesta=$cliente->call('consultarTrabajador',$parametro);  

	  echo  
	    '<tr>
          <td width="1%" >&nbsp;<input name="trabajador_id" type="hidden" id="trabajador_id" value="'.$respuesta[0]['trabajador_id'].'" /></td>
          <td width="34%" >Nombres</td>
          <td width="100%" colspan="2"><input name="nombre_postulado" class="campotexto" type="text" id="nombre_postulado" size="25" value="'.$respuesta[0]['nombres'].'" required="required" /></td>
        </tr>';
     echo  
        '<tr>
              <td width="1%" >&nbsp;</td>
           <td width="34%" >Apellidos</td>
          <td  width="100%" colspan="2"><input name="apellido_postulado" class="campotexto" type="text" id="apellido_postulado" size="25" value="'.$respuesta[0]['apellidos'].'" required="required" /></td>
        </tr>';	 
	 echo 
	   '<tr>
              <td width="1%" >&nbsp;</td>
           <td width="34%" >Descripcion</td>
          <td  width="100%" colspan="2"><input name="descripcion_postulado" class="campotexto" type="text" id="descripcion_postulado" size="25" value="'.$respuesta[0]['dependencia'].'" required="required" /></td>
        </tr>';	 	
		
break;	

/************************** CASO #2 SERVICIO consultarNacionalidad  ************/
case '2':	
	
$respuesta2=$cliente->call('consultarNacionalidad',$parametro2);

	  echo  
	    '<tr>
          <td  >&nbsp;</td>
          <td  width="30%">Nombres</td>
          <td  width="70%" colspan="2"><input name="nombre_postulado" class="campotexto" type="text" id="nombre_postulado" size="25" value="'.$respuesta2[0]['nombres'].'" required="required" /></td>
        </tr>';
    echo  
        '<tr>
              <td>&nbsp;</td>
           <td width="30%" >Apellidos</td>
          <td  width="70%" colspan="2"><input name="apellido_postulado" class="campotexto" type="text" id="apellido_postulado" size="25" value="'.$respuesta2[0]['apellidos'].'" required="required" /></td>
        </tr>';	 
	 echo 
	   '<tr>
              <td>&nbsp;</td>
           <td width="30%" >Descripcion</td>
          <td  width="70%" colspan="2"><input name="descripcion_postulado" class="campotexto" type="text" id="descripcion_postulado" size="25" value=" " required="required" /></td>
        </tr>';	 	
		
break;	
  /*****************         ERROR            */
    default:
	echo 'Error Debe Seleccionar un Tipo';
	break;	

	}
?>

