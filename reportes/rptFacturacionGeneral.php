<?php

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

$id				=	$_GET['id'];

$resEmpresa		=	$serviciosEmpresas->traerEmpresasPorId($id);

$empresa		=	mysql_result($resEmpresa,0,1);

$datos			=	$serviciosReportes->rptFacturacionGeneralPorEmpresa($id);

$TotalIngresos = 0;
$TotalEgresos = 0;
$Totales = 0;
$Caja = 0;



class PDF extends FPDF
{
// Cargar los datos




// Tabla coloreada
function ingresosFacturacion($header, $data, &$TotalIngresos)
{
	$this->SetFont('Arial','',12);
	$this->Ln();
	$this->Ln();
	$this->Cell(60,7,'Facturaci�n General',0,0,'L',false);
	$this->SetFont('Arial','',10);
    // Colores, ancho de l�nea y fuente en negrita
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
	$this->Ln();
	
	
    // Cabecera
    $w = array(20,65,20,18,25,25,25);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],6,$header[$i],1,0,'C',true);
    $this->Ln();
    // Restauraci�n de colores y fuentes
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Datos
    $fill = false;
	
	$total = 0;
	$totalcant = 0;
	
	$this->SetFont('Arial','',8);
    while ($row = mysql_fetch_array($data))
    {
		$total = $total + $row[4];
		$totalcant = $totalcant + 1;
		
        $this->Cell($w[0],4,$row[0],'LR',0,'L',$fill);
		$this->Cell($w[1],4,$row[1],'LR',0,'L',$fill);
        $this->Cell($w[2],4,$row[2],'LR',0,'C',$fill);
		$this->Cell($w[3],4,$row[3],'LR',0,'C',$fill);
		$this->Cell($w[4],4,number_format($row[4],2,',','.'),'LR',0,'R',$fill);
		$this->Cell($w[5],4,number_format($row[5],2,',','.'),'LR',0,'R',$fill);
		$this->Cell($w[6],4,number_format($row[6],2,',','.'),'LR',0,'R',$fill);
        $this->Ln();
        $fill = !$fill;
    }
	
    // L�nea de cierre
    $this->Cell(array_sum($w),0,'','T');
	$this->SetFont('Arial','',12);
	$this->Ln();
	$this->Ln();
	$this->Cell(60,7,'Cantidad de Facturas: '.$totalcant,0,0,'L',false);
	$this->Ln();
	$this->Cell(60,7,'Total: $'.number_format($total, 2, '.', ','),0,0,'L',false);
	
	$TotalIngresos = $TotalIngresos + $total;
}

}






$pdf = new PDF();


// T�tulos de las columnas

$headerFacturacion = array("Factura", "Cliente", "Referencia","Fecha", "Importe", "Abonos", "Saldo");
// Carga de datos

$pdf->AddPage();

$pdf->SetFont('Arial','U',17);
$pdf->Cell(180,7,'Reporte General de Facturaci�n',0,0,'C',false);
$pdf->Ln();
$pdf->SetFont('Arial','U',14);
$pdf->Cell(180,7,"Empresa: ".strtoupper($empresa),0,0,'C',false);
$pdf->Ln();
$pdf->Cell(180,7,'Fecha: '.date('Y-m-d'),0,0,'C',false);
$pdf->Ln();

$pdf->SetFont('Arial','',10);

$pdf->ingresosFacturacion($headerFacturacion,$datos,$TotalFacturacion);

$pdf->Ln();

$pdf->SetFont('Arial','',13);

$nombreTurno = "rptFacturacionGeneral-".$fecha.".pdf";

$pdf->Output($nombreTurno,'D');


?>

