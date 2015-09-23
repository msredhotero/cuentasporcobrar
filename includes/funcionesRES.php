<?php

/**
 * @author www.intercambiosvirtuales.org
 * @copyright 2013
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosRES {
	
	function TraerConducta() {
		$sql = "select c.idconducta,c.refequipo,e.nombre,c.puntos 
				from tbconducta c
				inner join dbequipos e
				on c.refequipo = e.idequipo
				order by c.puntos desc";
		return $this-> query($sql,0);
		
	}
	
	function TraerIdConducta($id) {
		$sql = "select c.idconducta,c.refequipo,e.nombre,c.puntos  
				from tbconducta c
				inner join dbequipos e
				on c.refequipo = e.idequipo
				where c.idconducta =".$id;
		return $this-> query($sql,0);
		
	}


	function insertarConducta($idequipo,$puntos) {
		$sql = "insert into tbconducta(idconducta,refequipo,puntos)
							values ('',".$idequipo.",".$puntos.")";
		return $this-> query($sql,1);
		
	}
	
	function modificarConducta($idconducta,$idequipo,$puntos) {
		$sql = "update tbconducta set puntos =".$puntos.", refequipo = ".$idequipo." where idconducta = ".$idconducta;
		$this-> query($sql,0);
		return $sql;
	}
	

        function modificarConductaPuntos($idconducta,$puntos) {
		$sql = "update tbconducta set puntos =".$puntos." where idconducta = ".$idconducta;
		return $this-> query($sql,0);
		
	}


	function eliminarConducta($id) {
		$sql = "delete from tbconducta where idconducta =".$id;
		return $this-> query($sql,0);
		
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