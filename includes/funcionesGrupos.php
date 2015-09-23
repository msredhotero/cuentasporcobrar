<?php

/**
 * @author www.intercambiosvirtuales.org
 * @copyright 2013
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosG {
	
	function TraerGrupos() {
		$sql = "select * from dbgrupos order by idgrupo limit 5";
		return $this-> query($sql,0);
	}
	
	function TraerIdGrupos($id) {
		$sql = "select * from dbgrupos where idgrupo = ".$id;
		return $this-> query($sql,0);
	}
	
	function TraerLetraGrupo() {
		$sql = "select letra
				from dbgrupos g
				right join tbletras l
				on  right(nombre,1) = l.letra
				where nombre is null
				order by l.letra";
		return $this-> query($sql,0);
	}
	
	
	function insertarGrupos($letra) {

		$sql = "insert into dbgrupos (idgrupo,nombre) values ('','".$letra."')";
		$res = $this->query($sql,1);
		return $res;
	}
	
	
	
	function query($sql,$accion) {
		
		
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
	
	
	} //fin de servicios

?>