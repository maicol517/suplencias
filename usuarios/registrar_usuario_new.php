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





<form id="form1" class="prueba" name="form1" method="post" action="usuarios/registrar_usuario_add.php">


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
          <td colspan="4"><h2>REGISTRAR USUARIO
           
             
          </h2></td>
          </tr>

        <tr  >
          <td width="2%" >&nbsp;</td>
          <td width="35%" >Cedula            </td>
          <td width="63%" colspan="2"><input name="cedula" class="campotexto" type="text" id="cedula" size="25" required="required" /></td>
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






      </table>
      <p>&nbsp;</p></td>
    </tr>
  </table>

</form>
