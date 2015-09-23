<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Generador de Fixture</title>
</head>

<body>
<?php
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


function traerEquipoMenosId($id,$horario) {
	if ($id == '0') {
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
			order by g.nombre , h.horario , tp.valor desc , tge.prioridad desc

				";


	} else {
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
			where tge.refequipo not in (".$id.")
			order by g.nombre , h.horario , tp.valor desc , tge.prioridad desc

				";
	}
	
	$res3 = query($sql,0);
	if (mysql_num_rows($res)>0) {
		return mysql_result($res3,0,'refequipo');
	}
	return 0;
}



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


function traerEquipos($limit) {

		$sql		=	"
			select 
				tge.refGrupo,
				tge.IdTorneoGE,
				tge.refequipo,
				tge.prioridad
			from
				dbtorneoge tge
			where tge.refequipo in (".$limit.")
			order by tge.prioridad desc
			
				";

	
	$res2 = query($sql,0);

	return $res2;
}

$canchasR = array("Cancha 1","Cancha 2","Cancha 3","Cancha 4","Cancha 5");

$fixture = array
  (
  array("Cancha 1","12:00:00",0,0),
  array("Cancha 1","13:30:00",0,0),
  array("Cancha 1","15:00:00",0,0),
  array("Cancha 1","16:30:00",0,0),
  
  array("Cancha 2","12:00:00",0,0),
  array("Cancha 2","13:30:00",0,0),
  array("Cancha 2","15:00:00",0,0),
  array("Cancha 2","16:30:00",0,0),
  
  array("Cancha 3","12:00:00",0,0),
  array("Cancha 3","13:30:00",0,0),
  array("Cancha 3","15:00:00",0,0),
  array("Cancha 3","16:30:00",0,0),
  
  
  array("Cancha 4","12:00:00",0,0),
  array("Cancha 4","13:30:00",0,0),
  array("Cancha 4","15:00:00",0,0),
  array("Cancha 4","16:30:00",0,0),
  
  array("Cancha 5","12:00:00",0,0),
  array("Cancha 5","13:30:00",0,0),
  array("Cancha 5","15:00:00",0,0),
  array("Cancha 5","16:30:00",0,0),
  
  array("Cancha 6","12:00:00",0,0),
  array("Cancha 6","13:30:00",0,0),
  array("Cancha 6","15:00:00",0,0),
  array("Cancha 6","16:30:00",0,0),
  
  array("Cancha 7","12:00:00",0,0),
  array("Cancha 7","13:30:00",0,0),
  array("Cancha 7","15:00:00",0,0),
  array("Cancha 7","16:30:00",0,0),
  
  array("Cancha 8","12:00:00",0,0),
  array("Cancha 8","13:30:00",0,0),
  array("Cancha 8","15:00:00",0,0),
  array("Cancha 8","16:30:00",0,0)
  );

$cadEquiposCargados = '0';


