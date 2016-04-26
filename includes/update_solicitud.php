<?php
include ("../seguridad.php");
include ("../db_link/conex.php");
include ("../funciones/funciones.php");
require('../lib/nusoap.php');
$cliente = new nusoap_client('http://prueba-servicios.mp.gob.ve/ws/ws.php?wsdl','wsdl');



// VERIFICAR QUE LA INFORMACION DEL FUNCIONARIO TITULAR SEA DISTINTO DE VACIO Y CORRECTA

    if (servicio_trabajador_titular($_POST['cedula'], $_POST['nombre'], $cliente) == 'f' ) {
          
       header("Location: ../template.php?ind=".md5('mod_solicitud')."&id_solicitud=".$_POST['id_solicitud']."&error=9");
    }else{

// VERIFICAR QUE LA INFORMACION DEL POSTULADO SEA DISTINTO DE VACIO Y CORRECTA

      if (servicio_trabajador_postulado($_POST['tipo'], $_POST['nacionalidad'], $_POST['cedula_postulado'], $_POST['nombre_p'], $cliente)== 'f') {
        
        header("Location: ../template.php?ind=".md5('mod_solicitud')."&id_solicitud=".$_POST['id_solicitud']."&error=10");
      }else{     

//VERIFICAR QUE LAS CEDULAS DEL TITULAR Y EL POSTULADO NO PUEDEN SER LAS MISMAS

      if($_POST['cedula'] == $_POST['cedula_postulado']){  

          header("Location: ../template.php?ind=".md5('mod_solicitud')."&id_solicitud=".$_POST['id_solicitud']."&error=4"); 
      }else{

//VERIFICA SI EL FUNCIONARIO TITULAR TIENE UNA SOLICITUD DE SUPLENCIAS ACTIVA  DISTINTA A LA SOLICITUD ACTUAL     
         
          if(funcionario_solicitud_activa_update($_POST['cedula'], $_POST['id_solicitud'], $link) == 't'){ 
  
           header("Location: ../template.php?ind=".md5('mod_solicitud')."&id_solicitud=".$_POST['id_solicitud']."&error=3");
          
          }else{

//VERIFICA SI EL POSTULADO POSEE UNA SOLICITUD DE SUPLENCIA ACTIVA DISTINTA A LA SOLICITUD ACTUAL   

           if(suplente_solicitud_activa_update($_POST['cedula_postulado'], $_POST['id_solicitud'], $link) == 't'){ 
    
             header("Location: ../template.php?ind=".md5('mod_solicitud')."&id_solicitud=".$_POST['id_solicitud']."&error=2");

            }else{


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


             }//FIN SI POSTULADO NO POSEE SOLICITUD ACTIVA     
        }//FIN SI TITULAR NO TIENE SOLICITUD ACTIVA
     }//FIN CEDULAS DE TITULAR Y POSTULADO SON DISTINTAS   */  

    }//FIN INFORMACION DEL TITULAR NO ES VACIA Y CORRECTA  
 }//FIN INFORMACION DEL POSTULADO NO ES VACIA  Y CORRECTA*/
?>
