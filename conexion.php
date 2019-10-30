<?php
function conectarse($bd){
	if (!($link = mysqli_connect("localhost","root")))
	{
		echo "No se pudo conectar a la base de datos";
		exit();
	}
	
	if (!(mysqli_select_db($link, $bd)))
	{
		echo "No se pudo seleccionar la tabla";
		exit();
	}
	return $link;
}
?>
