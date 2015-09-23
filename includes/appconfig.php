<?php

date_default_timezone_set('America/Buenos_Aires');

class appconfig {

function conexion() {
		
		$hostname = "localhost";
		$database = "db_prediobck8";
		$username = "root";
		$password = "";
		
		/*
		$hostname = "localhost";
		$database = "wwwpredi_98nicolas";
		$username = "wwwpredi_98nico";
		$password = "nicolaspredio98";
		*/
		
		/*
		$hostname = "localhost";
		$database = "estudiohamelin_com_ar_-_proyecto360";
		$username = "estudio";
		$password = "pro369";
		*/
		
		/*
		$hostname = "mysql.hostinger.es";
		$database = "u849094071_predi";
		$username = "u849094071_nico";
		$password = "rhcp7575";
		*/
		$conexion = array("hostname" => $hostname,
						  "database" => $database,
						  "username" => $username,
						  "password" => $password);
						  
		return $conexion;
}

}




?>