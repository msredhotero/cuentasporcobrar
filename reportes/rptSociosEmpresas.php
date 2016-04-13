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


$datos			=	$serviciosReportes->traerSocios();


class PDF extends FPDF
{
// Cargar los datos




// Tabla coloreada
function ingresosFacturacion($header, $data, &$TotalIngresos)
{
	$this->SetFont('Arial','',12);
	$this->Ln();
	$this->Ln();
	$this->Cell(60,7,'Socios-Empresas',0,0,'L',false);
	$this->SetFont('Arial','',11);
    // Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
	$this->Ln();
	
	
    // Cabecera
    $w = array(50,22,50,15,15,15,110);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],6,$header[$i],1,0,'C',true);
    $this->Ln();
    // Restauración de colores y fuentes
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Datos
    $fill = false;
	
	$totalcant = 0;
	
	$this->SetFont('Arial','',9);
    while ($row = mysql_fetch_array($data))
    {
		
		$totalcant = $totalcant + 1;
		
		//("Empresa", "Tipo Socio", "Nombre", "IFE","CURP", "RFC", "Domicilio");
        $this->Cell($w[0],5,$row['razonsocial'],'LR',0,'L',$fill);
		$this->Cell($w[1],5,$row['tiposocio'],'LR',0,'L',$fill);
        $this->Cell($w[2],5,$row['nombre'],'LR',0,'L',$fill);
		$this->Cell($w[3],5,$row['ife'],'LR',0,'C',$fill);
		$this->Cell($w[4],5,$row['curp'],'LR',0,'C',$fill);
		$this->Cell($w[5],5,$row['rfc'],'LR',0,'C',$fill);
		$this->Cell($w[6],5,substr($row['domicilio'],0,65),'LR',0,'L',$fill);
        $this->Ln();
        
		
		if ($totalcant == 25) {
			$this->AddPage();
			$this->SetFont('Arial','',11);
			// Colores, ancho de línea y fuente en negrita
			$this->SetFillColor(255,0,0);
			$this->SetTextColor(255);
			$this->SetDrawColor(128,0,0);
			$this->SetLineWidth(.3);
			for($i=0;$i<count($header);$i++)
				$this->Cell($w[$i],6,$header[$i],1,0,'C',true);
			$this->Ln();
			$this->SetFillColor(224,235,255);
			$this->SetTextColor(0);
			$this->SetFont('');
			// Datos
			$fill = false;
			$this->SetFont('Arial','',9);
		}
    }
	

	$fill = !$fill;
	$this->Cell(array_sum($w),0,'','T');
	
}

//Pie de página
function Footer()
{

$this->SetY(-10);

$this->SetFont('Arial','I',8);

$this->Cell(0,10,'Pagina '.$this->PageNo()." - Fecha: ".date('Y-m-d'),0,0,'C');
}
   
}






$pdf = new PDF("L");


// Títulos de las columnas

$headerFacturacion = array("Empresa", "Tipo Socio", "Nombre", "IFE","CURP", "RFC", "Domicilio");
// Carga de datos

$pdf->AddPage();

$pdf->SetFont('Arial','U',17);
$pdf->Cell(260,7,'Reporte Socios-Empresas',0,0,'C',false);


$pdf->SetFont('Arial','',10);

$pdf->ingresosFacturacion($headerFacturacion,$datos,$TotalFacturacion);

$pdf->Ln();



$pdf->SetFont('Arial','',13);

$nombreTurno = "rptSociosEmpresas-".$fecha.".pdf";

$pdf->Output($nombreTurno,'D');


?>

