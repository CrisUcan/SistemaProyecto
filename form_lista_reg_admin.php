<?php
session_start();
if($_SESSION['x']!='SI2'){
	header("Location:acceso.php?mensaje=No has iniciado sesion...");
	exit();
}
echo "<h5><a href = \"salir.php\">Cerrar Sesion</a></h5>";
echo '<br>';
echo "Hola ".$_SESSION['nombre']." Has iniciado tu sesion...";

@$buscar = $_POST['nombre'];
include('conexion.php');
$basedatos = "tec";
$link = conectarse($basedatos);

 @$records_per_page = 5;

        require 'zebrapagination/Zebra_Pagination.php';
		
        @$pagination = new Zebra_Pagination();

        $pagination->navigation_position(isset($_GET['navigation_position']) && in_array($_GET['navigation_position'], array('left', 'right')) ? $_GET['navigation_position'] : 'outside');
 
		@$x = ($pagination->get_page() - 1) * $records_per_page;
			
		$result = mysqli_query($link,"SELECT SQL_CALC_FOUND_ROWS  r.id, r.matricula, r.fecha, r.hora, r.semestre, r.nombre, r.grupo, r.id_materia, m.nom_materia, r.sancion from tec.registro r
        left join  tec.alumnos a on r.id_alumno = a.id
        left join tec.materias m on r.id_materia = m.id
        where  r.estatus = '0' and r.nombre LIKE '%$buscar%' ORDER BY r.id LIMIT $x, $records_per_page")or die('error en la consulta...');//. (($pagination->get_page()) * 10) .
  
        $rows = mysqli_fetch_assoc(mysqli_query($link, 'SELECT FOUND_ROWS() AS rows'));
		
        $pagination->records($rows['rows']);
        $pagination->records_per_page($records_per_page);							
?>
<html>
<title>LISTADO DE ALUMNOS REGISTRADOS AL CENTRO DE COMPUTO</title>
<meta charset="utf-8">
        <link rel="stylesheet" href="zebrapagination/public/css/zebra_pagination.css" type="text/css">
        <link rel="stylesheet" href="zebrapagination/examples/style.css" type="text/css">
<style type="text/css">
.style1 {
	font-size: 12px;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
}
.style2 {
	font-size: 10px;
	color: #990000;
	font-weight: bold;
}
</style>
<head></head>
<body>
	<form name = "form1" action = "form_lista_reg_admin.php" method = "post">
		<table width="1005" >
		  <!--DWLayoutTable-->
			<tr>
				<td height="26" colspan="9" align="right" valign="middle">
					Buscar: <input name = "nombre" type = "text" size="10">
					<input type = "submit" name = "buscar" value = "BUSCAR" >			
					<hr>				</td>
		    </tr>
			<tr>
			   <td width="84" height="17" align="left" valign="middle"><span class="style1">MATRICULA</span></td>
			   <td width="134" align="center" valign="middle"><span class="style1">NOMBRE</span></td>
			   <td width="92" align="center" valign="middle"><span class="style1">FECHA</span></td>
			   <td width="89" align="center" valign="middle"><span class="style1">HORA</span></td>
			   <td width="74" align="center" valign="middle"><span class="style1">GRUPO</span></td>
			   <td width="61" align="center" valign="middle"><span class="style1">SEMESTRE</span></td>
			   <td width="142" align="center" valign="middle"><span class="style1">MATERIA</span></td>
			   <td width="87" align="center" valign="middle"><span class="style1">SANCI&Oacute;N</span></td>
			   <td width="184" align="center" valign="middle"><span class="style1">Borrar Registro</span></td>
			</tr>
			
			<?php
			    $c = 0;
				while (@$row = mysqli_fetch_array($result)){
				$c+=1;	
			?>
	 <tr>
        <td height="21" align="left" valign="middle"><span class="style2">
		<?php echo "<a href = \"edit_reg.php?id=$row[id]&ed=1&matricula=$row[matricula]\" title = \" Asignar Sanción u Observación\">$row[matricula]</a>"; ?></td>
		<td align="left" valign="middle"><span class="style2"><?php echo $row['nombre'];?></span></td>
		<td align="center" valign="middle"><span class="style2"><?php echo $row['fecha'];?></span></td>
		<td align="center" valign="middle"><span class="style2"><?php echo $row['hora'];?></span></td>
		<td align="center" valign="middle"><span class="style2"><?php echo $row['grupo'];?></span></td>
		<td align="center" valign="middle"><span class="style2"><?php echo $row['semestre'];?></span></td>
		<td align="center" valign="middle"><span class="style2"><?php echo $row['nom_materia'];?></span></td>
		<td align="center" valign="middle"><span class="style2"><?php echo $row['sancion'];?></span></td>
			<td align="center" valign="middle"><?php echo "<a href = \"alta.php?id=$row[id]&opcion=3\">Eliminar</a>"; ?></td>
			<?php } ?>
		  </tr>
	 <tr>
	   <td height="17" colspan="9" valign="top"><hr><?php echo $pagination->render();?></td>
	   </tr>
	 <tr>
	   <td height="21" colspan="9" align="center" valign="middle"><br>
       Total Registrados: <?php
		  $registrados = mysqli_query($link, "select count(*) total_registrados from tec.registro where estatus = 0");
		  $row_registrados = mysqli_fetch_array($registrados);
		   echo "Mostrando ".$c." de ".$row_registrados['total_registrados']; ?></td>
	   </tr>
	  </table>
	</form>
</body>
</html>