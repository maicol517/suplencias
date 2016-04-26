<form id="form1" class="prueba" name="form1" method="post" action="includes/registrar_requisito_add.php">


  <table width="95%" border="0" align="center" cellspacing="1" >
    <tr>
      <td>
      <table width="80%" border="0" cellspacing="1" class="tabla_proveedor">
        <tr>
          <td colspan="4"><h2>REQUISITOS</h2></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Requisitos</td>
          <td colspan="2"><input type="text" class="campotexto" name="requisito" id="requisito" required /></td>
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
          <td colspan="9"><h2>LISTADO REQUISITOS</h2></td>
        </tr>
        <tr  bgcolor="#1D699E" class="titulo_usuarios">
          <th width="20%" >Estatus</th>
          <th width="80%" >Requisito</th>
          
        </tr>
        <?php
		$color=0; $total=0;
	   while($Cons_requisito_list = pg_fetch_object($Consulta_requisito_solicitud)){
		    ?>
        <tr bgcolor="<?php if ($color%2==0) echo '#eeeeee'; else echo '#ffffff'; ?>">
          <td align="center">&nbsp;
            <?php if($Cons_requisito_list->estatus=='t'){ ?>
            <img src="images/activo.png"  width="22" height="22" />
            <?php }else{ ?>
            <img src="images/inactivo.png"  width="22" height="22" />
            <?php } ?></td>
          <td align="center"><?=$Cons_requisito_list->descripcion;?></td>
          
        </tr>
        <?php 
		 $color++;
	     $total++;
		} 
		pg_free_result($Consulta_requisito_solicitud);
        pg_close($link);
		?>
      </table>
      <p>&nbsp;</p></td>
    </tr>
  </table>

</form>
