<?php

/**
 * @author www.intercambiosvirtuales.org
 * @copyright 2013
 */

date_default_timezone_set('America/Buenos_Aires');
//session_start();
class ServiciosZonasEquipos {
	
	function TraerGruposActivos() {
		$sql = "SELECT
			distinct	g.idgrupo,g.nombre
				FROM
				dbgrupos g
				Inner Join dbgruposequipos ge ON g.idgrupo = ge.refgrupo
				Inner Join dbtorneoge tge ON ge.idgrupoequipo = tge.refgrupoequipo
				Inner Join dbtorneos t ON t.idtorneo = tge.reftorneo
				Inner Join dbequipos e ON e.idequipo = ge.refequipo
				where t.activo = 1";	
		return $this-> query($sql,0);
	
	}
	
	function TraerIdTorneoGE($idgrupo,$idequipo,$idtorneo) {
		$sql = "SELECT
					g.idgrupo,
					g.nombre as gruponombre,
					t.nombre as torneonombre,
					t.idtorneo,
					t.activo,
					e.idequipo,
					e.nombre as equiponombre,
					tge.idtorneoge as idtorneoeg
					FROM
					dbtorneoge tge
					Inner Join dbgrupos g ON g.idgrupo = tge.refgrupo
					Inner Join dbtorneos t ON t.idtorneo = tge.reftorneo
					Inner Join dbequipos e ON e.idequipo = tge.refequipo
					where t.activo = 1 and g.idgrupo =".$idgrupo." and e.idequipo=".$idequipo." and t.idtorneo=".$idtorneo;
		$res = $this-> query($sql,0);
		return $res;		
					
	}
	
	function TraerEquiposSinGrupos() {
		$sql = "SELECT
					e.idequipo,
					e.nombre
					FROM
					dbgrupos g
					Inner Join dbgruposequipos ge ON g.idgrupo = ge.refgrupo
					Inner Join dbtorneoge tge ON ge.idgrupoequipo = tge.refgrupoequipo
					Inner Join dbtorneos t ON t.idtorneo = tge.reftorneo and t.activo = 1
					right Join dbequipos e ON e.idequipo = ge.refequipo
					where tge.refgrupoequipo is  null
					order by e.nombre";
					return $this-> query($sql,0);
	}
	
	
	function TraerGruposEquiposId($idgrupo) {
		
		if ($idgrupo == "") {
			$sql = "SELECT
					g.idgrupo,
					g.nombre as gruponombre,
					t.nombre as torneonombre,
					t.idtorneo,
					t.activo,
					e.idequipo,
					e.nombre as equiponombre,
					ge.idgrupoequipo
					FROM
					dbgrupos g
					Inner Join dbgruposequipos ge ON g.idgrupo = ge.refgrupo
					Inner Join dbtorneoge tge ON ge.idgrupoequipo = tge.refgrupoequipo
					Inner Join dbtorneos t ON t.idtorneo = tge.reftorneo
					Inner Join dbequipos e ON e.idequipo = ge.refequipo
					where t.activo = 1";	
		} else {
			$sql = "SELECT
					g.idgrupo,
					g.nombre as gruponombre,
					t.nombre as torneonombre,
					t.idtorneo,
					t.activo,
					e.idequipo,
					e.nombre as equiponombre,
					ge.idgrupoequipo
					FROM
					dbgrupos g
					Inner Join dbgruposequipos ge ON g.idgrupo = ge.refgrupo
					Inner Join dbtorneoge tge ON ge.idgrupoequipo = tge.refgrupoequipo
					Inner Join dbtorneos t ON t.idtorneo = tge.reftorneo
					Inner Join dbequipos e ON e.idequipo = ge.refequipo
					where t.activo = 1 and g.idgrupo =".$idgrupo;
		}
		return $this-> query($sql,0);		
				
	}
	
	function traerFixturePorEquipo($idequipo) {
		$sql = "
			select
			*
			from
			(
			select 
			fi.idfixture,
			(select e.nombre 
			        from dbtorneoge tge
			        inner 
			        join dbtorneos t
			        on tge.reftorneo = t.idtorneo and t.activo = true
			        inner 
			        join dbequipos e
			        on e.idequipo = tge.refequipo
			        inner 
			        join dbgrupos g
			        on g.idgrupo = tge.refgrupo
			        where tge.idtorneoge = fi.reftorneoge_a) as equipoa,
			fi.resultado_a as resultadoa,
			fi.resultado_b as resultadob,
			(select e.nombre 
			        from dbtorneoge tge
			        inner 
			        join dbtorneos t
			        on tge.reftorneo = t.idtorneo and t.activo = true
			        inner 
			        join dbequipos e
			        on e.idequipo = tge.refequipo
			        inner 
			        join dbgrupos g
			        on g.idgrupo = tge.refgrupo
			        where tge.idtorneoge = fi.reftorneoge_b) as equipob,
			
			(select g.nombre
			        from dbtorneoge tge
			        inner 
			        join dbtorneos t
			        on tge.reftorneo = t.idtorneo and t.activo = true
			        inner 
			        join dbequipos e
			        on e.idequipo = tge.refequipo
			        inner 
			        join dbgrupos g
			        on g.idgrupo = tge.refgrupo
			        where tge.idtorneoge = fi.reftorneoge_b) as zona,   
			fi.fechajuego,
			f.tipofecha as fecha,
			fi.hora,
			g.nombre,
			(select tge.refequipo 
			        from dbtorneoge tge
			        inner 
			        join dbtorneos t
			        on tge.reftorneo = t.idtorneo and t.activo = true
			        inner 
			        join dbequipos e
			        on e.idequipo = tge.refequipo
			        inner 
			        join dbgrupos g
			        on g.idgrupo = tge.refgrupo
			        where tge.idtorneoge = fi.reftorneoge_a) as idequipoa,
			(select tge.refequipo 
			        from dbtorneoge tge
			        inner 
			        join dbtorneos t
			        on tge.reftorneo = t.idtorneo and t.activo = true
			        inner 
			        join dbequipos e
			        on e.idequipo = tge.refequipo
			        inner 
			        join dbgrupos g
			        on g.idgrupo = tge.refgrupo
			        where tge.idtorneoge = fi.reftorneoge_b) as idequipob
					from dbfixture as fi
					        inner 
					        join tbfechas AS f
					        on fi.reffecha = f.idfecha
					        inner 
					        join dbtorneoge tge
					        on tge.idtorneoge = fi.reftorneoge_b
					        inner 
					        join dbtorneos t
					        on tge.reftorneo = t.idtorneo and t.activo = true
					        inner 
					        join dbgrupos g
					        on g.idgrupo = tge.refgrupo
					 
					 
					 
					 ) w
					 where w.idequipoa = ".$idequipo." or w.idequipob = ".$idequipo." 
					 order by w.idfixture desc,w.nombre,w.hora";

		return $this-> query($sql,0);
	}
	
