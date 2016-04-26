<?php
include ("../seguridad.php");
include ("../db_link/conex.php");
include ("../funciones/funciones.php");

//MODIFICAR AREA DE ESPECIALIDAD




		          pg_query ($link, "UPDATE profesiones
   SET descripcion='".$_POST['area_especialidad']."', audit_ip='".$_SERVER['REMOTE_ADDR']."', 
		       audit_dep_id='".$_SESSION['usu_dependencia_id']."', estatus='".$_POST['estatus']."', audit_usu_id='".$_SESSION['usu_id_trabajador']."'
 WHERE id='".$_POST['area_id']."'");

          header("Location: ../template.php?ind=".md5('registrar_area_especialidad').""); 

   





?>





