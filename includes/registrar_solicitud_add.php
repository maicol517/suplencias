<?php
include ("../seguridad.php");
include ("../db_link/conex.php");
include ("../funciones/funciones.php");
require('../lib/nusoap.php');
$cliente = new nusoap_client('http://prueba-servicios.mp.gob.ve/ws/ws.php?wsdl','wsdl');

//echo $_POST['trabajador_id'].'<br/>'.$_POST['trabajador_id_p'];    


/*$valor=servicio_trabajador_titular($_POST['cedula'], $_POST['nombre'], $cliente);

echo $valor.'<br/>';

$valor_p=servicio_trabajador_postulado($_POST['tipo'], $_POST['nacionalidad'], $_POST['cedula_postulado'], $_POST['nombre_p'], $cliente);

echo $valor_p;*/


//CONDICION PARA SABER SI ES DISTRITO CAPITAL 

         if ($_SESSION['usu_estado_id']==1) {
           $condicion=1;
         } else {
           $condicion=2;
         }
// VERIFICAR QUE LA INFORMACION DEL FUNCIONARIO TITULAR SEA DISTINTO DE VACIO Y CORRECTA

    if (servicio_trabajador_titular($_POST['cedula'], $_POST['nombre'], $cliente) == 'f' ) {
          
       header("Location: ../template.php?ind=".md5('registrar_solicitud')."&error=9");
    }else{

// VERIFICAR QUE LA INFORMACION DEL POSTULADO SEA DISTINTO DE VACIO Y CORRECTA

      if (servicio_trabajador_postulado($_POST['tipo'], $_POST['nacionalidad'], $_POST['cedula_postulado'], $_POST['nombre_p'], $cliente)== 'f') {
        
        header("Location: ../template.php?ind=".md5('registrar_solicitud')."&error=10");
      }else{

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

                $result = pg_query($link, "select n.id, n.clasificacion_id, n.rol_aprobacion_id, n.orden, cs.condicion_id from niveles_aprobacion n
                join clasificacion_solicitud cs on cs.id=n.clasificacion_id
                where 
                rol_aprobacion_id='".$_SESSION['usu_rol_aprobacion']."' and orden='1' and condicion_id='$condicion' and n.estatus ='t' and cs.estatus='t'");


                if(pg_num_rows($result)>0){ //si existe funcionario
                       $row = pg_fetch_row($result);
                       $clasificasion_solicitud_id=$row[1];
//REGISTRAR NUEVA SOLICITUD
                    pg_query ($link, "INSERT INTO solicitud(
                                 fecha_incio, fecha_fin, 
                                motivo_id, tipo_solicitud_id, tipo_cargo_id, usuario_id, usuario_estado_id, 
                                usuario_dependencia_id, clasificacion_id, rol_aprobacion_id, estatus_solicitud, audit_usu_id, audit_ip, audit_dep_id, n_educativo, area_especialidad, experiencia, habilidades, cursos, correo)
                        VALUES ( '".fecha_usa($_POST['fecha_inicio'])."', '".fecha_usa($_POST['fecha_fin'])."', 
                                '".$_POST['m_suplencia']."', '".$_POST['t_solicitud']."', '".$_POST['t_cargo']."', '".$_SESSION['usu_id']."', '".$_SESSION['usu_estado_id']."', 
                                '".$_SESSION['usu_dependencia_id']."', '$clasificasion_solicitud_id' , '".$_SESSION['usu_rol_aprobacion']."', 'PROCESO', '".$_SESSION['usu_id']."', '".$_SERVER['REMOTE_ADDR']."', '".$_SESSION['usu_dependencia_id']."', 
                                '".$_POST['n_educativo']."', '".$_POST['a_especialidad']."', '".$_POST['experiencia']."',
                                 '".$_POST['habilidades']."', '".$_POST['cursos']."', '".$_POST['correo']."')");
            			
                             $id_sol=NULL;
                      $sql_solicitud_clasificacion = pg_query($link, "SELECT id as id_solicitud, clasificacion_id  FROM solicitud where usuario_id='".$_SESSION['usu_id']."' and estatus='t' order by id desc limit 1");

                        while($nro = pg_fetch_object($sql_solicitud_clasificacion)){ 
                         
                      
//REGISTRAR TRABAJADOR TITULAR
                            pg_query ($link, "INSERT INTO trabajador_titular(trabajador_id,
                                         solicitud_id, cedula, nombres, apellidos, 
                                        cargo_id, cargo_descripcion, dependencia_id, dependencia_descripcion, 
                                        audit_usu_id, audit_ip, audit_dep_id)
                                VALUES ( '".$_POST['trabajador_id']."','$nro->id_solicitud', '".$_POST['cedula']."', '".$_POST['nombre']."', '".$_POST['apellido']."', 
                                        '".$_POST['cargo_id']."', '".$_POST['cargo']."', '".$_POST['dependencia_id']."', '".$_POST['dependencia']."','".$_SESSION['usu_id']."', 
                                        '".$_SERVER['REMOTE_ADDR']."', '".$_SESSION['usu_dependencia_id']."')");	
                                    
                                      
//REGISTRAR SUPLENTE                     
                                         if($_POST['tipo']==1){
                                                pg_query ($link, "INSERT INTO suplente(
                                                            nacionalidad, cedula, nombres, apellidos, trabajador_id, 
                                                            descripcion, tipo_suplente_id, solicitud_id, audit_usu_id, 
                                                            audit_ip, audit_dep_id)
                                                    VALUES ( '".$_POST['nacionalidad']."', '".$_POST['cedula_postulado']."', '".$_POST['nombre_p']."', '".$_POST['apellido_p']."', '".$_POST['trabajador_id_p']."', 
                                                            '".$_POST['dependencia_p']."', '".$_POST['tipo']."', '$nro->id_solicitud',  '".$_SESSION['usu_id']."', 
                                                            '".$_SERVER['REMOTE_ADDR']."', '".$_SESSION['usu_dependencia_id']."')");  
                                          }
                                         if($_POST['tipo']==2){    
                                                pg_query ($link, "INSERT INTO suplente(
                                                            nacionalidad, cedula, nombres, apellidos, 
                                                            descripcion, tipo_suplente_id, solicitud_id, audit_usu_id, 
                                                            audit_ip, audit_dep_id)
                                                    VALUES ( '".$_POST['nacionalidad']."', '".$_POST['cedula_postulado']."', '".$_POST['nombre_p']."', '".$_POST['apellido_p']."', 
                                                            '".$_POST['dependencia_p']."', '".$_POST['tipo']."', '$nro->id_solicitud',  '".$_SESSION['usu_id']."', 
                                                            '".$_SERVER['REMOTE_ADDR']."', '".$_SESSION['usu_dependencia_id']."')");  
                                         } 
                                     
                                      add_workflow_insert($nro->id_solicitud, $nro->clasificacion_id,$link);    

                                      $id_sol=$nro->id_solicitud;                          	
                        }//FIN while
            				
                        pg_close($link);
            		
                   //header("Location: ../template.php");
                    header("Location: ../template.php?ind=".md5('registrar_archivo')."&id_solicitud=".$id_sol."");
                }else{

                   header("Location: ../template.php?ind=".md5('registrar_solicitud')."&error=1");
                   // NO EXISTE NINGUN PROCESO PARA QUE USUARIO REGISTRE SOLICITUD
                }   
             }//FIN SI POSTULADO NO POSEE SOLICITUD ACTIVA     
        }//FIN SI TITULAR NO TIENE SOLICITUD ACTIVA
     }//FIN CEDULAS DE TITULAR Y POSTULADO SON DISTINTAS 
    }//FIN INFORMACION DEL TITULAR NO ES VACIA Y CORRECTA  
 }//FIN INFORMACION DEL POSTULADO NO ES VACIA  Y CORRECTA
?>