	function TraerFixturePorGrupo($idgrupo){
	$sql = "select 
			fi.idfixture,
			(select e.nombre 
			        from dbtorneoge tge
			        inner 
			        join dbgruposequipos ge
			        on ge.idgrupoequipo = tge.refgrupoequipo
			        inner 
			        join dbtorneos t
			        on tge.reftorneo = t.idtorneo and t.activo = true
			        inner 
			        join dbequipos e
			        on e.idequipo = ge.refequipo
			        inner 
			        join dbgrupos g
			        on g.idgrupo = ge.refgrupo
			        where tge.idtorneoge = fi.reftorneoge_a and g.idgrupo=".$idgrupo.") as equipoa,
			fi.resultado_a as resultadoa,
			(select e.nombre 
			        from dbtorneoge tge
			        inner 
			        join dbgruposequipos ge
			        on ge.idgrupoequipo = tge.refgrupoequipo
			        inner 
			        join dbtorneos t
			        on tge.reftorneo = t.idtorneo and t.activo = true
			        inner 
			        join dbequipos e
			        on e.idequipo = ge.refequipo
			        inner 
			        join dbgrupos g
			        on g.idgrupo = ge.refgrupo
			        where tge.idtorneoge = fi.reftorneoge_b and g.idgrupo=".$idgrupo.") as equipob,
			fi.resultado_b as resultadob,
			(select g.nombre
			        from dbtorneoge tge
			        inner 
			        join dbgruposequipos ge
			        on ge.idgrupoequipo = tge.refgrupoequipo
			        inner 
			        join dbtorneos t
			        on tge.reftorneo = t.idtorneo and t.activo = true
			        inner 
			        join dbequipos e
			        on e.idequipo = ge.refequipo
			        inner 
			        join dbgrupos g
			        on g.idgrupo = ge.refgrupo
			        where tge.idtorneoge = fi.reftorneoge_b and g.idgrupo=".$idgrupo.") as zona,   
			fi.fechajuego,
			f.tipofecha as fecha,
			fi.hora
					from dbfixture as fi
					        inner 
					        join tbfechas AS f
					        on fi.reffecha = f.idfecha
					        inner 
					        join dbtorneoge tge
					        on tge.idtorneoge = fi.reftorneoge_b
					        inner 
					        join dbgruposequipos ge
					        on ge.idgrupoequipo = tge.refgrupoequipo
					        inner 
					        join dbtorneos t
					        on tge.reftorneo = t.idtorneo and t.activo = true
					        inner 
					        join dbgrupos g
					        on g.idgrupo = ge.refgrupo
					where g.idgrupo=".$idgrupo." order by f.tipofecha";
			//$sql2 = "select * from dbgrupos where idgrupo=".$idgrupo;
			return $this-> query($sql,0);
			//return $sql;
			
}
	
	function TraerTodoFixture() {
		$sql = "select 
			fi.idfixture,
			(select e.nombre 
			        from dbtorneoge tge
			        inner 
			        join dbtorneos t
			        on tge.reftorneo = t.idtorneo and t.activo = true
			        inner 
			        join dbequipos e
			        on e.idequipo = tge.refequipo
			        inner 
			        join dbgrupos g
			        on g.idgrupo = tge.refgrupo
			        where tge.idtorneoge = fi.reftorneoge_a) as equipoa,
					(case when fi.resultado_a is null then (select
												(case when sum(gg.goles) is null then (case when fi.chequeado = 1 then 0 else null end) else sum(gg.goles) end)
												from		tbgoleadores gg
												where gg.reffixture = fi.idfixture and gg.refequipo = (select tge.refequipo 
																										from dbtorneoge tge
																										inner 
																										join dbtorneos t
																										on tge.reftorneo = t.idtorneo and t.activo = true
																										inner 
																										join dbequipos e
																										on e.idequipo = tge.refequipo
																										inner 
																										join dbgrupos g
																										on g.idgrupo = tge.refgrupo
																										where tge.idtorneoge = fi.reftorneoge_a))
				else fi.resultado_a end) as resultadoa,
					(case when fi.resultado_b is null then (select
															(case when sum(gg.goles) is null then (case when fi.chequeado = 1 then 0 else null end) else sum(gg.goles) end)
															from		tbgoleadores gg
															where gg.reffixture = fi.idfixture and gg.refequipo = (select tge.refequipo 
						from dbtorneoge tge
						inner 
						join dbtorneos t
						on tge.reftorneo = t.idtorneo and t.activo = true
						inner 
						join dbequipos e
						on e.idequipo = tge.refequipo
						inner 
						join dbgrupos g
						on g.idgrupo = tge.refgrupo
						where tge.idtorneoge = fi.reftorneoge_b))
							else fi.resultado_b end) as resultadob,
			(select e.nombre 
			        from dbtorneoge tge
			        inner 
			        join dbtorneos t
			        on tge.reftorneo = t.idtorneo and t.activo = true
			        inner 
			        join dbequipos e
			        on e.idequipo = tge.refequipo
			        inner 
			        join dbgrupos g
			        on g.idgrupo = tge.refgrupo
			        where tge.idtorneoge = fi.reftorneoge_b) as equipob,
			
			(select g.nombre
			        from dbtorneoge tge
			        inner 
			        join dbtorneos t
			        on tge.reftorneo = t.idtorneo and t.activo = true
			        inner 
			        join dbequipos e
			        on e.idequipo = tge.refequipo
			        inner 
			        join dbgrupos g
			        on g.idgrupo = tge.refgrupo
			        where tge.idtorneoge = fi.reftorneoge_b) as zona,   
			fi.fechajuego,
			f.tipofecha as fecha,
			fi.hora,
			(case when fi.chequeado = 1 then '1' else '0' end) as chequeado,
			g.nombre
					from dbfixture as fi
					        inner 
					        join tbfechas AS f
					        on fi.reffecha = f.idfecha
					        inner 
					        join dbtorneoge tge
					        on tge.idtorneoge = fi.reftorneoge_b
					        inner 
					        join dbtorneos t
					        on tge.reftorneo = t.idtorneo and t.activo = true
							inner
							join		tbtipotorneo tp
							on			tp.idtipotorneo = t.reftipotorneo
					        inner 
					        join dbgrupos g
					        on g.idgrupo = tge.refgrupo
							
							where tp.descripciontorneo = '".$_SESSION['torneo_predio']."'
							
					 order by g.nombre,f.tipofecha,fi.hora";
		 return $this-> query($sql,0);
	}
	
	
	function TraerFixtureSinChequear() {
		$sql = "select 
			fi.idfixture,
			(select e.nombre 
			        from dbtorneoge tge
			        inner 
			        join dbtorneos t
			        on tge.reftorneo = t.idtorneo and t.activo = true
			        inner 
			        join dbequipos e
			        on e.idequipo = tge.refequipo
			        inner 
			        join dbgrupos g
			        on g.idgrupo = tge.refgrupo
			        where tge.idtorneoge = fi.reftorneoge_a) as equipoa,
					(case when fi.resultado_a is null then (select
												(case when sum(gg.goles) is null then (case when fi.chequeado = 1 then 0 else null end) else sum(gg.goles) end)
												from		tbgoleadores gg
												where gg.reffixture = fi.idfixture and gg.refequipo = (select tge.refequipo 
																										from dbtorneoge tge
																										inner 
																										join dbtorneos t
																										on tge.reftorneo = t.idtorneo and t.activo = true
																										inner 
																										join dbequipos e
																										on e.idequipo = tge.refequipo
																										inner 
																										join dbgrupos g
																										on g.idgrupo = tge.refgrupo
																										where tge.idtorneoge = fi.reftorneoge_a))
				else fi.resultado_a end) as resultadoa,
					(case when fi.resultado_b is null then (select
															(case when sum(gg.goles) is null then (case when fi.chequeado = 1 then 0 else null end) else sum(gg.goles) end)
															from		tbgoleadores gg
															where gg.reffixture = fi.idfixture and gg.refequipo = (select tge.refequipo 
						from dbtorneoge tge
						inner 
						join dbtorneos t
						on tge.reftorneo = t.idtorneo and t.activo = true
						inner 
						join dbequipos e
						on e.idequipo = tge.refequipo
						inner 
						join dbgrupos g
						on g.idgrupo = tge.refgrupo
						where tge.idtorneoge = fi.reftorneoge_b))
							else fi.resultado_b end) as resultadob,
			(select e.nombre 
			        from dbtorneoge tge
			        inner 
			        join dbtorneos t
			        on tge.reftorneo = t.idtorneo and t.activo = true
			        inner 
			        join dbequipos e
			        on e.idequipo = tge.refequipo
			        inner 
			        join dbgrupos g
			        on g.idgrupo = tge.refgrupo
			        where tge.idtorneoge = fi.reftorneoge_b) as equipob,
			
			(select g.nombre
			        from dbtorneoge tge
			        inner 
			        join dbtorneos t
			        on tge.reftorneo = t.idtorneo and t.activo = true
			        inner 
			        join dbequipos e
			        on e.idequipo = tge.refequipo
			        inner 
			        join dbgrupos g
			        on g.idgrupo = tge.refgrupo
			        where tge.idtorneoge = fi.reftorneoge_b) as zona,   
			fi.fechajuego,
			f.tipofecha as fecha,
			fi.hora,
			g.nombre
					from dbfixture as fi
					        inner 
					        join tbfechas AS f
					        on fi.reffecha = f.idfecha
					        inner 
					        join dbtorneoge tge
					        on tge.idtorneoge = fi.reftorneoge_b
					        inner 
					        join dbtorneos t
					        on tge.reftorneo = t.idtorneo and t.activo = true
							inner
							join		tbtipotorneo tp
							on			tp.idtipotorneo = t.reftipotorneo
					        inner 
					        join dbgrupos g
					        on g.idgrupo = tge.refgrupo
							
							where tp.descripciontorneo = '".$_SESSION['torneo_predio']."' and fi.chequeado = 0
							
					 order by g.nombre,f.tipofecha,fi.hora";
		 return $this-> query($sql,0);
	}
	
