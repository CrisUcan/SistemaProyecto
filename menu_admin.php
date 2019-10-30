<?php
session_start();
if($_SESSION['x']!='SI2'){
	header("Location:acceso.php?mensaje=No has iniciado sesion...");
	exit();
}
echo "<h5><a href = \"salir.php\">Cerrar Sesión</a></h5>";
echo '<br>';
echo "Hola ".$_SESSION['nombre']." Has iniciado tu sesion en el menu Administrador...";

?>
<html>
<title></title>
<head></head>
<body>
<table width="376" align="center">
<tr>
	<td width="163" align="center" valign="middle">
		<a href="form_lista_reg_admin.php">Alumnos Registrados</a> </td>
	<td width="53" align="center" valign="middle">
		| |	</td>
	<td width="78" align="center" valign="middle">
		<a href="calendario.php">Calendario</a> </td>
</tr>
</table>
</body>
</html>