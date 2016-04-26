<form id="form1" class="prueba" name="form1" method="post" action="includes/registrar_niveles_aprobacion_add.php">


  <table width="95%" border="0" align="center" cellspacing="1" >
    <tr>
      <td>
      <table width="80%" border="0" cellspacing="1" class="tabla_proveedor">
        <tr>
          <td colspan="4"><h2>NIVELES DE APROBACION</h2></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Clasificacion de Solicitud</td>
          <td colspan="2"><select name="clasificacion" class="campotexto" id="clasificacion" required="required">
            <option value="">Selecionar Clasificacion de Solicitud</option>
            
		
  	  <?php $sql_clasificacion = pg_query($link, "SELECT id, descripcion, estatus
  FROM clasificacion_solicitud where estatus='t' order by id asc"); 

		   while($clasificacion = pg_fetch_object($sql_clasificacion)){  ?>
       <option value="<?=$clasificacion->id?>"><?=$clasificacion->descripcion?></option>
        <?php  } ?>
        </select></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Rol de Aprobacion</td>
          <td colspan="2"><select name="rol" class="campotexto" id="rol" required="required">
            <option value="">Selecionar Rol de Aprobacion</option>
            
		
  	  <?php $sql_rol = pg_query($link, "SELECT id, descripcion, estatus
  FROM rol_aprobacion where estatus='t' order by id asc"); 

		   while($rol = pg_fetch_object($sql_rol)){  ?>
       <option value="<?=$rol->id?>"><?=$rol->descripcion?></option>
        <?php  } ?>
        </select></td>
        </tr>
               <tr>
          <td>&nbsp;</td>
          <td>Orden de Aprobacion</td>
          <td colspan="2"><select name="orden" class="campotexto" id="orden" required="required">
            <option value="">Selecionar Orden de Aprobacion</option>
            <option value="1">Primero</option>
            <option value="2">Segundo</option>
            <option value="3">Tercero</option>
            <option value="4">Cuarto</option>
            <option value="5">Quinto</option>
            <option value="6">Sexto</option>
            <option value="7">Septimo</option>
        </select></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4" align="center"><input class="bottonsumit" type="submit" name="button" id="button" value="Enviar" />
            </td>
        </tr>
        <tr>
          <td colspan="4" align="center">&nbsp;</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="1" class="tabla_proveedor_consulta">
        <tr>
          <td colspan="8"><h2>LISTADO NIVELES DE APROBACION</h2></td>
        </tr>
        <tr  bgcolor="#1D699E" class="titulo_usuarios">
         
          <th width="30%" >Clasificacion de Solicitud</th>
          <th width="70%" >Rol Aprobacion</th>
        </tr>
        <?php
		$color=0; $total=0; $aux=''; 
	   while($Cons_niveles_aprobacion = pg_fetch_object($Consulta_niveles_aprobacion)){
		    ?>
        <tr bgcolor="<?php if ($color%2==0) echo '#eeeeee'; else echo '#ffffff'; ?>">

          <td align="center"><strong><?php 
        if ($aux==''){  
		echo $Cons_niveles_aprobacion->clasificacion; 
		}else{
            if (($Cons_niveles_aprobacion->clasificacion!=$aux)  ){
			 echo $Cons_niveles_aprobacion->clasificacion; 
		 }else{
		  echo '';
		 }
	    }
	    
          $aux = $Cons_niveles_aprobacion->clasificacion;
          ?></strong></td>
          <td align="left">&nbsp;<?=orden_alfabetico($Cons_niveles_aprobacion->orden).$Cons_niveles_aprobacion->rol;?></td>
        </tr>
        <?php 
		 $color++;
	     $total++;
		} 
		pg_free_result($Consulta_niveles_aprobacion);
        pg_close($link);
		?>
      </table>
      <p>&nbsp;</p></td>
    </tr>
  </table>

</form>
