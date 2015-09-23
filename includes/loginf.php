<?php

/**
 * @author www.intercambiosvirtuales.org
 * @copyright 2013
 */
require_once 'appconfig.php';

		$appconfig	= new appconfig();
		$datos		= $appconfig->conexion();
		$hostname	= $datos['hostname'];
		$database	= $datos['database'];
		$username	= $datos['username'];
		$password	= $datos['password'];
		
$conex = mysql_connect($hostname,$username,$password) or die ("no se puede conectar".mysql_error());
		
$db = mysql_select_db($database);

$error = true;		
		
$nombre = $_POST['usuario'];
$password = $_POST['pass'];


$sqlusu = "select * from DbUsuarios where usuario = '".$nombre."'";

$respusu = mysql_query($sqlusu,$conn);

if (isset($respusu)) {
	$error = false;
	$sqlpass = "select * from DbUsuarios where password = '".$nombre."' and IdUsuario = ".mysql_result($respusu,0,0);

	$resppass = mysql_query($sqlusu,$conn);
	
	if (isset($resppass)) {
		$error = false;
		} else {
			$error = true;
		}
	
	}
	else
	
	{
		$error = true;	
	}
	

if ($error == true)
	{
		echo "<scrip>alert('Usuario o Password Incorrecto')</script>";
	} else {
		echo "<scrip>alert('Bienvenido')</script>";
		echo "<script>windows.location = 'adminshowgol.php'</script>";
	}




?>