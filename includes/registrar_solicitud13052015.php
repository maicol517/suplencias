
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

//*              SERVICIO TRABAJADOR 

/*	funcion que envia los datos por ajax	*/
	$(document).ready(function(){
		//cuando se de click en el boton enviar
		$('#cedula').blur(function(ev){
			
			
			//se almacenan los valores del los text en las variables 	
			var cedula = $("#cedula").val();
	         //var nacionalidad = $("#nacionalidad").val();

			var datos =	{	cedula:cedula
						};  
			$('#resultado').load("servicio_trabajador.php", datos);
			
			
			
			
		});
       
    });	
	
//*              SERVICIO POSTULADO

/*	funcion que envia los datos por ajax	*/
	$(document).ready(function(){
		//cuando se de click en el boton enviar
		$('#cedula_postulado').blur(function(ev){
			
			
			//se almacenan los valores del los text en las variables 	
			var cedula_postulado = $("#cedula_postulado").val();
	         var tipo = $("#tipo").val();
			 var nacionalidad = $("#nacionalidad").val();

			var datos_postulado =	{	cedula_postulado:cedula_postulado, tipo:tipo, nacionalidad:nacionalidad
						};  
			$('#resultado_postulado').load("servicio_postulado.php", datos_postulado);
			
			
			
			
		});
       
    });		
	
