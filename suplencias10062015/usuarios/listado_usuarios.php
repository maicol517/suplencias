  <table width="95%" border="0" align="center" cellspacing="1" >
    <tr>
      <td>
      <table width="100%" border="0" cellspacing="1" class="tabla_proveedor_consulta">
        <tr>
          <td colspan="9"><h2>USUARIOS REGISTRADOS</h2></td>
          </tr>

        <tr  bgcolor="#1D699E" class="titulo_usuarios">
          
          <th width="5%" >Estatus</th>
          <th width="5%" >Usuario</th>
          <th width="30%">Nombre y Apellidos</th>
          <th width="20%">Estado</th>
          <th width="25%" >Dependencia</th>

          <th width="7%">Rol</th>
          <th width="8%">Opcion</th>
        </tr>
        <?php
		$color=0; $total=0;
	   while($Cons_listado_usuarios = pg_fetch_object($Consulta_listado_usuarios)){
		    ?>
        <tr bgcolor="<?php if ($color%2==0) echo '#eeeeee'; else echo '#ffffff'; ?>">
          
          
          <td align="center"><?php if($Cons_listado_usuarios->estatus_usu=='t'){ ?>
            <img src="images/activo.png"  width="22" height="22" />
            <?php }else{ ?>
            <img src="images/inactivo.png"  width="22" height="22" />
            <?php } ?></td>
          <td align="center"><?=$Cons_listado_usuarios->login;?></td>
          <td align="center"><?=$Cons_listado_usuarios->nombres.' '.$Cons_listado_usuarios->apellidos;?></td>
          <td align="center"><?=$Cons_listado_usuarios->estado;?></td>
          <td align="center"><?=$Cons_listado_usuarios->dependencia;?></td>
          <td align="center"><?=$Cons_listado_usuarios->rol;?></td>
          <td align="center"><a href="template.php?ind=<? echo md5('mod_usuario');?>&amp;id=<?=encrypt($Cons_listado_usuarios->trabajador_id,'LLAVE')?>" ><img src="images_icon/edit.png" title="Editar Usuario" width="16" height="16" /></a></td>
        </tr>
        <?php 
		 $color++;
	     $total++;
		} 
		pg_free_result($Consulta_listado_usuarios);
        pg_close($link);
		?>
      </table>
     </td>
    </tr>
  </table>
