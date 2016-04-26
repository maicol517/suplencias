<?php

include ("../seguridad.php");
include ("../db_link/conex.php");
include ("../funciones/funciones.php");


/*echo 'valor '.$_POST['aprobacion_id'].'<br/>';
echo 'valor '.$_POST['obs'].'<br/>';
echo 'id_solicitud '.$_POST['id_solicitud'].'<br/>';
echo id_historico($_POST['id_solicitud'],$link);   id_clasificacion*/


/*
echo 'maximo orden'.max_orden($_POST['id_solicitud'], $_POST['id_clasificacion'],$link).'<br/>';

echo 'orden historico'.$orden_historico = max_orden_historico($_POST['id_solicitud'], $_POST['id_clasificacion'],$link);
                   
echo '<br/>'.'Nuevo nivel'.$nuevo_nivel=new_nivel_aprobacion($_POST['id_solicitud'], $_POST['id_clasificacion'], $orden_historico, $link).'<br/>';*/

pg_query ($link, "UPDATE historico_solicitud
   SET usuario_id='".$_SESSION['usu_id']."', aprobado='".$_POST['aprobacion_id']."', observacions='".$_POST['obs']."', fecha_actualizacion=now(), audit_usu_id='".$_SESSION['usu_id']."', audit_ip='".$_SERVER['REMOTE_ADDR']."', audit_dep_id='".$_SESSION['usu_dependencia_id']."'
 WHERE solicitud_id = '".$_POST['id_solicitud']."' and id='".id_historico($_POST['id_solicitud'],$link)."'");
//pg_close($link);

switch ($_POST['aprobacion_id']) {
	case '1':
        if (max_orden($_POST['id_solicitud'], $_POST['id_clasificacion'],$link) == max_orden_historico($_POST['id_solicitud'], $_POST['id_clasificacion'],$link) ){  
     		header("Location: msj_operacion.php");
     	}else{
     		add_workflow($_POST['id_solicitud'], $_POST['id_clasificacion'],$link);
     		header("Location: msj_operacion.php");
     	}
		header("Location: msj_operacion.php");
		break;
	
	case '2':
		header("Location: msj_operacion.php");
		break;

	case '3':
	    pg_query ($link, "UPDATE historico_solicitud
   			SET devolucion='TRUE'
 			WHERE solicitud_id = '".$_POST['id_solicitud']."'");

        $nivel_aprobacion=new_min_nivel_aprobacion($_POST['id_solicitud'], $_POST['id_clasificacion'], $link);
        pg_query ($link, "INSERT INTO historico_solicitud(
                      solicitud_id, fecha, usuario_id, nivel_aprobacion_id, aprobado, 
                      observacions, fecha_actualizacion, audit_usu_id, audit_ip, 
                      audit_dep_id)
              VALUES ( '".$_POST['id_solicitud']."', now(), '".$_SESSION['usu_id']."', '$nivel_aprobacion', '0', 
                      'SOLICITUD DEVUELTA', now(), '".$_SESSION['usu_id']."', '".$_SERVER['REMOTE_ADDR']."', '".$_SESSION['usu_dependencia_id']."')");

	    //add_workflow($_POST['id_solicitud'], $_POST['id_clasificacion'],$link);
		header("Location: msj_operacion.php");
		break;	
}



      /*
      EN PROCESO = 0
      APROBADO   = 1
      NEGADO     = 2
      DEVOLVER   = 3
      */


?>


