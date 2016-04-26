<?php 

/********************* FUNCIONES **************************************/
//FUNCION QUE CALCULA DIAS TRANSCURRIDOS ENTRE DOS FECHAS
function dias_transcurridos($fecha_i,$fecha_f)
{
	$dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
	$dias 	= abs($dias); $dias = floor($dias);		
	return $dias;
}//FIN dias_transcurridos

//FUNCION FECHA VENEZUELA 03-12-2015
function fecha_venezuela($fecha)
{
	if ($fecha == '') {
		return NULL;
	
	} else {
		$porciones = explode("-", $fecha);	
	    $fecha_s= $porciones[2].'-'.$porciones[1].'-'.$porciones[0];
	    return $fecha_s;
	}
}//FIN fecha_venezuela

//FUNCION FECHA ESTADOS UNIDOS 2015/12/03
function fecha_usa($fecha)
{
	$porciones = explode("/", $fecha);	
	$fecha_s= $porciones[2].'/'.$porciones[1].'/'.$porciones[0];
	return $fecha_s;
}//FIN fecha_usa

//FUNCION ENCRIPTAR
function encrypt($cad,$llave)
{
	$long		= strlen($cad);
	$long_lla	= strlen($llave);
	
	for($i=0;$i<$long;$i++)
	{
		$asc	= ord($cad[$i]);
	}
	$sum=0;
	
	for($i=0;$i<$long_lla;$i++)
	{
		
		$asc_lla	= ord($llave[$i]);
		$sum		= $sum+(($asc_lla*4)/3); 
		
	}
	$cad_enc='';
	for($i=0;$i<$long;$i++)
	{
		$asc_enc	= ord($cad[$i])+$sum;
		$enc		= chr($asc_enc);	 
		$cad_enc	.= $enc;
	}
	$cad_enc	= base64_encode($cad_enc);
	return $cad_enc;
	
}//FIN encrypt

//FUNCION DESENCRIPTAR
function decrypt($cad_des,$llave)
{
	$cadena		= base64_decode($cad_des);
	$long_lla	= strlen($llave);
	$long_des	= strlen($cadena);
	$sum		= 0;
	for($i=0;$i<$long_lla;$i++)
	{
		$asc_lla	= ord($llave[$i]);
		$sum		= $sum+(($asc_lla*4)/3); 
	}
	$cad_ori = '';
	for($i=0;$i<$long_des;$i++)
	{
		$asc_cad_des	= ord($cadena[$i])-$sum;
		$cad_ori		.=	chr($asc_cad_des);
	}
	return $cad_ori;
}//FIN decrypt

//FUNCION QUE MUESTRA IMAGEN 
function estatus_historico_img($valor){

	switch ($valor) {
		case '0':
			return $valor= '<img src="images_icon/state_wait.gif" width="12" height="12" title="EN PROCESO" />EN PROCESO';
			break;
		case '1':
			return $valor= '<img src="images_icon/state_ok.png" width="12" height="12" title="APROBADO" /> APROBADO';
			break;
		case '2':
			return $valor= '<img src="images_icon/state_stop.png" width="12" height="12" title="RECHAZADO" />RECHAZADO';
			break;
		case '3':
			return $valor= '<img src="images_icon/state_skip.png" width="12" height="12" title="DEVUELTO" /> DEVUELTO';
			break;	
	}//FIN switch
}//FIN estatus_historico_img

//FUNCION QUE MUESTRA IMAGEN Y DESCRIPCION DEL ESTATUS DEL WORKFLOW
function estatus_historico($valor){

	switch ($valor) {
		case '0':
			return $valor= '<img src="images_icon/state_wait.gif" width="16" height="16" /> EN PROCESO';
			break;
		case '1':
			return $valor= '<img src="images_icon/state_ok.png" width="16" height="16" /> APROBADO';
			break;
		case '2':
			return $valor= '<img src="images_icon/state_stop.png" width="16" height="16" /> RECHAZADO';
			break;
		case '3':
			return $valor= '<img src="images_icon/state_skip.png" width="16" height="16" /> DEVUELTO';
			break;	
	}//FIN switch
}//FIN estatus_historico

