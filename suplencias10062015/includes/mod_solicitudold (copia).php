
<!-- DATECPICKER -->
<link rel="stylesheet" href="css/jquery-ui.css" />
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui.js"></script>
<script>
$(function () {
$("#fecha").datepicker();
});
</script>

<script>
 $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '<Ant',
 nextText: 'Sig>',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 minDate: '0d',
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
$(function () {
$(".fecha").datepicker();


});
</script>



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

/*  */

function deshabilitar_campos(valor) // "Desgravamene Unico" Desabilita los Campos en los item C y D 
{
 if(valor=='1')
 { 
 
   document.form1.dependencia_p.readOnly=true;
   document.form1.dependencia_p.value='';
   document.form1.nombre_p.value='';
   document.form1.apellido_p.value='';
   document.form1.cedula_postulado.value='';
   document.form1.trabajador_id_p.value='';

}
 
 if(valor=='2') //"Desgravamene Detallado" Habilita los Campos en los item C y D 
 { 
   document.form1.dependencia_p.readOnly=false;
   document.form1.dependencia_p.value='';
   document.form1.nombre_p.value='';
   document.form1.apellido_p.value='';
   document.form1.cedula_postulado.value='';
 }
 


}//fin funcion



//* SERVICIO FUNCIONARIOS DEL MINISTERIO PUBLICO *//

 function LlenarDatos(text)
    {    
        var datos = text.split('|'); 


       document.getElementById('nombre').value = datos[0];
	   document.getElementById('apellido').value = datos[1];
       document.getElementById('cargo').value = datos[2];
       document.getElementById('dependencia').value = datos[3];
       document.getElementById('cargo_id').value = datos[4];
       document.getElementById('dependencia_id').value = datos[5];
	   document.getElementById('trabajador_id').value = datos[6];
  }
      function obten_datos()
    {  
	
	  var cedula = document.form1.cedula.value;
           $.ajax({
                type: 'get',
                dataType: 'text',
                url: 'obten_personal.php',
                data: {valor: cedula},
                success: function(text){
                    LlenarDatos(text);
                        }
            });  
        }


//* SERVICIO POSTULADO *//

 function LlenarDatos_postulado(text)
    {     
        var datos = text.split('|'); 		

    if(datos[0] == 1){
	   document.getElementById('nombre_p').value = datos[1];
	   document.getElementById('apellido_p').value = datos[2];
       document.getElementById('dependencia_p').value = datos[3];
	   document.getElementById('trabajador_id_p').value = datos[4];
	 
	 }
	
     if(datos[0] == 2){
       document.getElementById('nombre_p').value = datos[1];
	   document.getElementById('apellido_p').value = datos[2];  
	 }
  }
  
      function obten_datos_postulado()
    {  
	  //alert('111');
	  var cedula_postulado = document.form1.cedula_postulado.value;
	  var nacionalidad = document.form1.nacionalidad.value;
	  var tipo = document.form1.tipo.value;
           $.ajax({
                type: 'get',
                dataType: 'text',
                url: 'servicio_postulado.php',
                data: {cedula_postulado: cedula_postulado, nacionalidad : nacionalidad, tipo: tipo},
                success: function(text){
                    LlenarDatos_postulado(text);
                        }
            });  
        }

/*   FUNCION PARA DESBLOQUEAR LA FECHA FINAL DE LA SUPLENCIA     */
function desbloquear_fecha(){

	 document.getElementById("fecha_fin").disabled = false;
	}
function contar_dias(){
	 var f1=document.form1.fecha_inicio.value;
	 var f2=document.form1.fecha_fin.value;
	
	 var aFecha1 = f1.split('/');
     var aFecha2 = f2.split('/');
     var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]);
     var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]);
     var dif = fFecha2 - fFecha1;
     var dias = Math.floor(dif / (1000 * 60 * 60 * 24))+1;
	 if(dias <= 15){
		 document.getElementById("dias").innerHTML = "ERROR LA FECHA NO DEBE SER MENOR A 15 DIAS";
		 }else{
		 document.getElementById("dias").innerHTML = " ";
		 
			 }
	}				