function buscardisponibilidad($horario,$equipo,&$fixture,$cancha) {
	$valor = 0;
	
	switch ($cancha) {
		case 'Cancha 1':
			for ($i=0;$i<4;$i++) {
				
				if ($fixture[$i][1] == $horario) {
					if ($fixture[$i][2] == 0) {
						$fixture[$i][2] = $equipo;
						return 1;
						
					}
					
					if ($fixture[$i][3] == 0) {
						$fixture[$i][3] = $equipo;
						return 2;
					}
						
					
				} 
			}
		break;
		case 'Cancha 2':
			for ($i=4;$i<8;$i++) {
				
					if ($fixture[$i][1] == $horario) {
						if ($fixture[$i][2] == 0) {
							$fixture[$i][2] = $equipo;
							return 1;
							
						}
						
						if ($fixture[$i][3] == 0) {
							$fixture[$i][3] = $equipo;
							return 2;
						}
						
					
				} 
			}
		break;
		
		case 'Cancha 3':
			for ($i=8;$i<12;$i++) {
				
					if ($fixture[$i][1] == $horario) {
						if ($fixture[$i][2] == 0) {
							$fixture[$i][2] = $equipo;
							return 1;
							
						}
						
						if ($fixture[$i][3] == 0) {
							$fixture[$i][3] = $equipo;
							return 2;
						}
						
					
				} 
			}
		break;
		
		case 'Cancha 4':
			for ($i=12;$i<16;$i++) {
				
					if ($fixture[$i][1] == $horario) {
						if ($fixture[$i][2] == 0) {
							$fixture[$i][2] = $equipo;
							return 1;
							
						}
						
						if ($fixture[$i][3] == 0) {
							$fixture[$i][3] = $equipo;
							return 2;
						}
						
					
				} 
			}
		break;
		
		case 'Cancha 5':
			for ($i=16;$i<20;$i++) {
				
					if ($fixture[$i][1] == $horario) {
						if ($fixture[$i][2] == 0) {
							$fixture[$i][2] = $equipo;
							return 1;
							
						}
						
						if ($fixture[$i][3] == 0) {
							$fixture[$i][3] = $equipo;
							return 2;
						}
						
					
				} 
			}
		break;
		
		case 'Cancha 6':
			for ($i=20;$i<24;$i++) {
				
					if ($fixture[$i][1] == $horario) {
						if ($fixture[$i][2] == 0) {
							$fixture[$i][2] = $equipo;
							return 1;
							
						}
						
						if ($fixture[$i][3] == 0) {
							$fixture[$i][3] = $equipo;
							return 2;
						}
						
					
				} 
			}
		break;
		
		case 'Cancha 7':
			for ($i=24;$i<28;$i++) {
				
					if ($fixture[$i][1] == $horario) {
						if ($fixture[$i][2] == 0) {
							$fixture[$i][2] = $equipo;
							return 1;
							
						}
						
						if ($fixture[$i][3] == 0) {
							$fixture[$i][3] = $equipo;
							return 2;
						}
						
					
				} 
			}
		break;
		
		case 'Cancha 8':
			for ($i=28;$i<32;$i++) {
				
					if ($fixture[$i][1] == $horario) {
						if ($fixture[$i][2] == 0) {
							$fixture[$i][2] = $equipo;
							return 1;
							
						}
						
						if ($fixture[$i][3] == 0) {
							$fixture[$i][3] = $equipo;
							return 2;
						}
						
					
				} 
			}
		break;
	}
	return $valor;
}



$tabla = '<table class="table table-striped table-responsive">';
$i = 10;
$limit = "59,56,55,53,44,41,52,49,50,48";
$resPrincipa = traerEquipos($limit);

$limitnuevo = $limit;

function Itracion($resPrincipal,&$i,&$fixture,$cancha,&$limitnuevo) {
	echo $cancha."<br>";
	$limitnuevo = "";
	while ($row = mysql_fetch_array($resPrincipal)) {
		
		$resHE = traerEquipoPorId($row['refequipo']);
		
		
		$j = 0;
		while ($rowHE = mysql_fetch_assoc($resHE)) {
			$j = $j + 1;
			if (buscardisponibilidad($rowHE['horario'],$row['refequipo'],$fixture,$cancha) > 0) {
				$i=$i-1;
				break;
			} 
			if ($j == 4) {
				$limitnuevo = $limitnuevo.$row['refequipo'].",";
				break;	
			}
		}
		
		mysql_free_result($resHE);
		
	}
	//return array(0=>$i,1=>$fixture);
}


for ($k=0;$k<5;$k++) {
	if ($i > 0) {
		$resPrincipa2 = traerEquipos($limitnuevo);
		Itracion($resPrincipa2,$i,$fixture,$canchasR[$k],$limitnuevo);
		$limitnuevo = substr($limitnuevo,0,strlen($limitnuevo)-1);
		echo 'Entro en el Nuevo Iteracion: '.$i.' <br>';
		echo $limitnuevo."<br>";
		
		mysql_free_result($resPrincipa2);
	}
}


/*
if ($i > 0) {
	$cancha = "Cancha 2";
	$limitnuevo = substr($limitnuevo,0,strlen($limitnuevo)-1);
	echo 'Entro en el Nuevo Iteracion: '.$i.' <br>';
	echo $limitnuevo."<br>";
	$resPrincipa2 = traerEquipos($limitnuevo);
	
	Itracion($resPrincipa2,$i,$fixture,$cancha,$limitnuevo);	
}


$tabla = $tabla."</table>";

echo var_dump($fixture);
*/
//buscardisponibilidad('12:00:00',53,$fixture);

echo var_dump($fixture);
echo $i;
?>
</body>
</html>