//FUNCION QUE MUESTRA IMAGEN Y DESCRIPCION DEL ESTATUS DEL WORKFLOW
function estatus_historico_ext($valor){

	switch ($valor) {
		case '0':
			return $valor= '<img src="../images_icon/state_wait.gif" width="16" height="16" /> EN PROCESO';
			break;
		case '1':
			return $valor= '<img src="../images_icon/state_ok.png" width="16" height="16" /> APROBADO';
			break;
		case '2':
			return $valor= '<img src="../images_icon/state_stop.png" width="16" height="16" /> RECHAZADO';
			break;
		case '3':
			return $valor= '<img src="../images_icon/state_skip.png" width="16" height="16" /> DEVUELTO';
			break;	
	}//FIN switch
}//FIN estatus_historico_ext

function pregunta_ext($valor){

	switch ($valor) {
				case '2':
			return $valor= '<tr>
			    <td width="95%" style="font-size:14px; font-weight:bold;" colspan="2"><input name="aprobacion_id" type="radio"  value="1" />
			    <img src="../images_icon/state_ok.png" width="16" height="16" /> Continuar el Proceso de esta Solicitud</td>
			  </tr>
              <tr>
			    <td width="95%" style="font-size:14px; font-weight:bold;" colspan="2"><input name="aprobacion_id" type="radio"  value="2" />
			    <img src="../images_icon/state_stop.png" width="16" height="16" /> Rechazar el Proceso de esta Solicitud</td>
			  </tr>
			  ';
			break;

		case '3':
			return $valor= '<tr>
			    <td width="95%" style="font-size:14px; font-weight:bold;" colspan="2"><input name="aprobacion_id" type="radio"  value="1" />
			    <img src="../images_icon/state_ok.png" width="16" height="16" /> Continuar el Proceso de esta Solicitud</td>
			  </tr>
              <tr>
			    <td width="95%" style="font-size:14px; font-weight:bold;" colspan="2"><input name="aprobacion_id" type="radio"  value="2" />
			    <img src="../images_icon/state_stop.png" width="16" height="16" /> Rechazar el Proceso de esta Solicitud</td>
			  </tr>
			  ';
			break;

		case '4':
			return $valor= '<tr>
			    <td width="95%" style="font-size:14px; font-weight:bold;" colspan="2"><input name="aprobacion_id" type="radio"  value="1" />
			    <img src="../images_icon/state_ok.png" width="16" height="16" /> Aprobar el Proceso de esta Solicitud</td>
			  </tr>
              <tr>
			    <td width="95%" style="font-size:14px; font-weight:bold;" colspan="2"><input name="aprobacion_id" type="radio"  value="2" />
			    <img src="../images_icon/state_stop.png" width="16" height="16" /> Rechazar el Proceso de esta Solicitud</td>
			  </tr>
			  <tr>
			    <td width="95%" style="font-size:14px; font-weight:bold;" colspan="2"><input name="aprobacion_id" type="radio"  value="3" />
			    <img src="../images_icon/state_skip.png" width="16" height="16" /> Devolver el Proceso de esta Solicitud</td>
			  </tr>
			  ';
			break;		

		case '5':
			return $valor= '<tr>
			    <td width="95%" style="font-size:14px; font-weight:bold;" colspan="2"><input name="aprobacion_id" type="radio"  value="1" />
			    <img src="../images_icon/state_ok.png" width="16" height="16" /> Continuar el Proceso de esta Solicitud</td>
			  </tr>
              <tr>
			    <td width="95%" style="font-size:14px; font-weight:bold;" colspan="2"><input name="aprobacion_id" type="radio"  value="2" />
			    <img src="../images_icon/state_stop.png" width="16" height="16" /> Rechazar el Proceso de esta Solicitud</td>
			  </tr>
			  <tr>
			    <td width="95%" style="font-size:14px; font-weight:bold;" colspan="2"><input name="aprobacion_id" type="radio"  value="3" />
			    <img src="../images_icon/state_skip.png" width="16" height="16" /> Devolver el Proceso de esta Solicitud</td>
			  </tr>
			  ';
			break;	

		case '6':
			return $valor= '<tr>
			    <td width="95%" style="font-size:14px; font-weight:bold;" colspan="2"><input name="aprobacion_id" type="radio"  value="1" />
			    <img src="../images_icon/state_ok.png" width="16" height="16" /> Aprobar el Proceso de esta Solicitud</td>
			  </tr>
              <tr>
			    <td width="95%" style="font-size:14px; font-weight:bold;" colspan="2"><input name="aprobacion_id" type="radio"  value="2" />
			    <img src="../images_icon/state_stop.png" width="16" height="16" /> Rechazar el Proceso de esta Solicitud</td>
			  </tr>
			  ';
			break;		
		
	}//FIN switch
}//FIN pregunta_ext

