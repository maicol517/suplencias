<div id="ddblueblockmenu">
                    <ul>
                        <li style="list-style: none"><a href="template.php">&nbsp; Inicio</a></li>
                    </ul>
                                <div class="menutitle">Suplencias menu</div>
                                <ul>                                   
                                              
                                     <li style="list-style: none"><a href="template.php?ind=<?php echo md5('registrar_solicitud'); ?>">&nbsp;<img src="images/vineta-peq.jpg">&nbsp;Registrar Solicitud</a></li>                                     
                                     <li style="list-style: none"><a href="template.php?ind=<?php echo md5('listado_solicitudes'); ?>">&nbsp;<img src="images/vineta-peq.jpg">&nbsp;Listado de Solicitudes</a></li> </ul>
                         
                          <?php if (($_SESSION['usu_rol_aprobacion'] > 2) and ($_SESSION['usu_rol_aprobacion'] < 5)) { ?> 
                          
                            <div class="menutitle">Autorizar </div>
                                <ul>                                       
                                     <li style="list-style: none"><a href="template.php?ind=<?php echo md5('aprobar_solicitud');// md5(2); ?>">&nbsp;<img src="images/vineta-peq.jpg">&nbsp;Aprobar Solicitud</a> </li>                           
                                </ul>  
                          <?php   } ?>   

                          <?php if ($_SESSION['usu_rol_aprobacion'] == 2)  { ?>  
                                <div class="menutitle">Devoluciones</div>
                                <ul>                                          
                                     <li style="list-style: none"><a href="template.php?ind=<?php echo md5('aprobar_solicitud'); ?>">&nbsp;<img src="images/vineta-peq.jpg">&nbsp;Solicitud Devuelta</a></li>                      
                                </ul>

                          <?php   } ?>       
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
