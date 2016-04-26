  <table width="95%" border="0" align="center" cellspacing="1" >
    <tr>
      <td>
      <table width="100%" border="0" cellspacing="1" class="tabla_proveedor_consulta">
        <tr>
          <td colspan="8"><h2>LISTADO DE SOLICITUDES</h2></td>
          </tr>

        <tr  bgcolor="#1D699E" class="titulo_usuarios">
          <th width="15%" >Nº Solicitud</th>
          <th width="25%">Periodo </th>
          
          <th width="30%">Trabajador Titular</th>
          <th width="20%">Progreso</th>
        
          <th width="10%">Acción</th>
        </tr>
        <?php
		$color=0; $total=0;
	   while($listado = pg_fetch_object($listado_solicitudes)){
		    ?>
        <tr bgcolor="<?php if ($color%2==0) echo '#eeeeee'; else echo '#ffffff'; ?>">
          <td align="center">&nbsp;SS-<?=$listado->id;?>-2015</td>
          <td align="center"><?=$listado->fecha_incio;?> al <?=$listado->fecha_fin;?></td>
          <td align="center"><?=$listado->nombres.' '.$listado->apellidos;?></td>
          <td align="left"><progress value="<?= max_orden_historico($listado->id, $listado->clasificacion_id,$link)?>" max="<?= max_orden($listado->id, $listado->clasificacion_id,$link) ?>"><div pseudo="-webkit-progress-bar"><div pseudo="-webkit-progress-value"></div></div>
          
          </progress><span style="font-size:9px; font-weight:bold">
          <?= max_orden_historico($listado->id, $listado->clasificacion_id,$link)?> de <?= max_orden($listado->id, $listado->clasificacion_id,$link) ?></span><br/><div style="font-size:9px; text-align:center" ><?= estatus_historico_img(estatus_actual($listado->id, $listado->clasificacion_id,$link))?></div></td>
          <td align="center">&nbsp;<a href="template.php?ind=<?php echo md5('ver_solicitud'); ?>&amp;id_solicitud=<?=$listado->id;?>"><img src="images_icon/act_view.gif" title="Ver" width="16" height="16" /></a>&nbsp;<a href="template.php?ind=<? echo md5('mod_solicitud');?>&amp;id_solicitud=<?=$listado->id;?>" ><img src="images_icon/edit.png" title="Editar Solicitud" width="16" height="16" /></a>&nbsp;<a href="template.php?ind=<?php echo md5('registrar_archivo'); ?>&amp;id_solicitud=<?=$listado->id;?>"><img src="images_icon/pdf.png" title="Documentos" width="16" height="16" /></a></td>
        </tr>
        <?php 
		 $color++;
	     $total++;
		} 
		pg_free_result($listado_solicitudes);
        pg_close($link);
		?>
      </table>
     </td>
    </tr>
  </table>