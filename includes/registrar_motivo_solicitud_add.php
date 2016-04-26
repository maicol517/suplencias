<?php
include ("../seguridad.php");
include ("../db_link/conex.php");

	pg_query ($link, "INSERT INTO motivo_suplencia(
             descripcion,  audit_usu_id, audit_ip, audit_dep_id)
    VALUES ('".$_POST['nombre_motivo']."', '".$_SESSION['usu_id_trabajador']."', '".$_SERVER['REMOTE_ADDR']."', '".$_SESSION['usu_dependencia_id']."')");
				
pg_close($link);
		
header("Location: ../template.php?ind=ceffaedde48d26b79df3472eee7fa42c");

?>
