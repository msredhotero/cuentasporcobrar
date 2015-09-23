<?php

/**
 * @author www.intercambiosvirtuales.org
 * @copyright 2013
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosHistorial {
	
	///////////////////*  COPIA de tablas *///////////
	/* TABLAS */
	/*
	bck_dbequipos
	bck_dbfixture
	bck_dbjugadores
	bck_dbreemplazo
	bck_dbsuspendidosfechas
	bck_dbtorneoge
	bck_tbamonestados
	bck_tbconducta
	bck_tbgoleadores
	bck_tbsuspendidos
	*/
	/* FIN */
	function borrarHistorial($idtorneo, $idzona) {
		$sqlEquipos = "delete from bck_dbequipos where reftorneo = ".$idtorneo." and refgrupo =".$idzona;
		$this->query($sqlEquipos,0);
		
		$sqlFixture = "delete from bck_dbfixture where reftorneo = ".$idtorneo." and refgrupo =".$idzona;
		$this->query($sqlFixture,0);
		
		$sqlJugadores = "delete from bck_dbjugadores where reftorneo = ".$idtorneo." and refgrupo =".$idzona;
		$this->query($sqlJugadores,0);
		
		$sqlSuspendidos = "delete from bck_tbsuspendidos where reftorneo = ".$idtorneo." and refgrupo =".$idzona;
		$this->query($sqlSuspendidos,0);
		
		$sqlSuspendidosFecha = "delete from bck_dbsuspendidosfechas where reftorneo = ".$idtorneo." and refgrupo =".$idzona;
		$this->query($sqlSuspendidosFecha,0);
		
		$sqlTorneoGE = "delete from bck_dbtorneoge where reftorneo = ".$idtorneo." and refgrupo =".$idzona;
		$this->query($sqlTorneoGE,0);
		
		$sqlAmonestados = "delete from bck_tbamonestados where reftorneo = ".$idtorneo." and refgrupo =".$idzona;
		$this->query($sqlAmonestados,0);
		
		$sqlConducta = "delete from bck_tbconducta where reftorneo = ".$idtorneo." and refgrupo =".$idzona;
		$this->query($sqlConducta,0);
		
		$sqlGoleadores = "delete from bck_tbgoleadores where reftorneo = ".$idtorneo." and refgrupo =".$idzona;
		$this->query($sqlGoleadores,0);
		
	}
	
	
	function copiar($idtorneo, $idzona) {
		
		$this->borrarHistorial($idtorneo,$idzona);
		
		$sqlEquipos = "insert into bck_dbequipos
				select
				e.*,".$idtorneo.",".$idzona."
				from		dbtorneos t
				inner join	dbtorneoge tge on t.idtorneo = tge.reftorneo
				inner join  dbequipos e on e.idequipo = tge.refequipo
				
				where		t.idtorneo = ".$idtorneo." and tge.refgrupo = ".$idzona;
				
		$this->query($sqlEquipos,1);
		
		$sqlFixture = "insert into bck_dbfixture
		select
		fix.*,".$idtorneo.",".$idzona."
		from		dbtorneos t
		inner join	dbtorneoge tge on t.idtorneo = tge.reftorneo
		inner join  dbfixture fix on fix.reftorneoge_a = tge.idtorneoge
		
		where		t.idtorneo = ".$idtorneo." and tge.refgrupo = ".$idzona;		
		$this->query($sqlFixture,1);
		
		$sqlJugadores = "insert into bck_dbjugadores
		select
		j.*,".$idtorneo.",".$idzona."
		from		dbtorneos t
		inner join	dbtorneoge tge on t.idtorneo = tge.reftorneo
		inner join  dbjugadores j on j.idequipo = tge.refequipo
		where		t.idtorneo = ".$idtorneo." and tge.refgrupo = ".$idzona;
		$this->query($sqlJugadores,1);
		
		
		$sqlReemplazos = "por ahora queda la misma";
		//$this->query($sqlReemplazos,1);
		
		$sqlSuspendidos = "insert into bck_tbsuspendidos
		select
		s.*,".$idtorneo.",".$idzona."
		from		dbtorneos t
		inner join	dbtorneoge tge on t.idtorneo = tge.reftorneo
		inner join  dbjugadores j on j.idequipo = tge.refequipo
		inner join  tbsuspendidos s on s.refequipo = tge.refequipo and s.refjugador = j.idjugador
		where		t.idtorneo = ".$idtorneo." and tge.refgrupo = ".$idzona;
		$this->query($sqlSuspendidos,1);
		
		
		$sqlSuspendidosFecha = "insert into bck_dbsuspendidosfechas
		select
		sf.*,".$idtorneo.",".$idzona."
		from		dbtorneos t
		inner join	dbtorneoge tge on t.idtorneo = tge.reftorneo
		inner join  dbjugadores j on j.idequipo = tge.refequipo
		inner join  tbsuspendidos s on s.refequipo = tge.refequipo and s.refjugador = j.idjugador
		inner join  dbsuspendidosfechas sf on sf.refsuspendido = s.idsuspendido
		where		t.idtorneo = ".$idtorneo." and tge.refgrupo = ".$idzona;
		$this->query($sqlSuspendidosFecha,1);
		
		
		$sqlTorneoGE = "insert into bck_dbtorneoge
		select
		tge.*
		from		dbtorneos t
		inner join	dbtorneoge tge on t.idtorneo = tge.reftorneo
		where		t.idtorneo = ".$idtorneo." and tge.refgrupo = ".$idzona;
		$this->query($sqlTorneoGE,1);
		
		
		$sqlAmonestados = "insert into bck_tbamonestados
		select
		a.*,".$idtorneo.",".$idzona."
		from		dbtorneos t
		inner join	dbtorneoge tge on t.idtorneo = tge.reftorneo
		inner join  tbamonestados a on a.refequipo = tge.refequipo
		where		t.idtorneo = ".$idtorneo." and tge.refgrupo = ".$idzona;
		$this->query($sqlAmonestados,1);
		
		$sqlConducta = "insert into bck_tbconducta
		select
		c.*,".$idtorneo.",".$idzona."
		from		dbtorneos t
		inner join	dbtorneoge tge on t.idtorneo = tge.reftorneo
		inner join  tbconducta c on c.refequipo = tge.refequipo
		where		t.idtorneo = ".$idtorneo." and tge.refgrupo = ".$idzona;
		$this->query($sqlConducta,1);
		
		
		$sqlGoleadores = "insert into bck_tbgoleadores
		select
		g.*,".$idtorneo.",".$idzona."
		from		dbtorneos t
		inner join	dbtorneoge tge on t.idtorneo = tge.reftorneo
		inner join	tbgoleadores g on g.refequipo = tge.refequipo
		where		t.idtorneo = ".$idtorneo." and tge.refgrupo = ".$idzona;
		$this->query($sqlGoleadores,1);
		
		
		
	}
	
	///////////////////* FIN  */////////////////////
	
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
	
	}
?>