	//where tp.descripciontorneo = '".$_SESSION['torneo_predio']."'
	
	function insertarHorariosEquiposPrioridades($reftorneoge,$refturno,$valor) {
		$sql = "insert into dbturnosequiposprioridad(iddbturnosequiposprioridad,reftorneoge,refturno,valor)
		values ('',".$reftorneoge.",".$refturno.",".$valor.")";
		$res = $this->query($sql,1);
		return $res;
	}
	
	
	function modificarHorariosEquiposPrioridades($id,$refturno,$valor) {
		$sql = "update dbturnosequiposprioridad
		set
			refturno = ".$refturno.",valor = ".$valor."
		where iddbturnosequiposprioridad =".$id;
		$res = $this->query($sql,0);
		return $res;
	}
	
	
	function eliminarHorariosEquiposPrioridades($id) {
		$sql = "delete from dbturnosequiposprioridad where iddbturnosequiposprioridad =".$id;
		$res = $this->query($sql,0);
		return $res;
	} 
	
	
	function insertarZonasEquipos($refgrupo,$reftorneo,$refequipo,$prioridad) {
		$sql = "insert into dbtorneoge(IdTorneoGE,refgrupo,reftorneo,refequipo,prioridad)
		values ('',".$refgrupo.",".$reftorneo.",".$refequipo.",".($prioridad == '' ? 0 : $prioridad).")";
		$res = $this->query($sql,1);
		return $res;
	}
	
	
	
	
	function modificarZonasEquipos($id,$refgrupo,$reftorneo,$refequipo,$prioridad) {
		$sql = "update dbtorneoge
		set
		refgrupo = ".$refgrupo.",reftorneo = ".$reftorneo.",refequipo = ".$refequipo.",prioridad = ".$prioridad."
		where IdTorneoGE =".$id;
		$res = $this->query($sql,0);
		return $res;
	}

	
	function eliminarZonasEquipos($id) {
		
		$this->eliminarHorariosEquiposPrioridades($id);

		$sqldelTorGE = "delete from dbtorneoge where idtorneoge =".$id;
		$res = $this-> query($sqldelTorGE,0);
		
		return $res;
	
		
	}
	
	
	
	function agregarFixture($idgrupo,$idequipoa,$idequipob,$resultadoa,$resultadob,$idtorneo,$fecha,$fechajuego,$hora,$minutos) {
		
		
		
		$ideq1 = $this->TraerIdTorneoGE($idgrupo,$idequipoa,$idtorneo);
		$ideq2 = $this->TraerIdTorneoGE($idgrupo,$idequipob,$idtorneo);
		
		$sqlfecha = "select * from tbfechas where tipofecha='".$fecha."'";
		
		$resfecha = $this->query($sqlfecha,0);
		$idfecha= mysql_result($resfecha,0,0);
		
		$horario = $hora.":".$minutos;
		
		if ($resultadoa == '')
		$resultadoa = 'null';
		
		if ($resultadob == '')
		$resultadob = 'null';
		
		
		$sql = "insert into dbfixture(idfixture,
									  reftorneoge_a,
									  resultado_a,
									  reftorneoge_b,
									  resultado_b,
									  fechajuego,
									  refFecha,
									  hora) 
					values ('',".$ideq1.",".$resultadoa.",".$ideq2.",".$resultadob.",'".$fechajuego."',".$idfecha.",'".$horario."')";
		$this-> query($sql,1);
		
