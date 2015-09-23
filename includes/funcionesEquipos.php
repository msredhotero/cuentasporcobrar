<?php

/**
 * @author www.intercambiosvirtuales.org
 * @copyright 2013
 */
date_default_timezone_set('America/Buenos_Aires');

class ServiciosE {
	
	function traerEquipoPorZonaTorneos($idTorneo, $idZona) {
		$sql = "select e.idequipo, e.nombre 
				from dbequipos e
				inner join dbtorneoge tge 
				on	tge.refequipo = e.idequipo 
				where	tge.reftorneo = ".$idTorneo." and tge.refgrupo =".$idZona;
		return $this-> query($sql,0);	
	}

	function TraerEquipos() {
		$sql = "select IdEquipo,
				Nombre,
				nombrecapitan,
				emailcapitan,
				telefonocapitan,
				facebookcapitan,
				nombresubcapitan,
				emailsubcapitan,
				telefonosubcapitan,
				facebooksubcapitan from dbequipos order by nombre";
		return $this-> query($sql,0);
	}

	
	function TraerIdEquipo($id) {
		$sql = "select * from dbequipos where idequipo = ".$id;
		return $this-> query($sql,0);
	}
	
	function TraerIdEquipoInfo($id) {
		$sql = "select * from dbequipos e
				inner join dbcontactos c
				on e.refcontacto = c.idcontacto 
				where idequipo = ".$id;
		return $this-> query($sql,0);
	}
	
function insertarEquipos($nombre,$nombrecapitan,$telefonocapitan,$facebookcapitan,$nombresubcapitan,$telefonosubcapitan,$facebooksubcapitan,$emailcapitan,$emailsubcapitan) {
$sql = "insert into dbequipos(idequipo,nombre,nombrecapitan,telefonocapitan,facebookcapitan,nombresubcapitan,telefonosubcapitan,facebooksubcapitan,emailcapitan,emailsubcapitan)
values ('','".utf8_decode($nombre)."','".utf8_decode($nombrecapitan)."','".utf8_decode($telefonocapitan)."','".utf8_decode($facebookcapitan)."','".utf8_decode($nombresubcapitan)."','".utf8_decode($telefonosubcapitan)."','".utf8_decode($facebooksubcapitan)."','".utf8_decode($emailcapitan)."','".utf8_decode($emailsubcapitan)."')";
$res = $this->query($sql,1);
if ((integer)$res > 0) {
	$sql2 = "insert into tbconducta(idconducta,refequipo,puntos,reffecha)
	values ('',".$res.",0,0)";
	$res2 = $this->query($sql2,1);	
}
return $res;
}


function modificarEquipos($id,$nombre,$nombrecapitan,$telefonocapitan,$facebookcapitan,$nombresubcapitan,$telefonosubcapitan,$facebooksubcapitan,$emailcapitan,$emailsubcapitan) {
$sql = "update dbequipos
set
nombre = '".utf8_decode($nombre)."',nombrecapitan = '".utf8_decode($nombrecapitan)."',telefonocapitan = '".utf8_decode($telefonocapitan)."',facebookcapitan = '".utf8_decode($facebookcapitan)."',nombresubcapitan = '".utf8_decode($nombresubcapitan)."',telefonosubcapitan = '".utf8_decode($telefonosubcapitan)."',facebooksubcapitan = '".utf8_decode($facebooksubcapitan)."',emailcapitan = '".utf8_decode($emailcapitan)."',emailsubcapitan = '".utf8_decode($emailsubcapitan)."'
where idequipo =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarEquipos($id) {
$sql = "delete from dbequipos where idequipo =".$id;
$res = $this->query($sql,0);
return $res;
} 
	
	
	
	
	
function insertarSuspendidos($refjugador,$motivos,$cantidadfechas,$fechacreacion) {
$sql = "insert into tbsuspendidos(idsuspendido,refjugador,motivos,cantidadfechas,fechacreacion)
values ('',".$refjugador.",'".utf8_decode($motivos)."',".$cantidadfechas.",'".utf8_decode($fechacreacion)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarSuspendidos($id,$refjugador,$motivos,$cantidadfechas,$fechacreacion) {
$sql = "update tbsuspendidos
set
refjugador = ".$refjugador.",motivos = '".utf8_decode($motivos)."',cantidadfechas = ".$cantidadfechas.",fechacreacion = '".utf8_decode($fechacreacion)."'
where idsuspendido =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarSuspendidos($id) {
$sql = "delete from tbsuspendidos where idsuspendido =".$id;
$res = $this->query($sql,0);
return $res;
} 	
	
	
	
	
function insertarPuntosEquipos($refequipo,$puntos,$amarillas,$azules,$rojas,$reffixture,$reffecha,$reftorneo) {
$sql = "insert into tbpuntosequipos(idpuntosequipo,refequipo,puntos,amarillas,azules,rojas,reffixture,reffecha,reftorneo)
values ('',".$refequipo.",".($puntos == '' ? 'null' : $puntos).",".($amarillas == '' ? 'null' : $amarillas).",".($azules == '' ? 'null' : $azules).",".($rojas == '' ? 'null' : $rojas).",".$reffixture.",".$reffecha.",".$reftorneo.")";
//return $sql;
$res = $this->query($sql,1);
return $res;
}


function modificarPuntosEquipos($id,$refequipo,$puntos,$amarillas,$azules,$rojas,$reffixture,$reffecha,$reftorneo) {
$sql = "update tbpuntosequipos
set
refequipo = ".$refequipo.",puntos = ".($puntos == '' ? 'null' : $puntos).",amarillas = ".($amarillas == '' ? 'null' : $amarillas).",azules = ".($azules == '' ? 'null' : $azules).",rojas = ".($rojas == '' ? 'null' : $rojas).",reffixture = ".$reffixture.",reffecha = ".$reffecha.",reftorneo = ".$reftorneo."
where idpuntosequipo =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarPuntosEquipos($id) {
$sql = "delete from tbpuntosequipos where idpuntosequipo =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerPuntosEquipos() {
$sql = "select idpuntosequipo,refequipo,puntos,amarillas,azules,rojas,reffixture,reffecha,reftorneo from tbpuntosequipos order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerPuntosEquiposPorId($id) {
$sql = "select idpuntosequipo,refequipo,puntos,amarillas,azules,rojas,reffixture,reffecha,reftorneo from tbpuntosequipos where idpuntosequipo =".$id;
$res = $this->query($sql,0);
return $res;
} 


function traerPuntosEquiposPorFixtureEquipoFechaTorneo($refFixture, $refEquipo, $resFecha, $refTorneo) {
$sql = "select idpuntosequipo,refequipo,puntos,amarillas,azules,rojas,reffixture,reffecha,reftorneo from tbpuntosequipos where reffixture =".$refFixture." and reffecha =".$resFecha." and reftorneo =".$refTorneo." and refequipo =".$refEquipo;
$res = $this->query($sql,0);
return $res;
} 	
	
	
	
	function TraerUltimaFechaPorEquipo($idEquipo) {
		$sql = "select 
					(select 
							ee.nombre
						from
							dbequipos ee
								inner join
							dbtorneoge tgee ON ee.idequipo = tgee.refequipo
						where
							tgee.idtorneoge = f.reftorneoge_a) as equipoa,
					f.resultado_a,
					(select 
							ee.nombre
						from
							dbequipos ee
								inner join
							dbtorneoge tgee ON ee.idequipo = tgee.refequipo
						where
							tgee.idtorneoge = f.reftorneoge_b) as equipob,
					f.resultado_b,
					f.fechajuego,
					ff.tipofecha,
					f.hora
				from
					dbfixture f
						inner join
					dbtorneoge tge ON tge.idtorneoge = f.reftorneoge_a
						or tge.idtorneoge = f.reftorneoge_b
						inner join
					dbtorneos t ON tge.reftorneo = t.idtorneo
						inner join
					tbfechas ff ON ff.idfecha = f.reffecha
				where
					f.chequeado = 1 and tge.refequipo = ".$idEquipo."
						and t.activo = 1
				order by f.idfixture desc
				limit 1";
		return $this-> query($sql,0);		
	}
	
	
	function TraerFechasPorEquipo($idEquipo) {
		$sql = "select
					t.equipoa,
					COALESCE((select sum(gg.goles) 
							from
								dbequipos ee
									inner join
								dbtorneoge tgee ON ee.idequipo = tgee.refequipo
									inner join
								dbfixture fff ON tgee.idtorneoge = fff.reftorneoge_a
									inner join
								tbgoleadores gg ON gg.refequipo = ee.idequipo and gg.reffixture = fff.idfixture
							where
								fff.Idfixture = t.idfixture),0) as resultado_a,
					
					t.equipob,
					COALESCE((select sum(gg.goles) 
							from
								dbequipos ee
									inner join
								dbtorneoge tgee ON ee.idequipo = tgee.refequipo
									inner join
								dbfixture fff ON tgee.idtorneoge = fff.reftorneoge_b
									inner join
								tbgoleadores gg ON gg.refequipo = ee.idequipo and gg.reffixture = fff.idfixture
							where
								fff.Idfixture = t.idfixture),0) as resultado_b,
					t.fechajuego,
							t.tipofecha,
							t.hora,
							t.nombre,
							t.descripciontorneo
					from (
						select 
							(select 
									ee.nombre
								from
									dbequipos ee
										inner join
									dbtorneoge tgee ON ee.idequipo = tgee.refequipo
								where
									tgee.idtorneoge = f.reftorneoge_a) as equipoa,
					
							(select 
									ee.nombre
								from
									dbequipos ee
										inner join
									dbtorneoge tgee ON ee.idequipo = tgee.refequipo
								where
									tgee.idtorneoge = f.reftorneoge_b) as equipob,
							f.idfixture,
							f.reftorneoge_a,
							f.reftorneoge_b,
							f.fechajuego,
							ff.tipofecha,
							f.hora,
							t.nombre,
							tp.descripciontorneo
						from
							dbfixture f
								inner join
							dbtorneoge tge ON tge.idtorneoge = f.reftorneoge_a
								or tge.idtorneoge = f.reftorneoge_b
								inner join
							dbtorneos t ON tge.reftorneo = t.idtorneo
								inner join
							tbtipotorneo tp ON tp.idtipotorneo = t.reftipotorneo
								inner join
							tbfechas ff ON ff.idfecha = f.reffecha
						where
							f.chequeado = 1 and tge.refequipo = ".$idEquipo."
							  
						order by f.fechajuego desc
					) as t";
		return $this-> query($sql,0);		
	}	
	
	function traerResultadoPorEquipo($idEquipo) {
		$sql = "select
								count(*) as partidos,
							   sum(case when s.resultado_a > s.resultado_b then 1 else 0 end) as ganados, 
							   sum(case when s.resultado_a = s.resultado_b then 1 else 0 end) as empatados,
							   sum(case when s.resultado_a < s.resultado_b then 1 else 0 end) as perdidos,
							   sum(s.resultado_a) as golesafavor,
							   sum(s.resultado_b) as golesencontra,
							   (sum(s.resultado_a) - sum(s.resultado_b)) as diferencia,
							   ((sum(case when s.resultado_a > s.resultado_b then 1 else 0 end) * 3) +
								(sum(case when s.resultado_a = s.resultado_b then 1 else 0 end) * 1)) as pts
				from
				(
					select
					(case when r.idequipoa = ".$idEquipo." then r.resultado_a else r.resultado_b end) as resultado_a,
					(case when r.idequipob <> ".$idEquipo." then r.resultado_b else r.resultado_a end) as resultado_b
					from
					(
						select
						t.equipoa,
						COALESCE((select sum(gg.goles) 
								from
									dbequipos ee
										inner join
									dbtorneoge tgee ON ee.idequipo = tgee.refequipo
										inner join
									dbfixture fff ON tgee.idtorneoge = fff.reftorneoge_a
										inner join
									tbgoleadores gg ON gg.refequipo = ee.idequipo and gg.reffixture = fff.idfixture
								where
									fff.Idfixture = t.idfixture),0) as resultado_a,
				
						t.equipob,
						COALESCE((select sum(gg.goles) 
								from
									dbequipos ee
										inner join
									dbtorneoge tgee ON ee.idequipo = tgee.refequipo
										inner join
									dbfixture fff ON tgee.idtorneoge = fff.reftorneoge_b
										inner join
									tbgoleadores gg ON gg.refequipo = ee.idequipo and gg.reffixture = fff.idfixture
								where
									fff.Idfixture = t.idfixture),0) as resultado_b,
						t.fechajuego,
								t.tipofecha,
								t.hora,
								t.idequipoa,
								t.idequipob
						from (
							select 
								(select 
										ee.nombre
									from
										dbequipos ee
											inner join
										dbtorneoge tgee ON ee.idequipo = tgee.refequipo
									where
										tgee.idtorneoge = f.reftorneoge_a) as equipoa,
								(select 
										ee.idequipo
									from
										dbequipos ee
											inner join
										dbtorneoge tgee ON ee.idequipo = tgee.refequipo
									where
										tgee.idtorneoge = f.reftorneoge_a) as idequipoa,
								(select 
										ee.nombre
									from
										dbequipos ee
											inner join
										dbtorneoge tgee ON ee.idequipo = tgee.refequipo
									where
										tgee.idtorneoge = f.reftorneoge_b) as equipob,
								(select 
										ee.idequipo
									from
										dbequipos ee
											inner join
										dbtorneoge tgee ON ee.idequipo = tgee.refequipo
									where
										tgee.idtorneoge = f.reftorneoge_b) as idequipob,
								f.idfixture,
								f.reftorneoge_a,
								f.reftorneoge_b,
								f.fechajuego,
								
								ff.tipofecha,
								f.hora
							from
								dbfixture f
									inner join
								dbtorneoge tge ON tge.idtorneoge = f.reftorneoge_a
									or tge.idtorneoge = f.reftorneoge_b
									inner join
								dbtorneos t ON tge.reftorneo = t.idtorneo
									inner join
								tbfechas ff ON ff.idfecha = f.reffecha
							where
								f.chequeado = 1 and tge.refequipo = ".$idEquipo."
								  
							order by f.idfixture desc
						) as t
					) as r
				) as s";	
		return $this-> query($sql,0);
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
		
		        $error = 0;
		mysql_query("BEGIN");
		$result=mysql_query($sql,$conex);
		if ($accion && $result) {
			$result = mysql_insert_id();
		}
		if(!$result){
			$error=1;
		}
		if($error==1){
			mysql_query("ROLLBACK");
			return false;
		}
		 else{
			mysql_query("COMMIT");
			return $result;
		}
		
	}
	
	
	
	
	} //fin de servicios


?>