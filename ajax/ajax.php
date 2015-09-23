<?php

include ('../includes/funcionesUsuarios.php');
include ('../includes/funciones.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funcionesJugadores.php');
include ('../includes/funcionesEquipos.php');
include ('../includes/funcionesGrupos.php');
include ('../includes/funcionesZonasEquipos.php');
include ('../includes/funcionesNoticias.php');
include ('../includes/funcionesDATOS.php');
include ('../includes/funcionesPlayoff.php');

$serviciosUsuarios  = new ServiciosUsuarios();
$serviciosFunciones = new Servicios();
$serviciosHTML		= new ServiciosHTML();
$serviciosJugadores = new ServiciosJ();
$serviciosEquipos	= new ServiciosE();
$serviciosGrupos	= new ServiciosG();
$serviciosZonasEquipos	= new ServiciosZonasEquipos();
$serviciosNoticias = new ServiciosNoticias();
$serviciosDatos = new ServiciosDatos();
$serviciosPlayOff = new ServiciosPlayOff();

$accion = $_POST['accion'];


switch ($accion) {
    case 'login':
        enviarMail($serviciosUsuarios);
        break;
	case 'entrar':
		entrar($serviciosUsuarios);
		break;
	case 'insertarUsuario':
        insertarUsuario($serviciosUsuarios);
        break;
	case 'modificarUsuario':
        modificarUsuario($serviciosUsuarios);
        break;
	case 'registrar':
		registrar($serviciosUsuarios);
        break;
		

	case 'modificarCliente':
		modificarCliente($serviciosUsuarios);
		break;

/* PARA PlayOff */
case 'insertarPlayOff':
insertarPlayOff($serviciosPlayOff);
break;
case 'modificarPlayOff':
modificarPlayOff($serviciosPlayOff);
break;
case 'eliminarPlayOff':
eliminarPlayOff($serviciosPlayOff);
break;

/* Fin */

/* PARA Sedes */
case 'insertarSedes':
insertarSedes($serviciosFunciones);
break;
case 'modificarSedes':
modificarSedes($serviciosFunciones);
break;
case 'eliminarSedes':
eliminarSedes($serviciosFunciones);
break;

/* Fin */
/* PARA Horarios */
case 'insertarHorarios':
insertarHorarios($serviciosFunciones);
break;
case 'modificarHorarios':
modificarHorarios($serviciosFunciones);
break;
case 'eliminarHorarios':
eliminarHorarios($serviciosFunciones);
break;

/* Fin */
/* PARA Canchas */
case 'insertarCanchas':
insertarCanchas($serviciosFunciones);
break;
case 'modificarCanchas':
modificarCanchas($serviciosFunciones);
break;
case 'eliminarCanchas':
eliminarCanchas($serviciosFunciones);
break;

/* Fin */

	/* para los torneos */
	case 'insertarTorneo':
		insertarTorneo($serviciosFunciones);
		break;
	case 'modificarTorneo':
		modificarTorneo($serviciosFunciones);
		break;
	case 'eliminarTorneo':
		eliminarTorneo($serviciosFunciones);
		break;
	case 'traerTorneoPorTipoTorneo':
		traerTorneoPorTipoTorneo($serviciosFunciones);
		break;
	case 'cambiarTorneo':
		cambiarTorneo($serviciosFunciones);
		break;
	case 'traerZonaPorTorneos':
		traerZonaPorTorneos($serviciosFunciones);
		break;
		
	/* fin torneos */
	
	/* para los equipos */
	case 'insertarEquipos':
		insertarEquipos($serviciosEquipos);
		break;
	case 'modificarEquipos':
		modificarEquipos($serviciosEquipos);
		break;
	case 'eliminarEquipos':
		eliminarEquipos($serviciosEquipos);
		break; 
		
	case 'insertarConducta':
		insertarConducta($serviciosFunciones);
		break;
	case 'modificarConducta':
		modificarConducta($serviciosFunciones);
		break;
	case 'eliminarConducta':
		eliminarConducta($serviciosFunciones);
		break; 
	/* fin equipos */
	
	
	/* para los jugadores */
	case 'buscarJugadores':
		buscarJugadores($serviciosJugadores);
		break;
	case 'insertarJugadores':
		insertarJugadores($serviciosJugadores);
		break;
	case 'modificarJugadores':
		modificarJugadores($serviciosJugadores);
		break;
	case 'modificarJugadoresEx':
		modificarJugadoresEx($serviciosJugadores);
		break;
	case 'eliminarJugadores':
		eliminarJugadores($serviciosJugadores);
		break;
	case 'traerJugadores':
		traerJugadores($serviciosJugadores);
		break;
		
	case 'insertarGoleadores':
		insertarGoleadores($serviciosJugadores);
		break;
	case 'modificarGoleadores':
		modificarGoleadores($serviciosJugadores);
		break;
	case 'eliminarGoleadores':
		eliminarGoleadores($serviciosJugadores);
		break; 
	
	case 'insertarAmonestados':
		insertarAmonestados($serviciosJugadores);
		break;
	case 'modificarAmonestados':
		modificarAmonestados($serviciosJugadores);
		break;
	case 'eliminarAmonestados':
		eliminarAmonestados($serviciosJugadores);
		break; 
	case 'insertarEstadistica':
		insertarEstadistica($serviciosJugadores);
		break;
	
	case 'insertarSuspendidos':
		insertarSuspendidos($serviciosJugadores,$serviciosFunciones);
		break;
	case 'modificarSuspendidos':
		modificarSuspendidos($serviciosJugadores,$serviciosFunciones);
		break;
	case 'eliminarSuspendidos':
		eliminarSuspendidos($serviciosJugadores);
		break; 
	/* fin jugadores */
	
	
	/* para los zonas */
	
	case 'insertarGrupo':
		insertarGrupo($serviciosGrupos);
		break;
	case 'modificarGrupos':
		modificarGrupos($serviciosGrupos);
		break;
	case 'eliminarGrupos':
		eliminarGrupos($serviciosGrupos);
		break; 
	/* fin zonas */
	
	
	/* para los torneo-zonas-equipos */
	case 'insertarZonasEquipos':
		insertarZonasEquipos($serviciosZonasEquipos);
		break;
	case 'modificarZonasEquipos':
		modificarZonasEquipos($serviciosZonasEquipos);
		break;
	case 'eliminarZonasEquipos':
		eliminarZonasEquipos($serviciosZonasEquipos);
		break; 
	case 'TraerZonaPorTorneoEquipo':
		TraerZonaPorTorneoEquipo($serviciosZonasEquipos,$serviciosDatos);
		break;
	case 'reemplazarEquipos':
		reemplazarEquipos($serviciosZonasEquipos);
		break;
	case 'chequearPorFecha':
		chequearPorFecha($serviciosZonasEquipos);
		break;
	case 'cargarTablaConducta':
		cargarTablaConducta($serviciosZonasEquipos);
		break;
	case 'calcularTablaConducta':
		calcularTablaConducta($serviciosZonasEquipos);
		break;
	/* PARA Reemplazos */
	case 'insertarReemplazos':
		insertarReemplazos($serviciosZonasEquipos);
		break;
	case 'modificarReemplazos':
		modificarReemplazos($serviciosZonasEquipos);
		break;
	case 'eliminarReemplazos':
		eliminarReemplazos($serviciosZonasEquipos);
		break;
	/* Fin */

	/* fin torneo-zonas-equipos */
	
	
	/* para los fixture */
	case 'insertarFixture':
		insertarFixture($serviciosZonasEquipos);
		break;
	case 'modificarFixture':
		modificarFixture($serviciosZonasEquipos);
		break;
	case 'eliminarFixture':
		eliminarFixture($serviciosZonasEquipos);
		break; 
	case 'traerFixturePorEquipo':
		traerFixturePorEquipo($serviciosZonasEquipos);
		break;
	/* fin fixture */
	
	/* para los noticias */
	case 'insertarNoticiasPrincipales':
		insertarNoticiasPrincipales($serviciosNoticias);
		break;
	case 'modificarNoticiasPrincipales':
		modificarNoticiasPrincipales($serviciosNoticias);
		break;
	case 'eliminarNoticiasPrincipales':
		eliminarNoticiasPrincipales($serviciosNoticias);
		break; 
	
	case 'insertarNoticiasPredio':
		insertarNoticiasPredio($serviciosNoticias);
		break;
	case 'modificarNoticiasPredio':
		modificarNoticiasPredio($serviciosNoticias);
		break;
	case 'eliminarNoticiasPredio':
		eliminarNoticiasPredio($serviciosNoticias);
		break; 
			
	case 'insertarNoticias':
		insertarNoticias($serviciosNoticias);
		break;
	case 'modificarNoticias':
		modificarNoticias($serviciosNoticias);
		break;
	case 'eliminarNoticias':
		eliminarNoticias($serviciosNoticias);
		break; 
	case 'eliminarFoto':
		eliminarFoto($serviciosNoticias);
		break;
	/* fin noticias */
	
	/* Reportes */
	case 'traerResultadosPorTorneoZonaFecha':
		traerResultadosPorTorneoZonaFecha($serviciosDatos);
		break;
	case 'traerResultadosPorTorneoZonaFechaPagina':
		traerResultadosPorTorneoZonaFechaPagina($serviciosDatos);
		break;
	case 'TraerFixturePorZonaTorneo':
		TraerFixturePorZonaTorneo($serviciosDatos);
		break;
	case 'Goleadores':
		Goleadores($serviciosDatos);
		break;
	case 'GoleadoresPagina':
		GoleadoresPagina($serviciosDatos);
		break;
	case 'Suspendidos':
		Suspendidos($serviciosDatos);
		break;
	case 'SuspendidosPagina':
		SuspendidosPagina($serviciosDatos);
		break;
	case 'FixturePagina':
		FixturePagina($serviciosDatos);
		break;
	case 'FixturePaginaChico':
		FixturePaginaChico($serviciosDatos);
		break;
	case 'FixturePaginaChicoDos':
		FixturePaginaChicoDos($serviciosDatos);
		break;
		
	case 'TraerJugadoresFixtureA':
		TraerJugadoresFixtureA($serviciosDatos);
		break;
	case 'TraerJugadoresFixtureB':
		TraerJugadoresFixtureB($serviciosDatos);
		break;
	case 'TraerFixturePorZonaTorneoPagina';
		TraerFixturePorZonaTorneoPagina($serviciosDatos);
		break;
	case 'AmarillasAcumuladasPagina';
		AmarillasAcumuladasPagina($serviciosDatos);
		break;
	case 'AmarillasAcumuladas';
		AmarillasAcumuladas($serviciosDatos);
		break;
	case 'FairPlay';
		FairPlay($serviciosDatos);
		break;
	case 'FairPlayPagina';
		FairPlayPagina($serviciosDatos);
		break;
	/* Fin reportes */
}

//////////////////////////Traer datos */

