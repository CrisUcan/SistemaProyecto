<html>
<head>
<title>Untitled Document</title>
</head>

<body>
<form name="form1" action="alta.php" method="post">
    <table width="352" border="0" cellpadding="0" cellspacing="0">
      <!--DWLayoutTable-->
      <tr>
        <td></td>
    </tr>
      <tr>
        <td>Usuario:</td>
      <td>
        <input type="text" name="usuario" />
        </td>
    </tr>
      <tr>
        <td >Clave:</td>
      <td><input type="password" name="clave" /></td>
    </tr>
      <tr>
        <td>
		<input type="hidden" name="opcion" value="6"/>	
          <input type="submit" name="Submit" value="Accesar" />
        </td>
    </tr>
      <tr>
        <td>
		<?php 
		if (!empty($_GET['mensaje'])){
		 @$mensaje = $_GET['mensaje'];
		 echo $mensaje;  
		 }
		 ?></td>
    </tr>
    </table>
</form>
</body>
</html>
