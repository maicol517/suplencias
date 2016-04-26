<?php
include ("../seguridad.php");
include ("../db_link/conex.php");
include ("../funciones/funciones.php");

$dir_pdf="pdf";


$tipo = $_FILES["archivo_pdf"]['type'];

$tmp = $_FILES['archivo_pdf']['tmp_name'];

if($tipo == "application/pdf"){
				$tipo = 'pdf';
				}

if ($tipo == 'pdf'){
$A_insertar_pdf = md5(uniqid(rand(), true)).".".$tipo;
		 $archivo_pdf 	= move_uploaded_file($tmp, $dir_pdf."/".$A_insertar_pdf);
		
		pg_query ($link, "INSERT INTO archivos(
             t_documento, id_solicitud, archivo)
    VALUES ( '".$_POST['t_documento']."', '".$_POST['id_solicitud']."', '$A_insertar_pdf')");	



	
header("Location: ../template.php?ind=".md5('registrar_archivo')."&id_solicitud=".$_POST['id_solicitud']);		
		 }else{
	header("Location: ../template.php?ind=".md5('registrar_archivo')."&error=8&id_solicitud=".$_POST['id_solicitud']);		 
		 }

pg_close($link);



?>