/*function deshabilitar_campos(valor) 
{
 if(valor=='1')
 { 

  document.form1.tipo.disabled=false;
  document.form1.cedula_postulado.disabled=false; 
  document.form1.nacionalidad.disabled=false; 
  
  // SERVICIO POSTULADO SI //
  
  document.form1.nombre_postulado.disabled=false;
  document.form1.apellido_postulado.disabled=false;
  document.form1.descripcion_postulado.disabled=false;

}
 
 if(valor=='2') 
 { 
  document.form1.tipo.disabled=true;
   document.getElementById("cedula_postulado").value = " ";
  document.form1.cedula_postulado.disabled=true;
  document.form1.nacionalidad.disabled=true; 
  
  // SERVICIO POSTULADO NO //
  document.getElementById("nombre_postulado").value = " ";
  document.form1.nombre_postulado.disabled=true;
  document.getElementById("apellido_postulado").value = " ";
  document.form1.apellido_postulado.disabled=true;
  document.getElementById("descripcion_postulado").value = " ";
  document.form1.descripcion_postulado.disabled=true;
 }
 
 



}//fin funcion	*/
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
<form id="form1" class="prueba" name="form1" method="post" action="includes/registrar_solicitud_add.php">


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
          <td colspan="4"><h2>DATOS DE LA SOLICITUD</h2></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Motivo de la Suplencia
            <input name="t_solicitud" type="hidden" id="t_solicitud" value="1" /></td>
          <td colspan="2"><select name="m_suplencia" class="campotexto" id="m_suplencia" required="required">
            <option value="">Selecionar Motivo de la Suplencia</option>
            <?php
		
  	   $sql_motivo = pg_query($link, "SELECT id, descripcion, estatus
  FROM motivo_suplencia
where estatus='t' 
 order by id asc"); 

		   while($motivo = pg_fetch_object($sql_motivo)){  ?>
            <option value="<?= $motivo->id ?>">
              <?= $motivo->descripcion ?>
              </option>
            <?php } ?>
          </select></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Tipo de Cargo</td>
          <td colspan="2"><select name="t_cargo" class="campotexto" id="t_cargo" required="required">
            <option value="">Selecionar Tipo de Cargo</option>
            <?php
		
  	   $sql_tipo = pg_query($link, "SELECT id, descripcion, estatus
  FROM tipo_cargo
where estatus='t' 
 order by id asc"); 

		   while($tipo = pg_fetch_object($sql_tipo)){  ?>
            <option value="<?= $tipo->id ?>">
              <?= $tipo->descripcion ?>
              </option>
            <?php } ?>
          </select></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="3">Periodo de la Suplencia:&nbsp;&nbsp;&nbsp;Desde &nbsp;&nbsp;<input name="fecha_inicio" type="text" class="fecha" id="fecha_inicio" size="10" required="required" onchange="desbloquear_fecha()"/>
            <img src="images/ico_calendario.jpg" width="18" height="19" />&nbsp;&nbsp;Hasta&nbsp;&nbsp;<input name="fecha_fin" type="text" class="fecha" id="fecha_fin" size="10"  required="required"  disabled="disabled" onchange="contar_dias()"/>
            <img src="images/ico_calendario.jpg" width="18" height="19" /></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="3"><div style="color:#900; text-align:center; font-weight:bold;"id="dias"></div></td>
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

            </select><input name="cedula" style="width:75%" class="campotexto" type="text" id="cedula" size="25" required="required" /></td>
        </tr>
         <tr  >
          <td colspan="4" ><div  id="resultado"></div></td>
          </tr>
        <tr  >
          <td colspan="4"><h2>PERFIL DEL CANDIDATO  </h2></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Nivel Educativo</td>
          <td colspan="2"><select name="n_educativo" class="campotexto" id="n_educativo" required="required">
            <option value="" selected="selected">Selecionar Nivel Educativo</option>
            <option  value="Bachiller">Bachiller</option>
            <option  value="TSU">TSU</option>
            <option  value="Universitario">Universitario</option>
            <option  value="Postgrado">Postgrado</option>
          </select></td>
        </tr>
        <tr  >
          <td>&nbsp;</td>
          <td>Área de Especialidad</td>
          <td colspan="2"><select name="a_especialidad" class="campotexto" id="a_especialidad" required="required">
            <option value="" selected="selected">Selecionar Area de Especialidad</option>
            <?php
		
  	   $sql_profesiones = pg_query($link, "SELECT id, descripcion, estatus
  FROM profesiones
where estatus='t' 
 order by id asc"); 

		   while($profesiones = pg_fetch_object($sql_profesiones)){  ?>
              <option value="<?= $profesiones->id ?>">
              <?= $profesiones->descripcion ?>
              </option>
              <?php } ?>
          </select></td>
        </tr>
        <tr  >
          <td>&nbsp;</td>
          <td>Experiencia</td>
          <td colspan="2"><select name="experiencia" class="campotexto" id="experiencia" required="required">
            <option value="">Selecionar Años de Experiencia</option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>
            <option>11</option>
            <option>12</option>
            <option>13</option>
            <option>14</option>
            <option>15</option>
          </select></td>
        </tr>
        <tr  >
          <td>&nbsp;</td>
          <td>Habilidades y Destrezas</td>
          <td colspan="2"><textarea name="habilidades" cols="25" rows="2" class="campotexto" id="habilidades" required="required"></textarea></td>
        </tr>
        <tr  >
          <td>&nbsp;</td>
          <td>Cursos Realizados</td>
          <td colspan="2"><textarea name="cursos" cols="25" rows="2" class="campotexto" id="cursos" required="required"></textarea></td>
        </tr>
                <tr  >
          <td colspan="4"><h2>POSTULADO</h2></td>
          </tr>
        <tr  >
          <td>&nbsp;</td>
          <td>Tipo</td>
          <td colspan="2"><select name="tipo" class="campotexto" id="tipo" required="required">
            <option value="">Selecionar Tipo</option>
            <option value="1">Interno -  MP</option>
            <option value="2">Externo</option>
          </select></td>
        </tr>
        <tr  >
          <td>&nbsp;</td>
          <td>Cédula de Identidad</td>
          <td colspan="2"><select style="width:25%" class="campotexto" name="nacionalidad" id="nacionalidad"  >

              <option value="V">V</option>

              <option value="E">E</option>

            </select><input style="width:75%" name="cedula_postulado" class="campotexto"  type="text" id="cedula_postulado" size="25" required="required" /></td>
        </tr>
                 <tr  >
          <td colspan="4" ><div  id="resultado_postulado"></div></td>
          </tr>



        <tr>
          <td colspan="4"><h2>&nbsp;</h2></td>
          </tr>
        <tr>
          <td colspan="4" align="center"><input class="bottonsumit" type="submit" name="button" id="button" value="Enviar" /></td>
        </tr>
      </table>
      <p>&nbsp;</p></td>
    </tr>
  </table>

</form>