function pregunta_analista($valor){

	switch ($valor) {


		case '5':
			return $valor= '
			    <tr>
      <td colspan="2" bgcolor="#BFBFBF"><h2>ANÁLISIS DEL EXPEDIENTE</h2></td>
    </tr><tr>
    <td>Requisitos Minimos</td>
    <td style="font-size:14px; font-weight:bold;"><label for="obs"></label>
      <textarea name="obs_requisito" cols="25" rows="2" class="campotexto" id="obs_requisito" required="required"></textarea></td>
  </tr>
  <tr>
    <td>Resultado</td>
    <td style="font-size:14px; font-weight:bold;"><label for="obs"></label>
      <textarea name="obs_resultado" cols="25" rows="2" class="campotexto" id="obs_resultado" required="required"></textarea></td>
  </tr>';
			break;	

		case '6':
			return $valor= '<tr>
      <td colspan="2" bgcolor="#BFBFBF"><h2>ANÁLISIS DEL EXPEDIENTE</h2></td>
    </tr><tr>
    <td>Requisitos Minimos</td>
    <td style="font-size:14px; font-weight:bold;"><label for="obs"></label>
      <textarea name="obs_requisito" cols="25" rows="2" class="campotexto" id="obs_requisito" required="required"></textarea></td>
  </tr>
  <tr>
    <td>Resultado</td>
    <td style="font-size:14px; font-weight:bold;"><label for="obs"></label>
      <textarea name="obs_resultado" cols="25" rows="2" class="campotexto" id="obs_resultado" required="required"></textarea></td>
  </tr>';
			break;		
		
	}//FIN switch
}//FIN pregunta_analista

function analisis_expediente($rol_id, $requisito,$resultado){
   
 if (($rol_id == 5) || ($rol_id == 6)){ 
        
        if (($requisito != '') && ($resultado != '')){
      return '<br/><strong>Requisitos Minimos : </strong>'.$requisito.'<br/><strong>Resultado : </strong>'.$resultado;
        }
     
          }

}//FIN usuario_open_id



