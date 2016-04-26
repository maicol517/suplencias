
<?php  

require('lib/nusoap.php');
include ("db_link/conex.php");
extract($_POST);
//$cliente = new nusoap_client('http://ws.mp.gob.ve/ws.php?wsdl','wsdl');
$cliente = new nusoap_client('http://prueba-servicios.mp.gob.ve/ws/ws.php?wsdl','wsdl');

$parametro=array('cedula'=>$_POST["cedula"]);

$respuesta=$cliente->call('consultarTrabajador',$parametro);


function generaSelect()
{
 include ("db_link/conex.php");
  
  $consulta=pg_query("SELECT id, descripcion
  FROM estados_v");
  
  

  // Voy imprimiendo el primer select compuesto por los paises
  echo "<select name='select1' id='select1' onChange='cargaContenido(this.id)' required='required'>";
  echo "<option value='0'>Selecciona el Estado</option>";
  
  while($registro=pg_fetch_row($consulta))
  {
    echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
  }
  echo "</select>";
}


 
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
          <td width="54%" colspan="2"><input name="nombre"  class="campotexto" type="text" id="nombre" size="25" value="'.$respuesta[0]['nombres'].'" required="required" /></td>
        </tr>';
      echo  
        '<tr>
              <td width="1%" >&nbsp;</td>
           <td width="30%" >Apellidos</td>
          <td  width="54%" colspan="2"><input name="apellido"  class="campotexto" type="text" id="apellido" size="25" value="'.$respuesta[0]['apellidos'].'" required="required" /></td>
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
           <td width="30%" >Usuario</td>
          <td  width="54%" colspan="2"><input name="usuario" class="campotexto" type="text" id="usuario" size="25" value="'.$usuario.'" required="required" /></td>
        </tr>';	 	
        
       
       
        echo  '<tr>
          <td width="1%">&nbsp;</td>
          <td width="30%">Rol</td>
          <td width="54%"><select name="rol" class="campotexto" id="rol" required="required">
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
        
       
        
?>

