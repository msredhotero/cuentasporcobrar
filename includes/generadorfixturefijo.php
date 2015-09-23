
<?php

date_default_timezone_set('America/Buenos_Aires');

class GenerarFixture {

function traerEquipoPorId($id) {

		$sql		=	"
			select 
				tge.refGrupo,
				g.nombre,
				tge.IdTorneoGE,
				tge.refequipo,
				e.Nombre,
				h.horario,
				tge.prioridad,
				tp.valor
			from
				dbtorneoge tge
					inner join
				dbturnosequiposprioridad tp ON tge.IdTorneoGE = tp.reftorneoge
					inner join
				dbequipos e ON e.IdEquipo = tge.refequipo
					inner join
				dbgrupos g ON g.IdGrupo = tge.refgrupo
					inner join
				tbhorarios h ON h.idhorario = tp.refturno
			where tge.refequipo = ".$id."
			order by g.nombre  , tp.valor desc , tge.prioridad desc

				";

	
	$res = query($sql,0);
	if (mysql_num_rows($res)>0) {
		return $res;
	}
	return 0;
}


function traerEquipos($idtorneo, $idZona) {

		$sql		=	"
			select 
				concat(g.nombre,' - ', e.nombre)as nombreEquipo,tge.idtorneoge, g.nombre, e.nombre, t.nombre, tge.prioridad
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
					
					where	t.idtorneo = ".$idtorneo." and tge.refgrupo = ".$idZona." and t.activo = 1
					
			
				";

	
	$res2 = $this->query($sql,0);

	return $res2;
}

function devolverCantFilas($idtorneo, $idZona) {
	$equipo = $this->traerEquipos($idtorneo, $idZona);
	
	$cadFixture = '';
	$arEquipos = array();
	$arEquiposId = array();
	
	if ((mysql_num_rows($equipo)%2) == 1) {
		$cantidadEquipos = mysql_num_rows($equipo)+1;
		for ($p=0;$p<mysql_num_rows($equipo);$p++) {
			$arEquipos[$p] = mysql_result($equipo,$p,0);
			$arEquiposId[$p] = mysql_result($equipo,$p,1);
		}
		$arEquipos[$cantidadEquipos-1] = "borrar";
		$arEquiposId[$cantidadEquipos-1] = 0;
	} else {
		$cantidadEquipos = mysql_num_rows($equipo);
		for ($p=0;$p<mysql_num_rows($equipo);$p++) {
			$arEquipos[$p] = mysql_result($equipo,$p,0);
			$arEquiposId[$p] = mysql_result($equipo,$p,1);
		}
	}
	
	//var_dump($arEquipos);
	
	
	
	$columnas	= $cantidadEquipos - 1;
	$filas		= $cantidadEquipos / 2;
	
	return array("columnas"=>$columnas,"filas"=> $filas);
}



function TraerTodoFixture($idtorneo, $idZona) {
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
							
							where	t.idtorneo = ".$idtorneo." and tge.refgrupo = ".$idZona."
							
					 order by g.nombre,f.tipofecha,fi.hora";
		 return $this-> query($sql,0);
	}

function Generar($idtorneo, $idZona) {
	$equipo = $this->traerEquipos($idtorneo, $idZona);

	$res = $this->TraerTodoFixture($idtorneo,$idZona);

$cadFixture = '';
$arEquipos = array();
$arEquiposId = array();

if ((mysql_num_rows($equipo)%2) == 1) {
	$cantidadEquipos = mysql_num_rows($equipo)+1;
	for ($p=0;$p<mysql_num_rows($equipo);$p++) {
		$arEquipos[$p] = mysql_result($equipo,$p,0);
		$arEquiposId[$p] = mysql_result($equipo,$p,1);
	}
	$arEquipos[$cantidadEquipos-1] = "borrar";
	$arEquiposId[$cantidadEquipos-1] = 0;
} else {
	$cantidadEquipos = mysql_num_rows($equipo);
	for ($p=0;$p<mysql_num_rows($equipo);$p++) {
		$arEquipos[$p] = mysql_result($equipo,$p,0);
		$arEquiposId[$p] = mysql_result($equipo,$p,1);
	}
}

//var_dump($arEquipos);



$columnas	= $cantidadEquipos - 1;
$filas		= $cantidadEquipos / 2;

$fixture = array();

$fixtureNum = array();

if (mysql_num_rows($res)<1) {

$k = $cantidadEquipos;
$m = 2;

for ($i=1;$i<=$filas;$i++) {
	$m = $i + 1;

	if ($i >2) {
		$k = $k - 1;
	}

	for ($j=1;$j<=$columnas;$j++) {
		
		if (($i == 1) && ($j == 1)) {
			$fixture[$i-1][$j-1] = $arEquipos[0]."***".$arEquipos[1]."***".$arEquiposId[0]."***".$arEquiposId[1];
			$fixtureNum[$i-1][$j-1] = "1***2";

		} else {
			if ($i == 1) {

				$fixture[$i-1][$j-1] = $arEquipos[0]."***".$arEquipos[$cantidadEquipos+1-$j]."***".$arEquiposId[0]."***".$arEquiposId[$cantidadEquipos+1-$j];
					
			} else {

				$fixture[$i-1][$j-1] = $arEquipos[$k-1]."***".$arEquipos[$m-1]."***".$arEquiposId[$k-1]."***".$arEquiposId[$m-1];
				$fixtureNum[$i-1][$j-1] = ($k)."***".($m);
				$k = $k - 1;
				
					
				if ($k < 2) {
					$k = $cantidadEquipos;	
				}
				
				$m = $m - 1;

				if ($m < 2) {
					$m = $cantidadEquipos;	
				}
				
				
			}
		}
		
		
	}	
}

}

return $fixture;

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


}
?>
</body>
</html>