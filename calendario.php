<?php
session_start();
if($_SESSION['x']!='SI2'){
	header("Location:acceso.php?mensaje=No has iniciado sesion...");
	exit();
}
echo "<h5><a href = \"salir.php\">Cerrar Sesion</a></h5>";
echo '<br>';
echo "Hola ".$_SESSION['nombre']." Has iniciado tu sesion...";
echo '<br>';
	if(!empty($_GET['fecha'])){
		$fecha1 = $_GET['fecha'];
		echo 'fecha1= '.$fecha1;
		echo '<br>';
	}
	if(empty($_GET['fecha']))
		$fecha1 = 0;
		
	if(!empty($_GET['fecha2'])){
		$fecha2 = $_GET['fecha2'];
		echo 'fecha2= '.$fecha2;	
		echo '<br>';
	}	
	if(empty($_GET['fecha']))
		$fecha2 = 0;
		
  	include('conexion.php');
	$basedatos = "tec";
	$link = conectarse($basedatos);
	$result = mysqli_query($link, "select count(*) total_reg from tec.registro as r
						   where r.estatus = 0 and ((r.fecha >= '$fecha1') and (r.fecha <= '$fecha2'))");
	$row = mysqli_fetch_array($result);	
	$registro_total = $row['total_reg'];				   
/*
	if($registro_total > 0)
		$registro_total = $registro_total;				   
	else
		echo 'No hay usuarios registrados';
	*/
	//----------------------Consulta Registro Sistemas--------------
	$result2 = mysqli_query($link, "select count(*) total_reg_isc from tec.registro as r
									left join tec.carreras c on c.clave = r.clave_carrera 
						            where r.estatus = 0 and c.clave = 'L04' and ((r.fecha >= '$fecha1') and (r.fecha <= '$fecha2'))");
	$row_isc = mysqli_fetch_array($result2);
	@$registro_isc = $row_isc['total_reg_isc'];	
	//----------------------Consulta Registro Administracion--------
	$result3 = mysqli_query($link, "select count(*) total_reg_la from tec.registro as r
									left join tec.carreras c on c.clave = r.clave_carrera 
						            where r.estatus = 0 and c.clave = 'L02' and ((r.fecha >= '$fecha1') and (r.fecha <= '$fecha2'))");
	$row_la = mysqli_fetch_array($result3);
	@$registro_la = $row_la['total_reg_la'];
	//----------------------Consulta Registro Gastronomia--------
	$result4 = mysqli_query($link, "select count(*) total_reg_lg from tec.registro as r
									left join tec.carreras c on c.clave = r.clave_carrera
						            where r.estatus = 0 and c.clave = 'L03' and ((r.fecha >= '$fecha1') and (r.fecha <= '$fecha2'))");
	$row_lg = mysqli_fetch_array($result4);
	@$registro_lg = $row_lg['total_reg_lg'];
	//----------------------Consulta Registro Industrias--------
	$result5 = mysqli_query($link, "select count(*) total_reg_ia from tec.registro as r
									left join tec.carreras c on c.clave = r.clave_carrera
						            where r.estatus = 0 and c.clave = 'L01' and ((r.fecha >= '$fecha1') and (r.fecha <= '$fecha2'))");
	$row_ia = mysqli_fetch_array($result5);
	@$registro_ia = $row_ia['total_reg_ia'];
	//----------------------Consulta Registro Energias--------
	$result6 = mysqli_query($link, "select count(*) total_reg_er from tec.registro as r
									left join tec.carreras c on c.clave = r.clave_carrera
						            where r.estatus = 0 and c.clave = 'L05' and ((r.fecha >= '$fecha1') and (r.fecha <= '$fecha2'))");
	$row_er = mysqli_fetch_array($result6);
	@$registro_er = $row_er['total_reg_er'];	
	//----------------------Consulta Registro Turismo--------
	$result7 = mysqli_query($link, "select count(*) total_reg_lt from tec.registro as r
									left join tec.carreras c on c.clave = r.clave_carrera
						            where r.estatus = 0 and c.clave = 'L06' and ((r.fecha >= '$fecha1') and (r.fecha <= '$fecha2'))");
	$row_lt = mysqli_fetch_array($result7);
	@$registro_lt = $row_lt['total_reg_lt'];	
	//-----------------------Software mas utilizado----------
	$result8 = mysqli_query($link, "SELECT r.software, COUNT(r.software) totsoftware FROM tec.registro r 
						            where r.estatus = 0  and ((r.fecha >= '$fecha1') and (r.fecha <= '$fecha2')) GROUP BY r.software order by totsoftware desc");
	//$row_software = mysqli_fetch_array($result8);
	//@$registro_software  = $row_software['software_max'];			
?>
<html lang="en">
<head>
<title>Home</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" charset="utf-8"/>
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">

<!-- calendar stylesheet -->
  <link rel="stylesheet" type="text/css" media="all" href="jscalendar/calendar-win2k-cold-1.css" title="win2k-cold-1" />

  <!-- main calendar program -->
  <script type="text/javascript" src="jscalendar/calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="jscalendar/lang/calendar-es.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="jscalendar/calendar-setup.js"></script>
  <script>
  function validar(){
  	if(document.form1.fecha.value == 0){
		alert('Debes insertar la fecha 1');
		document.form1.fecha1.focus();
	}
	if(document.form1.fecha2.value == 0){
		alert('Debes insertar la fecha 2');
		document.form1.fecha2.focus();
	}
	document.form1.submit();
  }
  </script>
  <script type="text/javascript">
    function catcalc(cal) {
        var date = cal.date;
        var time = date.getTime()
        // use the _other_ field
        var field = document.getElementById("f_calcdate");
        if (field == cal.params.inputField) {
            field = document.getElementById("f_date_a");
            time -= Date.WEEK; // substract one week
        } else {
            time += Date.WEEK; // add one week
        }
        var date2 = new Date(time);
        field.value = date2.print("%Y-%m-%d");
    }
</script>

  <style type="text/css">
<!--
.style2 {font-size: 12px}
.style3 {font-size: 10px}
.style4 {font-size: 14px}
.style8 {
	font-size: 12px;
	font-family: Arial, Helvetica, sans-serif;
	color: #990000;
	font-weight: bold;
}
.style10 {
	font-size: 12px;
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.style12 {font-size: 12px; font-family: Arial, Helvetica, sans-serif; }
-->
  </style>
</head>
<body>
	<br>
<form name="form1" action="calendario.php" method="get">
  <div align="center">
    <table width="593">
      <!--DWLayoutTable-->
     
  <tr>
    <td width="51" height="25" align="right" valign="middle" class="style3">DEL:</td>
    <td width="217" align="left" valign="middle"><label><span class="style2">
      <input type="text" name="fecha" id="f_date_b"  readonly="TRUE"/>
      <img src="jscalendar/img.gif" width="20" height="17" id="f_trigger_b" style="cursor: pointer; border: 1px solid red;" title="Selecciona la fecha y la hora de llegada"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" /></span></label></td>
  <td width="27" align="right" valign="middle" class="style3">AL:</td>
  <td width="266" align="left" valign="middle"><span class="style2">
    <input type="text" name="fecha2" id="f_date_c"  readonly="TRUE"/>
    <img src="jscalendar/img.gif" width="20" height="17" id="f_trigger_c" style="cursor: pointer; border: 1px solid red;" title="Selecciona la fecha y la hora de llegada"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" /></span></td>
  </tr>
  <tr>
    <td height="26" colspan="4" align="center" valign="middle">
      <input type="button" name="calcular" value="Calcular" onClick="validar();" />    </td>
    </tr>
  <tr>
    <td height="2"></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
    </table>
  </div>
  <script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_b",      // id of the input field
        ifFormat       :    "%Y/%m/%d",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
		align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    false,           // double-click mode
        step           :    1                // show all years in drop-down boxes (instead of every other year as default)
    });
	Calendar.setup({
        inputField     :    "f_date_c",      // id of the input field
        ifFormat       :    "%Y/%m/%d",       // format of the input field
        showsTime      :    true,            
        button         :    "f_trigger_c",   
		align          :    "Tl",           
        singleClick    :    false,           
        step           :    1                
    });
</script>
</form>
		

<br>
<br>
<table width="558" border="0" cellpadding="0" cellspacing="0" align="center">
  <!--DWLayoutTable-->
  
  <tr>
    <td height="36" colspan="2" align="left" valign="middle"><span class="style12">Total de Alumnos Registrados  =     
      <?php echo $registro_total; ?>	  </span>
	  <hr>	  </td>
  </tr>
  <tr>
    <td height="23" colspan="2" align="left" valign="middle"><span class="style12">Total de Alumnos de la Carrera de ISC  =     
      <?php echo $registro_isc; ?>	  </span>    </td>
  </tr> 
  <tr>
    <td height="23" colspan="2" align="left" valign="middle"><span class="style12">Total de Alumnos de la Carrera de Administracion  =     
      <?php echo $registro_la; ?>	  </span>    </td>
  </tr> 
  <tr>
    <td height="23" colspan="2" valign="top"><span class="style12">Total de Alumnos de la Carrera de Gastronomia  =  
      <?php echo $registro_lg; ?>	  </span>    </td>
  </tr> 
  <tr>
    <td height="23" colspan="2" valign="top"><span class="style12">Total de Alumnos de la Carrera de IIA  =    
      <?php echo $registro_ia; ?>	  </span>    </td>
  </tr>
  <tr>
    <td height="23" colspan="2" valign="top"><span class="style12">Total de Alumnos de la Carrera de IER  =     
      <?php echo $registro_er; ?>	  </span>    </td>
  </tr> 
  <tr>
    <td height="23" colspan="2" valign="top"><span class="style12">Total de Alumnos de la Carrera de Turismo =    
      <?php echo $registro_lt; ?>	  </span>    </td>
  </tr>
  <tr>
    <td height="15" colspan="2" valign="top">
	  <hr>	</td>
  </tr>
  <tr>
    <td width="277" height="23" valign="top">    
	  <span class="style10">
    Software mas utilizado	</span>	</td>
	  <td width="281" valign="top">    
	    <span class="style10">
      Cantidad	  </span>	  </td>
  </tr>
  <?php while ($row_software = mysqli_fetch_array($result8)){ ?> 
  <tr> 
      <td height="23" valign="top">    
	     <span class="style8">
      <?php echo $row_software['software']; ?></span></td>
	  <td valign="top">    
	    <span class="style8">
      <?php echo $row_software['totsoftware']; ?></span>	 </td>
  </tr>
  <tr>
    <td height="24" colspan="2" align="center" valign="middle"></td>
  </tr>
  
  <?php } ?>
  <tr>
    <td height="24" colspan="2" align="center" valign="middle"><input type="button" name="regresar" onClick="history.back();" value="<< Regresar" /></td>
  </tr>
</table>
</body>
</html>