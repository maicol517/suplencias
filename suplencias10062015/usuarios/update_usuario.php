<?php
include ("../seguridad.php");
include ("../db_link/conex.php");
include ("../funciones/funciones.php");

//VERIFICAR USUARIO SE ENCUENTRA EN EL OPEN ID


    if (isset($_POST['select2'])) {


		          pg_query ($link, "UPDATE usuarios
		   SET rol_aprobacion_id='".$_POST['rol']."', audit_usu_id='".$_SESSION['usu_id_trabajador']."', audit_ip='".$_SERVER['REMOTE_ADDR']."', 
		       audit_dep_id='".$_SESSION['usu_dependencia_id']."', estatus='".$_POST['estatus']."', dependencia_id='".$_POST['select2']."'
		 WHERE trabajador_id ='".$_POST['trabajador_id']."'");

          header("Location: ../template.php?ind=".md5('listado_usuarios')."&error=8"); 

    }else{ //

          
		          pg_query ($link, "UPDATE usuarios
		   SET rol_aprobacion_id='".$_POST['rol']."', audit_usu_id='".$_SESSION['usu_id_trabajador']."', audit_ip='".$_SERVER['REMOTE_ADDR']."', 
		       audit_dep_id='".$_SESSION['usu_dependencia_id']."', estatus='".$_POST['estatus']."'
		 WHERE trabajador_id ='".$_POST['trabajador_id']."'");

          header("Location: ../template.php?ind=".md5('listado_usuarios')."&error=9"); 

			
    
    } // FIN SELECT DEPENDENCIA SIN MODIFICAR






?>





