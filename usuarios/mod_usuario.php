<form id="form1" class="prueba" name="form1" method="post" action="usuarios/update_usuario.php">


  <table width="95%" border="0" align="center" cellspacing="1" >

    <tr>
      <td>
      <table width="76%" border="0" cellspacing="1" class="tabla_proveedor">
        <tr>
          <td colspan="4"><div align="right">
      <p style="color:#F00; font-weight:bold;"><?php //echo date();
            if (isset($_GET['error'])) {
          echo error($_GET['error']);
         
      }//Mostrar Si no esta Vacio
      ?></p>
      
    </div></td>
        </tr>
        <tr>
          <td colspan="4"><h2>MODIFICAR  USUARIO
            <input name="trabajador_id" type="hidden" id="trabajador_id" value="<?=decrypt($_GET['id'],'LLAVE') ?>" />
          </h2></td>
          </tr>
        <?php
		$color=0; $total=0;
	   while($Cons_mod_usuarios = pg_fetch_object($Consulta_mod_usuarios)){
		    ?>
        <tr  >
          <td >&nbsp;</td>
          <td >Estatus</td>
          <td colspan="2"><select name="estatus" id="estatus" class="campotexto" required="required">
            <option value="">Selecionar Estatus</option>
            <option value="t" <?php 
            if($Cons_mod_usuarios->estatus_usu=='t'){
			echo 'selected';	
			}	
            ?>>Activo</option>
            <option value="f" <?php 
            if($Cons_mod_usuarios->estatus_usu=='f'){
			echo 'selected';	
			}	
            ?>>Desactivo</option>
          </select></td>
        </tr>
        <tr  >
          <td width="2%" >&nbsp;</td>
          <td width="35%" >Cedula            </td>
          <td width="63%" colspan="2"><?= $Cons_mod_usuarios->cedula ?></td>
        </tr>
        <tr  >
          <td >&nbsp;</td>
          <td >Nombres </td>
          <td colspan="2"><?= $Cons_mod_usuarios->nombres ?></td>
        </tr>
        <tr  >
          <td >&nbsp;</td>
          <td >Apellidos</td>
          <td colspan="2"><?= $Cons_mod_usuarios->apellidos ?></td>
        </tr>
        <tr  >
          <td >&nbsp;</td>
          <td >Cargo</td>
          <td colspan="2"><?= $Cons_mod_usuarios->cargo ?></td>
        </tr>
        <tr  >
          <td >&nbsp;</td>
          <td >Usuario</td>
          <td colspan="2"><?= $Cons_mod_usuarios->login ?></td>
        </tr>
        <tr  >
          <td >&nbsp;</td>
          <td >Rol</td>
          <td colspan="2">
            <select name="rol" id="rol" class="campotexto" required="required">
               <option value="">Selecionar Rol</option>
               <?php 	   $sql_rol = pg_query($link, "SELECT id, descripcion, estatus
  FROM rol_aprobacion
where estatus='t' 
 order by id asc"); 

		   while($rol = pg_fetch_object($sql_rol)){  ?> 
              <option value="<?=$rol->id ?>" <?php 
            if($Cons_mod_usuarios->rol_id==$rol->id){
			echo 'selected';	
			}	
            ?>><?=$rol->descripcion ?></option>
            <?php  } ?>  
            </select></td>
        </tr>
        <tr  >
          <td >&nbsp;</td>
          <td >Estado</td>
          <td colspan="2"><select name="select1" id="select1" class="campotexto" onChange="cargaContenido(this.id)" required="required">
            <option value="">Selecionar Estado</option>
            <?php 	   $sql_estado = pg_query($link, "SELECT id, descripcion
    FROM estados_v"); 

		   while($estado = pg_fetch_object($sql_estado)){  ?>
            <option value="<?=$estado->id ?>" <?php 
            if($Cons_mod_usuarios->estado_id==$estado->id){
			echo 'selected';	
			}	
            ?>>
              <?=$estado->descripcion ?>
              </option>
            <?php  } ?>
          </select></td>
        </tr>
        <tr  >
          <td >&nbsp;</td>
          <td >Dependencia</td>
          <td colspan="2"><select disabled="disabled" class="campotexto" name="select2" id="select2" required="required">
            <option value="<?= $Cons_mod_usuarios->dependencia_id ?>"><?= $Cons_mod_usuarios->dependencia ?></option>
          </select></td>
        </tr>
        <tr  >
          <td colspan="4" ><p style="text-align:center; padding-top:7px"><input  class="bottonsumit" type="submit" name="button" id="button" value="Enviar" onClick="return confirm('Esta Usted de Acuerdo con la Modificación del Usuario?' )" /></p></td>
          </tr>

<?php 
        }
    	pg_free_result($Consulta_mod_usuarios);
        pg_close($link);
 ?>
      </table>
      <p>&nbsp;</p></td>
    </tr>
  </table>

</form>