</script>
<?php
	   while($ver = pg_fetch_object($solicitud_mod)){
?>
<br/>
<form id="form1" name="form1" method="post" action="includes/update_solicitud.php">
  <table width="90%" border="0" cellspacing="1" class="tabla_proveedor">
    <tr>
      <td colspan="4"><h2>DATOS DE LA SOLICITUD
        <input name="id_solicitud" type="hidden" id="id_solicitud" value="<?= $ver->id?>" /></h2></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Solicitud Nº</td>
      <td colspan="2"><strong>SS-<?= $ver->id?>-2015</strong></td>
    </tr>
    <tr>
      <td width="4%">&nbsp;</td>
      <td width="29%">Fecha de la Solicitud</td>
      <td width="67%" colspan="2"><?= fecha_venezuela($ver->fecha_incio); ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Motivo de la Suplencia</td>
      <td colspan="2"><select name="m_suplencia" class="campotexto" id="m_suplencia" required="required">
        <option value="">Seleccionar Motivo de la Suplencia</option>
        <?php
		
  	   $sql_motivo = pg_query($link, "SELECT id, descripcion, estatus
  FROM motivo_suplencia
where estatus='t' 
 order by id asc"); 

		   while($motivo = pg_fetch_object($sql_motivo)){  ?>
        <option value="<?= $motivo->id ?>" <?php 
            if($ver->motivo_id==$motivo->id){
			echo 'selected';	
			}	
            ?>>
          <?= $motivo->descripcion ?>
          </option>
        <?php } ?>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Tipo de Cargo</td>
      <td colspan="2"><select name="t_cargo" class="campotexto" id="t_cargo" required="required">
        <option value="">Seleccionar Tipo de Cargo</option>
        <?php
		
  	   $sql_tipo = pg_query($link, "SELECT id, descripcion, estatus
  FROM tipo_cargo
where estatus='t' 
 order by id asc"); 

		   while($tipo = pg_fetch_object($sql_tipo)){  ?>
        <option value="<?= $tipo->id ?>" <?php 
            if($ver->tipo_cargo_id==$tipo->id){
			echo 'selected';	
			}	
            ?>>
          <?= $tipo->descripcion ?>
          </option>
        <?php } ?>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3">Periodo de la Suplencia:
        &nbsp;&nbsp;Desde &nbsp;&nbsp;<input name="fecha_inicio" type="text" class="fecha" id="fecha_inicio" onchange="desbloquear_fecha()" value="<?= fecha_venezuela($ver->fecha_incio); ?>" size="10" required="required"/>
            <img src="images/ico_calendario.jpg" width="18" height="19" />&nbsp;&nbsp;Hasta&nbsp;&nbsp;<input name="fecha_fin" type="text"  disabled="disabled" class="fecha" id="fecha_fin" onchange="contar_dias()" value="<?= fecha_venezuela($ver->fecha_fin); ?>" size="10"  required="required"/>
      <img src="images/ico_calendario.jpg" width="18" height="19" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr  >
      <td colspan="4"><h2>DATOS DEL TITULAR DEL CARGO</h2></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Cedula</td>
      <td colspan="2"><select style="width:25%" class="campotexto" name="nacionalidad_c" id="nacionalidad_c" disabled="disabled" >
        <option value="V">V</option>
        <option value="E">E</option>
      </select>
        <input name="cedula" type="text" class="campotexto" id="cedula" style="width:74%" value="<?= $ver->t_cedula; ?>" size="25" required="required" onblur="obten_datos()"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Nombre</td>
      <td colspan="2">
        <input name="nombre" type="text" id="nombre" value="<?= $ver->t_nombre; ?>" class="campotexto" required="required" readonly="readonly"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Apellido</td>
      <td colspan="2">
      <input name="apellido" type="text" id="apellido" value="<?= $ver->t_apellido; ?>" class="campotexto" required="required" readonly="readonly" />
      <input name="trabajador_id" type="hidden" id="trabajador_id" value="<?= $ver->id_tt; ?>" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Dependencia</td>
      <td colspan="2">
      <input name="dependencia" type="text" id="dependencia" value="<?= $ver->t_dependencia; ?>" class="campotexto" required="required" readonly="readonly" />
      <input name="dependencia_id" type="hidden" id="dependencia_id" value="<?= $ver->dependencia_id ?>" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Cargo</td>
      <td colspan="2">
      <input name="cargo" type="text" id="cargo" value="<?= $ver->t_cargo; ?>" class="campotexto" required="required" readonly="readonly"/>
      <input name="cargo_id" type="hidden" id="cargo_id" value="<?= $ver->cargo_id ?>" /></td>
    </tr>
    <tr  >
      <td colspan="4" >&nbsp;</td>
    </tr>
    <tr  >
      <td colspan="4"><h2>REQUISITOS EXIGIDOS</h2></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Nivel Educativo</td>
      <td colspan="2"><select name="n_educativo" class="campotexto" id="n_educativo" required="required">
        <option value="" selected="selected">Seleccionar Nivel Educativo</option>
        <option  value="Bachiller" <?php if($ver->n_educativo=='Bachiller'){ echo 'selected'; }	?> >Bachiller</option>
        <option  value="TSU"  <?php if($ver->n_educativo=='TSU'){ echo 'selected'; }	?>>TSU</option>
        <option  value="Universitario"  <?php if($ver->n_educativo=='Universitario'){ echo 'selected'; }	?>>Universitario</option>
        <option  value="Postgrado"  <?php if($ver->n_educativo=='Postgrado'){ echo 'selected'; }	?>>Postgrado</option>
      </select></td>
    </tr>
    <tr  >
      <td>&nbsp;</td>
      <td>Área de Especialidad</td>
      <td colspan="2"><select name="a_especialidad" class="campotexto" id="a_especialidad" required="required">
        <option value="" selected="selected">Seleccionar Area de Especialidad</option>
        <?php
		
  	   $sql_profesiones = pg_query($link, "SELECT id, descripcion, estatus
  FROM profesiones
where estatus='t' 
 order by id asc"); 

		   while($profesiones = pg_fetch_object($sql_profesiones)){  ?>
        <option value="<?= $profesiones->id ?>" <?php if($ver->area_especialidad==$profesiones->id){ echo 'selected'; }	?>>
          <?= $profesiones->descripcion ?>
          </option>
        <?php } ?>
      </select></td>
    </tr>
    <tr  >
      <td>&nbsp;</td>
      <td>Experiencia</td>
      <td colspan="2"><select name="experiencia" class="campotexto" id="experiencia" required="required">
        <option value="">Seleccionar Años de Experiencia</option>
        <option value="1" <?php if($ver->experiencia=='1'){ echo 'selected'; }	?>>1</option>
        <option value="2" <?php if($ver->experiencia=='2'){ echo 'selected'; }	?>>2</option>
        <option value="3" <?php if($ver->experiencia=='3'){ echo 'selected'; }	?>>3</option>
        <option value="4" <?php if($ver->experiencia=='4'){ echo 'selected'; }	?>>4</option>
        <option value="5" <?php if($ver->experiencia=='5'){ echo 'selected'; }	?>>5</option>
        <option value="6" <?php if($ver->experiencia=='6'){ echo 'selected'; }	?>>6</option>
        <option value="7" <?php if($ver->experiencia=='7'){ echo 'selected'; }	?>>7</option>
        <option value="8" <?php if($ver->experiencia=='8'){ echo 'selected'; }	?>>8</option>
        <option value="9" <?php if($ver->experiencia=='9'){ echo 'selected'; }	?>>9</option>
        <option value="10" <?php if($ver->experiencia=='10'){ echo 'selected'; }	?>>10</option>
        <option value="11" <?php if($ver->experiencia=='11'){ echo 'selected'; }	?>>11</option>
        <option value="12" <?php if($ver->experiencia=='12'){ echo 'selected'; }	?>>12</option>
        <option value="13" <?php if($ver->experiencia=='13'){ echo 'selected'; }	?>>13</option>
        <option value="14" <?php if($ver->experiencia=='15'){ echo 'selected'; }	?>>14</option>
        <option value="15" <?php if($ver->experiencia=='15'){ echo 'selected'; }	?>>15</option>
      </select></td>
    </tr>
    <tr  >
      <td>&nbsp;</td>
      <td>Habilidades y Destrezas</td>
      <td colspan="2"><textarea name="habilidades" cols="25" rows="2" class="campotexto" id="habilidades" required="required"><?= $ver->habilidades; ?>
  </textarea></td>
    </tr>
    <tr  >
      <td>&nbsp;</td>
      <td>Cursos Realizados</td>
      <td colspan="2"><textarea name="cursos" cols="25" rows="2" class="campotexto" id="cursos" required="required"><?= $ver->cursos; ?>
  </textarea></td>
    </tr>
    <tr  >
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr  >
      <td colspan="4"><h2>POSTULADO</h2></td>
    </tr>

       <tr  >
          <td>&nbsp;</td>
          <td>Tipo</td>
         <td colspan="2"><input name="tipo" type="radio" onClick="javascript:deshabilitar_campos(1)" value="1" <?php if ($ver->tipo==1){?> checked="checked"<?php } ?> />
         Interno-MP
           <input name="tipo" type="radio" value="2" <?php if ($ver->tipo==2){?> checked="checked"<?php } ?> onClick="javascript:deshabilitar_campos(2)" />
         Externo
         <input name="trabajador_id_p" type="hidden" id="trabajador_id_p" value="<?= $ver->id_ts; ?>" /></td>
        </tr>
        <tr  >
          <td>&nbsp;</td>
          <td>Cédula de Identidad</td>
          <td colspan="2"><select style="width:25%" class="campotexto" name="nacionalidad" id="nacionalidad"  >

              <option value="V"  <?php if($ver->s_nacionalidad=='V'){
			echo 'selected';	
			}	
            ?>>V</option>

              <option value="E" <?php if($ver->s_nacionalidad=='E'){
			echo 'selected';	
			}	
            ?>>E</option>

            </select><input name="cedula_postulado"  type="text" class="campotexto" id="cedula_postulado" style="width:75%" onblur="obten_datos_postulado()" value="<?= $ver->s_cedula; ?>" size="25" required="required" /></td>
        </tr>

    <tr>
      <td>&nbsp;</td>
      <td>Nombre</td>
      <td colspan="2">
        <input name="nombre_p" type="text"  class="campotexto" id="nombre_p" value="<?= $ver->s_nombre; ?>" readonly="readonly" required="required"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Apellido</td>
      <td colspan="2">
      <input name="apellido_p" type="text"  class="campotexto" id="apellido_p" value="<?= $ver->s_apellido; ?>" readonly="readonly" required="required" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Dependencia</td>
      <td colspan="2">
      <input name="dependencia_p" type="text"  class="campotexto" id="dependencia_p" value="<?= $ver->s_descripcion; ?>" readonly="readonly" required="required" /></td>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3" align="center" style="padding-top:4px"><input class="bottonsumit" type="submit" name="button" id="button" value="Modificar" /></td>
    <tr  >
      <td colspan="4"><h2>DOCUMENTOS REGISTRADOS</h2></td>
    </tr>
  </table>
</form>
<?php } 
	
?>
<table width="90%" border="0" cellspacing="1" class="tabla_proveedor_consulta">
  <?php
		$color=0; $total=0;
	   while($lista = pg_fetch_object($lista_archivos)){
		    ?>
  <tr bgcolor="<?php if ($color%2==0) echo '#eeeeee'; else echo '#ffffff'; ?>">
    <td align="center">&nbsp;
      <?=$lista->t_documento;?></td>
    <td align="center">&nbsp;&nbsp;<a href="archivo/pdf/<?=$lista->archivo;?>" target="_blank"><img src="images_icon/pdf.png" title="Planilla" width="20" height="20" /></a>&nbsp;</td>
  </tr>
  <?php 
		 $color++;
	     $total++;
		} 
		pg_free_result($lista_archivos);
        pg_close($link);
		?>
</table><br/>
<table width="95%" border="0" align="center" cellspacing="1" >
  <tr>
    <td><table width="100%" border="0" cellspacing="1" class="tabla_proveedor_consulta">
      <tr>
        <td colspan="6" bgcolor="#BFBFBF">&nbsp;<img src="images_icon/history.gif" width="16" height="16" />&nbsp;<strong>HISTORICO DEL CICLO</strong></td>
      </tr>
      <tr  bgcolor="#EEE" >
        <td width="47%" >Estacion:</td>
        <td width="16%">Estatus:</td>
        <td width="12%">Recibido el:</td>
        <td width="25%">Observaciones:</td>
      </tr>
      <?php
	  while($historico = pg_fetch_object($ciclo_historico)){
		    ?>
      <tr>
        <td align="left">&nbsp;
          <?= orden_alfabetico($historico->orden).$historico->rol; ?></td>
        <td align="center"><?= estatus_historico($historico->aprobado); ?></td>
        <td align="center"><?= fecha_venezuela($historico->fecha); ?></td>
        <td align="center"><?= $historico->observacions; ?></td>
      </tr>
      <?php
	} 
		
		?>
    </table></td>
  </tr>
</table>
