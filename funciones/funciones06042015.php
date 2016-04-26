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
		case '1':
			return $valor= '<img src="../images_icon/state_ok.png" width="16" height="16" /> Continuar el Proceso de esta Solicitud';
			break;
		case '2':
			return $valor= '<img src="../images_icon/state_stop.png" width="16" height="16" /> Rechazar el Proceso de esta Solicitud';
			break;
		case '3':
			return $valor= '<img src="../images_icon/state_skip.png" width="16" height="16" /> Devolver el Proceso de esta Solicitud';
			break;	
	}//FIN switch
}//FIN pregunta_ext

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
              where s.id='$solicitud' and cs.id='$clasificacion'
              order by hs.id desc limit 1");
                while($max_orden_historico= pg_fetch_object($sql_plantilla_mayor_historico)){ 
                 
                  return $max_orden_historico->max_orden_historico;
                }//FIN while

}//FIN max_orden_historico

//FUNCION ID HISTORICO
function id_historico($solicitud, $link){

	$sql_id_historico = pg_query($link, "select hs.id as historico_id
    	      from historico_solicitud hs
              left join solicitud s on s.id = hs.solicitud_id
              left join niveles_aprobacion n on n.id = hs.nivel_aprobacion_id
              left join clasificacion_solicitud cs on cs.id = s.clasificacion_id
              join tipo_solicitud tsol on tsol.id=s.tipo_solicitud_id
              where n.rol_aprobacion_id='".$_SESSION['usu_rol_aprobacion']."'   and hs.aprobado='0' and s.id='$solicitud'");

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
?>