		return 1;	
					
					
	}
	
	
	function insertarFixture($reftorneoge_a,$resultado_a,$reftorneoge_b,$resultado_b,$fechajuego,$refFecha,$cancha,$horario) {
		
		$sqlH = "select
				h.idhorario,h.horario
				from tbhorarios h
				where		h.idhorario = ".$horario;
		$resH = mysql_result($this-> query($sqlH,0),0,1);
		$horario = $resH;
		
		$sqlC = "select
				h.cancha
				from tbcanchas h
				where		h.idcancha = ".$cancha;
		$resC = mysql_result($this-> query($sqlC,0),0,0);
		$cancha = $resC;
		
		
		$sql = "insert into dbfixture(Idfixture,reftorneoge_a,resultado_a,reftorneoge_b,resultado_b,fechajuego,refFecha,cancha,hora)
		values ('',".$reftorneoge_a.",".($resultado_a == '' ? 'null' : $resultado_a).",".$reftorneoge_b.",".($resultado_b == '' ? 'null' : $resultado_b).",'".utf8_decode($fechajuego)."',".$refFecha.",'".$cancha."','".$horario."')";
		
		$res = $this->query($sql,1);
		return $res;
	}
	
	
	function modificarFixtureTodo($id,$reftorneoge_a,$resultado_a,$reftorneoge_b,$resultado_b,$fechajuego,$refFecha,$cancha,$horario,$chequeado) {
		
		$sqlH = "select
				h.idhorario,h.horario
				from tbhorarios h
				where		h.idhorario = ".$horario;
		$resH = mysql_result($this-> query($sqlH,0),0,1);
		$horario = $resH;
		
		$sqlC = "select
				h.cancha
				from tbcanchas h
				where		h.idcancha = ".$cancha;
		$resC = mysql_result($this-> query($sqlC,0),0,0);
		$cancha = $resC;
		
		if ($resultado_a == '') {
			$resultado_a = 'null';	
		}
		
		if ($resultado_b == '') {
			$resultado_b = 'null';	
		}
		
		
		$sql = "update dbfixture
		set
		reftorneoge_a = ".$reftorneoge_a.",resultado_a = ".$resultado_a.",reftorneoge_b = ".$reftorneoge_b.",resultado_b = ".$resultado_b.",fechajuego = '".$fechajuego."',refFecha = ".$refFecha.",cancha = '".utf8_decode($cancha)."',hora = '".$horario."', chequeado = ".$chequeado."  
		where Idfixture =".$id;
		
		$res = $this->query($sql,0);
		return 1;
	} 
	
	
	function eliminarFixture($id) {
		$sql = "delete from dbfixture where Idfixture =".$id;
		
		$res = $this->query($sql,0);
		return $res;
	} 

	
	function modificarFixture($idfixture,$resultadoa,$resultadob) {
		$sql = "update dbfixture set resultado_a =".$resultadoa.", resultado_b=".$resultadob." where idfixture =".$idfixture;
		$res = $this-> query($sql,0);
		return $res;
	}
	

	
	function cambiarEquipoPorEquipo($idequipob,$idgrupoequipo) {
		$sql = "update dbgruposequipos set refequipo =".$idequipob." where idgrupoequipo =".$idgrupoequipo;
		$res= $this-> query($sql,0);
		return $res;
	}
	
	function TraerIdFixture($idFixture,$idgrupo) {
		$sql = "select 
			fi.idfixture,
			(select e.nombre 
			        from dbtorneoge tge
			        inner 
			        join dbgruposequipos ge
			        on ge.idgrupoequipo = tge.refgrupoequipo
			        inner 
			        join dbtorneos t
			        on tge.reftorneo = t.idtorneo and t.activo = true
			        inner 
			        join dbequipos e
			        on e.idequipo = ge.refequipo
			        inner 
			        join dbgrupos g
			        on g.idgrupo = ge.refgrupo
			        where tge.idtorneoge = fi.reftorneoge_a and g.idgrupo=".$idgrupo.") as equipoa,
			fi.resultado_a as resultadoa,
			(select e.nombre 
			        from dbtorneoge tge
			        inner 
			        join dbgruposequipos ge
			        on ge.idgrupoequipo = tge.refgrupoequipo
			        inner 
			        join dbtorneos t
			        on tge.reftorneo = t.idtorneo and t.activo = true
			        inner 
			        join dbequipos e
			        on e.idequipo = ge.refequipo
			        inner 
			        join dbgrupos g
			        on g.idgrupo = ge.refgrupo
			        where tge.idtorneoge = fi.reftorneoge_b and g.idgrupo=".$idgrupo.") as equipob,
			fi.resultado_b as resultadob,
			(select g.nombre
			        from dbtorneoge tge
			        inner 
			        join dbgruposequipos ge
			        on ge.idgrupoequipo = tge.refgrupoequipo
			        inner 
			        join dbtorneos t
			        on tge.reftorneo = t.idtorneo and t.activo = true
			        inner 
			        join dbequipos e
			        on e.idequipo = ge.refequipo
			        inner 
			        join dbgrupos g
			        on g.idgrupo = ge.refgrupo
			        where tge.idtorneoge = fi.reftorneoge_b and g.idgrupo=".$idgrupo.") as zona,   
			fi.fechajuego,
			f.tipofecha as fecha,
			fi.hora
					from dbfixture as fi
					        inner 
					        join tbfechas AS f
					        on fi.reffecha = f.idfecha
					        inner 
					        join dbtorneoge tge
					        on tge.idtorneoge = fi.reftorneoge_b
					        inner 
					        join dbgruposequipos ge
					        on ge.idgrupoequipo = tge.refgrupoequipo
					        inner 
					        join dbtorneos t
					        on tge.reftorneo = t.idtorneo and t.activo = true
					        inner 
					        join dbgrupos g
					        on g.idgrupo = ge.refgrupo
					where g.idgrupo=".$idgrupo." and fi.idfixture=".$idFixture;
		return $this->query($sql,0);
	}
	
	
	function TraerEquiposSinZona() {
		$sql  = "select
					e.idequipo, e.nombre
				from		dbequipos e
				/*left
				join		dbtorneoge tge
				on			tge.refequipo = e.idequipo
				left
				join		dbtorneos t
				on			t.idtorneo = tge.reftorneo and t.activo = 1
				where		tge.idtorneoge is null*/
				order by e.nombre";
		return $this->query($sql,0);
		
	}
	
	function TraerEquiposZonas() {
		$sql  = "select 
			tge.idtorneoge, g.nombre, e.nombre, t.nombre, tge.prioridad
		from
			dbequipos e
				inner join
			dbtorneoge tge ON tge.refequipo = e.idequipo
				inner join
			dbgrupos g ON g.idgrupo = tge.refgrupo
				inner join
			dbtorneos t ON t.idtorneo = tge.reftorneo
			inner
							join		tbtipotorneo tp
							on			tp.idtipotorneo = t.reftipotorneo
			where tp.descripciontorneo = '".$_SESSION['torneo_predio']."' and t.activo = 1
			order by g.nombre, e.nombre";
		return $this->query($sql,0);
	}
	
	
	function TraerEquiposZonasPorZonas($idzona) {
		$sql  = "select 
			tge.idtorneoge, g.nombre, e.nombre, t.nombre, tge.prioridad
		from
			dbequipos e
				inner join
			dbtorneoge tge ON tge.refequipo = e.idequipo
				inner join
			dbgrupos g ON g.idgrupo = tge.refgrupo
				inner join
			dbtorneos t ON t.idtorneo = tge.reftorneo
			inner
							join		tbtipotorneo tp
							on			tp.idtipotorneo = t.reftipotorneo
			where tp.descripciontorneo = '".$_SESSION['torneo_predio']."' and t.activo = 1 and tge.refgrupo = ".$idzona."
			order by g.nombre, e.nombre";
		return $this->query($sql,0);
	}
	
	function TraerZonaPorTorneoEquipo($idEquipo) {
		$sql  = "select g.idgrupo, g.nombre,tp.idtipotorneo
				from dbtorneoge tge 
				inner join dbgrupos g on tge.refgrupo = g.idgrupo
				inner 
				        join dbtorneos t
				        on tge.reftorneo = t.idtorneo and t.activo = 1
				inner 
				        join tbtipotorneo tp
				        on t.reftipotorneo = tp.idtipotorneo
				inner
				join	dbequipos e
				on		e.idequipo = tge.refequipo
				where e.idequipo = ".$idEquipo."
				group by	e.idequipo, e.nombre,tp.idtipotorneo";
		return $this->query($sql,0);
	}
	
	function TraerEquiposZonasPorId($id) {
		$sql  = "select 
			idtorneoge, refgrupo, refequipo, reftorneo, prioridad
		from
			dbtorneoge 
		where idtorneoge = ".$id;
		return $this->query($sql,0);
	}
	
	function TraerEquiposZonasPorTorneoZona($idTorneo,$idZona) {
		$sql  = "select e.idequipo, e.nombre
				from dbtorneoge tge 
				inner join dbgrupos g on tge.refgrupo = g.idgrupo
				inner 
				        join dbtorneos t
				        on tge.reftorneo = t.idtorneo and t.activo = 1
				inner 
				        join tbtipotorneo tp
				        on t.reftipotorneo = tp.idtipotorneo
				inner
				join	dbequipos e
				on		e.idequipo = tge.refequipo
				where tp.idtipotorneo = ".$idTorneo." and g.idgrupo = ".$idZona."
				group by	e.idequipo, e.nombre";
		return $this->query($sql,0);
	}
	
	function TraerFixtureSinTablaConducta() {
		$sql  = "select 
					e.idequipo, e.nombre,ff.tipofecha
				from
					dbtorneoge tge
						inner join
					dbgrupos g ON tge.refgrupo = g.idgrupo
						inner join
					dbtorneos t ON tge.reftorneo = t.idtorneo
						and t.activo = 1
						inner join
					tbtipotorneo tp ON t.reftipotorneo = tp.idtipotorneo
						inner join
					dbequipos e ON e.idequipo = tge.refequipo
						inner join
					dbfixture fix ON fix.reftorneoge_a = tge.idtorneoge or fix.reftorneoge_b = tge.idtorneoge
						left join
					tbconducta cc ON cc.reffecha = fix.reffecha and cc.refequipo = e.idequipo and t.idtorneo = cc.reftorneo
						inner join
					tbfechas ff ON ff.idfecha = fix.reffecha
				where cc.idconducta is null
				group by	e.idequipo, e.nombre,ff.tipofecha
				order by e.nombre,ff.tipofecha desc";
		return $this->query($sql,0);
	}
	
		function insertarConducta($refequipo,$puntos,$reffecha,$reftorneo) {
		$sql = "insert into tbconducta(idconducta,refequipo,puntos,reffecha,reftorneo)
		values ('',".$refequipo.",".$puntos.",".$reffecha.",".$reftorneo.")";
		$res = $this->query($sql,1);
		return $res;
		}
		
		
		function modificarConducta($id,$refequipo,$puntos) {
		$sql = "update tbconducta
		set
		refequipo = ".$refequipo.",puntos = ".$puntos."
		where idconducta =".$id;
		$res = $this->query($sql,0);
		return $res;
		}


