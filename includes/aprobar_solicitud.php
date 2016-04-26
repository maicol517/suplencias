  <table width="95%" border="0" align="center" cellspacing="1" >
    <tr>
      <td>
      <table width="100%" border="0" cellspacing="1" class="tabla_proveedor_consulta">
        <tr>
          <td colspan="7"><h2>LISTADO DE SOLICITUDES POR APROBAR</h2></td>
          </tr>

        <tr  bgcolor="#1D699E" class="titulo_usuarios">
          <th width="15%" >Nº </th>
         
          <th width="20%">Periodo de la Suplencia</th>
          <th width="10%">Tipo Suplencia</th>
          <th width="25%">Trabajador Titular</th>
          <th width="20%">Estatus</th>
          <th width="10%">Acción</th>
        </tr>
        <?php
    $color=0; $total=0;
     while($listado_aprobar = pg_fetch_object($listado_solicitudes_aprobar)){
        ?>
        <tr bgcolor="<?php if ($color%2==0) echo '#eeeeee'; else echo '#ffffff'; ?>">
          <td align="center">&nbsp;SS-<?=$listado_aprobar->id;?>-2015</td>
          
          <td align="center"><?=$listado_aprobar->fecha_incio;?>
          &nbsp;al&nbsp;<?=$listado_aprobar->fecha_fin;?></td>
          <td align="center"><?=$listado_aprobar->t_solicitud;?></td>
          <td align="center"><?=$listado_aprobar->nombres.' '.$listado_aprobar->apellidos;?></td>
         <td align="left"><progress value="<?= max_orden_historico($listado_aprobar->id, $listado_aprobar->clasificacion_id,$link)?>" max="<?= max_orden($listado_aprobar->id, $listado_aprobar->clasificacion_id,$link) ?>"><div pseudo="-webkit-progress-bar"><div pseudo="-webkit-progress-value"></div></div>
          
          </progress><span style="font-size:9px; font-weight:bold">
          <?= max_orden_historico($listado_aprobar->id, $listado_aprobar->clasificacion_id,$link)?> de <?= max_orden($listado_aprobar->id, $listado_aprobar->clasificacion_id,$link) ?></span><br/><div style="font-size:9px; text-align:center" ><?= estatus_historico_img(estatus_actual($listado_aprobar->id, $listado_aprobar->clasificacion_id,$link))?></div></td>
          
          <td align="center">&nbsp;<a href="template.php?ind=<?php echo md5('ver_solicitud'); ?>&amp;id_solicitud=<?=$listado_aprobar->id;?>"><img src="images_icon/act_view.gif" title="Ver" width="16" height="16" /></a>&nbsp;&nbsp;<a href="includes/aprobacion.php?id_solicitud=<?=$listado_aprobar->id;?>&amp;id_clasificacion=<?=$listado_aprobar->clasificacion_id;?>&amp;TB_iframe=true&amp;height=500&amp;width=860" rel="sexylightbox"><img src="images_icon/history.gif" title="Historico de la Solicitud" width="16" height="16" /></a></td>
        </tr>
        <?php 
     $color++;
       $total++;
    } 
    pg_free_result($listado_solicitudes_aprobar);
        pg_close($link);
    ?>
      </table>
     </td>
    </tr>
  </table>
