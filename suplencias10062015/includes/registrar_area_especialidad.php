<form id="form1" class="prueba" name="form1" method="post" action="includes/registrar_area_especialidad_add.php">


  <table width="95%" border="0" align="center" cellspacing="1" >
    <tr>
      <td>
      <table width="80%" border="0" cellspacing="1" class="tabla_proveedor">
        <tr>
          <td colspan="4"><h2>AREA DE ESPECIALIDAD</h2></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Area de Especialidad</td>
          <td colspan="2"><input type="text" class="campotexto" name="area_especialidad" id="area_especialidad" required /></td>
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
          <td colspan="10"><h2>LISTADO AREAS DE ESPECIALIDAD</h2></td>
        </tr>
        <tr  bgcolor="#1D699E" class="titulo_usuarios">
          <th width="20%" >Estatus</th>
          <th width="69%" >Requisito</th>
          <th width="11%" >Opcion</th>
          
        </tr>
        <?php
		$color=0; $total=0;
	   while($Cons_area_especialidad = pg_fetch_object($Consulta_area_especialidad)){
		    ?>
        <tr bgcolor="<?php if ($color%2==0) echo '#eeeeee'; else echo '#ffffff'; ?>">
          <td align="center">&nbsp;
            <?php if($Cons_area_especialidad->estatus=='t'){ ?>
            <img src="images/activo.png"  width="22" height="22" />
            <?php }else{ ?>
            <img src="images/inactivo.png"  width="22" height="22" />
            <?php } ?></td>
          <td align="center"><?=$Cons_area_especialidad->descripcion;?></td>
          <td align="center"><a href="template.php?ind=<? echo md5('mod_area_especialidad');?>&amp;id=<?=encrypt($Cons_area_especialidad->id,'LLAVE')?>" ><img src="images_icon/edit.png" title="Editar Area Especialidad" width="16" height="16" /></a></td>
          
        </tr>
        <?php 
		 $color++;
	     $total++;
		} 
		pg_free_result($Consulta_area_especialidad);
        pg_close($link);
		?>
      </table>
      <p>&nbsp;</p></td>
    </tr>
  </table>

</form>