//FUNCION QUE MUESTRA EN UN SELECT LISTADO DE ESTADOS
function generaSelect()
{
	include ("db_link/conex.php");
	
	$consulta=pg_query("
    SELECT id, descripcion
    FROM estados_v");
	
	

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='select1' id='select1' class='campotexto' onChange='cargaContenido(this.id)' required='required'>";
	echo "<option value='0'>Selecciona el Estado</option>";
	
	while($registro=pg_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}
	echo "</select>";
}//FIN generaSelect


//FUNCION QUE INDICA UNA IMAGEN CON LOS NUMEROS DE ORDEN
function orden_alfabetico($orden)
{
	 switch ($orden) {

		case '1':
		   
			return $valor= '<img src="images/bt_1.png" width="30" height="30" />';
			
			break;	
		   
		case '2':
		   
			return $valor= '<img src="images/bt_2.png" width="30" height="30" />';
			
			break;		
		case '3':
		   
			return $valor= '<img src="images/bt_3.png" width="30" height="30" />';
			
			break;		
		case '4':
		   
			return $valor= '<img src="images/bt_4.png" width="30" height="30" />';
			
			break;		
		
		case '5':
		   
			return $valor= '<img src="images/bt_5.png" width="30" height="30" />';
			
			break;		
		case '6':
		   
			return $valor= '<img src="images/bt_6.png" width="30" height="30" />';
			
			break;		
		case '7':
		   
			return $valor= '<img src="images/bt_7.png" width="30" height="30" />';
			
			break;		
    }//FIN switch
}//FIN orden_alfabetico

//FUNCION QUE INDICA UNA IMAGEN CON LOS NUMEROS DE ORDEN
function orden_alfabetico_ext($orden)
{
	 switch ($orden) {

		case '1':
		   
			return $valor= '<img src="../images/bt_1.png" width="30" height="30" />';
			
			break;	
		   
		case '2':
		   
			return $valor= '<img src="../images/bt_2.png" width="30" height="30" />';
			
			break;		
		case '3':
		   
			return $valor= '<img src="../images/bt_3.png" width="30" height="30" />';
			
			break;		
		case '4':
		   
			return $valor= '<img src="../images/bt_4.png" width="30" height="30" />';
			
			break;		
		
		case '5':
		   
			return $valor= '<img src="../images/bt_5.png" width="30" height="30" />';
			
			break;		
		case '6':
		   
			return $valor= '<img src="../images/bt_6.png" width="30" height="30" />';
			
			break;		
		case '7':
		   
			return $valor= '<img src="../images/bt_7.png" width="30" height="30" />';
			
			break;		
    }//FIN switch
}//FIN orden_alfabetico_ext

//FUNCION QUE DA VALOR BOOLEANO
function valor_booleano($valor){
	if ($valor == 1){
		
		$valor_s='t';
	
	}else{
	    
		$valor_s='f';
    }
	
	return $valor_s;
}//FIN valor_booleano

//FUNCION MAXIMO ORDEN WORKFLOW EN ESA SOLICITUD
function max_orden($solicitud, $clasificacion,$link){

    $sql_plantilla_mayor = pg_query($link, "select MAX(n.orden) as max_orden
              from solicitud s
              left join clasificacion_solicitud cs on cs.id = s.clasificacion_id
              left join niveles_aprobacion n on n.clasificacion_id = s.clasificacion_id
              where s.id='$solicitud' and cs.id='$clasificacion'");
                while($max_orden= pg_fetch_object($sql_plantilla_mayor)){ 
                 
                  return $max_orden->max_orden;
                }//FIN while
}//FIN max_orden

//FUNCION MAXIMO ORDEN EN EL HISTORICO DE WORKFLOW DE ESA SOLICITUD 
function max_orden_historico($solicitud, $clasificacion,$link){

    $sql_plantilla_mayor_historico = pg_query($link, "select n.orden as max_orden_historico
              from historico_solicitud hs
              left join solicitud s on s.id = hs.solicitud_id
              left join niveles_aprobacion n on n.id = hs.nivel_aprobacion_id
              left join clasificacion_solicitud cs on cs.id = s.clasificacion_id
              where s.id='$solicitud' and cs.id='$clasificacion' and hs.devolucion='f'
              order by hs.id desc limit 1");
                while($max_orden_historico= pg_fetch_object($sql_plantilla_mayor_historico)){ 
                 
                  return $max_orden_historico->max_orden_historico;
                }//FIN while

}//FIN max_orden_historico

//FUNCION ESTATUS ACTUAL
function estatus_actual($solicitud, $clasificacion,$link){

    $sql_estatus_actual = pg_query($link, "select n.orden as max_orden_historico, solicitud_id, aprobado as estatus_actual
              from historico_solicitud hs
              left join solicitud s on s.id = hs.solicitud_id
              left join niveles_aprobacion n on n.id = hs.nivel_aprobacion_id
              left join clasificacion_solicitud cs on cs.id = s.clasificacion_id
              where s.id='$solicitud' and cs.id='$clasificacion'  and hs.devolucion='f'
              order by hs.id desc limit 1");
                while($estatus_actual= pg_fetch_object($sql_estatus_actual)){ 
                 
                  return $estatus_actual->estatus_actual;
                }//FIN while

}//FIN estatus_actual

//FUNCION ID HISTORICO
function id_historico($solicitud, $link){

	$sql_id_historico = pg_query($link, "select hs.id as historico_id
    	      from historico_solicitud hs
              left join solicitud s on s.id = hs.solicitud_id
              left join niveles_aprobacion n on n.id = hs.nivel_aprobacion_id
              left join clasificacion_solicitud cs on cs.id = s.clasificacion_id
              join tipo_solicitud tsol on tsol.id=s.tipo_solicitud_id
              where n.rol_aprobacion_id='".$_SESSION['usu_rol_aprobacion']."' and hs.aprobado='0' and s.id='$solicitud' and hs.devolucion='f'");

    /*$sql_id_historico = pg_query($link, "select hs.id as historico_id
    	      from historico_solicitud hs
              left join solicitud s on s.id = hs.solicitud_id
              left join niveles_aprobacion n on n.id = hs.nivel_aprobacion_id
              left join clasificacion_solicitud cs on cs.id = s.clasificacion_id
              join tipo_solicitud tsol on tsol.id=s.tipo_solicitud_id
              where n.rol_aprobacion_id='".$_SESSION['usu_rol_aprobacion']."' and s.usuario_dependencia_id='".$_SESSION['usu_dependencia_id']."'  and hs.aprobado='0' and s.id='$solicitud'");*/
                while($id_historico= pg_fetch_object($sql_id_historico)){ 
                 
                  return $id_historico->historico_id;
                }//FIN while
}//FIN id_historico


//
function new_nivel_aprobacion($solicitud, $clasificacion, $orden, $link){
   
    $sql_new_nivel_aprobacion = pg_query($link, "select n.id as id_nivel_aprobacion
              from solicitud s
              left join clasificacion_solicitud cs on cs.id = s.clasificacion_id
              left join niveles_aprobacion n on n.clasificacion_id = s.clasificacion_id
              where s.id='$solicitud' and cs.id='$clasificacion' and orden > '$orden'
              order by n.orden asc limit 1");
                while($nivel_new= pg_fetch_object($sql_new_nivel_aprobacion)){ 
                 
                  return $nivel_new->id_nivel_aprobacion;
                }//FIN while

}//FIN new_nivel_aprobacion

function new_min_nivel_aprobacion($solicitud, $clasificacion, $link){
   
    $sql_new_min_nivel_aprobacion = pg_query($link, "select n.id as id_nivel_aprobacion, n.orden
              from solicitud s
              left join clasificacion_solicitud cs on cs.id = s.clasificacion_id
              left join niveles_aprobacion n on n.clasificacion_id = s.clasificacion_id
              where s.id='$solicitud' and cs.id='$clasificacion'
              order by n.orden asc limit 1");
                while($nivel_new_min= pg_fetch_object($sql_new_min_nivel_aprobacion)){ 
                 
                  return $nivel_new_min->id_nivel_aprobacion;
                }//FIN while

}//FIN new_min_nivel_aprobacion

//FUNCION INSERTA NUEVO WORKFLOW CUNADO EMPIEZA UN PROCESO
function add_workflow_insert($solicitud, $clasificacion,$link)
{

      /*
      EN PROCESO = 0
      APROBADO   = 1
      NEGADO     = 2
      DEVOLVER   = 3
      */

   // INSERTAR EL PRIMER WORKFLOW *nivel aprobacion


    $sql_nivel_aprobacion = pg_query($link, "select s.id as id_solicitud, cs.id as id_clasificacion, cs.descripcion as descripcion_clasificacion, 
      n.id as id_nivel_aprobacion, n.rol_aprobacion_id, n.orden as orden
    from solicitud s
    left join clasificacion_solicitud cs on cs.id = s.clasificacion_id
    left join niveles_aprobacion n on n.clasificacion_id = s.clasificacion_id
    where s.id='$solicitud' and cs.id='$clasificacion'
    order by n.orden asc limit 1");

      while($nivel= pg_fetch_object($sql_nivel_aprobacion)){ 

          pg_query ($link, "INSERT INTO historico_solicitud(
                      solicitud_id, fecha, usuario_id, nivel_aprobacion_id, aprobado, 
                      observacions, fecha_actualizacion, audit_usu_id, audit_ip, 
                      audit_dep_id)
              VALUES ( '$solicitud', now(), '".$_SESSION['usu_id']."', '$nivel->id_nivel_aprobacion', '1', 
                      'INGRESO NUEVO', now(), '".$_SESSION['usu_id']."', '".$_SERVER['REMOTE_ADDR']."', '".$_SESSION['usu_dependencia_id']."')");


           // CONSULTA EL ORDEN MAYOR DE SU WORKFLOW CLASIFICACION  FUNCION "max_orden($solicitud, $clasificacion)"
          
           if (max_orden($solicitud, $clasificacion,$link) >=2 ){
                   $orden_historico = max_orden_historico($solicitud, $clasificacion,$link);
                   $nuevo_nivel=new_nivel_aprobacion($solicitud, $clasificacion, $orden_historico, $link);

		                pg_query ($link, "INSERT INTO historico_solicitud(
		                 solicitud_id, fecha, usuario_id, nivel_aprobacion_id, aprobado, 
		                observacions, fecha_actualizacion, audit_usu_id, audit_ip, 
		                audit_dep_id)
		        VALUES ( '$solicitud', now(), NULL, '$nuevo_nivel', '0', 
		                'AUTOMATICO', now(), NULL, NULL, NULL)");

            }//FIN if

      }//FIN while

}// FIN add_workflow_insert

//FUNCION INSERT WORKFLOW
function add_workflow($solicitud, $clasificacion,$link)
{

      /*
      EN PROCESO = 0
      APROBADO   = 1
      NEGADO     = 2
      DEVOLVER   = 3
      */

           // CONSULTA SI EL MAXIMO ORDEN DE LA CLASIFICACION EN MAYOR O IGUAL AL ACTUAL
          
           if (max_orden($solicitud, $clasificacion,$link) >= max_orden_historico($solicitud, $clasificacion,$link) ){
                   $orden_historico = max_orden_historico($solicitud, $clasificacion,$link);
                   $nuevo_nivel=new_nivel_aprobacion($solicitud, $clasificacion, $orden_historico, $link);

		                pg_query ($link, "INSERT INTO historico_solicitud(
		                 solicitud_id, fecha, usuario_id, nivel_aprobacion_id, aprobado, 
		                observacions, fecha_actualizacion, audit_usu_id, audit_ip, 
		                audit_dep_id)
		        VALUES ( '$solicitud', now(), NULL, '$nuevo_nivel', '0', 
		                'AUTOMATICO', now(), NULL, NULL, NULL)");

            }//FIN if

   

}// FIN add_workflow


function funcionario_solicitud_activa($cedula_titular, $link){
   
    $sql_funcionario_solicitud_activa = pg_query($link, "SELECT s.id, tt.cedula, s.fecha_incio, s.fecha_fin FROM solicitud s
	join trabajador_titular tt on s.id=tt.solicitud_id
	where cedula='$cedula_titular' and now() <= fecha_fin ");

               if(pg_num_rows($sql_funcionario_solicitud_activa)>0){ //si existe funcionario
               	 	return 't';
               	}else{
               		return 'f';	
               	} 

}//FIN funcionario_solicitud_activa


function funcionario_solicitud_activa_update($cedula_titular, $solicitud_id, $link){  
   
    $sql_funcionario_solicitud_activa = pg_query($link, "SELECT s.id, tt.cedula, s.fecha_incio, s.fecha_fin FROM solicitud s
	join trabajador_titular tt on s.id=tt.solicitud_id
	where cedula='$cedula_titular' and s.id <> '$solicitud_id' and now() <= fecha_fin ");

               if(pg_num_rows($sql_funcionario_solicitud_activa)>0){ //si existe funcionario
               	 	return 't';
               	}else{
               		return 'f';	
               	} 

}//FIN funcionario_solicitud_activa_update

function suplente_solicitud_activa($cedula_suplente, $link){
   
    $sql_suplente_solicitud_activa = pg_query($link, "SELECT s.id, su.cedula, s.fecha_incio, s.fecha_fin FROM solicitud s
join suplente su on s.id=su.solicitud_id
where cedula='$cedula_suplente' and now() <= fecha_fin");

               if(pg_num_rows($sql_suplente_solicitud_activa)>0){ //si existe funcionario
               	 	return 't';
               	}else{
               		return 'f';	
               	} 

}//FIN suplente_solicitud_activa

function suplente_solicitud_activa_update($cedula_suplente, $solicitud_id, $link){
   
    $sql_suplente_solicitud_activa = pg_query($link, "SELECT s.id, su.cedula, s.fecha_incio, s.fecha_fin FROM solicitud s
join suplente su on s.id=su.solicitud_id
where cedula='$cedula_suplente'  and s.id <> '$solicitud_id' and now() <= fecha_fin");

               if(pg_num_rows($sql_suplente_solicitud_activa)>0){ //si existe funcionario
               	 	return 't';
               	}else{
               		return 'f';	
               	} 

}//FIN suplente_solicitud_activa_update

function error($valor){

  switch ($valor) {
  	case '1':
  		return 'NO EXISTE NINGUN PROCESO PARA QUE USUARIO REGISTRE UNA SOLICITUD DE SUPLENCIA';
  	break;

  	case '2':
  		return 'EL POSTULADO POSEE UNA SOLICITUD DE SUPLENCIA ACTIVA ';
  	break;

  	case '3':
  		return 'EL FUNCIONARIO TITULAR TIENE UNA SOLICITUD DE SUPLENCIAS ACTIVA';
  	break;

  	case '4':
  		return 'LAS CEDULAS DEL TITULAR Y EL POSTULADO NO PUEDEN SER LAS MISMAS';
  	break;

  	case '5':
  		return 'USUARIO SE ENCUENTRA REGISTRADO EN EL SISTEMA';
  	break;

  	case '6':
  		return 'FUNCIONARIO NO SE ENCUENTRA REGISTRADO EN EL OPEN ID COMUNICARSE AL 0212-5099999';
  	break;

  	case '7':
  		return 'USUARIO Y CONTRASEÑA INCORRECTOS';
  	break;

  	case '8':
  		return 'EL UNICO FORMATO PERMITIDO ES PDF';
  	break;

  	case '9':
  		return 'LA INFORMACION DEL FUNCIONARIO TITULAR ES INCORRECTA';
  	break;

  	case '10':
  		return 'LA INFORMACION DEL POSTULADO ES INCORRECTA';
  	break;

  	default:
  		return 'Error no Registrado en el Sistema';
  	break;
  }

}

function usuario_resgistrado($cedula_usuario, $link){
   
    $sql_usuario_activo = pg_query($link, "SELECT login, trabajadores.cedula, trabajadores.nombres, 
		 	trabajadores.apellidos, rol_aprobacion.descripcion as rol, usuarios.dependencia_id, d.descripcion as dependencia, d.estado_id, d.estado_descripcion as estado
		  FROM open_id.users 
		join trabajadores on trabajadores.cedula=open_id.users.cedula
		join usuarios on usuarios.trabajador_id=trabajadores.id 
		join rol_aprobacion on rol_aprobacion.id=usuarios.rol_aprobacion_id
		join dependencias d on d.id=usuarios.dependencia_id
		where open_id.users.suspended='f' and usuarios.estatus='t' and trabajadores.cedula='$cedula_usuario'");

               if(pg_num_rows($sql_usuario_activo)>0){ //si existe funcionario
               	 	return 't';
               	}else{
               		return 'f';	
               	} 

}//FIN usuario_resgistrado

function usuario_open_id($cedula, $link){
   
    $sql_usuario_open_id = pg_query($link, "SELECT id 
  FROM open_id.users where cedula='$cedula'");

               if(pg_num_rows($sql_usuario_open_id)>0){ //si existe funcionario
               	 	return 't';
               	}else{
               		return 'f';	
               	} 

}//FIN usuario_open_id



function servicio_trabajador_titular($cedula, $nombre, $cliente){

	$parametro=array('cedula'=>$cedula);

	$respuesta=$cliente->call('consultarTrabajador',$parametro);

		if (($respuesta[0]['nombres']==$nombre) and ($respuesta[0]['cedula']==$cedula)){
 
 			 return 't';

				}else{

			 return 'f';
        }

}

function servicio_trabajador_postulado($tipo, $nacionalidad, $cedula, $nombre, $cliente){

   switch ($tipo) {

	// CASO #1 SERVICIO consultarTrabajador  
	case 1:	
	$parametro=array('cedula'=>$cedula);	
	$respuesta=$cliente->call('consultarTrabajador',$parametro);  

	        if (($respuesta[0]['nombres']==$nombre) and ($respuesta[0]['cedula']==$cedula)){
	 
	 			 return 't';

					}else{

				 return 'f';
	        }
	break;	

	//CASO #2 SERVICIO consultarNacionalidad 
		
	case 2:	
	$parametro2=array('cedula'=>$cedula, 'nacionalidad'=>$nacionalidad);
	$respuesta2=$cliente->call('consultarNacionalidad',$parametro2);

	        if (($respuesta2[0]['nombres']==$nombre) and ($respuesta2[0]['cedula']==$cedula)){
	 
	 			 return 't';

					}else{

				 return 'f';
	        }
			
	break;	

   }//FIN CASO TIPO
}//FIN FUNCION servicio_trabajador_postulado



?>