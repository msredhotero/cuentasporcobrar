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

$fecha = date('Y-m-d');

$data = $serviciosTurnos->traerPrimerUltimoTurno(date('Y-m-d'));


require('fpdf.php');

$header = array("Hora", "Cancha 1", "Cancha 2", "Cancha 3");

class PDF extends FPDF
{
// Cargar los datos


// Tabla coloreada
function FancyTable($header, $data)
{
    // Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Cabecera
    $w = array(40, 35, 45, 40);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();
    // Restauración de colores y fuentes
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Datos
    $fill = false;
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
        $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
        $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
        $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
        $this->Ln();
        $fill = !$fill;
    }
    // Línea de cierre
    $this->Cell(array_sum($w),0,'','T');
}
}

$pdf = new PDF();
// Títulos de las columnas
$header = array('País', 'Capital', 'Superficie (km2)', 'Pobl. (en miles)');
// Carga de datos
$data = $pdf->LoadData('paises.txt');
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->BasicTable($header,$data);
$pdf->AddPage();
$pdf->ImprovedTable($header,$data);
$pdf->AddPage();
$pdf->FancyTable($header,$data);
$pdf->Output();


?>

