
<?php  

/*
include ("db_link/conex.php");
extract($_POST);
//$cliente = new nusoap_client('http://ws.mp.gob.ve/ws.php?wsdl','wsdl');
$cliente = new nusoap_client('http://prueba-servicios.mp.gob.ve/ws/ws.php?wsdl','wsdl');

$parametro=array('cedula'=>$_POST["cedula"]);

$respuesta=$cliente->call('consultarTrabajador',$parametro);*/

 require ('../ca/soap.php');
 include ("db_link/conex.php");
/////////////////////////////////////////////////// ESTO ES LO DEL SERVICIO  /////////////////////////////////////////////

$parametro=array('cedula'=>'16309159');

//LLAMAR AL SERVICIO DESDE EL BUS

try {

    $sClient = new llamarSoapBus('https://wso2-dev.mp.gob.ve:9443/services/WSMP_DEV?wsdl', array('trace' => 1, 'soap_version' => SOAP_1_2));

    $test = $sClient->consultarTrabajador($parametro);

//    var_dump($test);

    //print_r($test);

} catch (SoapFault $e) {

    echo "Error llamando al servicio: " . $e;

    exit();

}  

function objectToArray($datos) {

        if (is_object($datos)) {          

            $datos = get_object_vars($datos);

        }

        if (is_array($datos)) {          

            return array_map(__FUNCTION__, $datos);

        }

        else {          

            return $datos;

        }

    }


    $objeto_aux = new stdClass;        

    $objeto_aux=$test;

    $arreglo = objectToArray($objeto_aux);



     foreach($arreglo as $i=> $respuesta){

         

       }   

        //echo $respuesta[0]['nombres'].'|'.$respuesta[0]['apellidos'];


 
//*********************** CONSULTA OPEN ID VER NOMBRE DE USUARIO ***************************/
 
 $sql_user = pg_query($link, "SELECT open_id.users.id as id, login
  FROM open_id.users 
join trabajadores on trabajadores.cedula=open_id.users.cedula
where open_id.users.cedula='".$_POST['cedula']."'"); 

		   while($user = pg_fetch_object($sql_user)){  
			  $usuario = $user->login; 
		   }

//*****************************************************************************************/	

	  echo  
	    '<tr>
          <td width="1%" >&nbsp;</td>
          <td width="30%" >Nombres	<input name="trabajador_id" type="hidden" id="trabajador_id" value="'.$respuesta[0]['trabajador_id'].'" /></td>
          <td width="54%" colspan="2"><input name="nombre" class="campotexto" type="text" id="nombre" size="25" value="'.$respuesta[0]['nombres'].'" required="required" /></td>
        </tr>';
      echo  
        '<tr>
              <td width="1%" >&nbsp;</td>
           <td width="30%" >Apellidos</td>
          <td  width="54%" colspan="2"><input name="apellido" class="campotexto" type="text" id="apellido" size="25" value="'.$respuesta[0]['apellidos'].'" required="required" /></td>
        </tr>';	 
	  echo
	    '<tr>
              <td width="1%" >&nbsp;</td>
           <td width="30%" >Cargo</td>
          <td  width="54%" colspan="2"><input name="cargo" class="campotexto" type="text" id="cargo" size="25" value="'.$respuesta[0]['cargo'].'" required="required" /></td>
        </tr>';	 	
	 echo 
	   '<tr>
              <td width="1%" >&nbsp;</td>
           <td width="30%" >Dependencia</td>
          <td  width="54%" colspan="2"><input name="dependencia" class="campotexto" type="text" id="dependencia" size="25" value="'.$respuesta[0]['dependencia'].'" required="required" /></td>
        </tr>';	 	
		
	 echo  
	   '<tr>
              <td width="1%" >&nbsp;</td>
           <td width="30%" >Estado</td>
          <td  width="54%" colspan="2"><input name="estado" class="campotexto" type="text" id="estado" size="25" value="'.$respuesta[0]['estado'].'" required="required" /></td>
        </tr>';	 
      echo  
        '<tr>
              <td width="1%" >&nbsp;</td>
           <td width="30%" >Usuario</td>
          <td  width="54%" colspan="2"><input name="usuario" class="campotexto" type="text" id="usuario" size="25" value="'.$usuario.'" required="required" /></td>
        </tr>';	 	
 /*     echo 
        '<tr>
              <td width="1%" >&nbsp;</td>
           <td width="30%" >Telefono</td>
          <td  width="54%" colspan="2"><input name="tlf" class="campotexto" type="text" id="tlf" size="25" value="" required="required" /></td>
        </tr>';	 
     echo  
       '<tr>
              <td width="1%" >&nbsp;</td>
           <td width="30%" >Correo</td>
          <td  width="54%" colspan="2"><input name="correo" class="campotexto" type="text" id="correo" size="25" value="" required="required" /></td>
        </tr>';	 */
       
       
        echo  '       <tr>
          <td>&nbsp;</td>
          <td>Rol</td>
          <td colspan="2"><select name="rol" class="campotexto" id="rol" required="required">
            <option value="">Selecionar Rol</option>';
            
		
  	   $sql_rol = pg_query($link, "SELECT id, descripcion, estatus
  FROM rol_aprobacion
where estatus='t' 
 order by id asc"); 

		   while($rol = pg_fetch_object($sql_rol)){  
          echo  '    <option value="'.$rol->id.'"> '.$rol->descripcion.'</option>';
          } 
         echo  '  </select></td>
        </tr>';
        
       echo  '   <tr>
          <td colspan="4"><h2>&nbsp;</h2></td>
          </tr>
        <tr>
          <td colspan="4" align="center"><input class="bottonsumit" type="submit" name="button" id="button" value="Enviar" /></td>
        </tr>';  
        
?>

