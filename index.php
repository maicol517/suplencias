<?php 
include ("funciones/funciones.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/css.css" type="text/css" media="all" />

<title>Ministerio Público | Suplencias</title>

</head>
<body>
<table width="900px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td height="124" colspan="2" background="images/banner_limpio.jpg">&nbsp;</td>
  </tr>
  <tr>
    <td width="147" valign="top">&nbsp;</td>
    <td width="884" ><div align="right">
      <p style="color:#F00; font-weight:bold;"><?php //echo date();
            if (isset($_GET['error'])) {
          echo error($_GET['error']);
         
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
        <td class="titulo_index">Bienvenidos al Modulo de Suplencias del <br/> Ministerio Público</td>
      </tr>
      <tr>
        <td><form name="form1" method="post" action="validar.php">
          <table width="90%" border="0" align="center" cellspacing="7">
            <tr>
              <td >&nbsp;</td>
              <td colspan="2" >&nbsp;</td>
            </tr>
            <tr>
              <td width="50%" class="titulo_usuarios" bgcolor="#487BB2">Usuario No Registrados</td>
              <td width="50%" colspan="2" class="titulo_usuarios" bgcolor="#254C75">Usuario Registrados</td>
            </tr>
            <tr>
              <td rowspan="3" class="resumen_no_registrados">Si no posee una cuenta de acceso al sistema, por favor haga click <a href="usuario.php">Aqui</a> para ingresar al Registro de usuarios del Sistema Interno de Proveedores y Contratistas del Ministerio Público</td>
              <td class="titulo_usuarios_int">Usuario                </td>
              <td><input type="text" class="campotexto" name="login" id="login"></td>
            </tr>
            <tr>
              <td class="titulo_usuarios_int">Clave&nbsp;&nbsp;&nbsp;</td>
              <td><input type="password" name="password" class="campotexto" id="password"></td>
              </tr>
            <tr>
              <td colspan="2" align="center" class="titulo_usuarios_int2">¿Olvidó su contraseña?</td>
              </tr>
            <tr>
              <td >&nbsp;</td>
              <td colspan="2" align="center"><input class="bottonsumit" type="submit" name="button" id="button" value="Enviar" /></td>
            </tr>
          </table>
        </form></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2">
  </tr>
</table>
</body>
</html>
