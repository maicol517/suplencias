  <table width="95%" border="0" align="center" cellspacing="1" >
    <tr>
      <td>
      <table width="100%" border="0" cellspacing="1" class="tabla_proveedor_consulta">
        <tr>
          <td colspan="7"><h2>LISTADO DE SOLICITUDES POR APROBARa</h2></td>
          </tr>

        <tr  bgcolor="#1D699E" class="titulo_usuarios">
          <th width="15%" >Nº de Solicitud</th>
          
          <th width="25%">Estado</th>
          <th width="5%">Tipo Suplencia</th>
          <th width="25%">Trabajador Titular</th>
          <th width="20%">Progreso</th>
          <th width="10%">Acción</th>
        </tr>
        <?php
    $color=0; $total=0;
     while($listado_aprobar_rrhh = pg_fetch_object($listado_solicitudes_aprobar_rrhh)){
        ?>
        <tr bgcolor="<?php if ($color%2==0) echo '#eeeeee'; else echo '#ffffff'; ?>">
          <td align="center">&nbsp;SS-<?=$listado_aprobar_rrhh->id;?>-2015</td>
          
          <td align="center"><abbr title="<?=$listado_aprobar_rrhh->dependencia_descripcion;?>"><?=$listado_aprobar_rrhh->estado_descripcion;?></abbr></td>
          <td align="center"><?=$listado_aprobar_rrhh->t_solicitud;?></td>
          <td align="center"><?=$listado_aprobar_rrhh->nombres.' '.$listado_aprobar_rrhh->apellidos;?></td>
         <td align="left"><progress value="<?= max_orden_historico($listado_aprobar_rrhh->id, $listado_aprobar_rrhh->clasificacion_id,$link)?>" max="<?= max_orden($listado_aprobar_rrhh->id, $listado_aprobar_rrhh->clasificacion_id,$link) ?>"><div pseudo="-webkit-progress-bar"><div pseudo="-webkit-progress-value"></div></div>
          
          </progress><span style="font-size:9px; font-weight:bold">
          <?= max_orden_historico($listado_aprobar_rrhh->id, $listado_aprobar_rrhh->clasificacion_id,$link)?> de <?= max_orden($listado_aprobar_rrhh->id, $listado_aprobar_rrhh->clasificacion_id,$link) ?></span><br/><div style="font-size:9px; text-align:center" ><?= estatus_historico_img(estatus_actual($listado_aprobar_rrhh->id, $listado_aprobar_rrhh->clasificacion_id,$link))?></div></td>
          <td align="center">&nbsp;<a href="template.php?ind=<?php echo md5('ver_solicitud'); ?>&amp;id_solicitud=<?=$listado_aprobar_rrhh->id;?>"><img src="images_icon/act_view.gif" title="Ver" width="16" height="16" /></a>&nbsp;<a href="template.php?ind=<? echo md5('mod_solicitud');?>&amp;id_solicitud=<?=$listado_aprobar_rrhh->id;?>" ><img src="images_icon/edit.png" title="Editar Solicitud" width="16" height="16" /></a>&nbsp;<a href="includes/aprobacion.php?id_solicitud=<?=$listado_aprobar_rrhh->id;?>&amp;id_clasificacion=<?=$listado_aprobar_rrhh->clasificacion_id;?>&amp;TB_iframe=true&amp;height=500&amp;width=860" rel="sexylightbox"><img src="images_icon/history.gif" title="Historico de la Solicitud" width="16" height="16" /></a></td>
        </tr>
        <?php 
     $color++;
       $total++;
    } 
    pg_free_result($listado_solicitudes_aprobar_rrhh);
        pg_close($link);
    ?>
      </table>
     </td>
    </tr>
  </table>
