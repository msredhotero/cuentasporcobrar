<?php

date_default_timezone_set('America/Buenos_Aires');

class ServiciosCOPIA {
	
	function TraerResultadosPorGrupos($idgrupo,$idtorneo) {
		$sql = "select 
		       r.nombre,
		       count(*) as partidos,
		       sum(case when r.resultado_a > r.resultado_b then 1 else 0 end) as ganados, 
		       sum(case when r.resultado_a = r.resultado_b then 1 else 0 end) as empatados,
		       sum(case when r.resultado_a < r.resultado_b then 1 else 0 end) as perdidos,
		       sum(r.resultado_a) as golesafavor,
		       sum(r.resultado_b) as golesencontra,
		       (sum(r.resultado_a) - sum(r.resultado_b)) as diferencia,
		       ((sum(case when r.resultado_a > r.resultado_b then 1 else 0 end) * 3) +
		        (sum(case when r.resultado_a = r.resultado_b then 1 else 0 end) * 1)) as pts,
		        r.idequipo
		
				from (
				SELECT
				dbequipos.idequipo,
				dbequipos.nombre,
				dbtorneos.activo,
				dbfixture.fechajuego,
				dbfixture.hora,
				dbfixture.resultado_a,
				dbfixture.resultado_b,
				dbfixture.reffecha,
				copia_dbgruposequipos.refgrupo
				FROM
				dbequipos
				Inner Join copia_dbgruposequipos ON dbequipos.idequipo = copia_dbgruposequipos.refequipo
				Inner Join copia_dbtorneoge ON copia_dbgruposequipos.idgrupoEquipo = copia_dbtorneoge.refgrupoequipo  and copia_dbgruposequipos.reftorneo = ".$idtorneo."
				Inner Join dbtorneos ON dbtorneos.idtorneo = copia_dbtorneoge.reftorneo
				Inner Join dbfixture ON copia_dbtorneoge.IdTorneoge = dbfixture.reftorneoge_a
				WHERE
				dbtorneos.idtorneo =  ".$idtorneo." 
				and copia_dbgruposequipos.refgrupo = ".$idgrupo."
				/*AND dbequipos.IdEquipo =  17*/
				
				UNION all
				
				SELECT
				dbequipos.idequipo,
				dbequipos.nombre,
				dbtorneos.activo,
				dbfixture.fechajuego,
				dbfixture.hora,
				dbfixture.resultado_b,
				dbfixture.resultado_a,
				dbfixture.reffecha,
				copia_dbgruposequipos.refgrupo
				FROM
				dbequipos
				Inner Join copia_dbgruposequipos ON dbequipos.idequipo = copia_dbgruposequipos.refequipo
				Inner Join copia_dbtorneoge ON copia_dbgruposequipos.idgrupoequipo = copia_dbtorneoge.refgrupoequipo  and copia_dbgruposequipos.reftorneo = ".$idtorneo."
				Inner Join dbtorneos ON dbtorneos.idtorneo = copia_dbtorneoge.reftorneo
				Inner Join dbfixture ON copia_dbtorneoge.idtorneoge = dbfixture.reftorneoge_b
				WHERE
				dbtorneos.idtorneo =  ".$idtorneo." 
				and copia_dbgruposequipos.refgrupo = ".$idgrupo."
				/*AND dbequipos.IdEquipo =  17*/
				
				) as r
				group by r.nombre,r.idequipo 
				order by pts desc,diferencia desc,golesafavor desc,golesencontra desc,ganados desc";
				return $this-> query($sql,0);
				//return $sql;
	}
	
	
	function TraerResultadosPorGruposMax($idgrupo,$idtorneo) {
		$sql = "select 
		       r.nombre,
		       count(*) as partidos,
		       sum(case when r.resultado_a > r.resultado_b then 1 else 0 end) as ganados, 
		       sum(case when r.resultado_a = r.resultado_b then 1 else 0 end) as empatados,
		       sum(case when r.resultado_a < r.resultado_b then 1 else 0 end) as perdidos,
		       sum(r.resultado_a) as golesafavor,
		       sum(r.resultado_b) as golesencontra,
		       (sum(r.resultado_a) - sum(r.resultado_b)) as diferencia,
		       ((sum(case when r.resultado_a > r.resultado_b then 1 else 0 end) * 3) +
		        (sum(case when r.resultado_a = r.resultado_b then 1 else 0 end) * 1)) as pts,
		        r.idequipo
		
				from (
				SELECT
				dbequipos.idequipo,
				dbequipos.nombre,
				dbtorneos.activo,
				dbfixture.fechajuego,
				dbfixture.hora,
				dbfixture.resultado_a,
				dbfixture.resultado_b,
				dbfixture.reffecha,
				copia_dbgruposequipos.refgrupo
				FROM
				dbequipos
				Inner Join copia_dbgruposequipos ON dbequipos.idequipo = copia_dbgruposequipos.refequipo
				Inner Join copia_dbtorneoge ON copia_dbgruposequipos.idgrupoEquipo = copia_dbtorneoge.refgrupoequipo  and copia_dbgruposequipos.reftorneo = ".$idtorneo."
				Inner Join dbtorneos ON dbtorneos.idtorneo = copia_dbtorneoge.reftorneo
				Inner Join dbfixture ON copia_dbtorneoge.IdTorneoge = dbfixture.reftorneoge_a
				WHERE
				dbtorneos.idtorneo =  ".$idtorneo." 
				and copia_dbgruposequipos.refgrupo = ".$idgrupo."
				/*AND dbequipos.IdEquipo =  17*/
				
				UNION all
				
				SELECT
				dbequipos.idequipo,
				dbequipos.nombre,
				dbtorneos.activo,
				dbfixture.fechajuego,
				dbfixture.hora,
				dbfixture.resultado_b,
				dbfixture.resultado_a,
				dbfixture.reffecha,
				copia_dbgruposequipos.refgrupo
				FROM
				dbequipos
				Inner Join copia_dbgruposequipos ON dbequipos.idequipo = copia_dbgruposequipos.refequipo
				Inner Join copia_dbtorneoge ON copia_dbgruposequipos.idgrupoequipo = copia_dbtorneoge.refgrupoequipo  and copia_dbgruposequipos.reftorneo = ".$idtorneo."
				Inner Join dbtorneos ON dbtorneos.idtorneo = copia_dbtorneoge.reftorneo
				Inner Join dbfixture ON copia_dbtorneoge.idtorneoge = dbfixture.reftorneoge_b
				WHERE
				dbtorneos.idtorneo =  ".$idtorneo." 
				and copia_dbgruposequipos.refgrupo = ".$idgrupo."
				/*AND dbequipos.IdEquipo =  17*/
				
				) as r
				group by r.nombre,r.idequipo 
				order by pts desc,diferencia desc,golesafavor desc,golesencontra desc,ganados desc limit 1";
				return $this-> query($sql,0);
				//return $sql;
	}
	
	
	
