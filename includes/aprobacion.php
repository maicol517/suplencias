<?php 
include ("../seguridad.php");
include ("../db_link/conex.php");
include ("../funciones/funciones.php");
?>
<link rel="stylesheet" href="../css/css.css" type="text/css" media="all" />
 <p style="font-size:16px" align="center">Solicitud Nº <strong>SS-<?= $_GET['id_solicitud']?>-2015</strong></p>
  <table width="100%" border="0" cellspacing="1" class="tabla_proveedor_consulta">
    <tr>
      <td colspan="6" bgcolor="#BFBFBF">&nbsp;<img src="../images_icon/history.gif" width="16" height="16" />&nbsp;<strong>HISTORICO DEL CICLO</strong></td>
    </tr>
    <tr  bgcolor="#EEE" >
      <td width="47%" >Estacion:</td>
      <td width="16%">Estatus:</td>
      <td width="12%">Recibido el:</td>
      <td width="25%">Observaciones:</td>
    </tr>
    <?php
    $ciclo_historico = pg_query($link, "SELECT clasificacion_solicitud.id, clasificacion_solicitud.descripcion as clasificacion, 
rol_aprobacion.id, rol_aprobacion.descripcion as rol, orden, niveles_aprobacion.estatus as estatus,
hs.fecha, hs.aprobado, hs.observacions, hs.req_minimos, hs.resultado, hs.fecha_actualizacion, hs.devolucion
FROM niveles_aprobacion
join clasificacion_solicitud on clasificacion_solicitud.id=niveles_aprobacion.clasificacion_id
join rol_aprobacion on rol_aprobacion.id=niveles_aprobacion.rol_aprobacion_id
left join solicitud s on clasificacion_solicitud.id = s.clasificacion_id and niveles_aprobacion.clasificacion_id = s.clasificacion_id
left join historico_solicitud hs on niveles_aprobacion.id = hs.nivel_aprobacion_id and s.id = hs.solicitud_id
where niveles_aprobacion.estatus='TRUE' 
and clasificacion_solicitud.estatus='TRUE' 
and rol_aprobacion.estatus='TRUE'
and niveles_aprobacion.clasificacion_id = s.clasificacion_id
and s.id=".$_GET['id_solicitud']." and devolucion is true
union all
SELECT clasificacion_solicitud.id, clasificacion_solicitud.descripcion as clasificacion, 
rol_aprobacion.id, rol_aprobacion.descripcion as rol, orden, niveles_aprobacion.estatus as estatus,
hs.fecha, hs.aprobado, hs.observacions, hs.req_minimos, hs.resultado, hs.fecha_actualizacion, hs.devolucion
FROM niveles_aprobacion
join clasificacion_solicitud on clasificacion_solicitud.id=niveles_aprobacion.clasificacion_id
join rol_aprobacion on rol_aprobacion.id=niveles_aprobacion.rol_aprobacion_id
left join solicitud s on clasificacion_solicitud.id = s.clasificacion_id and niveles_aprobacion.clasificacion_id = s.clasificacion_id
left join historico_solicitud hs on niveles_aprobacion.id = hs.nivel_aprobacion_id and s.id = hs.solicitud_id and hs.devolucion is not true
where niveles_aprobacion.estatus='TRUE' 
and clasificacion_solicitud.estatus='TRUE' 
and rol_aprobacion.estatus='TRUE'
and niveles_aprobacion.clasificacion_id = s.clasificacion_id
and s.id=".$_GET['id_solicitud']."
order by fecha_actualizacion, orden, devolucion");   
	  while($historico = pg_fetch_object($ciclo_historico)){
		    ?>
    <tr>
      <td align="left">&nbsp;
        <?= orden_alfabetico_ext($historico->orden).$historico->rol; ?></td>
      <td align="center"><?= estatus_historico_ext($historico->aprobado); ?></td>
      <td align="center"><?= fecha_venezuela($historico->fecha); ?></td>
      <td align="center"><?= $historico->observacions; ?><?= analisis_expediente($_SESSION['usu_rol_aprobacion'], $historico->req_minimos, $historico->resultado); ?></td>
    </tr>
    <?php
	} 
		
		?>
  </table>

<?php
       $solicitud_ver = pg_query($link, "SELECT s.fecha_incio, s.fecha_fin, 
		       s.motivo_id, ms.descripcion as motivo, s.tipo_solicitud_id, s.tipo_cargo_id, tc.descripcion as tipo_cargo, s.usuario_estado_id, 
		       s.usuario_dependencia_id, s.clasificacion_id, 
		       s.n_educativo, s.area_especialidad, p.descripcion as especialidad, s.experiencia, s.habilidades, s.cursos, tt.cedula as t_cedula, tt.nombres as t_nombre, tt.apellidos as t_apellido,
		       tt.cargo_descripcion as t_cargo, tt.dependencia_descripcion as t_dependencia,
				tipo_suplente.descripcion as s_tipo, ts.nacionalidad as s_nacionalidad, ts.cedula as s_cedula, ts.nombres as s_nombre, ts.apellidos as s_apellido,
				 ts.descripcion as s_descripcion 
				  FROM solicitud s 
        join tipo_cargo tc on tc.id=s.tipo_cargo_id
        join motivo_suplencia ms on ms.id=s.motivo_id   
        join profesiones p on p.id=s.area_especialidad
				left join trabajador_titular tt on tt.solicitud_id=s.id
				left join suplente ts on ts.solicitud_id=s.id
				left join tipo_suplente on tipo_suplente.id=ts.tipo_suplente_id
				where s.id='".$_GET['id_solicitud']."' and s.estatus='t' and tt.estatus='t'"); 
	   while($ver = pg_fetch_object($solicitud_ver)){
?>
<br/>
<table width="100%" border="0" cellspacing="1" class="tabla_proveedor">
  <tr>
    <td colspan="4" bgcolor="#BFBFBF"><h2>DATOS DE LA SOLICITUD</h2></td>
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
    <td colspan="4" bgcolor="#BFBFBF"><h2>DATOS DEL TITULAR DEL CARGO</h2></td>
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
    <td colspan="4" bgcolor="#BFBFBF"><h2>REQUISITOS EXIGIDOS</h2></td>
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
    <td colspan="4" bgcolor="#BFBFBF"><h2>POSTULADO</h2></td>
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
</table>
<?php } 
	
?><form id="form1" name="form1" method="post" action="aprobacion_UPDATE.php">
<br/>
  <table align="center" width="500px" border="0" class="tabla_proveedor_consulta">
  <tr>
    <td colspan="2" align="center"><img src="../images_icon/question.png" width="32" height="32" />
      <input name="id_solicitud" type="hidden" id="id_solicitud" value="<?= $_GET['id_solicitud']; ?>" />
      <input name="id_clasificacion" type="hidden" id="id_clasificacion" value="<?= $_GET['id_clasificacion']; ?>" /></td>
    </tr>
    <?= pregunta_ext($_SESSION['usu_rol_aprobacion']); ?>

   <?= pregunta_analista($_SESSION['usu_rol_aprobacion']); ?>
    <tr>
      <td colspan="2" bgcolor="#BFBFBF"><h2>OBSERVACIONES</h2></td>
    </tr>
    <tr>
    <td>Observacion</td>
    <td style="font-size:14px; font-weight:bold;"><label for="obs"></label>
      <textarea name="obs" cols="25" rows="2" class="campotexto" id="obs" required="required"></textarea></td>
  </tr>

  </table>
<p style="text-align:center"><input  class="bottonsumit" type="submit" name="button" id="button" value="Enviar" onClick="return confirm('Esta Usted de Acuerdo con el Estatus de la Solicitud Seleccionado?' )" /></p>
</form>
