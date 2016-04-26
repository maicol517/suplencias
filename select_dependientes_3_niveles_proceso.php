<?php
// Array que vincula los IDs de los selects declarados en el HTML con el nombre de la tabla donde se encuentra su contenido
$listadoSelects=array(
"select1"=>"select_1",
"select2"=>"dependencias",

);

function validaSelect($selectDestino)
{
	// Se valida que el select enviado via GET exista
	global $listadoSelects;
	if(isset($listadoSelects[$selectDestino])) return true;
	else return false;
}

function validaOpcion($opcionSeleccionada)
{
	// Se valida que la opcion seleccionada por el usuario en el select tenga un valor numerico
	if(is_numeric($opcionSeleccionada)) return true;
	else return false;
}

 $selectDestino=$_GET["select"];  $opcionSeleccionada=$_GET["opcion"];
 $estar =$_GET["esta"];
if(validaSelect($selectDestino) && validaOpcion($opcionSeleccionada))
{
	$tabla=$listadoSelects[$selectDestino];
include ("db_link/conex.php");
if ($tabla == 'dependencias'){
 


	$consulta=pg_query("SELECT id, descripcion as opcion, estado_id as relacion FROM $tabla WHERE estado_id='$opcionSeleccionada' order by opcion asc") ;
}

	
	// Comienzo a imprimir el select
	echo "<select name='".$selectDestino."' id='".$selectDestino."' class='campotexto' onChange='cargaContenido(this.id, select1.value)' required='required'>";
	echo "<option value='0'>Seleccionar</option>";
	while($registro=pg_fetch_row($consulta))
	{
		// Convierto los caracteres conflictivos a sus entidades HTML correspondientes para su correcta visualizacion
		$registro[1]=htmlentities($registro[1]);
		// Imprimo las opciones del select
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}			
	echo "</select>";
}
?>
