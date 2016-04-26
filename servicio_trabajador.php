
<?php  
require('lib/nusoap.php');
include ("db_link/conex.php");
extract($_POST);
//$cliente = new nusoap_client('http://ws.mp.gob.ve/ws.php?wsdl','wsdl');
$cliente = new nusoap_client('http://prueba-servicios.mp.gob.ve/ws/ws.php?wsdl','wsdl');

$parametro=array('cedula'=>$_POST["cedula"]);

$respuesta=$cliente->call('consultarTrabajador',$parametro);


	
	
	  echo  
	    '<tr>
          <td width="1%" >&nbsp;</td>
          <td width="34%" >Nombres</td>
          <td width="100%" colspan="2"><input name="nombre" class="campotexto" type="text" id="nombre" size="25" value="'.$respuesta[0]['nombres'].'" required="required" /></td>
        </tr>';
     echo  
        '<tr>
              <td width="1%" >&nbsp;</td>
           <td width="34%" >Apellidos</td>
          <td  width="100%" colspan="2"><input name="apellido" class="campotexto" type="text" id="apellido" size="25" value="'.$respuesta[0]['apellidos'].'" required="required" /></td>
        </tr>';	 
	  echo
	    '<tr>
              <td width="1%" >&nbsp;<input name="cargo_id" type="hidden" id="cargo_id" value="'.$respuesta[0]['cargo_id'].'" /></td>
           <td width="34%" >Cargo</td>
          <td  width="100%" colspan="2"><input name="cargo" class="campotexto" type="text" id="cargo" size="25" value="'.$respuesta[0]['cargo'].'" required="required" /></td>
        </tr>';	 	
	 echo 
	   '<tr>
              <td width="1%" >&nbsp;<input name="dependencia_id" type="hidden" id="dependencia_id" value="'.$respuesta[0]['dependencia_id'].'" /></td>
           <td width="34%" >Dependencia</td>
          <td  width="100%" colspan="2"><input name="dependencia" class="campotexto" type="text" id="dependencia" size="25" value="'.$respuesta[0]['dependencia'].'" required="required" /></td>
        </tr>';	 	
		
	 echo  
	   '<tr>
              <td width="1%" >&nbsp;</td>
           <td width="34%" >Estado</td>
          <td  width="100%" colspan="2"><input name="estado" class="campotexto" type="text" id="estado" size="25" value="'.$respuesta[0]['estado'].'" required="required" /></td>
        </tr>';	 



        
?>