function toArray($query)
{
    $res = array();
    while ($row = @mysql_fetch_array($query)) {
        $res[] = $row;
    }
    return $res;
}


/* PARA PlayOff */
function insertarPlayOff($serviciosPlayOff) {
$refequipo = $_POST['refequipo'];
$reftorneo = $_POST['reftorneo'];
$refzona = $_POST['refzona'];
$fechacreacion = $_POST['fechacreacion'];
$res = $serviciosPlayOff->insertarPlayOff($refequipo,$reftorneo,$refzona,$fechacreacion);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarPlayOff($serviciosPlayOff) {
$id = $_POST['id'];
$refequipo = $_POST['refequipo'];
$reftorneo = $_POST['reftorneo'];
$refzona = $_POST['refzona'];
$fechacreacion = $_POST['fechacreacion'];
$res = $serviciosPlayOff->modificarPlayOff($id,$refequipo,$reftorneo,$refzona,$fechacreacion);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarPlayOff($serviciosPlayOff) {
$id = $_POST['id'];
$res = $serviciosPlayOff->eliminarPlayOff($id);
echo $res;
}

/* Fin */ 

/* PARA Canchas */
function insertarCanchas($serviciosCanchas) {
$cancha = $_POST['cancha'];
$res = $serviciosCanchas->insertarCanchas($cancha);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarCanchas($serviciosCanchas) {
$id = $_POST['id'];
$cancha = $_POST['cancha'];
$res = $serviciosCanchas->modificarCanchas($id,$cancha);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarCanchas($serviciosCanchas) {
$id = $_POST['id'];
$res = $serviciosCanchas->eliminarCanchas($id);
echo $res;
}

/* Fin */ 

/* PARA Horarios */
function insertarHorarios($serviciosHorarios) {
$horario = $_POST['horario'];
$reftipotorneo = $_POST['reftipotorneo'];
$res = $serviciosHorarios->insertarHorarios($horario,$reftipotorneo);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarHorarios($serviciosHorarios) {
$id = $_POST['id'];
$horario = $_POST['horario'];
$reftipotorneo = $_POST['reftipotorneo'];
$res = $serviciosHorarios->modificarHorarios($id,$horario,$reftipotorneo);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarHorarios($serviciosHorarios) {
$id = $_POST['id'];
$res = $serviciosHorarios->eliminarHorarios($id);
echo $res;
}

/* Fin */ 


/* PARA Sedes */
function insertarSedes($serviciosSedes) {
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$res = $serviciosSedes->insertarSedes($nombre,$direccion);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarSedes($serviciosSedes) {
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$res = $serviciosSedes->modificarSedes($id,$nombre,$direccion);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarSedes($serviciosSedes) {
$id = $_POST['id'];
$res = $serviciosSedes->eliminarSedes($id);
echo $res;
}

/* Fin */ 


/* Reportes */
function traerResultadosPorTorneoZonaFecha($serviciosDatos) {
	$idtorneo	= $_POST['reftorneo'];
	$idzona		= $_POST['refzona'];
	$idfecha	= $_POST['reffecha'];
	$zona		= $_POST['zona'];
	
	$res = $serviciosDatos->traerResultadosPorTorneoZonaFecha($idtorneo,$idzona,$idfecha);
	
	$cad = '<div class="row">
                	<table cellpadding="0" cellspacing="0" border="2" bordercolor="#FF0000" style="width:750px; margin-left:20px; font-weight:bold;">
                    	<tr bgcolor="#bfbfbf">
                        	<td colspan="5" align="center" style="font-size:1.9em;">RESULTADOS '.$zona.'</td>
                        </tr>';
                        while ($row = mysql_fetch_array($res)) {
                        	$cad = $cad.'<tr style="font-size:1.5em;">
                        	<td align="center" bgcolor="#bfbfbf" width="40px" style="padding:1px 6px;">'.$row['resultadoa'].'</td>
                            <td align="center" style="padding:1px 6px;">'.(substr(utf8_encode($row['equipo1']),0,17)).'</td>
                            <td align="center" style="padding:1px 6px;" bgcolor="#bfbfbf">Horario '.$row['hora'].'</td>
                            <td align="center" style="padding:1px 6px;">'.(substr(utf8_encode($row['equipo2']),0,17)).'</td>
                            <td align="center" style="padding:1px 6px;" bgcolor="#bfbfbf" width="40px">'.$row['resultadob'].'</td>
                        </tr>';
                    	}
                    $cad = $cad.'</table>
                
                </div>';
	echo $cad;
}

/* Reportes */
function traerResultadosPorTorneoZonaFechaPagina($serviciosDatos) {
	$idtorneo	= $_POST['reftorneo'];
	$idzona		= $_POST['refzona'];
	$idfecha	= $_POST['reffecha'];
	$zona		= $_POST['zona'];
	
	$res = $serviciosDatos->traerResultadosPorTorneoZonaFecha($idtorneo,$idzona,$idfecha);
	
	$cad = '';
                        while ($row = mysql_fetch_array($res)) {
                        	$cad = $cad.'<tr>
                        	<td align="center">'.$row['resultadoa'].'</td>
                            <td align="center">'.(substr(utf8_encode($row['equipo1']),0,17)).'</td>
                            <td align="center">'.$row['hora'].'</td>
                            <td align="center">'.(substr(utf8_encode($row['equipo2']),0,17)).'</td>
                            <td align="center">'.$row['resultadob'].'</td>
                        </tr>';
                    	}

	echo $cad;
}



function TraerJugadoresFixtureA($serviciosDatos) {
	$idfixture	= $_POST['idfixture'];

	
	$res = $serviciosDatos->TraerJugadoresFixtureA($idfixture);
	
	$cad = '';
                        while ($row = mysql_fetch_array($res)) {
                        	$cad = $cad.'<tr>
							
                        	<td align="center">'.$row['RojasA'].'</td>
                            <td align="center">'.$row['amarillasA'].'</td>
                            <td align="center">'.$row['golesA'].'</td>
                            <td align="right" style="font-size:0.9em;">'.(substr(utf8_encode($row['apynA']),0,17)).'</td>
							<td></td>
                        </tr>';
                    	}

	echo $cad;
}


function TraerJugadoresFixtureB($serviciosDatos) {
	$idfixture	= $_POST['idfixture'];

	
	$res = $serviciosDatos->TraerJugadoresFixtureB($idfixture);
	
	$cad = '';
                        while ($row = mysql_fetch_array($res)) {
                        	$cad = $cad.'<tr>
							<td></td>
                            <td align="left" style="font-size:0.9em;">'.(substr(utf8_encode($row['apynB']),0,17)).'</td>
							<td align="center">'.$row['golesB'].'</td>
							<td align="center">'.$row['amarillasB'].'</td>
							<td align="center">'.$row['RojasB'].'</td>
							
                        </tr>';
                    	}

	echo $cad;
}


function FixturePagina($serviciosDatos) {
	$idtorneo	= $_POST['reftorneo'];
	$idzona		= $_POST['refzona'];
	$idfecha	= $_POST['reffecha'];
	$zona		= $_POST['zona'];
	$cad = '';
	
	for ($i=$idfecha;$i>=23;$i--) {
		$cad = $cad.'
				<div class="col-md-6">
				<div class="panel panel-predio" style="margin-top:20px;">
                                <div class="panel-heading">
                                	<h3 class="panel-title">'.mysql_result($serviciosDatos->TraerFechaPorId($i),0,1).'</h3>
                                	<img src="imagenes/logo2-chico.png" style="float:right;margin-top:-21px; width:26px; height:24px;">
                                </div>
                                <div class="panel-body-predio">
                                	';
									
		$res = $serviciosDatos->traerResultadosPorTorneoZonaFecha($idtorneo,$idzona,$i);
		
		$cad = $cad.'<table class="table table-responsive table-striped" style="font-size:0.8em; padding:2px;">
                                	
                                	<thead>
                                    	<tr>
                                        	<th style="text-align:center">Result. A</th>
                                            <th style="text-align:center">Equipo A</th>
                                            <th style="text-align:center">Horario</th>
                                            <th style="text-align:center">Equipo B</th>
                                            <th style="text-align:center">Result. B</th>
                                            <th style="text-align:center">Ver</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
	
                        while ($row = mysql_fetch_array($res)) {
                        	$cad = $cad.'<tr>
                        	<td align="center" id="resA'.$row['idfixture'].'">'.$row['resultadoa'].'</td>
                            <td align="center" id="equipoA'.$row['idfixture'].'">'.(substr(utf8_encode($row['equipo1']),0,17)).'</td>
                            <td align="center">'.$row['hora'].'</td>
                            <td align="center" id="equipoB'.$row['idfixture'].'">'.(substr(utf8_encode($row['equipo2']),0,17)).'</td>
                            <td align="center" id="resB'.$row['idfixture'].'">'.$row['resultadob'].'</td>
							<td><img src="imagenes/verIco2.png" style="cursor:pointer;" id="'.$row['idfixture'].'" class="varModificar" data-target="#dialogModificar" data-toggle="modal"></td>
                        </tr>';
                    	}
													
        $cad = $cad.'</tbody>
                                </table></div>
                            </div>
						</div>';	
		
		
	}


	echo $cad;
}


function FixturePaginaChico($serviciosDatos) {
	$idtorneo	= $_POST['reftorneo'];
	$idzona		= $_POST['refzona'];
	$idfecha	= $_POST['reffecha'];
	$zona		= $_POST['zona'];
	$cad = '';
	
	for ($i=$idfecha;$i>=23;$i--) {
		$cad = $cad.'
				<div class="col-md-12">
				<div class="panel panel-predio" style="margin-top:0;">
                                <div class="panel-heading">
                                	<h3 class="panel-title">'.mysql_result($serviciosDatos->TraerFechaPorId($i),0,1).'</h3>
                                	<img src="imagenes/logo2-chico.png" style="float:right; margin-top:-21px; width:26px; height:24px;">
                                </div>
                                <div class="panel-body-predio">
                                	';
									
		$res = $serviciosDatos->traerResultadosPorTorneoZonaFecha($idtorneo,$idzona,$i);
		
		$cad = $cad.'<table class="table table-responsive table-striped" style="font-size:0.8em; padding:2px;">
                                	
                                	<thead>
                                    	<tr>
                                        	<th style="text-align:center;padding:3px;">Result. A</th>
                                            <th style="text-align:center;padding:3px;">Equipo A</th>
                                            <th style="text-align:center;padding:3px;">Horario</th>
                                            <th style="text-align:center;padding:3px;">Equipo B</th>
                                            <th style="text-align:center;padding:3px;">Result. B</th>
                                            <th style="text-align:center;padding:3px;">Ver</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
	
                        while ($row = mysql_fetch_array($res)) {
                        	$cad = $cad.'<tr>
                        	<td align="center" id="resA'.$row['idfixture'].'" style="padding:3px;">'.$row['resultadoa'].'</td>
                            <td align="center" id="equipoA'.$row['idfixture'].'" style="padding:3px;">'.(substr(utf8_encode($row['equipo1']),0,17)).'</td>
                            <td align="center" style="padding:3px;">'.$row['hora'].'</td>
                            <td align="center" id="equipoB'.$row['idfixture'].'" style="padding:3px;">'.(substr(utf8_encode($row['equipo2']),0,17)).'</td>
                            <td align="center" id="resB'.$row['idfixture'].'" style="padding:3px;">'.$row['resultadob'].'</td>
							<td style="padding:3px;"><img src="imagenes/verIco2.png" style="cursor:pointer;" id="'.$row['idfixture'].'" class="varModificar" data-target="#dialogModificar" data-toggle="modal"></td>
                        </tr>';
                    	}
													
        $cad = $cad.'</tbody>
                                </table></div>
                            </div>
						</div>';	
		
		
	}


	echo $cad;
}



function FixturePaginaChicoDos($serviciosDatos) {
	$idtorneo	= $_POST['reftorneo'];
	$idzona		= $_POST['refzona'];
	$idfecha	= $_POST['reffecha'];
	$zona		= $_POST['zona'];
	$cad = '';
	
	if ($idfecha == 23) {
		$menos = 0;	
	} else {
		$menos = 1;	
	}
	
	for ($i=$idfecha;$i>=$idfecha-$menos;$i--) {
		$cad = $cad.'
				<div class="col-md-12">
				<div class="panel panel-predio" style="margin-top:0;">
                                <div class="panel-heading">
                                	<h3 class="panel-title">'.mysql_result($serviciosDatos->TraerFechaPorId($i),0,1).'</h3>
                                	<img src="imagenes/logo2-chico.png" style="float:right; margin-top:-21px; width:26px; height:24px;">
                                </div>
                                <div class="panel-body-predio" style="padding-bottom:0px;">
                                	';
									
		$res = $serviciosDatos->traerResultadosPorTorneoZonaFecha($idtorneo,$idzona,$i);
		
		$cad = $cad.'<table class="table table-responsive table-striped" style="font-size:0.9em; padding:0 2px;">
                                	
                                	<thead>
                                    	<tr>
                                        	<th style="text-align:center;padding:3px;">Result. A</th>
                                            <th style="text-align:center;padding:3px;">Equipo A</th>
                                            <th style="text-align:center;padding:3px;">Horario</th>
                                            <th style="text-align:center;padding:3px;">Equipo B</th>
                                            <th style="text-align:center;padding:3px;">Result. B</th>
                                            <th style="text-align:center;padding:3px;">Ver</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
	
                        while ($row = mysql_fetch_array($res)) {
                        	$cad = $cad.'<tr>
                        	<td align="center" id="resA'.$row['idfixture'].'" style="padding:3px;">'.$row['resultadoa'].'</td>
                            <td align="center" id="equipoA'.$row['idfixture'].'" style="padding:3px;">'.(substr(utf8_encode($row['equipo1']),0,17)).'</td>
                            <td align="center" style="padding:3px;">'.$row['hora'].'</td>
                            <td align="center" id="equipoB'.$row['idfixture'].'" style="padding:3px;">'.(substr(utf8_encode($row['equipo2']),0,17)).'</td>
                            <td align="center" id="resB'.$row['idfixture'].'" style="padding:3px;">'.$row['resultadob'].'</td>
							<td style="padding:3px;"><img src="imagenes/verIco2.png" style="cursor:pointer;" id="'.$row['idfixture'].'" class="varModificar" data-target="#dialogModificar" data-toggle="modal"></td>
                        </tr>';
                    	}
													
        $cad = $cad.'</tbody>
                                </table></div>
                            </div>
						</div>';	
		
		
	}


	echo $cad;
}


function TraerFixturePorZonaTorneo($serviciosDatos) {
	
	$idtorneo	= $_POST['reftorneo'];
	$idzona		= $_POST['refzona'];
	$zona		= $_POST['zona'];
	$idfecha	= $_POST['reffecha'];
	$res2 = $serviciosDatos->TraerFixturePorZonaTorneo($idtorneo,$idzona,$idfecha);
	
	$cad2 = '
	<div class="row">
                	<table cellpadding="0" cellspacing="0" border="2" bordercolor="#FF0000" style="width:auto; margin-left:20px; font-weight:bold; margin-right:5px;">
                    	<tr bgcolor="#bfbfbf">
                        	<td colspan="11" align="center" style="font-size:1.9em;">RESULTADOS '.$zona.'</td>
                        </tr>
                        <tr style="font-size:1.5em;">
                        	<td align="center" style="padding:1px 6px;">POSICION</td>
                            <td align="center" style="padding:1px 6px;">EQUIPO</td>
                            <td align="center" style="padding:1px 6px;">PTS</td>
                            <td align="center" style="padding:1px 6px;">PJ</td>
                            <td align="center" style="padding:1px 6px;">PG</td>
                            <td align="center" style="padding:1px 6px;">PE</td>
                            <td align="center" style="padding:1px 6px;">PP</td>
                            <td align="center" style="padding:1px 6px;">GF</td>
                            <td align="center" style="padding:1px 6px;">GC</td>
                            <td align="center" style="padding:1px 6px;">DIF</td>
                            <td align="center" style="padding:1px 6px;">F.P.</td>
                        </tr>';

						$i =1;
						$puntos = 0;
						while ($row1 = mysql_fetch_array($res2)) {
						
							
							if (($row1['reemplzado'] == '0') || (($row1['reemplzado'] == '1') && ($row1['volvio'] == '1'))) {	
							$cad2 = $cad2.'<tr style="font-size:1.5em;">
								<td align="right" style="padding:1px 6px;">'.$i.'</td>
								<td align="left" style="padding:1px 6px;">'.utf8_encode($row1['nombre']).'</td>
								<td align="right" style="padding:1px 6px;">'.$row1['pts'].'</td>
								<td align="right" style="padding:1px 6px;">'.$row1['partidos'].'</td>
								<td align="right" style="padding:1px 6px;">'.$row1['ganados'].'</td>
								<td align="right" style="padding:1px 6px;">'.$row1['empatados'].'</td>
								<td align="right" style="padding:1px 6px;">'.$row1['perdidos'].'</td>
								<td align="right" style="padding:1px 6px;">'.$row1['golesafavor'].'</td>
								<td align="right" style="padding:1px 6px;">'.$row1['golesencontra'].'</td>
								<td align="right" style="padding:1px 6px;">'.$row1['diferencia'].'</td>
								<td align="right" style="padding:1px 6px;">'.$row1['puntos'].'</td>
							</tr>';
					
							$i = $i + 1;
							}
						}
                    $cad2 = $cad2.'</table>
                
                </div>';
	echo $cad2;
}





function TraerFixturePorZonaTorneoPagina($serviciosDatos) {
	
	$idtorneo	= $_POST['reftorneo'];
	$idzona		= $_POST['refzona'];
	$zona		= $_POST['zona'];
	$idfecha	= $_POST['reffecha'];
	
	$res2 = $serviciosDatos->TraerFixturePorZonaTorneo($idtorneo,$idzona,$idfecha);
	$cad2 = '';
	$cad2 = $cad2.'
				<div class="col-md-12">
				<div class="panel panel-predio">
                                <div class="panel-heading">
                                	<h3 class="panel-title">'.$zona.'</h3>
                                	<img src="imagenes/logo2-chico.png" style="float:right;margin-top:-21px; width:26px; height:24px;">
                                </div>
                                <div class="panel-body-predio" style="padding:5px 20px;">
                                	';
	$cad2 = $cad2.'
	<div class="row">
                	<table class="table table-responsive table-striped" style="font-size:1em; padding:0px;">

                        <thead>
							<tr>
								<th align="center">POS.</th>
								<th align="center">EQUIPO</th>
								<th align="center">PTS</th>
								<th align="center">PJ</th>
								<th align="center">PG</th>
								<th align="center">PE</th>
								<th align="center">PP</th>
								<th align="center">GF</th>
								<th align="center">GC</th>
								<th align="center">DIF</th>
								<th align="center">F.P.</th>
								<th align="center">% Goles</th>
								<th align="center">EFECT.</th>
								<th align="center"><img src="imagenes/icoRoja.png"></th>
                            	<th align="center"><img src="imagenes/icoAmarilla.png"></th>
							</tr>
						</thead>
						<tbody>';

						$i =1;
						$puntos = 0;
						while ($row1 = mysql_fetch_array($res2)) {
						
							
							if (($row1['reemplzado'] == '0') || (($row1['reemplzado'] == '1') && ($row1['volvio'] == '1'))) {
							$cad2 = $cad2.'
							<tr>
								<td align="center">'.$i.'</td>
								<td align="left"><a href="equipo.php?eq='.$row1['idequipo'].'">'.utf8_encode($row1['nombre']).'</a></td>
								<td align="center">'.$row1['pts'].'</td>
								<td align="center">'.$row1['partidos'].'</td>
								<td align="center">'.$row1['ganados'].'</td>
								<td align="center">'.$row1['empatados'].'</td>
								<td align="center">'.$row1['perdidos'].'</td>
								<td align="center">'.$row1['golesafavor'].'</td>
								<td align="center">'.$row1['golesencontra'].'</td>
								<td align="center">'.$row1['diferencia'].'</td>
								<td align="center">'.$row1['puntos'].'</td>
								<td align="center">'.$row1['porcentajegoles'].'%</td>
								<td align="center">'.$row1['efectividad'].'%</td>
								<td align="center">'.$row1['rojas'].'</td>
								<td align="center">'.$row1['amarillas'].'</td>
							</tr>';
					
							$i = $i + 1;
							}
						}
                    $cad2 = $cad2.'</tbody>
                                </table>
								</div>
								</div>
                            </div>
						</div>';
	echo $cad2;
}



function GoleadoresPagina($serviciosDatos) {
	$idtorneo	= $_POST['reftorneo'];
	$idzona		= $_POST['refzona'];
	$zona		= $_POST['zona'];
	$idfecha	= $_POST['reffecha'];
	
	$res3 = $serviciosDatos->Goleadores($idtorneo,$idzona,$idfecha);
	$cad3 = '';
	$cad3 = $cad3.'
				<div class="col-md-12">
				<div class="panel panel-predio">
                                <div class="panel-heading">
                                	<h3 class="panel-title">'.$zona.' - Goleadores</h3>
                                	<img src="imagenes/logo2-chico.png" style="float:right;margin-top:-21px; width:26px; height:24px;">
                                </div>
                                <div class="panel-body-predio" style="padding:5px 20px;">
                                	';
	$cad3 = $cad3.'
	<div class="row">
                	<table class="table table-responsive table-striped" style="font-size:0.9em; padding:2px;">
						<thead>
                        <tr>
                        	<th align="left">Nombre y Apellido</th>
                            <th align="left">Equipo</th>
                            <th align="center">Goles</th>
                        </tr>
						</thead>
						<tbody>';
                        
						$i =1;
						while ($row1 = mysql_fetch_array($res3)) {
						if (($row1['reemplzado'] == '0') || (($row1['reemplzado'] == '1') && ($row1['volvio'] == '1'))) {
                        $cad3 = $cad3.'<tr>
                            <td align="left" style="padding:1px;">'.strtoupper(utf8_encode($row1['apyn'])).'</td>
                            <td align="left" style="padding:1px;"><a href="equipo.php?eq='.$row1['refequipo'].'">'.utf8_encode($row1['nombre']).'</a></td>
                            <td align="center" style="padding:1px;">'.$row1['cantidad'].'</td>
 
                        </tr>';
         
						$i = $i + 1;
						}
						}
                    $cad3 = $cad3.'</tbody>
                                </table>
								</div>
								</div>
                            </div>
						</div>';
	echo $cad3;
}



function Goleadores($serviciosDatos) {
	$idtorneo	= $_POST['reftorneo'];
	$idzona		= $_POST['refzona'];
	$zona		= $_POST['zona'];
	$idfecha	= $_POST['reffecha'];
	
	$res3 = $serviciosDatos->Goleadores($idtorneo,$idzona,$idfecha);
	
	$cad3 = '
	<div class="row" style="margin-top:20px;">
                	<table cellpadding="0" cellspacing="0" border="2" bordercolor="#FF0000" style="width:auto; margin-left:20px; font-weight:bold; margin-right:20px;">
                    	<tr bgcolor="#bfbfbf">
                        	<td colspan="3" align="center" style="font-size:1.9em;">GOLEADORES '.$zona.'</td>
                        </tr>
                        <tr style="font-size:1.5em;">
                        	<td align="center" style="padding:1px 6px;">NOMBRE Y APELLIDO</td>
                            <td align="center" style="padding:1px 6px;">EQUIPO</td>
                            <td align="center" style="padding:1px 6px;">CANTIDAD</td>
                        </tr>';
                        
						$i =1;
						while ($row1 = mysql_fetch_array($res3)) {
						if (($row1['reemplzado'] == '0') || (($row1['reemplzado'] == '1') && ($row1['volvio'] == '1'))) {
                        $cad3 = $cad3.'<tr style="font-size:1.5em;">
                            <td align="left" style="padding:1px 6px;">'.strtoupper(utf8_encode($row1['apyn'])).'</td>
                            <td align="right" style="padding:1px 6px;">'.utf8_encode($row1['nombre']).'</td>
                            <td align="right" style="padding:1px 6px;">'.$row1['cantidad'].'</td>
 
                        </tr>';
         
						$i = $i + 1;
						}
						}
                    $cad3 = $cad3.'</table>
                
                </div>';
	echo $cad3;
}


function Suspendidos($serviciosDatos) {
	$idtorneo	= $_POST['reftorneo'];
	$idzona		= $_POST['refzona'];
	$idfecha	= $_POST['reffecha'];
	$zona		= $_POST['zona'];
	
	$res4 = $serviciosDatos->SuspendidosNuevo($idtorneo,$idzona,$idfecha);
	
	$res5 = $serviciosDatos->SuspendidosPorSiempre($idtorneo,$idzona,$idfecha);
	
	$cad4 = '
	<div class="row" style="margin-top:20px;">
                	<table cellpadding="0" cellspacing="0" border="2" bordercolor="#FF0000" style="width:auto; margin-left:20px; font-weight:bold; margin-right:20px;">
                    	<tr bgcolor="#bfbfbf">
                        	<td colspan="4" align="center" style="font-size:1.9em;">SUSPENDIDOS '.$zona.'</td>
                        </tr>
                        <tr style="font-size:1.5em;">
                        	<td align="center" style="padding:1px 6px;">NOMBRE Y APELLIDO</td>
                            <td align="center" style="padding:1px 6px;">EQUIPO</td>
                            <td align="center" style="padding:1px 6px;">MOTIVO</td>
							<td align="center" style="padding:1px 6px;">CANTIDAD</td>
                        </tr>';
                        
						$i =1;
						$restantes = 0;
						while ($row1 = mysql_fetch_array($res4)) {
							
							if (($row1['reemplzado'] == '0') || (($row1['reemplzado'] == '1') && ($row1['volvio'] == '1'))) {
							$restantes = $serviciosDatos->traerFechasRestantes($idfecha,$row1['refjugador'],$row1['refequipo'],$row1['refsuspendido']);
							//echo $restantes;
							$restantes = (integer)$row1['cantidad'] - (integer)$restantes;
							if ($restantes != 0) { 
								$cad4 = $cad4.'<tr style="font-size:1.5em;">
									<td align="left" style="padding:1px 6px;">'.strtoupper(utf8_encode($row1['apyn'])).'</td>
									<td align="right" style="padding:1px 6px;">'.utf8_encode($row1['nombre']).'</td>
									<td align="right" style="padding:1px 6px;">'.utf8_encode($row1['motivos']).'</td>
									<td align="right" style="padding:1px 6px;">'.$row1['cantidad'].'(Resta '.$restantes.')'.'</td>
								</tr>';
								
								$i = $i + 1;
							}
							}
						}
						
						
						while ($row2 = mysql_fetch_array($res5)) {


								$cad4 = $cad4.'<tr style="font-size:1.5em;">
									<td align="left" style="padding:1px 6px;">'.strtoupper(utf8_encode($row2['apyn'])).'</td>
									<td align="right" style="padding:1px 6px;">'.utf8_encode($row2['nombre']).'</td>
									<td align="right" style="padding:1px 6px;">'.utf8_encode($row2['motivos']).'</td>
									<td align="right" style="padding:1px 6px;">Todas</td>
								</tr>';
								
								$i = $i + 1;

						}
                    $cad4 = $cad4.'</table>
                
                </div>';
	echo $cad4;
}



function SuspendidosPagina($serviciosDatos) {
	$idtorneo	= $_POST['reftorneo'];
	$idzona		= $_POST['refzona'];
	$idfecha	= $_POST['reffecha'];
	$zona		= $_POST['zona'];
	
	$res4 = $serviciosDatos->SuspendidosNuevo($idtorneo,$idzona,$idfecha);
	
	$res5 = $serviciosDatos->SuspendidosPorSiempre($idtorneo,$idzona,$idfecha);
	$cad3 = '';
	$cad3 = $cad3.'
				<div class="col-md-12">
				<div class="panel panel-predio">
                                <div class="panel-heading">
                                	<h3 class="panel-title">'.$zona.' - Suspendidos</h3>
                                	<img src="imagenes/logo2-chico.png" style="float:right;margin-top:-21px; width:26px; height:24px;">
                                </div>
                                <div class="panel-body-predio" style="padding:5px 20px;">
                                	';
	$cad3 = $cad3.'
	<div class="row">
                	<table class="table table-responsive table-striped" style="font-size:0.9em; padding:2px;">
						<thead>
                        <tr>
                        	<th align="left">Nombre y Apellido</th>
                            <th align="left">Equipo</th>
                            <th align="center">Amarillas</th>
							<th align="center">Cant.</th>
                        </tr>
						</thead>
						<tbody>';
                        
						$i =1;
						$restantes = 0;
						while ($row1 = mysql_fetch_array($res4)) {
							
							if (($row1['reemplzado'] == '0') || (($row1['reemplzado'] == '1') && ($row1['volvio'] == '1'))) {
							$restantes = $serviciosDatos->traerFechasRestantes($idfecha,$row1['refjugador'],$row1['refequipo'],$row1['refsuspendido']);
							//echo $restantes;
							$restantes = (integer)$row1['cantidad'] - (integer)$restantes;
							if ($restantes != 0) { 
								$cad3 = $cad3.'<tr>
									<td align="left" style="padding:1px;">'.strtoupper(utf8_encode($row1['apyn'])).'</td>
									<td align="left" style="padding:1px;"><a href="equipo.php?eq='.$row1['refequipo'].'">'.utf8_encode($row1['nombre']).'</a></td>
									<td align="left" style="padding:1px;">'.utf8_encode($row1['motivos']).'</td>
									<td align="center" style="padding:1px;">'.$row1['cantidad'].'(Resta '.$restantes.')'.'</td>
								</tr>';
								
								$i = $i + 1;
							}
							}
						}
						
						
						while ($row2 = mysql_fetch_array($res5)) {


								$cad3 = $cad3.'<tr>
									<td align="left" style="padding:1px ;">'.strtoupper(utf8_encode($row2['apyn'])).'</td>
									<td align="left" style="padding:1px ;">'.utf8_encode($row2['nombre']).'</td>
									<td align="left" style="padding:1px ;">'.utf8_encode($row2['motivos']).'</td>
									<td align="center" style="padding:1px ;">Todas</td>
								</tr>';
								
								$i = $i + 1;

						}
                    $cad3 = $cad3.'</tbody>
                                </table>
								</div>
								</div>
                            </div>
						</div>';
	echo $cad3;
}


function AmarillasAcumuladasPagina($serviciosDatos) {
	$idtorneo	= $_POST['reftorneo'];
	$idzona		= $_POST['refzona'];
	$zona		= $_POST['zona'];
	$idfecha	= $_POST['reffecha'];
	
	$res3 = $serviciosDatos->traerAcumuladosAmarillasPorTorneoZona($idtorneo,$idzona,$idfecha);
	$cad3 = '';
	$cad3 = $cad3.'
				<div class="col-md-12">
				<div class="panel panel-predio">
                                <div class="panel-heading">
                                	<h3 class="panel-title">'.$zona.' - Amarillas</h3>
                                	<img src="imagenes/logo2-chico.png" style="float:right;margin-top:-21px; width:26px; height:24px;">
                                </div>
                                <div class="panel-body-predio" style="padding:5px 20px;">
                                	';
	$cad3 = $cad3.'
	<div class="row">
                	<table class="table table-responsive table-striped" style="font-size:0.9em; padding:2px;">
						<thead>
                        <tr>
                        	<th align="left">Nombre y Apellido</th>
                            <th align="left">Equipo</th>
                            <th align="center">Amarillas</th>
                        </tr>
						</thead>
						<tbody>';
                        
						$i =1;
						while ($row1 = mysql_fetch_array($res3)) {
                        $cad3 = $cad3.'<tr>
                            <td align="left" style="padding:1px;">'.strtoupper(utf8_encode($row1['apyn'])).'</td>
                            <td align="left" style="padding:1px;"><a href="equipo.php?eq='.$row1['refequipo'].'">'.utf8_encode($row1['nombre']).'</a></td>
                            <td align="center" style="padding:1px;">'.$row1['cantidad'].'</td>
 
                        </tr>';
         
						$i = $i + 1;
						}
                    $cad3 = $cad3.'</tbody>
                                </table>
								</div>
								</div>
                            </div>
						</div>';
	echo $cad3;
}





function AmarillasAcumuladas($serviciosDatos) {
	
	$idtorneo	= $_POST['reftorneo'];
	$idzona		= $_POST['refzona'];
	$zona		= $_POST['zona'];
	$idfecha	= $_POST['reffecha'];
	
	$res2 = $serviciosDatos->traerAcumuladosAmarillasPorTorneoZona($idtorneo,$idzona,$idfecha);
	
	$cad2 = '
	<div class="row">
                	<table cellpadding="0" cellspacing="0" border="2" bordercolor="#FF0000" style="width:auto; margin-left:20px; font-weight:bold; margin-right:5px;">
                    	<tr bgcolor="#bfbfbf">
                        	<td colspan="11" align="center" style="font-size:1.9em;">AMARILLAS '.$zona.'</td>
                        </tr>
                        <tr style="font-size:1.5em;">
                            <td align="center" style="padding:1px 6px;">EQUIPO</td>
                            <td align="center" style="padding:1px 6px;">JUGADOR</td>
							<td align="center" style="padding:1px 6px;">DNI</td>
                            <td align="center" style="padding:1px 6px;">AMARILLAS</td>
                        </tr>';

						$i =1;
						$puntos = 0;
						while ($row1 = mysql_fetch_array($res2)) {
						
							
						if (($row1['reemplzado'] == '0') || (($row1['reemplzado'] == '1') && ($row1['volvio'] == '1'))) {
							$cad2 = $cad2.'<tr style="font-size:1.5em;">
								<td align="left" style="padding:1px 6px;">'.utf8_encode($row1['nombre']).'</td>
								<td align="right" style="padding:1px 6px;">'.strtoupper(utf8_encode($row1['apyn'])).'</td>
								<td align="right" style="padding:1px 6px;">'.utf8_encode($row1['dni']).'</td>
								<td align="right" style="padding:1px 6px;">'.$row1['cantidad'].'</td>
							</tr>';
						}
						}
                    $cad2 = $cad2.'</table>
                
                </div>';
	echo $cad2;
}



function FairPlay($serviciosDatos) {
	
	$idtorneo	= $_POST['reftorneo'];
	$idzona		= $_POST['refzona'];
	$zona		= $_POST['zona'];
	$idfecha	= $_POST['reffecha'];
	
	$res2 = $serviciosDatos->fairplay($idtorneo,$idzona,$idfecha);
	
	$cad2 = '
	<div class="row">
                	<table cellpadding="0" cellspacing="0" border="2" bordercolor="#FF0000" style="width:auto; margin-left:20px; font-weight:bold; margin-right:5px;">
                    	<tr bgcolor="#bfbfbf">
                        	<td colspan="11" align="center" style="font-size:1.9em;">FairPlay '.$zona.'</td>
                        </tr>
                        <tr style="font-size:1.5em;">
                            <td align="center" style="padding:1px 6px;">EQUIPO</td>
                            <td align="center" style="padding:1px 6px;">PUNTOS</td>
                        </tr>';

						$i =1;
						$puntos = 0;
						while ($row1 = mysql_fetch_array($res2)) {
						
							
				
							$cad2 = $cad2.'<tr style="font-size:1.5em;">
								<td align="left" style="padding:1px 6px;">'.utf8_encode($row1['nombre']).'</td>
								<td align="right" style="padding:1px 6px;">'.utf8_encode($row1['puntos']).'</td>
							</tr>';

						}
                    $cad2 = $cad2.'</table>
                
                </div>';
	echo $cad2;
}


function FairPlayPagina($serviciosDatos) {
	
	$idtorneo	= $_POST['reftorneo'];
	$idzona		= $_POST['refzona'];
	$zona		= $_POST['zona'];
	$idfecha	= $_POST['reffecha'];
	
	$res2 = $serviciosDatos->fairplay($idtorneo,$idzona,$idfecha);
	
	$cad3 = '';
	$cad3 = $cad3.'
				<div class="col-md-12">
				<div class="panel panel-predio">
                                <div class="panel-heading">
                                	<h3 class="panel-title">'.$zona.' - FairPlay</h3>
                                	<img src="imagenes/logo2-chico.png" style="float:right;margin-top:-21px; width:26px; height:24px;">
                                </div>
                                <div class="panel-body-predio" style="padding:5px 20px;">
                                	';
	$cad3 = $cad3.'
	<div class="row">
                	<table class="table table-responsive table-striped" style="font-size:0.9em; padding:2px;">
						<thead>
                        <tr>
                            <th align="left">Equipo</th>
                            <th align="center">Puntos</th>
                        </tr>
						</thead>
						<tbody>';

						$i =1;
						$puntos = 0;
						while ($row1 = mysql_fetch_array($res2)) {
						
							
				
							$cad3 = $cad3.'<tr style="font-size:1.5em;">
								<td align="left" style="padding:1px;"><a href="equipo.php?eq='.utf8_encode($row1['refequipo']).'">'.utf8_encode($row1['nombre']).'</td>
								<td align="center" style="padding:1px;">'.$row1['puntos'].'</td>
							</tr>';

						}
                    $cad3 = $cad3.'</tbody>
                                </table>
								</div>
								</div>
                            </div>
						</div>';
	echo $cad3;
}
/* Fin reportes */

/* para los noticias */




function insertarNoticias($serviciosNoticias) {
	$titulo = $_POST['titulo'];
	$parrafo = $_POST['parrafo'];
	$fechacreacion = $_POST['fechacreacion'];
	if (isset($_POST['galeria'])) {
		$galeria = 1;
	} else {
		$galeria = 0;
	}

	$res = $serviciosNoticias->insertarNoticias($titulo,$parrafo,$fechacreacion,$galeria);
	if ((integer)$res > 0) {
		$imagenes = array("imagen1" => 'imagen1',
						  "imagen2" => 'imagen2',
						  "imagen3" => 'imagen3',
						  "imagen4" => 'imagen4',
						  "imagen5" => 'imagen5',
						  "imagen6" => 'imagen6',
						  "imagen7" => 'imagen7',
						  "imagen8" => 'imagen8');
	
		foreach ($imagenes as $valor) {
			$serviciosNoticias->subirArchivo($valor,'galeria',$res);
		}
		echo '';
	} else {
		echo 'Huvo un error al insertar datos';
	}
}
function modificarNoticias($serviciosNoticias) {
	
	$id = $_POST['id'];
	$titulo = $_POST['titulo'];
	$parrafo = $_POST['parrafo'];
	$fechacreacion = $_POST['fechacreacion'];
	if (isset($_POST['galeria'])) {
		$galeria = 1;
	} else {
		$galeria = 0;
	}
	
	$cantImagenes		=	$_POST['cantidadImagenes'];
	
	$cantImagenes		= 8 - (integer)$cantImagenes;
	
	
	$res = $serviciosNoticias->modificarNoticias($id,$titulo,$parrafo,$fechacreacion,$galeria);
	if ($res == true) {
		$imagenes = array("imagen1" => 'imagen1',
						  "imagen2" => 'imagen2',
						  "imagen3" => 'imagen3',
						  "imagen4" => 'imagen4',
						  "imagen5" => 'imagen5',
						  "imagen6" => 'imagen6',
						  "imagen7" => 'imagen7',
						  "imagen8" => 'imagen8');
	
		for ($i=1;$i<=$cantImagenes;$i++) {
			$valor = "imagen".$i;
			$serviciosNoticias->subirArchivo($valor,'galeria',$id);
		}
		echo '';
	} else {
		echo 'Huvo un error al modificar datos';
	}
}
function eliminarNoticias($serviciosNoticias) {
	$id = $_POST['id'];

	//**** Debo eliminar todas las imagenes que hay en la noticias y la carpeta tambien *//////////
	$resT = $serviciosNoticias->TraerFotosNoticias($id);
	
	while ($resT = mysql_fetch_array($resT)) {
		$serviciosNoticias->eliminarFoto($resT['idfoto']);	
	}
	
	
	$res = $serviciosNoticias->eliminarNoticias($id);

	echo $res;
} 

function eliminarFoto($serviciosNoticias) {
	$id			=	$_POST['id'];
	echo $serviciosNoticias->eliminarFoto($id);
}


function insertarNoticiasPrincipales($serviciosNoticias) {
$titulo = $_POST['titulo'];
$noticiaprincipal = $_POST['noticiaprincipal'];
$fechacreacion = $_POST['fechacreacion'];
$res = $serviciosNoticias->insertarNoticiasPrincipales($titulo,$noticiaprincipal,$fechacreacion);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarNoticiasPrincipales($serviciosNoticias) {
	$id = $_POST['id'];
	$titulo = $_POST['titulo'];
	$noticiaprincipal = $_POST['noticiaprincipal'];
	$fechacreacion = $_POST['fechacreacion'];
	
	$res = $serviciosNoticias->modificarNoticiasPrincipales($id,$titulo,$noticiaprincipal,$fechacreacion);
	if ($res == true) {
		echo '';
	} else {
		echo 'Huvo un error al modificar datos';
	}
}
function eliminarNoticiasPrincipales($serviciosNoticias) {
$id = $_POST['id'];
$res = $serviciosNoticias->eliminarNoticiasPrincipales($id);
echo $res;
} 




function insertarNoticiasPredio($serviciosNoticiasPredio) {
$titulo = $_POST['titulo'];
$noticiapredio = $_POST['noticiapredio'];
$fechacreacion = $_POST['fechacreacion'];
$res = $serviciosNoticiasPredio->insertarNoticiasPredio($titulo,$noticiapredio,$fechacreacion);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarNoticiasPredio($serviciosNoticiasPredio) {
$id = $_POST['id'];
$titulo = $_POST['titulo'];
$noticiapredio = $_POST['noticiapredio'];
$fechacreacion = $_POST['fechacreacion'];
$res = $serviciosNoticiasPredio->modificarNoticiasPredio($id,$titulo,$noticiapredio,$fechacreacion);
if ($res == true) {
		echo '';
	} else {
		echo 'Huvo un error al modificar datos';
	}
}
function eliminarNoticiasPredio($serviciosNoticiasPredio) {
$id = $_POST['id'];
$res = $serviciosNoticiasPredio->eliminarNoticiasPredio($id);
echo $res;
} 
/* fin noticias */



/* para los torneos */

function traerZonaPorTorneos($serviciosFunciones) {
	$idTorneo	= 	$_POST["reftorneo"];
	
	$res	= $serviciosFunciones->traerZonaPorTorneos($idTorneo);
	
	echo json_encode(toArray($res));	
	
}
function insertarTorneo($serviciosFunciones) {
	$nombre			=	$_POST['nombre'];
	$fechacreacion	=	$_POST['fechacreacion'];

	if (isset($_POST['activo'])) {
		$activo	= 1;
	} else {
		$activo = 0;
	}
	
	if (isset($_POST['actual'])) {
		$actual	= 1;
	} else {
		$actual = 0;
	}
	$reftipotorneo	=	$_POST['reftipotorneo'];
	
	$res = $serviciosFunciones->insertarTorneo($nombre,$fechacreacion,$activo,$actual,$reftipotorneo);
	//echo $res;
	
	if ((integer)$res > 0) {
		echo '';
	} else {
		echo "Huvo un error al insertar datos";	
	}
}

function modificarTorneo($serviciosFunciones) {
	$id				=	$_POST['id'];
	$nombre			=	$_POST['nombre'];
	$fechacreacion	=	$_POST['fechacreacion'];
	if (isset($_POST['activo'])) {
		$activo	= 1;
	} else {
		$activo = 0;
	}
	
	if (isset($_POST['actual'])) {
		$actual	= 1;
	} else {
		$actual = 0;
	}
	$reftipotorneo	=	$_POST['reftipotorneo'];
	
	$res = $serviciosFunciones->modificarTorneo($id,$nombre,$fechacreacion,$activo,$actual,$reftipotorneo);
	

	if ($res == true) {
		echo '';
	} else {
		echo 'Huvo un error al modificar datos';
	}
}

function eliminarTorneo($serviciosFunciones) {
	$id				=	$_POST['id'];
	
	$res = $serviciosFunciones->eliminarTorneo($id);
	echo $res;
}


function traerTorneoPorTipoTorneo($serviciosFunciones) {
	$idtipotorneo	=	$_POST['reftipotorneo'];
	
	$res = $serviciosFunciones->traerTorneoPorTipoTorneo($idtipotorneo);
	
	$cad = '';
	while ($roww = mysql_fetch_array($res)) {
		$cad = $cad.'<option value="'.$roww[0].'">'.utf8_encode($roww[1]).'</td>';	
	}
	echo $cad;
}

function cambiarTorneo($serviciosFunciones) {
	$idtipotorneo		=	$_POST['reftipotorneo'];
	$idtorneo = '';
	//$idtorneo			=	$_POST['reftorneo'];
	
	$res = $serviciosFunciones->cambiarTorneo($idtipotorneo,$idtorneo);
	//echo $res;
	if ($res == true) {
		echo '';
	} else {
		echo 'Huvo un error al cambiar el torneo';
	}
}

/* fin torneos */
	
/* para los equipos */

function traerEquipoPorZonaTorneos($serviciosEquipos) {
	$refTorneo		= $_POST['reftorneo'];
	$refZona		= $_POST['refzona'];
	
	$res	= $serviciosEquipos->traerEquipoPorZonaTorneos($refTorneo,$refZona);
	
	echo json_encode(toArray($res));
}


function insertarEquipos($serviciosEquipos) {
	$Nombre 			= $_POST['nombre'];
	$nombrecapitan 		= $_POST['nombrecapitan'];
	$telefonocapitan 	= $_POST['telefonocapitan'];
	$facebookcapitan 	= $_POST['facebookcapitan'];
	$nombresubcapitan 	= $_POST['nombresubcapitan'];
	$telefonosubcapitan = $_POST['telefonosubcapitan'];
	$facebooksubcapitan = $_POST['facebooksubcapitan'];
	$emailcapitan 		= $_POST['emailcapitan'];
	$emailsubcapitan 	= $_POST['emailsubcapitan'];

	$res = $serviciosEquipos->insertarEquipos($Nombre,$nombrecapitan,$telefonocapitan,$facebookcapitan,$nombresubcapitan,$telefonosubcapitan,$facebooksubcapitan,$emailcapitan,$emailsubcapitan);
	if ((integer)$res > 0) {
		echo '';
	} else {
		echo 'Huvo un error al insertar datos';
	}
}
function modificarEquipos($serviciosEquipos) {
	$id 				= $_POST['id'];
	$Nombre 			= $_POST['nombre'];
	$nombrecapitan 		= $_POST['nombrecapitan'];
	$telefonocapitan 	= $_POST['telefonocapitan'];
	$facebookcapitan 	= $_POST['facebookcapitan'];
	$nombresubcapitan 	= $_POST['nombresubcapitan'];
	$telefonosubcapitan = $_POST['telefonosubcapitan'];
	$facebooksubcapitan = $_POST['facebooksubcapitan'];
	$emailcapitan 		= $_POST['emailcapitan'];
	$emailsubcapitan 	= $_POST['emailsubcapitan'];

	$res = $serviciosEquipos->modificarEquipos($id,$Nombre,$nombrecapitan,$telefonocapitan,$facebookcapitan,$nombresubcapitan,$telefonosubcapitan,$facebooksubcapitan,$emailcapitan,$emailsubcapitan);
	
	if ($res == true) {
		echo '';
	} else {
		echo 'Huvo un error al insertar datos';
	}
}

function eliminarEquipos($serviciosEquipos) {
	$id = $_POST['id'];
	$res = $serviciosEquipos->eliminarEquipos($id);
	echo $res;
}





function insertarConducta($serviciosFunciones) {
	$refequipo = $_POST['refequipo'];
	$puntos = $_POST['puntos'];
	$reffecha =$_POST['reffecha'];
	$reftorneo = $_POST['reftorneo'];
	
	$res = $serviciosFunciones->modificarConductaPorEquipo($refequipo,$puntos,$reffecha,$reftorneo);
	if ($res == true) {
		echo '';
	} else {
		echo 'Huvo un error al modificar datos';
	}
}
function modificarConducta($serviciosFunciones) {
	$id = $_POST['id'];
	$refequipo = $_POST['refequipo'];
	$puntos = $_POST['puntos'];
	$res = $serviciosFunciones->modificarConducta($id,$refequipo,$puntos);
	if ($res == true) {
		echo '';
	} else {
		echo 'Huvo un error al modificar datos';
	}
}
function eliminarConducta($serviciosFunciones) {
	$id = $_POST['id'];
	$res = $serviciosFunciones->eliminarConducta($id);
	echo $res;
} 
/* fin equipos */


/* para los jugadores */

function buscarJugadores($serviciosJugadores) {
	$tipobusqueda	= $_POST['tipobusqueda'];
	$busqueda		= $_POST['busqueda'];
	
	$res = $serviciosJugadores->buscarJugadores($tipobusqueda,$busqueda);
	
	$cad3 = '';
	//////////////////////////////////////////////////////busquedajugadores/////////////////////
	$cad3 = $cad3.'
				<div class="col-md-12">
				<div class="panel panel-info">
                                <div class="panel-heading">
                                	<h3 class="panel-title">Resultado de la Busqueda</h3>
                                	<img src="../../imagenes/logo2-chico.png" style="float:right;margin-top:-21px; width:26px; height:24px;">
                                </div>
                                <div class="panel-body-predio" style="padding:5px 20px;">
                                	';
	$cad3 = $cad3.'
	<div class="row">
                	<table id="example" class="table table-responsive table-striped" style="font-size:0.8em; padding:2px;">
						<thead>
                        <tr>
                        	<th align="left">Equipo</th>
                            <th align="left">Jugador</th>
                            <th align="center">DNI</th>
							<th align="center">Invitado</th>
							<th align="center">Expulsado</th>
							<th>Acciones</th>
                        </tr>
						</thead>
						<tbody>';
	while ($rowJ = mysql_fetch_array($res)) {
		$cad3 .= '<tr>
					<td>'.utf8_encode($rowJ[1]).'</td>
					<td>'.utf8_encode($rowJ[2]).'</td>
					<td>'.utf8_encode($rowJ[3]).'</td>
					<td>'.utf8_encode($rowJ[4]).'</td>
					<td>'.utf8_encode($rowJ[5]).'</td>
					<td>
								
							<div class="btn-group">
								<button class="btn btn-success" type="button">Acciones</button>
								
								<button class="btn btn-success dropdown-toggle" data-toggle="dropdown" type="button">
								<span class="caret"></span>
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								
								<ul class="dropdown-menu" role="menu">
									<li>
									<a href="modificar.php?id='.$rowJ[0].'" class="varmodificar" id="'.$rowJ[0].'">Modificar</a>
									</li>

									
								</ul>
							</div>
						</td>';
	}
	
	$cad3 = $cad3.'</tbody>
                                </table></div>
                            </div>
						</div>';
						
	echo $cad3;
}

function insertarJugadores($serviciosJugadores) {
	$apyn 		= $_POST['apyn'];
	$idequipo 	= $_POST['idequipo'];
	
	if (isset($_POST['invitado'])) {
		$invitado = 1;
	} else {
		$invitado = 0;
	}

	
	$dni 		= str_replace('.','',$_POST['dni']);
	
	$res = $serviciosJugadores->insertarJugadores($apyn,$dni,$idequipo,$invitado);
	if ((integer)$res > 0) {
		echo '';
	} else {
		echo 'Huvo un error al insertar datos';
	}
}
function modificarJugadores($serviciosJugadores) {
	$id 		= $_POST['id'];
	$apyn 		= $_POST['apyn'];
	$idequipo 	= $_POST['idequipo'];
	$dni 		= $_POST['dni'];
	
	if (isset($_POST['invitado'])) {
		$invitado = 1;
	} else {
		$invitado = 0;
	}
	
	if (isset($_POST['expulsado'])) {
		$invitado = 1;
	} else {
		$invitado = 0;
	}
	
	$res = $serviciosJugadores->modificarJugadores($apyn,$dni,$idequipo,$id,$invitado);
	
	
	if ($res == true) {
		echo '';
	} else {
		echo 'Huvo un error al MODIFICAR datos';
	}
	
}

function modificarJugadoresEx($serviciosJugadores) {
	$id 		= $_POST['id'];
	$apyn 		= $_POST['apyn'];
	$idequipo 	= $_POST['idequipo'];
	$dni 		= $_POST['dni'];
	
	$invitado	= $_POST['invitado'];
	$expulsado	= $_POST['expulsado'];
	
	$res = $serviciosJugadores->modificarJugadores($apyn,$dni,$idequipo,$id,$invitado,$expulsado);
	
	//echo $res;
	
	if ($res == true) {
		echo '';
	} else {
		echo 'Huvo un error al MODIFICAR datos';
	}
}
function eliminarJugadores($serviciosJugadores) {
	$id = $_POST['id'];
	
	$res = $serviciosJugadores->eliminarJugadores($id);
	echo $res;
} 

function traerJugadores($serviciosJugadores) {
	$idequipo		=	$_POST['refequipo'];
	
	$res = $serviciosJugadores->TraerJugadoresPorEquipo($idequipo);
	
	$cad = '';
	while ($roww = mysql_fetch_array($res)) {
		$cad = $cad.'<option value="'.$roww[0].'">'.utf8_encode($roww[1]).' - '.$roww[2].'</td>';	
	}
	echo $cad;
		
}



function insertarGoleadores($serviciosJugadores) {
	$refequipo 	= $_POST['refequipo'];
	$reffixture = $_POST['reffixture'];
	$goles 		= $_POST['goles'];
	$refjugador = $_POST['refjugador'];

	$res = $serviciosJugadores->insertarGoleadores($refequipo,$reffixture,$goles,$refjugador);

	if ((integer)$res > 0) {
		echo '';
	} else {
		echo 'Huvo un error al insertar datos';
	}
}

function modificarGoleadores($serviciosJugadores) {
	$id 		= $_POST['id'];
	$refequipo 	= $_POST['refequipo'];
	$reffixture = $_POST['reffixture'];
	$goles 		= $_POST['goles'];
	$refjugador = $_POST['refjugador'];
	
	$res = $serviciosJugadores->modificarGoleadores($id,$refequipo,$reffixture,$goles,$refjugador);

	if ($res == true) {
		echo '';
	} else {
		echo 'Huvo un error al modificar datos';
	}
}

function eliminarGoleadores($serviciosJugadores) {
$id = $_POST['id'];
$res = $serviciosJugadores->eliminarGoleadores($id);
echo $res;
} 




function insertarAmonestados($serviciosJugadores) {
	$refjugador = $_POST['refjugador'];
	$refequipo 	= $_POST['refequipo'];
	$reffixture = $_POST['reffixture'];
	$amarillas 	= $_POST['amarillas'];
	
	$res = $serviciosJugadores->insertarAmonestados($refjugador,$refequipo,$reffixture,$amarillas);
	if ((integer)$res > 0) {
		echo '';
	} else {
		echo 'Huvo un error al insertar datos';
	}
}
function modificarAmonestados($serviciosJugadores) {
	$id 		= $_POST['id'];
	$refjugador = $_POST['refjugador'];
	$refequipo	 = $_POST['refequipo'];
	$reffixture = $_POST['reffixture'];
	$amarillas 	= $_POST['amarillas'];
	
	$res = $serviciosJugadores->modificarAmonestados($id,$refjugador,$refequipo,$reffixture,$amarillas);
	if ($res == true) {
		echo '';
	} else {
		echo 'Huvo un error al modificar datos';
	}
}
function eliminarAmonestados($serviciosJugadores) {
$id = $_POST['id'];
$res = $serviciosJugadores->eliminarAmonestados($id);
echo $res;
}


function insertarEstadistica($serviciosJugadores) {
	$refjugador = $_POST['refjugador'];
	$refequipo 	= $_POST['refequipo'];
	$reffixture = $_POST['reffixture'];
	$amarillas 	= $_POST['amarillas'];
	$goles 		= $_POST['goles'];
	
	if (($goles != '') || ($goles != 0)) {
		$res2 = $serviciosJugadores->insertarGoleadores($refequipo,$reffixture,$goles,$refjugador);
	}
			
	if (($amarillas != '') || ($amarillas != 0)) {
		$res  = $serviciosJugadores->insertarAmonestados($refjugador,$refequipo,$reffixture,$amarillas);
	}	
	
	return '';
	
}



function insertarSuspendidos($serviciosSuspendidos,$serviciosFunciones) {
	$refjugador = $_POST['refjugador'];
	$refequipo = $_POST['refequipo'];
	$motivos = str_replace("'",'',trim($_POST['motivos']));
	$cantidadfechas = $_POST['cantidadfechas'];
	$fechacreacion = date('Y-m-d');
	$reffixture = $_POST['reffixture'];
	
	
	
	
	$res = $serviciosSuspendidos->insertarSuspendidos($refequipo,$refjugador,$motivos,$cantidadfechas,$fechacreacion,$reffixture);
	if ((integer)$res > 0) {
		$resFechas = $serviciosFunciones->TraerFecha();
		$cad = 'fecha';
		while ($rowFS = mysql_fetch_array($resFechas)) {
			if (isset($_POST[$cad.$rowFS[0]])) {
				$serviciosFunciones->insertarSuspendidosFechas($refjugador,$refequipo,$rowFS[0],$res);
			}
		}
		echo '';
	} else {
		echo 'Huvo un error al insertar datos';
	}
}
function modificarSuspendidos($serviciosSuspendidos,$serviciosFunciones) {
	$id = $_POST['id'];
	$refjugador = $_POST['refjugador'];
	$refequipo = $_POST['refequipo'];
	$motivos = str_replace("'",'',trim($_POST['motivos']));
	$cantidadfechas = $_POST['cantidadfechas'];
	$fechacreacion = date('Y-m-d');
	$reffixture = $_POST['reffixture'];
	
	$res = $serviciosSuspendidos->modificarSuspendidos($id,$refequipo,$refjugador,$motivos,$cantidadfechas,$fechacreacion,$reffixture);
	
	
	
	if ($res == true) {
		$serviciosFunciones->eliminarSuspendidosFechas($refjugador,$refequipo);
			$resFechas = $serviciosFunciones->TraerFecha();
			$cad = 'fecha';
			while ($rowFS = mysql_fetch_array($resFechas)) {
				if (isset($_POST[$cad.$rowFS[0]])) {
					$serviciosFunciones->insertarSuspendidosFechas($refjugador,$refequipo,$rowFS[0],$id);
				}
			}
		echo '';
	} else {
		echo 'Huvo un error al modificar datos';
	}
}
function eliminarSuspendidos($serviciosSuspendidos) {
	$id = $_POST['id'];
	
	$res = $serviciosSuspendidos->eliminarSuspendidos($id);
	echo $res;
} 

/* fin jugadores */


/* para los zonas */
function insertarGrupo($serviciosGrupos) {
$Nombre = $_POST['nombre'];
$res = $serviciosGrupos->insertarGrupos($Nombre);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarGrupos($serviciosGrupos) {
	$id = $_POST['id'];
	$Nombre = $_POST['nombre'];
	
	$res = $serviciosGrupos->modificarGrupos($id,$Nombre);
	if ($res == true) {
		echo '';
	} else {
		echo 'Huvo un error al modificar datos';
	}
}
function eliminarGrupos($serviciosGrupos) {
$id = $_POST['id'];
$res = $serviciosGrupos->eliminarGrupos($id);
echo $res;
} 
/* fin zonas */


/* para los torneo-zonas-equipos */

/* PARA Reemplazos */
function insertarReemplazos($serviciosReemplazos) {
	$refequipo 				= $_POST['refequipo'];
	$refequiporeemplazado 	= $_POST['refequiporeemplazado'];
	$puntos 				= $_POST['puntos'];
	$golesencontra 			= $_POST['golesencontra'];
	$reffecha 				= $_POST['reffecha'];
	$reftorneo 				= $_POST['reftorneo'];
	$ptsfairplay			= $_POST['fairplay'];
	
	$res = $serviciosReemplazos->insertarReemplazos($refequipo,$refequiporeemplazado,$puntos,$golesencontra,$reffecha,$reftorneo,$ptsfairplay);
	
	if ((integer)$res > 0) {
		echo '';
	} else {
		echo 'Huvo un error al insertar datos';
	}
}
function modificarReemplazos($serviciosReemplazos) {
	$id 					= $_POST['id'];
	$refequipo 				= $_POST['refequipo'];
	$refequiporeemplazado 	= $_POST['refequiporeemplazado'];
	$puntos 				= $_POST['puntos'];
	$golesencontra 			= $_POST['golesencontra'];
	$reffecha 				= $_POST['reffecha'];
	$reftorneo 				= $_POST['reftorneo'];
	
	$res = $serviciosReemplazos->modificarReemplazos($id,$refequipo,$refequiporeemplazado,$puntos,$golesencontra,$reffecha,$reftorneo);
	
	if ($res == true) {
		echo '';
	} else {
		echo 'Huvo un error al modificar datos';
	}
}

function eliminarReemplazos($serviciosReemplazos) {
	$id = $_POST['id'];
	$res = $serviciosReemplazos->eliminarReemplazos($id);
	echo $res;
}

/* Fin */ 

function insertarZonasEquipos($serviciosZonasEquipos) {
	$refgrupo 		= $_POST['refgrupo'];
	$reftorneo 		= $_POST['reftorneo'];
	$refequipo 		= $_POST['refequipo'];
	$prioridad	 	= $_POST['prioridad'];
	
	
	$res = $serviciosZonasEquipos->insertarZonasEquipos($refgrupo,$reftorneo,$refequipo,$prioridad);
	if ((integer)$res > 0) {
		
		for ($i=1;$i<=4;$i++) {
			$serviciosZonasEquipos->insertarHorariosEquiposPrioridades($res,$_POST['idhorario'.$i],$_POST['horario'.$i]);
		}
		
		echo '';
	} else {
		echo 'Huvo un error al insertar datos';
	}
}


function modificarZonasEquipos($serviciosZonasEquipos) {
	
	$id 		= $_POST['id'];
	$refgrupo 	= $_POST['refgrupo'];
	$reftorneo 	= $_POST['reftorneo'];
	$refequipo 	= $_POST['refequipo'];
	$prioridad 	= $_POST['prioridad'];
	
	$res = $serviciosZonasEquipos->modificarZonasEquipos($id,$refgrupo,$reftorneo,$refequipo,$prioridad);
	for ($i=1;$i<=4;$i++) {
			$serviciosZonasEquipos->modificarHorariosEquiposPrioridades($_POST['idtp'.$i],$_POST['idhorario'.$i],$_POST['horario'.$i]);
		}
	if ($res == true) {
		echo '';
	} else {
		echo 'Huvo un error al modificar datos';
	}
}


function eliminarZonasEquipos($serviciosZonasEquipos) {
$id = $_POST['id'];
$res = $serviciosZonasEquipos->eliminarZonasEquipos($id);
echo $res;
} 


function TraerZonaPorTorneoEquipo($serviciosZonasEquipos,$serviciosDatos) {

	$refequipo 		= $_POST['refequipo'];
	$reffecha		= $_POST['reffecha'];
	
	$res = $serviciosZonasEquipos->TraerZonaPorTorneoEquipo($refequipo);
	
	$idequipo = 0;
	$nombre = '';
	$pts = 0;
	$ptsfp = 0;
	$golesc = 0;
	
	if (mysql_num_rows($res)>0) {
		$idzona = mysql_result($res,0,0);
		$reftorneo = mysql_result($res,0,2);
		$res2 = $serviciosDatos->TraerFixturePorZonaTorneo($reftorneo,$idzona,$reffecha);
		
		while ($row = mysql_fetch_array($res2)) {
			if ($row['equipoactivo'] != 1) {
			$idequipo = $row['idequipo'];
			$nombre = utf8_encode($row['nombre']);
			$pts = $row['pts'];
			$ptsfp = $row['puntos'];
			$golesc = $row['golesencontra'];
			}
		}
	}
///	$datos = array('nombre'=>$nombre,'idequipo'=>$idequipo,'pts'=>$pts,'ptsfp'=>$ptsfp,'golesc'=>$golesc);
	$datos = array($nombre,$idequipo,$pts,$ptsfp,$golesc);
	echo json_encode($datos);
}


function reemplazarEquipos($serviciosZonasEquipos) {
	$equipoReemplazado		=	$_POST['refequipor'];
	$equipoAReemplazado		=	$_POST['refequiporr'];
	$pts					=	$_POST['puntos'];
	$golesencontra			=	$_POST['golesec'];
	$ptsfairplay			=	$_POST['puntosfp'];
	$reffecha				=	$_POST['fecharr'];
	
	$res = $serviciosZonasEquipos->reemplazarEquipos($equipoReemplazado,$equipoAReemplazado,$pts,$golesencontra,$ptsfairplay,$reffecha);
	
	//echo $res;
	
	if ((integer)$res > 0) {
		echo '';
	} else {
		echo 'Huvo un error al insertar datos';
	}
}


function chequearPorFecha($serviciosZonasEquipos) {
	$reffecha		=	$_POST['reffecha'];	
	
	$res = $serviciosZonasEquipos->chequearPorFecha($reffecha);
	if ((integer)$res > 0) {
		echo '';
	} else {
		echo 'Huvo un error al chequear los datos';
	}
}

function cargarTablaConducta($serviciosZonasEquipos) {
	$reffecha		=	$_POST['reffecha'];	
	
	$res = $serviciosZonasEquipos->cargarTablaConducta($reffecha);
	//echo $res;
	
	if ((integer)$res > 0) {
		echo '';
	} else {
		echo 'Huvo un error al chequear los datos';
	}
}

function calcularTablaConducta($serviciosZonasEquipos) {
	$reffecha		=	$_POST['reffecha'];	
	
	$res = $serviciosZonasEquipos->calcularTablaConducta($reffecha);
	//echo $res;
	
	if ((integer)$res > 0) {
		echo '';
	} else {
		echo 'Huvo un error al chequear los datos';
	}
}

/* fin torneo-zonas-equipos */


/* para los fixture */


function insertarFixture($serviciosZonasEquipos) {
	$reftorneoge_a 	= $_POST['reftorneoge_a'];
	$resultado_a 	= $_POST['resultado_a'];
	$reftorneoge_b 	= $_POST['reftorneoge_b'];
	$resultado_b 	= $_POST['resultado_b'];
	$fechajuego 	= $_POST['fechajuego'];
	$refFecha 		= $_POST['reffecha'];
	$cancha 		= $_POST['cancha'];
	$horario 		= $_POST['hora'];
	
	$res = $serviciosZonasEquipos->insertarFixture($reftorneoge_a,$resultado_a,$reftorneoge_b,$resultado_b,$fechajuego,$refFecha,$cancha,$horario);
	
	if ((integer)$res > 0) {
		echo '';
	} else {
		echo 'Huvo un error al insertar datos';
	}
}


function modificarFixture($serviciosZonasEquipos) {
	$id 			= $_POST['id'];
	$reftorneoge_a 	= $_POST['reftorneoge_a'];
	$resultado_a 	= $_POST['resultado_a'];
	$reftorneoge_b 	= $_POST['reftorneoge_b'];
	$resultado_b 	= $_POST['resultado_b'];
	$fechajuego 	= $_POST['fechajuego'];
	$refFecha 		= $_POST['reffecha'];
	$cancha 		= $_POST['cancha'];
	$horario 		= $_POST['hora'];
	if (isset($_POST['chequeado'])) {
		$chequeado = 1;
	} else {
		$chequeado = 0;
	}

	$res = $serviciosZonasEquipos->modificarFixtureTodo($id,$reftorneoge_a,$resultado_a,$reftorneoge_b,$resultado_b,$fechajuego,$refFecha,$cancha,$horario,$chequeado);
	if ($res == true) {
		echo '';
	} else {
		echo 'Huvo un error al modificar datos';
	}
} 


function eliminarFixture($serviciosZonasEquipos) {
$id = $_POST['id'];
$res = $serviciosZonasEquipos->eliminarFixture($id);
echo $res;
} 


function traerFixturePorEquipo($serviciosZonasEquipos) {
	$idequipo		=	$_POST['refequipo'];
	
	$res4 = $serviciosZonasEquipos->traerFixturePorEquipo($idequipo);
	

	$cad = '';
	while ($row4 = mysql_fetch_array($res4)) {
		$cad = $cad.'<option value="'.$row4[0].'">'.$row4[7].' - '.$row4[8].'</td>';	
	}
	echo $cad;
		
}
/* fin fixture */
	
	
	
function modificarCliente($serviciosUsuarios) {
	$email		=	$_POST['email'];
	$password	=	$_POST['password'];
	$direccion	=	$_POST['direccion'];
	$nombre		=	$_POST['nombre'];
	$apellido	=	$_POST['apellido'];
	$id			=	$_POST['id'];
	
	echo $serviciosUsuarios->modificarUsuario($id,$apellido,$password,'',$email,$nombre,'',$direccion,'','','','');
}

function entrar($serviciosUsuarios) {
	$email		=	$_POST['email'];
	$pass		=	$_POST['pass'];
	echo $serviciosUsuarios->loginUsuario($email,$pass);
}


function registrar($serviciosUsuarios) {
	$apellido			=	$_POST['apellido'];
	$password			=	$_POST['password'];
	$refroll			=	2;
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombre'];
	$telefono			=	'';
	$direccion			=	$_POST['direccion'];
	$imagen				=	'';
	$mime				=	'';
	$carpeta			=	'';
	$intentoserroneos	=	0;
	$res = $serviciosUsuarios->insertarUsuario($apellido,$password,$refroll,$email,$nombre,$telefono,$direccion,$imagen,$mime,$carpeta,$intentoserroneos);
	if ((integer)$res > 0) {
		echo '';	
	} else {
		echo $res;	
	}
}


function insertarUsuario($serviciosUsuarios) {
	$apellido			=	$_POST['apellido'];
	$password			=	$_POST['password'];
	$refroll			=	2;
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombre'];
	$telefono			=	'';
	$direccion			=	$_POST['direccion'];
	$imagen				=	'';
	$mime				=	'';
	$carpeta			=	'';
	$intentoserroneos	=	0;
	echo $serviciosUsuarios->insertarUsuario($apellido,$password,$refroll,$email,$nombre,$telefono,$direccion,$imagen,$mime,$carpeta,$intentoserroneos);
}


function modificarUsuario($serviciosUsuarios) {
	$id					=	$_POST['id'];
	$apellido			=	$_POST['apellido'];
	$password			=	$_POST['password'];
	$refroll			=	2;
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombre'];
	$telefono			=	'';
	$direccion			=	$_POST['direccion'];
	$imagen				=	'';
	$mime				=	'';
	$carpeta			=	'';
	$intentoserroneos	=	0;
	echo $serviciosUsuarios->modificarUsuario($id,$apellido,$password,$refroll,$email,$nombre,$telefono,$direccion,$imagen,$mime,$carpeta,$intentoserroneos);
}


function enviarMail($serviciosUsuarios) {
	$email		=	$_POST['email'];
	$pass		=	$_POST['pass'];
	$torneo		=	$_POST['reftorneo'];
	
	echo $serviciosUsuarios->login($email,$pass,$torneo);
}


function devolverImagen($nroInput) {
	
	if( $_FILES['archivo'.$nroInput]['name'] != null && $_FILES['archivo'.$nroInput]['size'] > 0 ){
	// Nivel de errores
	  error_reporting(E_ALL);
	  $altura = 100;
	  // Constantes
	  # Altura de el thumbnail en píxeles
	  //define("ALTURA", 100);
	  # Nombre del archivo temporal del thumbnail
	  //define("NAMETHUMB", "/tmp/thumbtemp"); //Esto en servidores Linux, en Windows podría ser:
	  //define("NAMETHUMB", "c:/windows/temp/thumbtemp"); //y te olvidas de los problemas de permisos
	  $NAMETHUMB = "c:/windows/temp/thumbtemp";
	  # Servidor de base de datos
	  //define("DBHOST", "localhost");
	  # nombre de la base de datos
	  //define("DBNAME", "portalinmobiliario");
	  # Usuario de base de datos
	  //define("DBUSER", "root");
	  # Password de base de datos
	  //define("DBPASSWORD", "");
	  // Mime types permitidos
	  $mimetypes = array("image/jpeg", "image/pjpeg", "image/gif", "image/png");
	  // Variables de la foto
	  $name = $_FILES["archivo".$nroInput]["name"];
	  $type = $_FILES["archivo".$nroInput]["type"];
	  $tmp_name = $_FILES["archivo".$nroInput]["tmp_name"];
	  $size = $_FILES["archivo".$nroInput]["size"];
	  // Verificamos si el archivo es una imagen válida
	  if(!in_array($type, $mimetypes))
		die("El archivo que subiste no es una imagen válida");
	  // Creando el thumbnail
	  switch($type) {
		case $mimetypes[0]:
		case $mimetypes[1]:
		  $img = imagecreatefromjpeg($tmp_name);
		  break;
		case $mimetypes[2]:
		  $img = imagecreatefromgif($tmp_name);
		  break;
		case $mimetypes[3]:
		  $img = imagecreatefrompng($tmp_name);
		  break;
	  }
	  
	  $datos = getimagesize($tmp_name);
	  
	  $ratio = ($datos[1]/$altura);
	  $ancho = round($datos[0]/$ratio);
	  $thumb = imagecreatetruecolor($ancho, $altura);
	  imagecopyresized($thumb, $img, 0, 0, 0, 0, $ancho, $altura, $datos[0], $datos[1]);
	  switch($type) {
		case $mimetypes[0]:
		case $mimetypes[1]:
		  imagejpeg($thumb, $NAMETHUMB);
			  break;
		case $mimetypes[2]:
		  imagegif($thumb, $NAMETHUMB);
		  break;
		case $mimetypes[3]:
		  imagepng($thumb, $NAMETHUMB);
		  break;
	  }
	  // Extrae los contenidos de las fotos
	  # contenido de la foto original
	  $fp = fopen($tmp_name, "rb");
	  $tfoto = fread($fp, filesize($tmp_name));
	  $tfoto = addslashes($tfoto);
	  fclose($fp);
	  # contenido del thumbnail
	  $fp = fopen($NAMETHUMB, "rb");
	  $tthumb = fread($fp, filesize($NAMETHUMB));
	  $tthumb = addslashes($tthumb);
	  fclose($fp);
	  // Borra archivos temporales si es que existen
	  //@unlink($tmp_name);
	  //@unlink(NAMETHUMB);
	} else {
		$tfoto = '';
		$type = '';
	}
	$tfoto = utf8_decode($tfoto);
	return array('tfoto' => $tfoto, 'type' => $type);	
}


?>