<?php

/**
 * @author www.intercambiosvirtuales.org
 * @copyright 2013
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosEXCEL {
	
	function TraerAmonestados() {
		$sql = "select * from tbamonestados order by amarillas desc";
		return $this-> query($sql,0);
	}
	
	function TraerIdAmonestados($i) {
		$sql = "select * from tbamonestados where idamonestado =".$i;
		return $this-> query($sql,0);
	}
	
	
	function insertarAmonestados($apellido,$nombre,$equipo,$amarillas) {
		
		header( 'Content-type: text/html; charset=iso-8859-1' );
		
		$sql = "insert into tbamonestados(idamonestado,apellido,nombre,equipo,amarillas)
											values ('','".utf8_decode($apellido)."','".utf8_decode($nombre)."','".utf8_decode($equipo)."',".$amarillas.")";
		//echo $sql."<br>";
		$this-> query($sql,1);
		//echo $sql;
	}
	
	function modificarAmonestados($id,$apellido,$nombre,$equipo,$amarillas) {
		header( 'Content-type: text/html; charset=iso-8859-1' );
		
		$sql = "update tbamonestados
				set apellido = '".utf8_decode($apellido)."', nombre ='".utf8_decode($nombre)."', equipo ='".utf8_decode($equipo)."', amarillas =".$amarillas." where idamonestado =".$id;
		//echo $sql."<br>";
		$this-> query($sql,0);
		//return $sql;
	}
	

        function modificarAmonestadosAmarillas($id,$amarillas) {
		header( 'Content-type: text/html; charset=iso-8859-1' );
		
		$sql = "update tbamonestados
				set amarillas =".$amarillas." where idamonestado =".$id;
		//echo $sql."<br>";
		$this-> query($sql,0);
		//return $sql;
	}

	function eliminarAmonestados($id){
		$sql = "delete from tbamonestados where idamonestado =".$id;
		//echo $sql."<br>";
		$this-> query($sql,0);
	}
	
	
	
	
	function TraerSuspendidos() {
		$sql = "select * from tbsuspendidos";
		return $this-> query($sql,0);
	}
	
	
	function TraerIdSuspendidos($id) {
		$sql = "select * from tbsuspendidos where idsuspendido =".$id;
		return $this-> query($sql,0);
	}
	
	function insertarSuspendidos($apellido,$nombre,$equipo,$motivo) {
		$sql = "insert into tbsuspendidos(idsuspendido,apellido,nombre,equipo,motivos)
											values ('','".utf8_decode($apellido)."','".utf8_decode($nombre)."','".trim(utf8_decode($equipo))."','".utf8_decode($motivo)."')";
		$this-> query($sql,1);
	}
	
	
	function modificarSuspendidos($id,$apellido,$nombre,$equipo,$motivo) {
		$sql = "update tbsuspendidos
						set apellido ='".utf8_decode($apellido)."', nombre ='".utf8_decode($nombre)."', equipo ='".trim(utf8_decode($equipo))."', motivos='".utf8_decode($motivo)."' where idsuspendido =".$id;
		$this-> query($sql,0);
	}
	
        function modificarSuspendidosMotivos($id,$motivo) {
		$sql = "update tbsuspendidos
						set motivos='".utf8_decode($motivo)."' where idsuspendido =".$id;
		$this-> query($sql,0);
	}	


	function eliminarSuspendidos($id){
		$sql = "delete from tbsuspendidos where idsuspendido =".$id;
		//echo $sql."<br>";
		$this-> query($sql,0);
	}
	
	function TraerGoleadores() {
		$sql = "select * from tbgoleadores order by grupo,goles desc";
		return $this-> query($sql,0);
	}
	
	function TraerGoleadoresEquipo($equipo,$grupo) {
		$sql = "select * from tbgoleadores where equipo = '".$equipo."' and grupo = '".$grupo."' order by goles desc";
		return $this-> query($sql,0);
		//return $sql;
	}
	
	function TraerIdGoleadores($grupo) {
		$sql = "select * from tbgoleadores where grupo = '".$grupo."' order by goles desc";
		return $this-> query($sql,0);
	}
	
        function TraerIndiceGoleadores($id) {
		$sql = "select * from tbgoleadores where idgoleador = ".$id;
		return $this-> query($sql,0);
	}


	function TraerGruposGoleadores() {
		$sql = "SELECT DISTINCT
				tbgoleadores.grupo
				FROM
				tbgoleadores
				ORDER BY
				tbgoleadores.grupo ASC";
		return $this-> query($sql,0);
	}
	
	function insertarGoleadores($apellido,$nombre,$equipo,$goles,$grupo) {
		$sql = "insert into tbgoleadores(idgoleador,apellido,nombre,equipo,goles,grupo)
											values ('','".utf8_decode($apellido)."','".utf8_decode($nombre)."','".utf8_decode($equipo)."',".$goles.",'".trim($grupo)."')";
		$this-> query($sql,1);
	}
	
	
	function modificarGoleadores($id,$apellido,$nombre,$equipo,$goles,$grupo) {
		$sql = "update tbgoleadores
					set apellido ='".utf8_decode($apellido)."', nombre = '".utf8_decode($nombre)."', equipo ='".utf8_decode($equipo)."', goles =".$goles.", grupo ='".trim($grupo)."' where idgoleador =".$id;
		$this-> query($sql,0);
	}
	

        function modificarGoleadoresGoles($id,$goles) {
		$sql = "update tbgoleadores
					set goles =".$goles." where idgoleador =".$id;
		$this-> query($sql,0);
	}
	
	function eliminarGoleadores($id){
		$sql = "delete from tbgoleadores where idgoleador =".$id;
		//echo $sql."<br>";
		$this-> query($sql,0);
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