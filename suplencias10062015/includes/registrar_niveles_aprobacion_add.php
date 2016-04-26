<?php
include ("../seguridad.php");
include ("../db_link/conex.php");



	pg_query ($link, "INSERT INTO niveles_aprobacion(
            clasificacion_id, rol_aprobacion_id, orden,  audit_usu_id, audit_ip, 
       audit_dep_id)
    VALUES ('".$_POST['clasificacion']."', '".$_POST['rol']."', '".$_POST['orden']."', '".$_SESSION['usu_id_trabajador']."', '".$_SERVER['REMOTE_ADDR']."', '".$_SESSION['usu_dependencia_id']."')");
				
pg_close($link);
		
header("Location: ../template.php?ind=c70764f103ea9c8cc78e753848e8ca08");

?>
