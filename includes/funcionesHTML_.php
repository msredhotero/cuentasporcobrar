<?php

date_default_timezone_set('America/Buenos_Aires');

class ServiciosHTML {

function enviarMail($nombre,$mensaje,$email)
{
	$error = "";

	if (trim($nombre) == "")
	{
		$error = "Falta el nombre. ";
	}

	if (trim($mensaje) == "")
	{
		$error = $error." Falta el mensaje. ";
	}

	if (trim($email) == "")
	{
		$error = $error." Falta el email.";
	}

	if (strlen($error) < 1)
	{
		$sql = "insert into dbcontactos(idcontacto,nombre,mensaje,email,fecha) values ('','".$nombre."','".$mensaje."','".$email."','".date('Y-m-d H:i:s')."')";
		$this->query($sql,1);	
		return $error;
	} else {
		return $error;
	}
	

}



function footer() {
	echo "<!--comienzo del footer-->
<div id='footer'>
<div id='dentroFooter'>
<div align='center'>
<table width='800'>
<tr valign='top'>
<td align='left'>
<h4>Link's de interes</h4>
<ul>
<li><a href='http://www.grandt.clarin.com/'>Gran DT</a></li>
<li><a href='http://www.ole.com.ar/'>OLE</a></li>
<li><a href='http://www.foxsportsla.com/ar/'>Fox Sport</a></li>
<li><a href='http://www.afa.org.ar/'>AFA</a></li>
</ul>
</td>
<td align='left'>
<h4>Noticias</h4>
<ul>
<li><a href='http://www.eldia.com.ar/'>El Dia</a></li>
<li><a href='http://www.clarin.com/'>Clarin</a></li>
<li><a href='http://diariohoy.net/'>Hoy</a></li>
<li><a href='http://www.lanacion.com.ar/'>La Nación</a></li>
</ul>
</td>
<td align='left'>
<h4>Recursos</h4>
<ul>
<li><a href='http://www.hotmail.com/'>Hotmail</a></li>
<li><a href='http://ar.yahoo.com/'>Yahoo</a></li>
<li><a href='http://www.google.com.ar/'>Google</a></li>

</ul>
</td>
</tr>
</table>
</div>
</div>

   <div id='yo' align='center'>
   <br />
<p>© Copyright 2013 | ComplejoShowBol - La PLata, Buenos Aires. Diseño Web: Saupurein Marcos y Saupurein Javier .Tel:(0221)15-6184415</p>
</div>
</div><!--fin del footer-->";
}

Function query($sql,$accion) {
		
		
		require_once 'appconfig.php';

		$appconfig	= new appconfig();
		$datos		= $appconfig->conexion();	
		$hostname	= $datos['hostname'];
		$database	= $datos['database'];
		$username	= $datos['username'];
		$password	= $datos['password'];
		
		$conex = mysql_connect($hostname,$username,$password) or die ("no se puede conectar".mysql_error());
		
		mysql_select_db($database);
		
		$result = mysql_query($sql,$conex);
		if ($accion && $result) {
			$result = mysql_insert_id();
		}
		mysql_close($conex);
		return $result;
		
	}

}




?>