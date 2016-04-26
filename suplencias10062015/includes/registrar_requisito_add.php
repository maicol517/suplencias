<?php
include ("../seguridad.php");
include ("../db_link/conex.php");


	pg_query ($link, "INSERT INTO tipo_documento(
            descripcion, audit_usu_id, audit_ip, audit_dep_id)
    VALUES ('".$_POST['requisito']."', '".$_SESSION['usu_id_trabajador']."', '".$_SERVER['REMOTE_ADDR']."', '".$_SESSION['usu_dependencia_id']."')");
				
pg_close($link);
		
header("Location: ../template.php?ind=9a8f981d9f8061606bce27d750745551");

?>
