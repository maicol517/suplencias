<?php
include ("../seguridad.php");
include ("../db_link/conex.php");
include ("../funciones/funciones.php");

//VERIFICAR USUARIO SE ENCUENTRA EN EL OPEN ID

    if(usuario_open_id($_POST['cedula'],$link) == 'f'){ 

          header("Location: ../template.php?ind=".md5('registrar_usuario')."&error=6"); 
    }else{

//VERIFICAR FUNCIONARIO NO SE ENCUENTRE EN LA LISTA DE USUARIOS

    if(usuario_resgistrado($_POST['cedula'],$link) == 't'){ 

          header("Location: ../template.php?ind=".md5('registrar_usuario')."&error=5"); 
    }else{


			pg_query ($link, "INSERT INTO usuarios(
			            trabajador_id, rol_aprobacion_id,  audit_usu_id, audit_ip, 
			       audit_dep_id, dependencia_id)
			    VALUES ('".$_POST['trabajador_id']."', '".$_POST['rol']."', '".$_SESSION['usu_id_trabajador']."', '".$_SERVER['REMOTE_ADDR']."', '".$_SESSION['usu_dependencia_id']."',
			    	'".$_POST['select2']."')");

			pg_close($link);
				
			header("Location: ../template.php?ind=".md5('listado_usuarios')."");
    } // FIN REGISTRO DE USURIO   

}//FIN USUARIO SE ENCUEMNTRA EN EL OPEN ID


?>





