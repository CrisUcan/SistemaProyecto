<?php
@$mensaje = $_GET['mensaje'];
?>

<html>
	<title></title>
	<body>
		<form name= "form1" method="post" action="alta.php" >
			
			<tr>
				<td colspan="2">Matricula: <input type="text" name="matricula" ></td>
			</tr>
			<tr>
				<td colspan="2">
				    <input type="hidden" name="opcion" value="2" >
				       <input type="submit" name="verificar" value="Ingresar">
					<?php 
                        echo $mensaje;
                     ?>				</td>
			</tr>
			
		</form>	
	</body>
</html>