function traerCalculoPorFechaTorneoEquipo($refequipo,$reffecha,$idtorneo) {
	$sql = "select 
				*
			from
				(select 
					t.tipofecha,
						t.nombre,
						sum(t.puntos) as puntos,
						t.idequipo,
						t.idfecha
				from
					(select 
					f.tipofecha,
						e.nombre,
						count(a.amarillas) as puntos,
						f.idfecha,
						e.idequipo
				from
					tbamonestados a
				inner join dbequipos e ON e.idequipo = a.refequipo
				inner join dbfixture fix ON fix.idfixture = a.reffixture
				inner join tbfechas f ON f.idfecha = fix.reffecha
				inner join dbtorneoge tge ON tge.refequipo = e.idequipo
					and fix.reftorneoge_a = tge.idtorneoge
				where
					a.amarillas = 1 and tge.reftorneo = ".$idtorneo."
						and fix.reffecha = ".$reffecha."
				group by f.tipofecha , e.nombre , f.idfecha , e.idequipo union all select 
					f.tipofecha,
						e.nombre,
						count(a.amarillas) as puntos,
						f.idfecha,
						e.idequipo
				from
					tbamonestados a
				inner join dbequipos e ON e.idequipo = a.refequipo
				inner join dbfixture fix ON fix.idfixture = a.reffixture
				inner join tbfechas f ON f.idfecha = fix.reffecha
				inner join dbtorneoge tge ON tge.refequipo = e.idequipo
					and fix.reftorneoge_b = tge.idtorneoge
				where
					a.amarillas = 1 and tge.reftorneo = ".$idtorneo."
						and fix.reffecha = ".$reffecha."
				group by f.tipofecha , e.nombre , f.idfecha , e.idequipo union all select 
					f.tipofecha,
						e.nombre,
						sum(3) as puntos,
						f.idfecha,
						e.idequipo
				from
					tbsuspendidos a
				inner join dbequipos e ON e.idequipo = a.refequipo
				inner join (select 
					refsuspendido, min(reffecha) as idfecha
				from
					dbsuspendidosfechas
				group by refsuspendido) sp ON sp.refsuspendido = a.idsuspendido
				inner join tbfechas f ON f.idfecha = sp.idfecha - 1
				inner join dbfixture fix ON fix.idfixture = a.reffixture
				inner join dbtorneoge tge ON tge.refequipo = e.idequipo
					and fix.reftorneoge_a = tge.idtorneoge
				where
					tge.reftorneo = ".$idtorneo." and fix.reffecha = ".$reffecha." and (a.motivos like '%Roja Directa%' or a.motivos like '%Doble Amarilla%') 
				group by f.tipofecha , e.nombre , f.idfecha , e.idequipo union all select 
					f.tipofecha,
						e.nombre,
						sum(3) as puntos,
						f.idfecha,
						e.idequipo
				from
					tbsuspendidos a
				inner join dbequipos e ON e.idequipo = a.refequipo
				inner join (select 
					refsuspendido, min(reffecha) as idfecha
				from
					dbsuspendidosfechas
				group by refsuspendido) sp ON sp.refsuspendido = a.idsuspendido
				inner join tbfechas f ON f.idfecha = sp.idfecha - 1
				inner join dbfixture fix ON fix.idfixture = a.reffixture
				inner join dbtorneoge tge ON tge.refequipo = e.idequipo
					and fix.reftorneoge_b = tge.idtorneoge
				where
					tge.reftorneo = ".$idtorneo." and fix.reffecha = ".$reffecha." and (a.motivos like '%Roja Directa%' or a.motivos like '%Doble Amarilla%') 
				group by f.tipofecha , e.nombre , f.idfecha , e.idequipo) as t
				group by t.tipofecha , t.nombre , t.idequipo , t.idfecha) as tt
					inner join
				dbtorneoge tge ON tge.refequipo = tt.idequipo
					and tge.reftorneo = ".$idtorneo."
					inner join
				dbfixture fix ON (fix.reftorneoge_a = tge.idtorneoge
					or fix.reftorneoge_b = tge.idtorneoge)
					and fix.reffecha = tt.idfecha
			where
				tt.idfecha = ".$reffecha." and tt.idequipo = ".$refequipo." 
			order by 2";	
			
		$res = $this->query($sql,0);
		return $res;
}

