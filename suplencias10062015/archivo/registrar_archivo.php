<form id="form1" class="prueba" name="form1" method="post" action="archivo/archivo_add.php" enctype="multipart/form-data">


  <table width="95%" border="0" align="center" cellspacing="1" >
    <tr>
      <td>
      <table width="100%" border="0" cellspacing="0" class="tabla_proveedor">
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
          <td colspan="4"><h2>SUBIR SOPORTE DE DOCUMENTOS
            <input name="id_solicitud" type="hidden" id="id_solicitud" value="<?= $_GET['id_solicitud']; ?>" />
          </h2></td>
          </tr>
        <tr  >
          <td height="28" >&nbsp;</td>
          <td >Solicitud Nº</td>
          <td colspan="2"><strong>SS-<?= $_GET['id_solicitud']; ?>-2015</strong></td>
        </tr>
        <tr  >
          <td width="5%" >&nbsp;</td>
          <td width="33%" >Tipo de Documento</td>
          <td width="62%" colspan="2"><select name="t_documento" class="campotexto" id="t_documento" required>
            <option value="">Selecionar Tipo de Documento</option>
           <?php
		
  	   $sql_estado = pg_query($link, "SELECT id, descripcion
  FROM tipo_documento
where estatus='t' 
 order by descripcion asc"); 

		   while($estado = pg_fetch_object($sql_estado)){  ?>    
            
            <option value=<?= $estado->id ?>><?= $estado->descripcion ?></option>
           <?php } ?>
          </select></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Adjuntar Documento&nbsp;&nbsp;<img src="images_icon/pdf.png" width="25" height="25" /></td>
          <td colspan="2"><input name="archivo_pdf" class="campotexto" id="archivo_pdf" type="file" size="25" /></td>
        </tr>
      



        <tr>
          <td colspan="4"><h2>&nbsp;</h2></td>
        </tr>
        <tr>
          <td colspan="4" align="center"><input class="bottonsumit" type="submit" name="button" id="button" value="Enviar" /></td>
        </tr>
        <tr>
          <td colspan="4" align="center">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4" align="center"><table width="100%" border="0" cellspacing="1" class="tabla_proveedor_consulta">
        <tr>
          <td colspan="6"><h2>DOCUMENTOS REGISTRADOS</h2></td>
          </tr>

        <tr  bgcolor="#1D699E" class="titulo_usuarios">
          <th width="86%" >Tipo de Documento</th>
       



          <th width="14%">Archivo</th>
        </tr>
        <?php
		$color=0; $total=0;
	   while($lista = pg_fetch_object($lista_archivos)){
		    ?>
        <tr bgcolor="<?php if ($color%2==0) echo '#eeeeee'; else echo '#ffffff'; ?>">
          <td align="center">&nbsp;<?=$lista->t_documento;?></td>




          <td align="center">&nbsp;&nbsp;<a href="archivo/pdf/<?=$lista->archivo;?>" target="_blank"><img src="images_icon/pdf.png" title="Planilla" width="16" height="16" /></a>&nbsp;</td>
        </tr>
        <?php 
		 $color++;
	     $total++;
		} 
		pg_free_result($lista_archivos);
        pg_close($link);
		?>
      </table></td>
        </tr>
      </table>
      <p>&nbsp;</p></td>
    </tr>
  </table>

</form>
