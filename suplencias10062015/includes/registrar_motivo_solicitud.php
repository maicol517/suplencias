<form id="form1" class="prueba" name="form1" method="post" action="includes/registrar_motivo_solicitud_add.php">


  <table width="95%" border="0" align="center" cellspacing="1" >
    <tr>
      <td>
      <table width="80%" border="0" cellspacing="1" class="tabla_proveedor">
        <tr>
          <td colspan="4"><h2>MOTIVO DE LA SOLICITUD</h2></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Motivo de la Solicitud</td>
          <td colspan="2"><input type="text" class="campotexto" name="nombre_motivo" id="nombre_motivo" required /></td>
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
          <td colspan="9"><h2>LISTADO MOTIVOS</h2></td>
        </tr>
        <tr  bgcolor="#1D699E" class="titulo_usuarios">
          <th width="20%" >Estatus</th>
          <th width="80%" >Motivo</th>
          
        </tr>
        <?php
		$color=0; $total=0;
	   while($Cons_motivo_list = pg_fetch_object($Consulta_motivo_solicitud)){
		    ?>
        <tr bgcolor="<?php if ($color%2==0) echo '#eeeeee'; else echo '#ffffff'; ?>">
          <td align="center">&nbsp;
            <?php if($Cons_motivo_list->estatus=='t'){ ?>
            <img src="images/activo.png"  width="22" height="22" />
            <?php }else{ ?>
            <img src="images/inactivo.png"  width="22" height="22" />
            <?php } ?></td>
          <td align="center"><?=$Cons_motivo_list->descripcion;?></td>
          
        </tr>
        <?php 
		 $color++;
	     $total++;
		} 
		pg_free_result($Consulta_motivo_solicitud);
        pg_close($link);
		?>
      </table>
      <p>&nbsp;</p></td>
    </tr>
  </table>

</form>