function traerPuntosConductaPorFechaEquipo($refequipo,$reffecha,$idtorneo) {
	$sql = "select c.puntos,e.idequipo from tbconducta c
			inner join dbequipos e on e.idequipo = c.refequipo 
			where c.refequipo =".$refequipo." and c.reffecha <=".$reffecha." and c.reftorneo = ".$idtorneo." 
			 order by c.reffecha desc";
	$res = $this->query($sql,0);
	return $res;
}

function cargarTablaConducta($reffecha) {
		$sql  = "select 
					e.idequipo, e.nombre,ff.tipofecha, t.idtorneo
				from
					dbtorneoge tge
						inner join
					dbgrupos g ON tge.refgrupo = g.idgrupo
						inner join
					dbtorneos t ON tge.reftorneo = t.idtorneo
						and t.activo = 1
						inner join
					tbtipotorneo tp ON t.reftipotorneo = tp.idtipotorneo
						inner join
					dbequipos e ON e.idequipo = tge.refequipo
						inner join
					dbfixture fix ON fix.reftorneoge_a = tge.idtorneoge or fix.reftorneoge_b = tge.idtorneoge
						left join
					tbconducta cc ON cc.reffecha = fix.reffecha and cc.refequipo = e.idequipo and cc.reftorneo = t.idtorneo
						inner join
					tbfechas ff ON ff.idfecha = fix.reffecha
				where fix.reffecha = ".$reffecha." and cc.idconducta is null
				group by	e.idequipo, e.nombre,ff.tipofecha";
		
		//return $sql;
		$res = $this->query($sql,0);
		
		if (mysql_num_rows($res)>0) {
			while ($row6 = mysql_fetch_array($res)) {
				if (($reffecha - 1) == 22) {
					$puntos = 0;
				} else {
					$resPuntos = $this->traerPuntosConductaPorFechaEquipo($row6[0],$reffecha-1,$row6[3]);
					if (mysql_num_rows($resPuntos)>0) {
						$puntos = mysql_result($resPuntos,0,0);	
					}
				}
				$this->insertarConducta($row6[0],$puntos,$reffecha,$row6[3]);				
			}
		}
		
		return true;
		
	}
	
	
	function calcularTablaConducta($reffecha) {
		$sql  = "select 
					e.idequipo, e.nombre,ff.tipofecha, t.idtorneo
				from
					dbtorneoge tge
						inner join
					dbgrupos g ON tge.refgrupo = g.idgrupo
						inner join
					dbtorneos t ON tge.reftorneo = t.idtorneo
						and t.activo = 1
						inner join
					tbtipotorneo tp ON t.reftipotorneo = tp.idtipotorneo
						inner join
					dbequipos e ON e.idequipo = tge.refequipo
						inner join
					dbfixture fix ON fix.reftorneoge_a = tge.idtorneoge or fix.reftorneoge_b = tge.idtorneoge
						left join
					tbconducta cc ON cc.reffecha = fix.reffecha and cc.refequipo = e.idequipo and cc.reftorneo = t.idtorneo
						inner join
					tbfechas ff ON ff.idfecha = fix.reffecha
				where fix.reffecha = ".$reffecha." and cc.idconducta is null
				group by	e.idequipo, e.nombre,ff.tipofecha";
		
		//return $sql;
		$res = $this->query($sql,0);
		
		if (mysql_num_rows($res)>0) {
			while ($row6 = mysql_fetch_array($res)) {
				if (($reffecha - 1) == 22) {
					$resPuntosB = $this->traerCalculoPorFechaTorneoEquipo($row6[0],$reffecha,$row6[3]);
					if (mysql_num_rows($resPuntosB)>0) {
						$puntosB = mysql_result($resPuntosB,0,2);	
					} else {
						$puntosB = 0;	
					}
					$puntos = 0 + (integer)$puntosB;
				} else {
					$resPuntosA = $this->traerPuntosConductaPorFechaEquipo($row6[0],$reffecha-1,$row6[3]);
					$resPuntosB = $this->traerCalculoPorFechaTorneoEquipo($row6[0],$reffecha,$row6[3]);
					if (mysql_num_rows($resPuntosA)>0) {
						$puntosA = mysql_result($resPuntosA,0,0);	
					} else {
						$puntosA = 0;	
					}
					if (mysql_num_rows($resPuntosB)>0) {
						$puntosB = mysql_result($resPuntosB,0,2);	
					} else {
						$puntosB = 0;	
					}
					$puntos = (integer)$puntosA + (integer)$puntosB;
				}
				$this->insertarConducta($row6[0],$puntos,$reffecha,$row6[3]);				
			}
		}
		
		return true;
		
	}
	
	
	function TraerZonaPorTorneoEquipoNuevo($idTorneo,$idEquipo) {
		$sql  = "select g.idgrupo, g.nombre
				from dbtorneoge tge 
				inner join dbgrupos g on tge.refgrupo = g.idgrupo
				inner 
				        join dbtorneos t
				        on tge.reftorneo = t.idtorneo and t.activo = 1
				inner 
				        join tbtipotorneo tp
				        on t.reftipotorneo = tp.idtipotorneo
				inner
				join	dbequipos e
				on		e.idequipo = tge.refequipo
				where tp.idtipotorneo = ".$idTorneo." and e.idequipo = ".$idEquipo."
				group by	e.idequipo, e.nombre";
		return $this->query($sql,0);
	}
	
	function chequearPorFecha($reffecha) {
		$sql = "update dbfixture set chequeado = 1 where reffecha = ".$reffecha;
		return $this->query($sql,0);	
	}
	
	function TraerFixturePorId($id) {
		$sql = "SELECT idfixture,
					reftorneoge_a,
					resultado_a,
					reftorneoge_b,
					resultado_b,
					fechajuego,
					reffecha,
					hora,
					cancha,
					chequeado
				FROM dbfixture 
				where idfixture = ".$id;
		return $this->query($sql,0);	
	}

	
	function reemplazarEquipos($equipoReemplazado,$equipoQueReemplaza,$pts,$golesencontra,$ptsfairplay,$reffecha) {
		
		$sqlFixA = "select
						distinct f.idfixture
						from		dbtorneoge tge
						inner
						join		dbfixture f
						on			tge.idtorneoge = f.reftorneoge_a
						where		f.reffecha >= ".$reffecha." and tge.refequipo = ".$equipoReemplazado;
		$resFixA = $this->query($sqlFixA,0);
		
		$sqlFixB = "select
						distinct f.idfixture
						from		dbtorneoge tge
						inner
						join		dbfixture f
						on			tge.idtorneoge = f.reftorneoge_b
						where		f.reffecha >= ".$reffecha." and tge.refequipo = ".$equipoReemplazado;
		$resFixB = $this->query($sqlFixB,0);
		
		$sqlTGE = "select tge.refgrupo,tge.reftorneo 
					from dbtorneoge tge 
					where tge.refequipo = ".$equipoReemplazado;
		$resTGE = $this->query($sqlTGE,0);
		
//		
		
		if (mysql_num_rows($resTGE)>0) {
			$idZona = mysql_result($resTGE,0,0);
			$idTorneoNuevo = mysql_result($resTGE,0,1);
			$existe = $this->TraerIdTorneoGE($idZona,$equipoQueReemplaza,$idTorneoNuevo);
			
			if (mysql_num_rows($existe)>0) {
				$idTorneoGENuevo = mysql_result($existe,0,'idtorneoeg');
			} else {
				$idTorneoGENuevo = $this->insertarZonasEquipos($idZona,$idTorneoNuevo,$equipoQueReemplaza,1);
			}
		}
		//return $idTorneoGENuevo;
		$sql = "insert into dbreemplazo
							(idreemplazo,
							refequipo,
							refequiporeemplazado,
							puntos,
							golesencontra,
							reffecha,
							reftorneo)
				values
					('',
					".$equipoQueReemplaza.",
					".$equipoReemplazado.",
					".$pts.",
					".$golesencontra.",
					".$reffecha.",
					".$idTorneoNuevo.")";
		$res = $this->query($sql,1);
		if ((integer)$res > 0) {
			
			if (mysql_num_rows($resTGE)>0) {
				//update del fixture del equipo que sale
				while ($rowTA = mysql_fetch_array($resFixA)) {
					$sqlUpdateA = "update dbfixture set reftorneoge_a = ".$idTorneoGENuevo." where idfixture = ".$rowTA[0];
					$this->query($sqlUpdateA,0);
				}
				
				while ($rowTB = mysql_fetch_array($resFixB)) {
					$sqlUpdateB = "update dbfixture set reftorneoge_b = ".$idTorneoGENuevo." where idfixture = ".$rowTB[0];
					$this->query($sqlUpdateB,0);
				}
			}
			
			//inserto el fairplay
			$sqlEx = "select c.idconducta,e.nombre,c.puntos,e.idequipo from tbconducta c
			inner join dbequipos e on e.idequipo = c.refequipo 
			where c.refequipo =".$equipoQueReemplaza." and c.reffecha =".$reffecha;
			$resEx = $this->query($sqlEx,0);
			
			if (mysql_num_rows($resEx)>0) {
				//si existe le sumo
				$sqlCM = "update tbconducta
				set
				puntos = puntos + ".$ptsfairplay."
				where refequipo =".$equipoQueReemplaza;
				$this->query($sqlCM,0);
				
			} else {
				//sino existe lo inserto
				$sqlConducta = "insert into tbconducta(idconducta,refequipo,puntos,reffecha)
				values ('',".$equipoQueReemplaza.",".$ptsfairplay.",".$reffecha.")";
				$this->query($sqlConducta,1);
			}
			
			
			//inserto la baja del equipo
			$sqlBaja = "update dbtorneoge set activo = '1' where refequipo =".$equipoReemplazado;
			//$this->query($sqlBaja,0);
			
			return $res;
		}
		return '';
	}


