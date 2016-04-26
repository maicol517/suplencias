<form id="form1" class="prueba" name="form1" method="post" action="includes/update_area_especialidad.php">


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
          <td colspan="4"><h2>MODIFICAR  AREA DE ESPECIALIDAD
              <input name="area_id" type="hidden" id="area_id" value="<?=decrypt($_GET['id'],'LLAVE') ?>" />
         <?=decrypt($_GET['id'],'LLAVE') ?> </h2></td>
          </tr>
        <?php
		$color=0; $total=0;
	   while($Cons_area_especialidad = pg_fetch_object($Consulta_mod_area_especialidad)){
		    ?>
        <tr  >
          <td >&nbsp;</td>
          <td >Estatus</td>
          <td colspan="2"><select name="estatus" id="estatus" class="campotexto" required="required">
            <option value="">Selecionar Estatus</option>
            <option value="t" <?php 
            if($Cons_area_especialidad->estatus=='t'){
			echo 'selected';	
			}	
            ?>>Activo</option>
            <option value="f" <?php 
            if($Cons_area_especialidad->estatus=='f'){
			echo 'selected';	
			}	
            ?>>Desactivo</option>
          </select></td>
        </tr>
        <tr  >
          <td width="2%" >&nbsp;</td>
          <td width="35%" >Area de Especialidad</td>
          <td width="63%" colspan="2">
            <input name="area_especialidad" type="text" class="campotexto" id="area_especialidad" value="<?= $Cons_area_especialidad->descripcion ?>" required="required" /></td>
        </tr>
        
        <tr  >
          <td colspan="4" ><p style="text-align:center; padding-top:7px"><input  class="bottonsumit" type="submit" name="button" id="button" value="Enviar" onClick="return confirm('Esta Usted de Acuerdo con la Modificación del Area de especialidad?' )" /></p></td>
          </tr>

<?php 
        }
    	pg_free_result($Consulta_mod_area_especialidad);
        pg_close($link);
 ?>
      </table>
      <p>&nbsp;</p></td>
    </tr>
  </table>

</form>
