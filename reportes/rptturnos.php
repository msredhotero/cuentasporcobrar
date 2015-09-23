<?php

date_default_timezone_set('America/Buenos_Aires');
require '../includes/funcionesProductos.php';
require '../includes/funcionesTurnos.php';
require '../includes/funcionesConfiguraciones.php';

$serviciosProductos = new ServiciosProductos();
$serviciosTurnos	= new ServiciosTurnos();
$serviciosConfiguraciones = new ServiciosConfiguraciones();

$resCanchas = $serviciosTurnos->traerCanchas();
$resClientes= $serviciosTurnos->traerClientes();
$resTurnos = $serviciosTurnos->traerTurnos();

$fecha = $_GET['fecha'];

if ($fecha == '') {
	$fecha = date('Y-m-d');
}

$resPrimerUltimoTurno = $serviciosTurnos->traerPrimerUltimoTurno($fecha);


require('fpdf.php');

//$header = array("Hora", "Cancha 1", "Cancha 2", "Cancha 3");

class PDF extends FPDF
{
// Cargar los datos


// Tabla coloreada
function FancyTable($header, $data, $serviciosTurnos, $fecha)
{
	
	$this->Cell(60,7,'Fecha:'.$fecha,0,0,'C',false);
	$this->Ln();
    // Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
	
	
	
    // Cabecera
    $w = array(25, 53, 53, 53);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();
    // Restauración de colores y fuentes
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Datos
    $fill = false;
    for($i=mysql_result($data,0,0);$i<=mysql_result($data,0,1);$i++)
    {
		$turno1 = "";
		$turno2 = "";
		$turno3 = "";
		$cancha1 = $serviciosTurnos->traerTurnosPorDiaCanchaFecha($fecha,$i,1);
		$cancha2 = $serviciosTurnos->traerTurnosPorDiaCanchaFecha($fecha,$i,2);
		$cancha3 = $serviciosTurnos->traerTurnosPorDiaCanchaFecha($fecha,$i,3);
		if (mysql_num_rows($cancha1)>0) {
			$turno1 = mysql_result($cancha1,0,0);
		}
		if (mysql_num_rows($cancha2)>0) {
			$turno2 = mysql_result($cancha2,0,0);
		}
		if (mysql_num_rows($cancha3)>0) {
			$turno3 = mysql_result($cancha3,0,0);
		}

        $this->Cell($w[0],6,$i.":00",'LR',0,'C',$fill);
		$this->Cell($w[1],6,$turno1,'LR',0,'L',$fill);
        $this->Cell($w[2],6,$turno2,'LR',0,'L',$fill);
        $this->Cell($w[3],6,$turno3,'LR',0,'L',$fill);
        $this->Ln();
        $fill = !$fill;
    }
    // Línea de cierre
    $this->Cell(array_sum($w),0,'','T');
}
}

$pdf = new PDF();
$pdf->SetFont('Arial','',10);
// Títulos de las columnas
$header = array("Hora", "Cancha 1( -15 min)", "Cancha 2( 0 min)", "Cancha 3( 15 min)");
// Carga de datos
$data = $resPrimerUltimoTurno;


$pdf->AddPage();
$pdf->FancyTable($header,$data,$serviciosTurnos, $fecha);

$nombreTurno = "Turno-".$fecha.".pdf";

$pdf->Output($nombreTurno,'D');


?>