/* PARA Reemplazos */

function insertarReemplazos($refequipo,$refequiporeemplazado,$puntos,$golesencontra,$reffecha,$reftorneo,$ptsfairplay) {
$sql = "insert into dbreemplazo(idreemplazo,refequipo,refequiporeemplazado,puntos,golesencontra,reffecha,reftorneo)
values ('',".$refequipo.",".$refequiporeemplazado.",".$puntos.",".$golesencontra.",".$reffecha.",".$reftorneo.")";
$res = $this->query($sql,1);


////////////////////////////// VERIFICO el Fixture para cambiar las fechas con el equipo nuevo  ///////////////////////
	$sqlFixA = "select
						distinct f.idfixture
						from		dbtorneoge tge
						inner
						join		dbfixture f
						on			tge.idtorneoge = f.reftorneoge_a
						inner
						join		dbtorneos t
						on			t.idtorneo = tge.reftorneo
						where		t.activo = 1 and f.reffecha >= ".$reffecha." and tge.refequipo = ".$refequiporeemplazado." and t.reftipotorneo =".$reftorneo;
		$resFixA = $this->query($sqlFixA,0);
		
		$sqlFixB = "select
						distinct f.idfixture
						from		dbtorneoge tge
						inner
						join		dbfixture f
						on			tge.idtorneoge = f.reftorneoge_b
						inner
						join		dbtorneos t
						on			t.idtorneo = tge.reftorneo
						where		t.activo = 1 and f.reffecha >= ".$reffecha." and tge.refequipo = ".$refequiporeemplazado." and t.reftipotorneo =".$reftorneo;
		$resFixB = $this->query($sqlFixB,0);
		
		$sqlTGE = "select tge.refgrupo,tge.reftorneo 
					from dbtorneoge tge 
					inner
					join		dbtorneos t
					on			t.idtorneo = tge.reftorneo
					where 		t.activo = 1 and tge.refequipo = ".$refequiporeemplazado." and t.reftipotorneo =".$reftorneo;
		$resTGE = $this->query($sqlTGE,0);
		
	
		
		if (mysql_num_rows($resTGE)>0) {
			$idZona = mysql_result($resTGE,0,0);
			$idTorneoNuevo = mysql_result($resTGE,0,1);
			$existe = $this->TraerIdTorneoGE($idZona,$refequipo,$idTorneoNuevo);
			
			if (mysql_num_rows($existe)>0) {
				$idTorneoGENuevo = mysql_result($existe,0,'idtorneoeg');
			} else {
				$idTorneoGENuevo = $this->insertarZonasEquipos($idZona,$idTorneoNuevo,$refequipo,1);
			}
		}


if ((integer)$res > 0) {
			
			if (mysql_num_rows($resTGE)>0) {
				//update del fixture del equipo que sale
				while ($rowTA = mysql_fetch_array($resFixA)) {
					$sqlUpdateA = "update dbfixture set reftorneoge_a = ".$idTorneoGENuevo." where idfixture = ".$rowTA[0];
					$this->query($sqlUpdateA,0);
				}
				
				while ($rowTB = mysql_fetch_array($resFixB)) {
					$sqlUpdateB = "update dbfixture set reftorneoge_b = ".$idTorneoGENuevo." where idfixture = ".$rowTB[0];
					$this->query($sqlUpdateB,0);
				}
			}
			
			//inserto el fairplay
			$sqlEx = "select c.idconducta,e.nombre,c.puntos,e.idequipo from tbconducta c
			inner join dbequipos e on e.idequipo = c.refequipo 
			where c.refequipo =".$refequipo." and c.reffecha =".$reffecha." and c.reftorneo =".$idTorneoNuevo;
			$resEx = $this->query($sqlEx,0);
			
			if (mysql_num_rows($resEx)>0) {
				//si existe le sumo
				$sqlCM = "update tbconducta
				set
				puntos = puntos + ".$ptsfairplay."
				where refequipo =".$refequipo." and reftorneo =".$idTorneoNuevo;
				$this->query($sqlCM,0);
				
			} else {
				//sino existe lo inserto
				$sqlConducta = "insert into tbconducta(idconducta,refequipo,puntos,reffecha,reftorneo)
				values ('',".$refequipo.",".$ptsfairplay.",".$reffecha.",".$idTorneoNuevo.")";
				$this->query($sqlConducta,1);
			}
			
			
			//inserto la baja del equipo
			$sqlBaja = "update dbtorneoge set activo = '1' where refequipo =".$refequiporeemplazado;
			//$this->query($sqlBaja,0);
			
			return $res;
		}
		return '';
}


