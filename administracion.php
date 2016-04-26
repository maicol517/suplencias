
<?php
session_start(); // inicia la sesión
include ("db_link/conex.php");//conexion con la base de datos

?>
<script language="javascript" src="js/jquery.js"></script>
<script language="JavaScript" src="js/ajax.js"></script>
<script language="javascript" > 
/**************************************************************
Máscara de entrada. Script creado por Tunait! (21/12/2004)
Si quieres usar este script en tu sitio eres libre de hacerlo con la condición de que permanezcan intactas estas líneas, osea, los créditos.
No autorizo a distribuír el código en sitios de script sin previa autorización
Si quieres distribuírlo, por favor, contacta conmigo.
Ver condiciones de uso en http://javascript.tunait.com/
tunait@yahoo.com 
****************************************************************/
var patron = new Array(4,7)
var patron2 = new Array(1,3,3,3,3)
function mascara(d,sep,pat,nums){
if(d.valant != d.value){
	val = d.value
	largo = val.length
	val = val.split(sep)
	val2 = ''
	for(r=0;r<val.length;r++){
		val2 += val[r]	
	}
	if(nums){
		for(z=0;z<val2.length;z++){
			if(isNaN(val2.charAt(z))){
				letra = new RegExp(val2.charAt(z),"g")
				val2 = val2.replace(letra,"")
			}
		}
	}
	val = ''
	val3 = new Array()
	for(s=0; s<pat.length; s++){
		val3[s] = val2.substring(0,pat[s])
		val2 = val2.substr(pat[s])
	}
	for(q=0;q<val3.length; q++){
		if(q ==0){
			val = val3[q]
		}
		else{
			if(val3[q] != ""){
				val += sep + val3[q]
				}
		}
	}
	d.value = val
	d.valant = val
	}
}



function disableEnterKey(e){
var key;
if(window.event){
key = window.event.keyCode; //IE
}else{
key = e.which; //firefox
}
if(key==13){
return false;
}else{
return true;
}
}


/*	funcion que envia los datos por ajax	*/
	$(document).ready(function(){
		//cuando se de click en el boton enviar
		$('#cedula').blur(function(ev){
			
			
			//se almacenan los valores del los text en las variables 	
			var cedula = $("#cedula").val();
	        

			var datos =	{	cedula:cedula
						};  
			$('#resultado').load("servicio_usuario.php", datos);
			
			
			
			
		});
       
    });				
</script>
<style type="text/css">
<!--

.principal {
    height:134px !important;
    width: 100%;
	/* background-image: url(../../banner.png);*/
	 
	background:url(banner.png);
	background-size: 100% 100%;
}

</style>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/css.css" type="text/css" media="all" />

<title>Ministerio Público | Sistema de Información Geográfica</title>

</head>
<body>
<div class="principal"></div>

<table width="900px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td width="147" valign="top">&nbsp;</td>
    <td width="884" ><div align="right">
      <p style="color:#F00; font-weight:bold;"><?php //echo date();
      		  if (isset($_GET['error'])) {
			    if ($_GET['error'] == 't')

               {

				 echo ' ERROR EN AUTENTIFICACIÓN';

		       }
			   
		  }//Mostrar Si no esta Vacio
      ?></p>
      
    </div></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"  valign="top"><table width="70%" border="0" align="center" cellspacing="1">
      <tr>
        <td style="text-align:center; color:#00C; font-weight:bold;">Administracion de Usuarios</td>
      </tr>
      <tr>
        <td><form name="form1" method="post" action="">
          <table width="74%" border="0" align="center" cellspacing="7">
            <tr>
              <td colspan="2" >&nbsp;</td>
            </tr>
            <tr>
              <td width="50%" colspan="2" style="font-weight:bold; color:#CCC" bgcolor="#254C75">Registrar Usuario</td>
            </tr>

            <tr>
              <td class="titulo_usuarios_int">Cedula</td>
              <td><input name="cedula" class="campotexto" type="text" id="cedula" size="25" required="required" /></td>
            </tr>
             <tr  >
          <td colspan="4" >
            <div  id="resultado">       
               <tr>
                 <td width="1%" >&nbsp;</td>
                 <td width="30%" >&nbsp; Estado</td>
                 <td  width="54%" colspan="2"><?php generaSelect(); ?></td>
              </tr>
              <tr>
                 <td width="1%" >&nbsp;</td>
                 <td width="30%" >&nbsp;Dependencia</td>
                 <td  width="54%" colspan="2"><select disabled="disabled" class="campotexto" name="select2" id="select2" required="required">
                <option value="0">Selecciona opci&oacute;n...</option>
              </select>
           </td>
              </tr>
              <tr>
                <td colspan="4"><h2>&nbsp;</h2></td>
                </tr>
                  <tr>
                    <td colspan="4" align="center"><input class="bottonsumit" type="submit" name="button" id="button" value="Enviar" /></td>
                  </tr>
           </div>
        </td>
        </tr>
              <td class="titulo_usuarios_int">Tipo</td>
              <td><label for="select"></label>
                <select name="tipo" class="campotexto" id="tipo" required="required">
                  <option value="">Selecionar Tipo</option>
                  <?php
		
  	   $sql_tipo = pg_query($link, "SELECT id, descripcion, estatus
  FROM tipo
where estatus='t' 
 order by id asc"); 

		   while($condicion = pg_fetch_object($sql_tipo)){  ?>
                  <option value="<?= $condicion->id ?>">
                    <?= $condicion->descripcion ?>
                    </option>
                  <?php } ?>
                </select></td>
            </tr>
            <tr>
              <td colspan="2" align="center" class="titulo_usuarios_int2">&nbsp;</td>
              </tr>
            <tr>
              <td colspan="2" align="center"><input class="bottonsumit" type="submit" name="button" id="button" value="Enviar" /></td>
            </tr>
          </table>
        </form></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
      <table width="90%" border="0" align="center" cellpadding="0" class="tabla_proveedor_consulta" cellspacing="1">
        <tr style="font-weight:bold; color:#CCC" bgcolor="#254C75" align="center">
          <td width="15%">Cedula</td>
          <td width="30%">Nobres y Apellidos</td>
          <td width="15%">Usuario</td>
          <td width="25%">Tipo</td>
          <td width="15%">Opcion</td>
        </tr>
            <?php
		
  	   $sql_usuarios = pg_query($link, "SELECT u.id, u.usuario, u.clave, t.descripcion, u.nombres, u.apellidos, u.cedula
  FROM usuarios u
  join tipo t on t.id=u.tipo
where u.estatus='t' and t.estatus='t' order by t.id asc"); 

		   while($usuarios = pg_fetch_object($sql_usuarios)){  ?>
        <tr>
          <td><?= $usuarios->cedula; ?></td>
          <td><?= $usuarios->nombres.' '.$usuarios->apellidos; ?></td>
          <td><?= $usuarios->usuario; ?></td>
          <td><?= $usuarios->descripcion; ?></td>
          <td>&nbsp;</td>
        </tr>
    <?php  } ?>    
      </table>
<p>&nbsp;</p></td>
  </tr>
  <tr>
    <td colspan="2">
  </tr>
</table>
</body>
</html>
