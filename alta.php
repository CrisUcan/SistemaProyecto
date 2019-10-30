<?php
@$matricula = $_POST['matricula'];
@$nombre = $_POST['nombre'];
@$fecha = $_POST['fecha'];
@$hora = $_POST['hora'];
@$carrera = $_POST['carrera'];
@$semestre = $_POST['semestre'];
@$grupo = $_POST['grupo'];
@$software = $_POST['software'];
@$id_materia = $_POST['id_materia'];
@$id_alumno = $_POST['id_alumno'];
@$observacion = $_POST['observacion'];
@$sancion = $_POST['sancion'];

if (!empty($_POST['opcion'])){
	@$opcion = $_POST['opcion'];
}else
	@$opcion = $_GET['opcion'];

include ("conexion.php");
$basedatos = "tec";
$link = conectarse($basedatos);

switch ($opcion)
{
  case '1': //alta registro
     	mysqli_query($link,"insert into tec.registro set
	    matricula = '$matricula', 
     	nombre = '$nombre',
     	fecha = '$fecha',
     	hora = '$hora',
     	grupo = '$grupo',
		semestre = '$semestre',
		software = '$software',
		observacion = '$observacion',
		sancion = '$sancion',
		id_materia = '$id_materia',
	 	id_alumno = '$id_alumno',
		clave_carrera = '$carrera'") or die ('No se guardaron los datos');
     	header('location: form_lista_reg.php?mensaje=El usuario ha sido registrado en el sistema...');
  break;	
  
  case '2': //consulta matricula
  	  @$op = $_POST['op'];
	  $result = mysqli_query($link, "select count(*) as cantidad from tec.alumnos  where matricula = '$matricula' ");
	  $row = mysqli_fetch_array($result);
	  if($row['cantidad'] != 1)
	  {
	  	  header('location: form_m.php?mensaje= La matricula '.$matricula.' no se encuentra registrada...');
	  }
	  else{
	 		   $consulta = mysqli_query($link, "select *from tec.alumnos where matricula = '$matricula'");
               $row2 = mysqli_fetch_array($consulta);
               //$carrera = $row2['carrera'];
			   session_start();
			   $_SESSION['carrera'] = $row2['carrera'];
			   $_SESSION['matricula'] = $matricula;
			   $_SESSION['x'] = 'SI';
               header("location:edit_reg.php?op=$op&ed=0"); //matricula=$matricula&
           }
  break;
  default:
  break;
} 
?>