function modificarReemplazos($id,$refequipo,$refequiporeemplazado,$puntos,$golesencontra,$reffecha,$reftorneo) {

$resReemplazo = $this->traerReemplazosPorId($id);

$refEquipoActual = mysql_result($resReemplazo,0,'refequipo');
$refEquipoReempActual = mysql_result($resReemplazo,0,'refequiporeemplazado');


$sql = "update dbreemplazo
set
refequipo = ".$refequipo.",refequiporeemplazado = ".$refequiporeemplazado.",puntos = ".$puntos.",golesencontra = ".$golesencontra.",reffecha = ".$reffecha.",reftorneo = ".$reftorneo."
where idreemplazo =".$id;
$res = $this->query($sql,0);


////////////////////////////// VERIFICO el Fixture para cambiar las fechas con el equipo nuevo  ///////////////////////
	$sqlFixA = "select
						distinct f.idfixture
						from		dbtorneoge tge
						inner
						join		dbfixture f
						on			tge.idtorneoge = f.reftorneoge_a
						inner
						join		dbtorneos t
						on			t.idtorneo = tge.reftorneo
						where		t.activo = 1 and f.reffecha >= ".$reffecha." and tge.refequipo = ".$refequiporeemplazado;
		$resFixA = $this->query($sqlFixA,0);
		
		$sqlFixB = "select
						distinct f.idfixture
						from		dbtorneoge tge
						inner
						join		dbfixture f
						on			tge.idtorneoge = f.reftorneoge_b
						inner
						join		dbtorneos t
						on			t.idtorneo = tge.reftorneo
						where		t.activo = 1 and f.reffecha >= ".$reffecha." and tge.refequipo = ".$refequiporeemplazado;
		$resFixB = $this->query($sqlFixB,0);
		
		//////////////////////// LO uso solo para encontrar el torneo y la zona a la que va a pertenecer el equipo ///////////////
		$sqlTGE = "select tge.refgrupo,tge.reftorneo 
					from dbtorneoge tge 
					inner
					join		dbtorneos t
					on			t.idtorneo = tge.reftorneo
					where 		t.activo = 1 and tge.refequipo = ".$refequiporeemplazado;
		$resTGE = $this->query($sqlTGE,0);
		
	

		if (mysql_num_rows($resTGE)>0) {
			$idZona = mysql_result($resTGE,0,0);
			$idTorneoNuevo = mysql_result($resTGE,0,1);
			
			///// VERIFICO que exista el torneoge del equipo que entra //////////////////////////////////
			$existe = $this->TraerIdTorneoGE($idZona,$refequipo,$idTorneoNuevo);
			
			if (mysql_num_rows($existe)>0) {
				$idTorneoGENuevo = mysql_result($existe,0,'idtorneoeg');
			} else {
				$idTorneoGENuevo = $this->insertarZonasEquipos($idZona,$idTorneoNuevo,$refequipo,1);
			}
		}
		
	
	if (($refEquipoActual != $refequipo) && ($refEquipoReempActual != $refequiporeemplazado)) {
		if (mysql_num_rows($resTGE)>0) {
			//update del fixture del equipo que sale
			while ($rowTA = mysql_fetch_array($resFixA)) {
				$sqlUpdateA = "update dbfixture set reftorneoge_a = ".$idTorneoGENuevo." where idfixture = ".$rowTA[0];
				$this->query($sqlUpdateA,0);
			}
			
			while ($rowTB = mysql_fetch_array($resFixB)) {
				$sqlUpdateB = "update dbfixture set reftorneoge_b = ".$idTorneoGENuevo." where idfixture = ".$rowTB[0];
				$this->query($sqlUpdateB,0);
			}
		}
	}


return $res;
}


function eliminarReemplazos($id) {

$resReemp = $this->traerReemplazosPorId($id);	

if (mysql_num_rows($resReemp)>0) {
	$sqlFixA = "select
						distinct f.idfixture
						from		dbtorneoge tge
						inner
						join		dbfixture f
						on			tge.idtorneoge = f.reftorneoge_a
						inner
						join		dbtorneos t
						on			t.idtorneo = tge.reftorneo
						where		t.activo = 1 and f.reffecha >= ".mysql_result($resReemp,0,'reffecha')." and tge.refequipo = ".mysql_result($resReemp,0,'refequipo')." and t.reftipotorneo =".mysql_result($resReemp,0,'reftorneo');
		$resFixA = $this->query($sqlFixA,0);
		
		$sqlFixB = "select
						distinct f.idfixture
						from		dbtorneoge tge
						inner
						join		dbfixture f
						on			tge.idtorneoge = f.reftorneoge_b
						inner
						join		dbtorneos t
						on			t.idtorneo = tge.reftorneo
						where		t.activo = 1 and f.reffecha >= ".mysql_result($resReemp,0,'reffecha')." and tge.refequipo = ".mysql_result($resReemp,0,'refequipo')." and t.reftipotorneo =".mysql_result($resReemp,0,'reftorneo');
		$resFixB = $this->query($sqlFixB,0);
		
		$sqlTGE = "select tge.refgrupo,tge.reftorneo 
					from dbtorneoge tge 
					inner
					join		dbtorneos t
					on			t.idtorneo = tge.reftorneo
					where 		t.activo = 1 and tge.refequipo = ".mysql_result($resReemp,0,'refequipo')." and t.reftipotorneo =".mysql_result($resReemp,0,'reftorneo');
		$resTGE = $this->query($sqlTGE,0);
		
	
		
		if (mysql_num_rows($resTGE)>0) {
			$idZona = mysql_result($resTGE,0,0);
			$idTorneoNuevo = mysql_result($resTGE,0,1);
			$existe = $this->TraerIdTorneoGE($idZona,mysql_result($resReemp,0,'refequipo'),$idTorneoNuevo);
			
			if (mysql_num_rows($existe)>0) {
				$this->eliminarZonasEquipos(mysql_result($existe,0,'idtorneoeg'));
			}
		}	
		
		if (mysql_num_rows($resTGE)>0) {
			//update del fixture del equipo que sale
			while ($rowTA = mysql_fetch_array($resFixA)) {
				$this->eliminarFixture($rowTA[0]);
			}
			
			while ($rowTB = mysql_fetch_array($resFixB)) {
				$this->eliminarFixture($rowTB[0]);
			}
		}
}
	
$sql = "delete from dbreemplazo where idreemplazo =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerReemplazos() {
$sql = "select 
			idreemplazo,
			(select e.nombre from dbequipos e where e.idequipo = r.refequipo) as nombrea,
			(select e.nombre from dbequipos e where e.idequipo = r.refequiporeemplazado) as nombreb,
			r.puntos,
			r.golesencontra,
			f.tipofecha,
			tt.descripciontorneo,
			r.refequipo,
			r.refequiporeemplazado,
			r.reffecha,
			r.reftorneo 
			from dbreemplazo r 
			left join tbtipotorneo tt on tt.idtipotorneo = r.reftorneo
			left join tbfechas f on f.idfecha = r.reffecha
			order by 1 desc";
$res = $this->query($sql,0);
return $res;
}


function traerReemplazosPorId($id) {
$sql = "select idreemplazo,refequipo,refequiporeemplazado,puntos,golesencontra,reffecha,reftorneo from dbreemplazo where idreemplazo =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */	
	
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
		mysql_query("SET NAMES 'utf8'");
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
	
	
	
	
	}

?>