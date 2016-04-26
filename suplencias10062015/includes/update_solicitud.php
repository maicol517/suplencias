<?php
include ("../seguridad.php");
include ("../db_link/conex.php");
include ("../funciones/funciones.php");

//echo $_POST['id_solicitud'];   '".$_POST['id_solicitud']."'

/*//CONDICION PARA SABER SI ES DISTRITO CAPINAL 
         if ($_SESSION['usu_estado_id']==1) {
           $condicion=1;
         } else {
           $condicion=2;
         }

//VERIFICAR QUE LAS CEDULAS DEL TITULAR Y EL POSTULADO NO PUEDEN SER LAS MISMAS

      if($_POST['cedula'] == $_POST['cedula_postulado']){  

          header("Location: ../template.php?ind=".md5('registrar_solicitud')."&error=4"); 
      }else{

//VERIFICA SI EL FUNCIONARIO TITULAR TIENE UNA SOLICITUD DE SUPLENCIAS ACTIVA     
         
          if(funcionario_solicitud_activa($_POST['cedula'],$link) == 't'){ 
  
           header("Location: ../template.php?ind=".md5('registrar_solicitud')."&error=3");
          
          }else{

//VERIFICA SI EL POSTULADO POSEE UNA SOLICITUD DE SUPLENCIA ACTIVA     

           if(suplente_solicitud_activa($_POST['cedula_postulado'],$link) == 't'){ 
    
             header("Location: ../template.php?ind=".md5('registrar_solicitud')."&error=2");

            }else{

//MODIFICAR SOLICITUD
                    pg_query ($link, "UPDATE solicitud
                                       SET fecha_incio='".fecha_usa($_POST['fecha_inicio'])."', fecha_fin='".fecha_usa($_POST['fecha_fin'])."', 
                                       motivo_id='".$_POST['m_suplencia']."', tipo_solicitud_id='".$_POST['t_solicitud']."', tipo_cargo_id='".$_POST['t_cargo']."',   audit_usu_id='".$_SESSION['usu_id']."', audit_ip='".$_SERVER['REMOTE_ADDR']."', audit_dep_id='".$_SESSION['usu_dependencia_id']."', n_educativo='".$_POST['n_educativo']."', 
                                       area_especialidad='".$_POST['a_especialidad']."', experiencia='".$_POST['experiencia']."', habilidades='".$_POST['habilidades']."', cursos='".$_POST['cursos']."'
                                       WHERE id='".$_POST['id_solicitud']."'");
            */


//MODIFICAR SOLICITUD
                    pg_query ($link, "UPDATE solicitud
                                       SET motivo_id='".$_POST['m_suplencia']."', tipo_cargo_id='".$_POST['t_cargo']."',   audit_usu_id='".$_SESSION['usu_id']."', audit_ip='".$_SERVER['REMOTE_ADDR']."', audit_dep_id='".$_SESSION['usu_dependencia_id']."', n_educativo='".$_POST['n_educativo']."', 
                                       area_especialidad='".$_POST['a_especialidad']."', experiencia='".$_POST['experiencia']."', habilidades='".$_POST['habilidades']."', cursos='".$_POST['cursos']."'
                                       WHERE id='".$_POST['id_solicitud']."'");

                    
//MODIFICAR TRABAJADOR TITULAR
                            pg_query ($link, "UPDATE trabajador_titular
                                               SET trabajador_id='".$_POST['trabajador_id']."', cedula='".$_POST['cedula']."', nombres='".$_POST['nombre']."', apellidos='".$_POST['apellido']."', 
                                               cargo_id='".$_POST['cargo_id']."', cargo_descripcion='".$_POST['cargo']."', dependencia_id='".$_POST['dependencia_id']."', dependencia_descripcion='".$_POST['dependencia']."', 
                                               audit_usu_id='".$_SESSION['usu_id']."', audit_ip='".$_SERVER['REMOTE_ADDR']."', audit_dep_id='".$_SESSION['usu_dependencia_id']."'
                                               WHERE solicitud_id='".$_POST['id_solicitud']."' ");	

                                                              
                                      
//MODIFICAR SUPLENTE                     
                                         if($_POST['tipo']==1){
                                                pg_query ($link, "UPDATE suplente
                                                                   SET nacionalidad='".$_POST['nacionalidad']."', cedula='".$_POST['cedula_postulado']."', nombres='".$_POST['nombre_p']."', apellidos='".$_POST['apellido_p']."', trabajador_id='".$_POST['trabajador_id_p']."', 
                                                                   descripcion='".$_POST['dependencia_p']."', tipo_suplente_id='".$_POST['tipo']."', audit_usu_id='".$_SESSION['usu_id']."', audit_ip='".$_SERVER['REMOTE_ADDR']."', 
                                                                   audit_dep_id='".$_SESSION['usu_dependencia_id']."' WHERE solicitud_id='".$_POST['id_solicitud']."'");  
                                         }
                                        
                                         if($_POST['tipo']==2){    
                                                pg_query ($link, "UPDATE suplente
                                                                   SET nacionalidad='".$_POST['nacionalidad']."', cedula='".$_POST['cedula_postulado']."', nombres='".$_POST['nombre_p']."', apellidos='".$_POST['apellido_p']."', 
                                                                   descripcion='".$_POST['dependencia_p']."', tipo_suplente_id='".$_POST['tipo']."', audit_usu_id='".$_SESSION['usu_id']."', audit_ip='".$_SERVER['REMOTE_ADDR']."', 
                                                                   audit_dep_id='".$_SESSION['usu_dependencia_id']."' WHERE solicitud_id='".$_POST['id_solicitud']."'");  
                                         } 
                                     
                                                       	

            				
                  header("Location: ../template.php");
            		 /*
                   header("Location: ../template.php");
                }else{

                   header("Location: ../template.php?ind=".md5('registrar_solicitud')."&error=1");
                   // NO EXISTE NINGUN PROCESO PARA QUE USUARIO REGISTRE SOLICITUD
                }   
             }//FIN SI POSTULADO NO POSEE SOLICITUD ACTIVA     
        }//FIN SI TITULAR NO TIENE SOLICITUD ACTIVA
     }//FIN CEDULAS DE TITULAR Y POSTULADO SON DISTINTAS   */  
?>
