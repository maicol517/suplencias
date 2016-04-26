<div id="ddblueblockmenu">
                    <ul>
                        <li style="list-style: none"><a href="template.php">&nbsp; Inicio</a></li>
                    </ul>
             <div class="menutitle">Usuarios</div>
                                <ul>       
                                                                      <li style="list-style: none"><a href="template.php?ind=<?php echo md5('registrar_usuario');// md5(2); ?>">&nbsp;<img src="images/vineta-peq.jpg">&nbsp;Registrar </a> </li>                                  
                                                                                                                                            <li style="list-style: none"><a href="template.php?ind=<?php echo md5('listado_usuarios');// md5(2); ?>">&nbsp;<img src="images/vineta-peq.jpg">&nbsp;Listado</a> </li>                                  

                                </ul>
                                
                                  <div class="menutitle">Administracion</div>
                                <ul>                                       
                                    <li style="list-style: none"><a href="template.php?ind=<?php echo md5('registrar_clasificacion_solicitud');// md5(2); ?>">&nbsp;<img src="images/vineta-peq.jpg">&nbsp;Clasificacion de Solicitud</a></li>     
                                    <li style="list-style: none"><a href="template.php?ind=<?php echo md5('registrar_niveles_aprobacion');// md5(2); ?>">&nbsp;<img src="images/vineta-peq.jpg">&nbsp;Niveles de Aprobacion</a></li>                          
                                    <li style="list-style: none"><a href="template.php?ind=<?php echo md5('registrar_motivo_solicitud');// md5(2); ?>">&nbsp;<img src="images/vineta-peq.jpg">&nbsp;Motivos de Solicitud</a></li>  
                                    <li style="list-style: none"><a href="template.php?ind=<?php echo md5('registrar_requisito');// md5(2); ?>">&nbsp;<img src="images/vineta-peq.jpg">&nbsp;Requisitos</a></li> 
                                    <li style="list-style: none"><a href="template.php?ind=<?php echo md5('registrar_area_especialidad');// md5(2); ?>">&nbsp;<img src="images/vineta-peq.jpg">&nbsp;Area Especialidad</a></li>                               
                                </ul>                                                                   
                           <div class="menutitle">Actualizar Datos</div>
                                <ul>                                       
                                     <li style="list-style: none"><a href="template.php?ind=<?php echo md5('contrasena');// md5(2); ?>">&nbsp;<img src="images/vineta-peq.jpg">&nbsp;Contraseña</a></li>                           
                                </ul>

                    <div class="menutitle">&nbsp;Servicios en Línea </div>
                    <ul>
                     <li style="list-style: none"><a href="#">&nbsp;<img src="images/vineta-peq.jpg">&nbsp;Manual de Usuario</a></li>
                        <li style="list-style: none"><a href="salir.php" onClick="return confirm('¿Está seguro que desea salir del sistema?');">&nbsp; Salir</a></li>
                    </ul>
                </div>
