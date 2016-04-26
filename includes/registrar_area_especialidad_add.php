<?php
include ("../seguridad.php");
include ("../db_link/conex.php");


	pg_query ($link, "INSERT INTO profesiones(
            descripcion, audit_usu_id, audit_ip, audit_dep_id)
    VALUES ('".$_POST['area_especialidad']."', '".$_SESSION['usu_id_trabajador']."', '".$_SERVER['REMOTE_ADDR']."', '".$_SESSION['usu_dependencia_id']."')");
				
pg_close($link);
		
header("Location: ../template.php?ind=".md5('registrar_area_especialidad').""); 

?>
