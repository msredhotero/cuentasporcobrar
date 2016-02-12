<?php

date_default_timezone_set('America/Buenos_Aires');

class appconfig {

function conexion() {
		
		$hostname = "localhost";
		$database = "facturacion2";
		$username = "root";
		$password = "";
		
		/*
		$hostname = "localhost";
		$database = "luisfacturacion";
		$username = "luisfacturacion";
		$password = "luisfacturacion1245";
		
		*/
		
		$conexion = array("hostname" => $hostname,
						  "database" => $database,
						  "username" => $username,
						  "password" => $password);
						  
		return $conexion;
}

}




?>