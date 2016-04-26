<form id="form1" class="prueba" name="form1" method="post" action="includes/registrar_clasificacion_solicitud_add.php">


  <table width="95%" border="0" align="center" cellspacing="1" >
    <tr>
      <td>
      <table width="80%" border="0" cellspacing="1" class="tabla_proveedor">
        <tr>
          <td colspan="4"><h2>CLASIFICACION DE SOLICITUD</h2></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Nombre Clasificacion de Solicitud</td>
          <td colspan="2"><input type="text" class="campotexto" name="nombre_clasificacion" id="nombre_clasificacion" required /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Condición</td>
          <td colspan="2"><select name="condicion" class="campotexto" id="condicion" required="required">
            <option value="">Selecionar Condición</option>
            <?php
		
  	   $sql_condicion = pg_query($link, "SELECT id, descripcion, estatus
  FROM condicion
where estatus='t' 
 order by id asc"); 

		   while($condicion = pg_fetch_object($sql_condicion)){  ?>
            <option value="<?= $condicion->id ?>">
              <?= $condicion->descripcion ?>
              </option>
            <?php } ?>
          </select></td>
        </tr>

        <tr>
          <td>&nbsp;</td>
          <td colspan="3">&nbsp;</td>
          </tr>
        <tr>
          <td colspan="4" align="center"><input class="bottonsumit" type="submit" name="button" id="button" value="Enviar" /></td>
        </tr>
        <tr>
          <td colspan="4" align="center">&nbsp;</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="1" class="tabla_proveedor_consulta">
        <tr>
          <td colspan="9"><h2>LISTADO CLASIFICACION DE SOLICITUD</h2></td>
        </tr>
        <tr  bgcolor="#1D699E" class="titulo_usuarios">
          <th width="10%" >Estatus</th>
          <th width="55%" >Nombre Clasificacion de Solicitud</th>
          <th width="35%" >Condición</th>
        </tr>
        <?php
		$color=0; $total=0;
	   while($Cons_clasificacion_list = pg_fetch_object($Consulta_clasificacion)){
		    ?>
        <tr bgcolor="<?php if ($color%2==0) echo '#eeeeee'; else echo '#ffffff'; ?>">
          <td align="center">&nbsp;
            <?php if($Cons_clasificacion_list->estatus=='t'){ ?>
            <img src="images/activo.png"  width="22" height="22" />
            <?php }else{ ?>
            <img src="images/inactivo.png"  width="22" height="22" />
            <?php } ?></td>
          <td align="center"><?=$Cons_clasificacion_list->descripcion;?></td>
          <td align="center"><?=$Cons_clasificacion_list->condicion;?></td>
        </tr>
        <?php 
		 $color++;
	     $total++;
		} 
		pg_free_result($Consulta_clasificacion);
        pg_close($link);
		?>
      </table>
      <p>&nbsp;</p></td>
    </tr>
  </table>

</form>
