<?php
	   while($ver = pg_fetch_object($solicitud_ver)){
?>
<br/>
<table width="90%" border="0" cellspacing="1" class="tabla_proveedor">
  <tr>
    <td colspan="4"><h2>DATOS DE LA SOLICITUD</h2></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Solicitud Nº</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="4%">&nbsp;</td>
    <td width="29%">Fecha de la Solicitud</td>
    <td width="67%" colspan="2"><?= fecha_venezuela($ver->fecha_incio); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Motivo de la Suplencia</td>
    <td colspan="2"><?= $ver->motivo; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Tipo de Cargo</td>
    <td colspan="2"><?= $ver->tipo_cargo; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">Periodo de la Suplencia:&nbsp;&nbsp;
      (<?= fecha_venezuela($ver->fecha_incio); ?>)
      &nbsp;Hasta:&nbsp;
    (<?= fecha_venezuela($ver->fecha_fin); ?>)</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr  >
    <td colspan="4"><h2>DATOS DEL TITULAR DEL CARGO</h2></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Cedula</td>
    <td colspan="2"><?= $ver->t_cedula; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Nombre</td>
    <td colspan="2"><?= $ver->t_nombre; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Apellido</td>
    <td colspan="2"><?= $ver->t_apellido; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Dependencia</td>
    <td colspan="2"><?= $ver->t_dependencia; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Cargo</td>
    <td colspan="2"><?= $ver->t_cargo; ?></td>
  </tr>

  <tr  >
    <td colspan="4" >&nbsp;</td>
  </tr>
  <tr  >
    <td colspan="4"><h2>REQUISITOS EXIGIDOS</h2></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Nivel Educativo</td>
    <td colspan="2"><?= $ver->n_educativo; ?></td>
  </tr>
  <tr  >
    <td>&nbsp;</td>
    <td>Área de Especialidad</td>
    <td colspan="2"><?= $ver->especialidad; ?></td>
  </tr>
  <tr  >
    <td>&nbsp;</td>
    <td>Experiencia</td>
    <td colspan="2"><?= $ver->experiencia; ?></td>
  </tr>
  <tr  >
    <td>&nbsp;</td>
    <td>Habilidades y Destrezas</td>
    <td colspan="2"><?= $ver->habilidades; ?></td>
  </tr>
  <tr  >
    <td>&nbsp;</td>
    <td>Cursos Realizados</td>
    <td colspan="2"><?= $ver->cursos; ?></td>
  </tr>
  <tr  >
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr  >
    <td colspan="4"><h2>POSTULADO</h2></td>
  </tr>
  <tr  >
    <td>&nbsp;</td>
    <td>Tipo</td>
    <td colspan="2"><?= $ver->s_tipo; ?></td>
  </tr>
  <tr  >
    <td>&nbsp;</td>
    <td>Cédula de Identidad</td>
    <td colspan="2"><?= $ver->s_nacionalidad.'-'.$ver->s_cedula; ?></td>
  </tr>
  <tr  >
    <td>&nbsp;</td>
    <td>Nombre</td>
    <td colspan="2"><?= $ver->s_nombre; ?></td>
  </tr>
  <tr  >
    <td>&nbsp;</td>
    <td>Apellido</td>
    <td colspan="2"><?= $ver->s_apellido; ?></td>
  </tr>
  <tr  >
    <td>&nbsp;</td>
    <td>Descripcion</td>
    <td colspan="2"><?= $ver->s_descripcion; ?></td>
  </tr>
  <tr  >
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
   <tr  >
    <td colspan="4"><h2>DOCUMENTOS REGISTRADOS</h2></td>
  </tr>
</table>
<?php } 
	
?>
<table width="90%" border="0" cellspacing="1" class="tabla_proveedor_consulta">
  <?php
		$color=0; $total=0;
	   while($lista = pg_fetch_object($lista_archivos)){
		    ?>
  <tr bgcolor="<?php if ($color%2==0) echo '#eeeeee'; else echo '#ffffff'; ?>">
    <td align="center">&nbsp;
      <?=$lista->t_documento;?></td>
    <td align="center">&nbsp;&nbsp;<a href="archivo/pdf/<?=$lista->archivo;?>" target="_blank"><img src="images_icon/pdf.png" title="Planilla" width="20" height="20" /></a>&nbsp;</td>
  </tr>
  <?php 
		 $color++;
	     $total++;
		} 
		pg_free_result($lista_archivos);
        pg_close($link);
		?>
</table><br/>
<table width="95%" border="0" align="center" cellspacing="1" >
  <tr>
    <td><table width="100%" border="0" cellspacing="1" class="tabla_proveedor_consulta">
      <tr>
        <td colspan="6" bgcolor="#BFBFBF">&nbsp;<img src="images_icon/history.gif" width="16" height="16" />&nbsp;<strong>HISTORICO DEL CICLO</strong></td>
      </tr>
      <tr  bgcolor="#EEE" >
        <td width="47%" >Estacion:</td>
        <td width="16%">Estatus:</td>
        <td width="12%">Recibido el:</td>
        <td width="25%">Observaciones:</td>
      </tr>
      <?php
	  while($historico = pg_fetch_object($ciclo_historico)){
		    ?>
      <tr>
        <td align="left">&nbsp;
          <?= orden_alfabetico($historico->orden).$historico->rol; ?></td>
        <td align="center"><?= estatus_historico($historico->aprobado); ?></td>
        <td align="center"><?= fecha_venezuela($historico->fecha); ?></td>
        <td align="center"><?= $historico->observacions; ?><?= analisis_expediente($_SESSION['usu_rol_aprobacion'], $historico->req_minimos, $historico->resultado); ?></td>
      </tr>
      <?php
	} 
		
		?>
    </table></td>
  </tr>
</table>
