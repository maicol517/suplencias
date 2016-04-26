<?php 
include ("seguridad.php");
include ("db_link/conex.php");


include ("funciones/funciones.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/css.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/menu.css" type="text/css" media="all" />
<!--  SELECT DEPENDIENTES-->
<script type="text/javascript" src="js/select_dependientes_3_niveles.js"></script>
<!--  POPOP -->
<script src="js/mootools.js" type="text/javascript"></script>
<script src="js/sexylightbox.packed.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/sexylightbox.css" type="text/css" media="all" />

<script type="text/javascript">
  window.addEvent('domready', function(){
    new SexyLightBox();
    new SexyLightBox({find:'sexywhite',color:'white', OverlayStyles:{'background-color':'#000'}});
  });
</script>



<title>Ministerio Público | Suplencias</title>

</head>
<body>
<table width="900px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td height="124" colspan="2" background="images/banner_limpio.jpg"><table width="100%" border="0" cellspacing="0">
      <tr align="right">
        <td width="54%">&nbsp;</td>
        <td width="46%">&nbsp;</td>
      </tr>
      <tr align="right">
        <td height="22">&nbsp;</td>
        <td><span class="titulo_index"><?php echo $_SESSION['usu_nombres'].' '.$_SESSION['usu_apellidos']; ?></span></td>
      </tr>
      <tr align="right">
        <td>&nbsp;</td>
        <td><span class="titulo_index"><?php echo $_SESSION['usu_dependencia']; ?></span></td>
      </tr>
      <tr align="right">
        <td>&nbsp;</td>
        <td><span class="titulo_index"><?php echo $_SESSION['usu_estado']; ?></span></td>
      </tr>
      <tr align="right">
        <td>&nbsp;</td>
        <td><span class="titulo_index"><?php echo $_SESSION['usu_rol_aprobacion_descripcion']; ?></span></td>
      </tr>
       <tr align="right">
        <td>&nbsp;</td>
        <td><span class="titulo_index"><?php echo $_SESSION['usu_dependencia_id'].'usuario id ='.$_SESSION['usu_id'].' rol id ='.$_SESSION['usu_rol_aprobacion'].' estado id =' .$_SESSION['usu_estado_id']; ?></span></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td class="titulo_index"> modulo de tramites internos 
</td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td class="titulo_index">&nbsp;</td>
  </tr>
  <tr>
    <td width="147" align="left" valign="top">
    
   <?php  
   switch ($_SESSION['usu_rol_aprobacion']) {
	   
		case '1':
		
		   include("menu/menu_1.php"); 
				
		break;	
		
		case '2':
		
		   include("menu/menu_3.php"); 
				
		break;	
		case '3':
		
		   include("menu/menu_3.php"); 
				
		break;		
		case '4':
		
		   include("menu/menu_3.php"); 
				
		break;	
		
		case '5':
		
		   include("menu/menu_5.php"); 
				
		break;	
		case '6':
		
		   include("menu/menu_5.php"); 
				
		break;			
   }//fin caso
   
   ?> 
    
    </td>
    <td width="884" align="center" valign="top" bgcolor="#FFFFFF"><?php 

/******************** VALIDA LA SELECCION *****************************/    
if (isset($_GET['ind'])) {
$ind = $_GET['ind'];
} else {
$ind = "";
}	

/*-***************** INICIO DEL CASO **********************************/		
switch ($ind) {

/**** registrar_archivo md5() ****/		
case md5('registrar_archivo'):

		 $lista_archivos = pg_query($link, "SELECT archivos.id as id_archivo, tipo_documento.descripcion as t_documento, id_solicitud, archivo
		  FROM archivos
		  join tipo_documento on tipo_documento.id=archivos.t_documento
		  where id_solicitud ='".$_GET['id_solicitud']."'"); 

			include("archivo/registrar_archivo.php");
			
break;	

/**** registrar_solicitud md5() ****/		
case md5('registrar_solicitud'):
		   
			include("includes/registrar_solicitud.php");
			
break;	
/****   listado_solicitudes md5() ****/		
case md5('listado_solicitudes'):
      if (($_SESSION['usu_rol_aprobacion']==2) or ($_SESSION['usu_rol_aprobacion']==3)) {
        	
	         $listado_solicitudes = pg_query($link, "select s.id, s.usuario_dependencia_id, n.rol_aprobacion_id, cs.id as clasificacion_id, hs.aprobado, s.fecha_incio, s.fecha_fin, tsol.descripcion as t_solicitud, tt.nombres, 
              tt.apellidos, tt.cargo_descripcion, tt.dependencia_descripcion
              from historico_solicitud hs
              left join solicitud s on s.id = hs.solicitud_id
              left join niveles_aprobacion n on n.id = hs.nivel_aprobacion_id
              left join clasificacion_solicitud cs on cs.id = s.clasificacion_id
              join tipo_solicitud tsol on tsol.id=s.tipo_solicitud_id
              join trabajador_titular tt on tt.solicitud_id=s.id
              where n.rol_aprobacion_id='".$_SESSION['usu_rol_aprobacion']."' and s.usuario_dependencia_id='".$_SESSION['usu_dependencia_id']."'  and hs.aprobado <> '0' and hs.devolucion='f'"); 

		}//FIN IF (SI ROL APROBACION ES US o USJ
	  if ($_SESSION['usu_rol_aprobacion']==4) {
	  		 
	  		 $listado_solicitudes = pg_query($link, "select s.id, s.fecha_incio, s.fecha_fin, tsol.descripcion as t_solicitud, tt.nombres, tt.apellidos,d.descripcion, d.estado_id, d.estado_descripcion
			from solicitud s
			join tipo_solicitud tsol on tsol.id=s.tipo_solicitud_id
			join trabajador_titular tt on tt.solicitud_id=s.id
	        join dependencias d on d.id=s.usuario_dependencia_id
	        where d.estado_id='".$_SESSION['usu_estado_id']."' and hs.aprobado <> '0' and hs.devolucion='f'"); 

        }//FIN IF (SI ROL APROBACION ES UAD
		 include("includes/listado_solicitudes.php");			
break;	

/****   listado_solicitudes_rrhh md5() ****/		
case md5('listado_solicitudes_rrhh'):
		 $listado_solicitudes_rrhh = pg_query($link, "select s.id, d.descripcion, d.estado_id, d.estado_descripcion,s.usuario_dependencia_id, n.rol_aprobacion_id, cs.id as clasificacion_id, hs.aprobado, s.fecha_incio, s.fecha_fin, tsol.descripcion as t_solicitud, tt.nombres, 
tt.apellidos, tt.cargo_descripcion, tt.dependencia_descripcion
              from historico_solicitud hs
              left join solicitud s on s.id = hs.solicitud_id
              left join niveles_aprobacion n on n.id = hs.nivel_aprobacion_id
              left join clasificacion_solicitud cs on cs.id = s.clasificacion_id
              join tipo_solicitud tsol on tsol.id=s.tipo_solicitud_id
              join trabajador_titular tt on tt.solicitud_id=s.id
              join dependencias d on d.id=s.usuario_dependencia_id
              where n.rol_aprobacion_id='".$_SESSION['usu_rol_aprobacion']."' and aprobado <> '0' and hs.aprobado <> '0' and hs.devolucion='f'"); 
		 include("includes/listado_solicitudes_rrhh.php");			
break;

					
/***** ver solicitud  md5****/

case md5('ver_solicitud'):
				 $solicitud_ver = pg_query($link, "SELECT s.fecha_incio, s.fecha_fin, 
							       s.motivo_id, ms.descripcion as motivo, s.tipo_solicitud_id, s.tipo_cargo_id, tc.descripcion as tipo_cargo, s.usuario_estado_id, 
							       s.usuario_dependencia_id, s.clasificacion_id, 
							       s.n_educativo, s.area_especialidad, p.descripcion as especialidad, s.experiencia, s.habilidades, s.cursos, tt.cedula as t_cedula, tt.nombres as t_nombre, tt.apellidos as t_apellido,
							       tt.cargo_descripcion as t_cargo, tt.dependencia_descripcion as t_dependencia,
								   tipo_suplente.descripcion as s_tipo, ts.nacionalidad as s_nacionalidad, ts.cedula as s_cedula, ts.nombres as s_nombre, ts.apellidos as s_apellido,
								   ts.descripcion as s_descripcion 
								   FROM solicitud s 
								   join tipo_cargo tc on tc.id=s.tipo_cargo_id
					               join motivo_suplencia ms on ms.id=s.motivo_id
					               join profesiones p on p.id=s.area_especialidad
					               left join trabajador_titular tt on tt.solicitud_id=s.id
								   left join suplente ts on ts.solicitud_id=s.id
								   left join tipo_suplente on tipo_suplente.id=ts.tipo_suplente_id
								   where s.id='".$_GET['id_solicitud']."' and s.estatus='t' and tt.estatus='t'"); 

	       		 $ciclo_historico = pg_query($link, "SELECT clasificacion_solicitud.id, clasificacion_solicitud.descripcion as clasificacion, 
									rol_aprobacion.id, rol_aprobacion.descripcion as rol, orden, niveles_aprobacion.estatus as estatus,
									hs.fecha, hs.aprobado, hs.observacions, hs.fecha_actualizacion, hs.devolucion
									FROM niveles_aprobacion
									join clasificacion_solicitud on clasificacion_solicitud.id=niveles_aprobacion.clasificacion_id
									join rol_aprobacion on rol_aprobacion.id=niveles_aprobacion.rol_aprobacion_id
									left join solicitud s on clasificacion_solicitud.id = s.clasificacion_id and niveles_aprobacion.clasificacion_id = s.clasificacion_id
									left join historico_solicitud hs on niveles_aprobacion.id = hs.nivel_aprobacion_id and s.id = hs.solicitud_id
									where niveles_aprobacion.estatus='TRUE' 
									and clasificacion_solicitud.estatus='TRUE' 
									and rol_aprobacion.estatus='TRUE'
									and niveles_aprobacion.clasificacion_id = s.clasificacion_id
									and s.id=".$_GET['id_solicitud']." and devolucion is true
									union all
									SELECT clasificacion_solicitud.id, clasificacion_solicitud.descripcion as clasificacion, 
									rol_aprobacion.id, rol_aprobacion.descripcion as rol, orden, niveles_aprobacion.estatus as estatus,
									hs.fecha, hs.aprobado, hs.observacions, hs.fecha_actualizacion, hs.devolucion
									FROM niveles_aprobacion
									join clasificacion_solicitud on clasificacion_solicitud.id=niveles_aprobacion.clasificacion_id
									join rol_aprobacion on rol_aprobacion.id=niveles_aprobacion.rol_aprobacion_id
									left join solicitud s on clasificacion_solicitud.id = s.clasificacion_id and niveles_aprobacion.clasificacion_id = s.clasificacion_id
									left join historico_solicitud hs on niveles_aprobacion.id = hs.nivel_aprobacion_id and s.id = hs.solicitud_id and hs.devolucion is not true
									where niveles_aprobacion.estatus='TRUE' 
									and clasificacion_solicitud.estatus='TRUE' 
									and rol_aprobacion.estatus='TRUE'
									and niveles_aprobacion.clasificacion_id = s.clasificacion_id
									and s.id=".$_GET['id_solicitud']."
									order by fecha_actualizacion, orden, devolucion"); 

		        $lista_archivos = pg_query($link, "SELECT archivos.id as id_archivo, tipo_documento.descripcion as t_documento, id_solicitud, archivo
								  FROM archivos
								  join tipo_documento on tipo_documento.id=archivos.t_documento
								  where id_solicitud ='".$_GET['id_solicitud']."'"); 

		    include("includes/ver_solicitud.php");			
break;		

/***** ver solicitud  md5****/

case md5('mod_solicitud'):
				 $solicitud_mod = pg_query($link, "SELECT s.id, s.fecha_incio, s.fecha_fin, 
							        s.motivo_id, s.tipo_solicitud_id, s.tipo_cargo_id, s.usuario_estado_id, 
							        s.usuario_dependencia_id, s.clasificacion_id, 
							        s.n_educativo, s.area_especialidad, s.experiencia, s.habilidades, s.cursos, tt.cedula as t_cedula, tt.nombres as t_nombre, tt.apellidos as t_apellido,
							        tt.cargo_descripcion as t_cargo, tt.cargo_id, tt.dependencia_descripcion as t_dependencia, tt.dependencia_id,
									tipo_suplente.descripcion as s_tipo, tipo_suplente.id as tipo, ts.nacionalidad as s_nacionalidad, ts.cedula as s_cedula, ts.nombres as s_nombre, ts.apellidos as s_apellido,
									ts.descripcion as s_descripcion, ts.trabajador_id as id_ts, tt.trabajador_id as id_tt
									FROM solicitud s 
									left join trabajador_titular tt on tt.solicitud_id=s.id
									left join suplente ts on ts.solicitud_id=s.id
									left join tipo_suplente on tipo_suplente.id=ts.tipo_suplente_id
									where s.id='".$_GET['id_solicitud']."' and s.estatus='t' and tt.estatus='t'"); 

	       		 $ciclo_historico = pg_query($link, "SELECT clasificacion_solicitud.id, clasificacion_solicitud.descripcion as clasificacion, 
									rol_aprobacion.id, rol_aprobacion.descripcion as rol, orden, niveles_aprobacion.estatus as estatus,
									hs.fecha, hs.aprobado, hs.observacions, hs.fecha_actualizacion, hs.devolucion
									FROM niveles_aprobacion
									join clasificacion_solicitud on clasificacion_solicitud.id=niveles_aprobacion.clasificacion_id
									join rol_aprobacion on rol_aprobacion.id=niveles_aprobacion.rol_aprobacion_id
									left join solicitud s on clasificacion_solicitud.id = s.clasificacion_id and niveles_aprobacion.clasificacion_id = s.clasificacion_id
									left join historico_solicitud hs on niveles_aprobacion.id = hs.nivel_aprobacion_id and s.id = hs.solicitud_id
									where niveles_aprobacion.estatus='TRUE' 
									and clasificacion_solicitud.estatus='TRUE' 
									and rol_aprobacion.estatus='TRUE'
									and niveles_aprobacion.clasificacion_id = s.clasificacion_id
									and s.id=".$_GET['id_solicitud']." and devolucion is true
									union all
									SELECT clasificacion_solicitud.id, clasificacion_solicitud.descripcion as clasificacion, 
									rol_aprobacion.id, rol_aprobacion.descripcion as rol, orden, niveles_aprobacion.estatus as estatus,
									hs.fecha, hs.aprobado, hs.observacions, hs.fecha_actualizacion, hs.devolucion
									FROM niveles_aprobacion
									join clasificacion_solicitud on clasificacion_solicitud.id=niveles_aprobacion.clasificacion_id
									join rol_aprobacion on rol_aprobacion.id=niveles_aprobacion.rol_aprobacion_id
									left join solicitud s on clasificacion_solicitud.id = s.clasificacion_id and niveles_aprobacion.clasificacion_id = s.clasificacion_id
									left join historico_solicitud hs on niveles_aprobacion.id = hs.nivel_aprobacion_id and s.id = hs.solicitud_id and hs.devolucion is not true
									where niveles_aprobacion.estatus='TRUE' 
									and clasificacion_solicitud.estatus='TRUE' 
									and rol_aprobacion.estatus='TRUE'
									and niveles_aprobacion.clasificacion_id = s.clasificacion_id
									and s.id=".$_GET['id_solicitud']."
									order by fecha_actualizacion, orden, devolucion"); 

             $lista_archivos = pg_query($link, "SELECT archivos.id as id_archivo, tipo_documento.descripcion as t_documento, id_solicitud, archivo
								  FROM archivos
								  join tipo_documento on tipo_documento.id=archivos.t_documento
								  where id_solicitud ='".$_GET['id_solicitud']."'"); 

		    include("includes/mod_solicitud.php");			
break;				

/**** consultar_estatus md5() ****/		
case md5('consultar_estatus'):
		   
			include("includes/consultar_estatus.php");
			
break;	
			
/**** actualizar_solicitud md5() ****/		
case md5('actualizar_solicitud'):
		   
			include("includes/actualizar_solicitud.php");
			
break;							

/**** aprobar_solicitud md5() ****/		
case md5('aprobar_solicitud'):

       if (($_SESSION['usu_rol_aprobacion']==2) or ($_SESSION['usu_rol_aprobacion']==3)) {

            $listado_solicitudes_aprobar = pg_query($link, "select s.id, s.usuario_dependencia_id, n.rol_aprobacion_id, cs.id as clasificacion_id, hs.aprobado, s.fecha_incio, s.fecha_fin, tsol.descripcion as t_solicitud, tt.nombres, 
              tt.apellidos, tt.cargo_descripcion, tt.dependencia_descripcion
              from historico_solicitud hs
              left join solicitud s on s.id = hs.solicitud_id
              left join niveles_aprobacion n on n.id = hs.nivel_aprobacion_id
              left join clasificacion_solicitud cs on cs.id = s.clasificacion_id
              join tipo_solicitud tsol on tsol.id=s.tipo_solicitud_id
              join trabajador_titular tt on tt.solicitud_id=s.id
              where n.rol_aprobacion_id='".$_SESSION['usu_rol_aprobacion']."' and s.usuario_dependencia_id='".$_SESSION['usu_dependencia_id']."'  and hs.aprobado='0'"); 
		}//FIN IF (SI ROL APROBACION ES US o USJ
		if ($_SESSION['usu_rol_aprobacion']==4) {

			$listado_solicitudes_aprobar = pg_query($link, "select s.id, s.usuario_dependencia_id, n.rol_aprobacion_id, cs.id as clasificacion_id, hs.aprobado, s.fecha_incio, s.fecha_fin, tsol.descripcion as t_solicitud, tt.nombres, 
              tt.apellidos, tt.cargo_descripcion, tt.dependencia_descripcion
              from historico_solicitud hs
              left join solicitud s on s.id = hs.solicitud_id
              left join niveles_aprobacion n on n.id = hs.nivel_aprobacion_id
              left join clasificacion_solicitud cs on cs.id = s.clasificacion_id
              join tipo_solicitud tsol on tsol.id=s.tipo_solicitud_id
              join trabajador_titular tt on tt.solicitud_id=s.id
              join dependencias d on d.id=s.usuario_dependencia_id
              where n.rol_aprobacion_id='".$_SESSION['usu_rol_aprobacion']."' and d.estado_id='".$_SESSION['usu_estado_id']."'  and hs.aprobado='0'"); 
		
		}//FIN IF (SI ROL APROBACION ES UAD
			include("includes/aprobar_solicitud.php");
			
break;		

/**** aprobar_solicitud_rrhh md5() ****/		
case md5('aprobar_solicitud_rrhh'):
      $listado_solicitudes_aprobar_rrhh = pg_query($link, "select s.id, d.descripcion, d.estado_id, d.estado_descripcion,s.usuario_dependencia_id, n.rol_aprobacion_id, cs.id as clasificacion_id, hs.aprobado, s.fecha_incio, s.fecha_fin, tsol.descripcion as t_solicitud, tt.nombres, 
tt.apellidos, tt.cargo_descripcion, tt.dependencia_descripcion
              from historico_solicitud hs
              left join solicitud s on s.id = hs.solicitud_id
              left join niveles_aprobacion n on n.id = hs.nivel_aprobacion_id
              left join clasificacion_solicitud cs on cs.id = s.clasificacion_id
              join tipo_solicitud tsol on tsol.id=s.tipo_solicitud_id
              join trabajador_titular tt on tt.solicitud_id=s.id
              join dependencias d on d.id=s.usuario_dependencia_id
              where n.rol_aprobacion_id='".$_SESSION['usu_rol_aprobacion']."' and  hs.aprobado='0'"); 
		   
			include("includes/aprobar_solicitud_rrhh.php");
			
break;		
		
								
		
/**** registrar_usuario md5() ****/		
case md5('registrar_usuario'):
		   
			include("usuarios/registrar_usuario_new.php");
			
break;	
			
/**** mod_usuario md5() ****/		
case md5('mod_usuario'):

             $Consulta_mod_usuarios = pg_query($link, "SELECT usuarios.trabajador_id, usuarios.estatus as estatus_usu,login, trabajadores.cedula, trabajadores.nombres, 
		 	trabajadores.apellidos, trabajadores.cargo, rol_aprobacion.descripcion as rol, rol_aprobacion.id as rol_id, usuarios.dependencia_id, d.descripcion as dependencia, d.estado_id, d.estado_descripcion as estado
		  FROM open_id.users 
		join trabajadores on trabajadores.cedula=open_id.users.cedula
		join usuarios on usuarios.trabajador_id=trabajadores.id 
		join rol_aprobacion on rol_aprobacion.id=usuarios.rol_aprobacion_id
		join dependencias d on d.id=usuarios.dependencia_id
		where open_id.users.suspended='f' and usuarios.trabajador_id='".decrypt($_GET['id'],'LLAVE')."'
		order by usuarios.id desc");    
		   
			include("usuarios/mod_usuario.php"); 
			
break;	

/**** listado_usuarios md5() ****/				
case md5('listado_usuarios'):
		 $Consulta_listado_usuarios = pg_query($link, "SELECT usuarios.trabajador_id,usuarios.estatus as estatus_usu, login, trabajadores.cedula, trabajadores.nombres, 
		 	trabajadores.apellidos, rol_aprobacion.descripcion as rol, usuarios.dependencia_id, d.descripcion as dependencia, d.estado_id, d.estado_descripcion as estado
		  FROM open_id.users 
		join trabajadores on trabajadores.cedula=open_id.users.cedula
		join usuarios on usuarios.trabajador_id=trabajadores.id 
		join rol_aprobacion on rol_aprobacion.id=usuarios.rol_aprobacion_id
		join dependencias d on d.id=usuarios.dependencia_id
		where open_id.users.suspended='f' 
		order by usuarios.id desc"); 
		 include("usuarios/listado_usuarios.php");			
break;		
		
/**** niveles_aprobacion md5() ****/		
case md5('registrar_niveles_aprobacion'):
		
		 $Consulta_niveles_aprobacion = pg_query($link, "
		SELECT clasificacion_id, clasificacion_solicitud.descripcion as clasificacion,  rol_aprobacion_id, rol_aprobacion.descripcion as rol, orden, niveles_aprobacion.estatus as estatus
		  FROM niveles_aprobacion
		join clasificacion_solicitud on clasificacion_solicitud.id=niveles_aprobacion.clasificacion_id
		join rol_aprobacion on rol_aprobacion.id=niveles_aprobacion.rol_aprobacion_id
		where niveles_aprobacion.estatus='TRUE' and clasificacion_solicitud.estatus='TRUE' and rol_aprobacion.estatus='TRUE' order by clasificacion_id, orden asc 
		"); 
		   
			include("includes/registrar_niveles_aprobacion.php");
			
break;				
		
		
/**** registrar_clasificacion_solicitud md5() ****/		
case md5('registrar_clasificacion_solicitud'):
		
				 $Consulta_clasificacion = pg_query($link, "SELECT cs.id, cs.descripcion, cs.estatus, c.descripcion as condicion
  FROM clasificacion_solicitud cs
join condicion c on c.id=cs.condicion_id 
where cs.estatus='t' and c.estatus='t'"); 
		   
			include("includes/registrar_clasificacion_solicitud.php");
			
break;		

/**** registrar_motivo_solicitud md5() ****/		
case md5('registrar_motivo_solicitud'):
		
				 $Consulta_motivo_solicitud = pg_query($link, "SELECT id, descripcion, estatus, audit_usu_id, audit_ip, audit_dep_id
  FROM motivo_suplencia "); 
		   
			include("includes/registrar_motivo_solicitud.php");
			
break;		
	
/**** registrar_requisito md5() ****/		
case md5('registrar_requisito'):
		
				 $Consulta_requisito_solicitud = pg_query($link, "SELECT id, descripcion, estatus
  FROM tipo_documento "); 
		   
			include("includes/registrar_requisito.php");
			
break;	

/**** registrar_area_especialidad md5() ****/		
case md5('registrar_area_especialidad'):
		
				 $Consulta_area_especialidad = pg_query($link, "SELECT id, descripcion, estatus
  FROM profesiones order by descripcion asc"); 
		   
			include("includes/registrar_area_especialidad.php");
			
break;	

/**** mod_area_especialidad md5() ****/		
case md5('mod_area_especialidad'):

             $Consulta_mod_area_especialidad = pg_query($link, "SELECT id, descripcion, estatus
  FROM profesiones	where id='".decrypt($_GET['id'],'LLAVE')."'");    
		   
			include("includes/mod_area_especialidad.php"); 
			
break;			
	
/**** contrasena md5(9c87400128d408cdcda0e4b3ff0e66fa) ****/		
case md5('contrasena'):
		   
			include("usuarios/contrasena.php");
			
break;						
/**********************************************************************/
default:
	 include("info/info.php");	
break;	
	}//fin caso
	?>
    </td>
  </tr>
  <tr>
    <td colspan="2">
  </tr>
</table>
</body>
</html>
