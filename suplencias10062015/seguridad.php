<?php
//Inicio la sesión
session_start();
include ("db_link/conex.php");//conexion con la base de datos

if (isset($_SESSION['autenticado']))
    {
		if ($_SESSION["autenticado"] == "si") 
			{	
	          $validar_SESSION = pg_query($link, "select * from usuarios where trabajador_id='".$_SESSION['usu_id_trabajador']."' and estatus='TRUE'");
			  if(pg_num_rows($validar_SESSION) == 0)
			   {	//si existe funcionario
	             header("Location: index.php?error=t");
                 exit();
               }
	    
            }else{
	
	           header("Location: index.php?error=t");
              exit();	
		
			}	
			
	}else{
	    header("Location: index.php?error=t");
       exit();	
	}	
	
	

?>

