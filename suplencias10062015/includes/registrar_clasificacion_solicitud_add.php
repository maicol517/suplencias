<?php
include ("../seguridad.php");
include ("../db_link/conex.php");



	pg_query ($link, "INSERT INTO clasificacion_solicitud(
            descripcion,  audit_usu_id, audit_ip, 
       audit_dep_id, condicion_id)
    VALUES ('".$_POST['nombre_clasificacion']."', '".$_SESSION['usu_id_trabajador']."', '".$_SERVER['REMOTE_ADDR']."', '".$_SESSION['usu_dependencia_id']."', '".$_POST['condicion']."')");
				
pg_close($link);
		
header("Location: ../template.php?ind=af9f97516db256530d4f3eea653cf16c");

?>
