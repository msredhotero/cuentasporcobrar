<?php

session_start();

if (!isset($_SESSION['usua_predio']))
{
	header('Location: ../../error.php');
} else {
	
date_default_timezone_set('America/Buenos_Aires');

include ('../includes/funcionesUsuarios.php');
include ('../includes/funciones.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funcionesClientes.php');
include ('../includes/funcionesEmpresas.php');
include ('../includes/funcionesEmpresaClientes.php');
include ('../includes/funcionesFacturas.php');
include ('../includes/funcionesPagos.php');
include ('../includes/funcionesReportes.php');


$serviciosUsuarios  		= new ServiciosUsuarios();
$serviciosFunciones 		= new Servicios();
$serviciosHTML				= new ServiciosHTML();
$serviciosClientes 			= new ServiciosClientes();
$serviciosEmpresas			= new ServiciosEmpresas();
$serviciosEmpresaClientes 	= new ServiciosEmpresaClientes();
$serviciosFacturas			= new ServiciosFacturas();
$serviciosPagos				= new ServiciosPagos();
$serviciosReportes			= new ServiciosReportes();

$fecha = date('Y-m-d');

require('fpdf.php');

//$header = array("Hora", "Cancha 1", "Cancha 2", "Cancha 3");

//$idEmpresa		=	$_GET['idEmp'];

//$resEmpresa		=	$serviciosEmpresas->traerEmpresasPorId($idEmpresa);

//$empresa		=	mysql_result($resEmpresa,0,1);

$idEmpresa = 0;

$datos			=	$serviciosReportes->rptSaldoEmpresa($idEmpresa);

$TotalIngresos = 0;
$TotalEgresos = 0;
$Totales = 0;
$Caja = 0;


function query($sql,$accion) {
		
		
		require_once '../../includes/appconfig.php';

		$appconfig	= new appconfig();
		$datos		= $appconfig->conexion();
		$hostname	= $datos['hostname'];
		$database	= $datos['database'];
		$username	= $datos['username'];
		$password	= $datos['password'];
        

		
		$conex = mysql_connect($hostname,$username,$password) or die ("no se puede conectar".mysql_error());
		
		mysql_select_db($database);
		/*
		$result = mysql_query($sql,$conex);
		if ($accion && $result) {
			$result = mysql_insert_id();
		}
		mysql_close($conex);
		return $result;
		*/
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
	
	

	
	
	$tituloReporte = "<h2>Reporte Saldos de Clientes</h2>";
	$tituloReporte3 = "<h3>Fecha: ".date('Y-m-d')."</h3>"; 

	$titulosColumnas = array("Nombre", "Cargos", "Abonos", "Saldo");
	// Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte

	
	
	if ($datos == false) {
		return 'Error al traer datos';
	} else {
		$cad = '<table id="Exportar_a_Excel">
					<tr>
						<th colspan="7">'.$tituloReporte.'</th>
					</tr>
					<tr>
						<th colspan="7">'.$tituloReporte3.'</th>
					</tr>
					<tr>
						<th style="background-color:#ababab;">Nombre</th>
						<th style="background-color:#ababab;">Cargos</th>
						<th style="background-color:#ababab;">Abonos</th>
						<th style="background-color:#ababab;">Saldo</th>
					</tr>';
		$i = 4; //Numero de fila donde se va a comenzar a rellenar
		 while ($fila = mysql_fetch_array($datos)) {

			 $i++;
			 $cad .= '<tr>';
			 $cad .= '<td>'.$fila[0].'</td>';
			 $cad .= '<td>'.str_replace(".",",",$fila[1]).'</td>';
			 $cad .= '<td>'.str_replace(".",",",$fila[2]).'</td>';
			 $cad .= '<td>'.str_replace(".",",",$fila[3]).'</td>';
			 $cad .= '</tr>';
		 }
		$cad .= '</table>';
	
	
}
?>

<!DOCTYPE HTML>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">



<title>Gestión: Facturación - Cuentas Por Cobrar</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style type="text/css">
		table {  color: #333; font-family: Helvetica, Arial, sans-serif; width: 640px; border-collapse: collapse;}
td, th { border: 1px solid #333; height: 30px; }
th { background: #D3D3D3; font-weight: bold; }
td { background: #FAFAFA; text-align: center; }
tr:nth-child(even) td { background: #F1F1F1; }  
tr:nth-child(odd) td { background: #FEFEFE; } 
tr td:hover { background: #666; color: #FFF; }
  
		
	</style>
    
    </head>

<body>
<?php 

header("Content-type: application/vnd.ms-excel; name='excel'");
		header("Content-Disposition: filename=rptSaldosEmpresaExcel.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		
		echo $cad; ?>
</body>
</html>
<?php } ?>