	function TraerFixturePorGrupoFechaZona($idgrupo,$fecha,$idtorneo) {
		$sql = "select 
			fi.idfixture,
			(select e.nombre 
			        from copia_dbtorneoge tge
			        
			        inner 
			        join copia_dbgruposequipos ge
			        on ge.idgrupoequipo = tge.refgrupoequipo and ge.reftorneo = ".$idtorneo."
			        
			        inner 
			        join dbtorneos t
			        on tge.reftorneo = t.idtorneo and t.idtorneo =  ".$idtorneo." 
			        
			        inner 
			        join dbequipos e
			        on e.idequipo = ge.refequipo
			        
			        inner 
			        join dbgrupos g
			        on g.idgrupo = ge.refgrupo
			        where tge.idtorneoge = fi.reftorneoge_a and g.idgrupo=".$idgrupo.") as equipoa,
			
			fi.resultado_a as resultadoa,
			
			(select e.nombre 
			        from copia_dbtorneoge tge
			        
			        inner 
			        join copia_dbgruposequipos ge
			        on ge.idgrupoequipo = tge.refgrupoequipo and ge.reftorneo = ".$idtorneo."
			        
			        inner 
			        join dbtorneos t
			        on tge.reftorneo = t.idtorneo and t.idtorneo =  ".$idtorneo." 
			        
			        inner 
			        join dbequipos e
			        on e.idequipo = ge.refequipo
			        
			        inner 
			        join dbgrupos g
			        on g.idgrupo = ge.refgrupo
			        where tge.idtorneoge = fi.reftorneoge_b and g.idgrupo=".$idgrupo.") as equipob,
			
			fi.resultado_b as resultadob,
			
			(select g.nombre
			        from copia_dbtorneoge tge
			        
			        inner 
			        join copia_dbgruposequipos ge
			        on ge.idgrupoequipo = tge.refgrupoequipo and ge.reftorneo = ".$idtorneo."
			        
			        inner 
			        join dbtorneos t
			        on tge.reftorneo = t.idtorneo and t.idtorneo =  ".$idtorneo." 
			        
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
			        join copia_dbtorneoge tge
			        on tge.idtorneoge = fi.reftorneoge_b
			
			        inner 
			        join copia_dbgruposequipos ge
			        on ge.idgrupoequipo = tge.refgrupoequipo and ge.reftorneo = ".$idtorneo."
			
			        inner 
			        join dbtorneos t
			        on tge.reftorneo = t.idtorneo and t.idtorneo =  ".$idtorneo." 
			        
			        inner 
			        join dbgrupos g
			        on g.idgrupo = ge.refgrupo
			
			where g.idgrupo=".$idgrupo." and f.tipofecha = '".trim($fecha)."'";
			return $this-> query($sql,0);
			//return $sql;
			
	}
	

function TraerFechasJugadasCopia($idtorneo) {
		$sql = "SELECT
				f.reffecha,
				t.nombre,
				fe.tipofecha
				FROM
				dbfixture f
				Inner Join copia_dbtorneoge tge ON tge.idtorneoge = f.reftorneoge_a
				Inner Join dbtorneos t ON t.idtorneo = tge.reftorneo
				inner join tbfechas fe on fe.idfecha = f.reffecha
				WHERE
				t.idtorneo =  ".$idtorneo." AND (f.resultado_a <>  '' or f.resultado_b <>  '')
				GROUP BY
				f.reffecha,
				t.nombre,
				fe.tipofecha";
		return $this-> query($sql,0);
	}


	function TraerIdGoleadores($grupo,$idtorneo) {
		$sql = "select * from bcktbgoleadores where grupo = '".$grupo."' and reftorneo = ".$idtorneo." order by goles desc";
		return $this-> query($sql,0);
		//return $sql;
	}


	function TraerIdGoleadoresMax($grupo,$idtorneo) {
		$sql = "select * from bcktbgoleadores where grupo = '".$grupo."' and reftorneo = ".$idtorneo." order by goles desc limit 1";
		return $this-> query($sql,0);
		//return $sql;
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