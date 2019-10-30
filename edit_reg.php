<?php
session_start();
if($_SESSION['x'] != 'SI'){
	header("location: form_m.php?mensaje=Para registrarte deberás ingresar tu matricula...");
	exit();
}
include("conexion.php");
$basedatos = "tec";
$link = conectarse($basedatos);

@$ed = $_GET['ed'];

if($ed == 0){
   @$matricula = $_SESSION['matricula'];
   @$op = $_GET['op'];
   @$carrera = $_SESSION['carrera'];
   $consulta = mysqli_query($link, "select *from tec.alumnos where matricula = '$matricula'");
   $row = mysqli_fetch_array($consulta);
}
if ($ed == '1'){
    @$id = $_GET['id'];
	@$matricula = $_GET['matricula'];
    @$result = mysqli_query($link, "select r.id, r.matricula, r.fecha, r.hora, r.semestre, r.nombre nom_completo, r.grupo, r.id_materia, m.nom_materia, a.ap_paterno, a.ap_materno, a.nombre, a.carrera, r.software, r.observacion, r.sancion from tec.registro r
    left join  tec.alumnos a on r.id_alumno = a.id
    left join tec.materias m on r.id_materia = m.id
    where  r.estatus = '0' and r.id = '$id'");	
	$row = mysqli_fetch_array($result);
	@$carrera = $row['carrera'];
}
 $consulta2 = mysqli_query($link, "select distinct grupo from tec.cargas where matricula = '$matricula' ");
 $consulta3 = mysqli_query($link, "select id, materia from tec.cargas where matricula = '$matricula'");
?>
<html>
<head>
<title>REGISTRO DE ALUMNOS</title>

<style type="text/css">
<!--
.style1 {font-family: Arial, Helvetica, sans-serif}
.style2 {
	font-size: 12px;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<?php if($ed == 1) echo "ADMINISTRADOR"; ?>
<hr>
<form name = "form1" action = "alta.php" method = "post"  />
<table width="465" border = "0">
  <!--DWLayoutTable-->
	<tr>
		<td width="459" height="24" align="left" valign="middle">Matricula:
        <input name = "matricula" type = "text"  readonly="true" Value = "<?php echo $matricula; ?>" size="15"/> </td>
  </tr>
	<tr>
	  <td height="24" valign="top">Nombre: 
      <input name = "nombre" type = "text"  readonly="true"  Value = "<?php echo $row['nombre'].' '.$row['ap_paterno'].' '.$row['ap_materno']; ?>" size="50"/>
      </td>
  </tr>
	<tr>
	  <td height="24" valign="top">Fecha:  
      <input type = "text" name = "fecha"  Value = "<?php echo ($ed == '0') ? date('Y-m-d') : $row['fecha']; ?>" readonly="true"/> </td>
  </tr>
	<tr>
	  <td height="24" valign="top">Hora de entrada :
      <input type = "text" name = "hora"  Value = "<?php echo ($ed == '0') ? date('H:i:s')  : $row['hora']; ?>" readonly="true"/> </td>
  </tr>
	<tr>
	  <td height="24" valign="top">Carrera: 
        <input name = "#" type = "text" readonly="true"  Value = "<?php 
		if ($row['carrera'] == 'L01') echo "INGENIERIA EN INDUSTRIAS ALIMENTARIAS";
		if ($row['carrera'] == 'L02') echo "LICENCIATURA EN ADMINISTRACION";
		if ($row['carrera'] == 'L03') echo "LICENCIATURA EN GASTRONOMIA";
		if ($row['carrera'] == 'L04') echo "INGENIERIA EN SISTEMAS COMPUTACIONALES";
		if ($row['carrera'] == 'L05') echo "INGENIERIA EN ENERGIAS RENOVABLES";
		if ($row['carrera'] == 'L06') echo "LICENCIATURA EN TURISMO";
		?>" size="45"/> 
		 <input name = "carrera" type = "hidden" readonly="true"  Value = "<?php echo $row['carrera'];?>"/>
		</td>
  </tr>
  <tr>
	  <td height="24" valign="top">Semestre: 
        <input name = "semestre" type = "text"  Value = "<?php echo $row['semestre']; ?>" size="3" readonly="true"/> </td>
  </tr>
  <tr>
	  <td height="24" valign="top">Grupo: 
	   <?php   
	  if($ed == 0){   ?> 
        <select name="grupo" >
          <option ></option>
          <?php
		   while ($row2 = mysqli_fetch_array($consulta2)){ 
		   ?>
          <option value="<?php echo $row2['grupo']; ?>"><?php echo $row2['grupo']; ?></option>
          <?php } ?>
        </select>
		<?php } 
		 if($ed == '1'){ ?>
		<input type="text" name="grupo" value="<?php echo $row['grupo'];?>" readonly="true">
		<?php } ?>
	</td>
  </tr>
<tr>
	  <td height="24" valign="top">Materia:  
	  <?php   
	  if($ed == 0){   ?>      
	    <select name="id_materia" >
          <option ></option>
          <?php
		  while (@$row3 = mysqli_fetch_array($consulta3)){ ?>
          <option value="<?php echo $row3['id']; ?>"><?php echo $row3['materia']; ?></option>
          <?php } ?>
        </select>
		<?php } 
		 if($ed == 1){ ?>
		<input name="materia" type="text" value="<?php echo $row['nom_materia'];?>" size="47" readonly="true">
		<input name="id_materia" type="hidden" value="<?php echo $row['id_materia'];?>" size="47" readonly="true">
		<?php } ?>
	</td>
  </tr>
  <tr>
	  <td height="24" valign="top">Software a Utilizar:
	  <?php 
	  if($ed == 0){ ?>        
	    <select name="software" >
          <option >...</option>
          <option value="WPS OFFICE">WPS OFFICE</option>
		  <option value="FOXIT READER">FOXIT READER</option>
		  <option value="PEAZIP">PEAZIP</option>
		  <option value="K-LITE">K-LITE</option>
		  <option value="NOTEPAD++">NOTEPAD++</option>
		  <option value="ANTIVIRUS 360 TOTAL SECURITY">360 TOTAL SECURITY</option>
		  <option value="GOOGLE CHROME">GOOGLE CHROME</option>
       </select>
	  <?php }
	  if($ed == 1){ 
	  ?>
	  <input type="text" name="software" value="<?php echo $row['software']; ?>" readonly="true">
	  <?php } ?>
	</td>
  </tr>
  <tr>
  <td>
  <?php if($ed == 1){  ?>
  <hr>
    <span class="style2">SANCIONES :    </span></td>
  </tr>
  <tr>
		<td width="459" height="24" align="left" valign="middle"> 
			<textarea name="observacion" cols="35" rows="4">Observaciones: <?php echo $row['observacion']; ?></textarea>
		</td>
  </tr>
  <tr>
  	<td>
	<?php if($row['sancion']==0){ ?>
		Tipo de sanción:
		<select name="sancion">
			<option>---</option>
			<option value = "1">1 dia de suspensión</option>
			<option value = "2">2 dias de suspensión</option>
			<option value = "3">3 dias de suspensión</option>
			<option value = "4">4 dias de suspensión</option>
			<option value = "5">5 dias de suspensión</option>
			<option value = "6">6 dias de suspensión</option>
			<option value = "7">7 dias de suspensión</option>
			<option value = "8">8 dias de suspensión</option>
			<option value = "9">9 dias de suspensión</option>
			<option value = "10">10 dias de suspensión</option>
		</select>
		<?php } if($row['sancion']>0){ ?>
		Cantidad de Dias: <input name = "sancion" type = "text"  Value = "<?php echo $row['sancion'];?>" size="3" />
		<?php } ?>
	</td>
  </tr>
  <?php } ?>
	<tr>
	  <td height="28" valign="top">
	  	<?php if($ed==0){ ?>
			<input type = "hidden"  name = "opcion" value="1"/>
			<?php } if($ed==1){ ?>
			<input type = "hidden"  name = "opcion" value="2"/>
			<?php } ?>
			
			<input name = "id_alumno" type = "hidden"  Value = "<?php echo $row['id']; ?>" />
			<input type = "submit" name = "guardar" value = "GUARDAR"  id = "id_guardar"/>
			<input type="button" name="regresar" onClick="history.back();" value="<< Regresar" />
			</form>	
			</td>
  </tr>
</table>
</body>
</html>
