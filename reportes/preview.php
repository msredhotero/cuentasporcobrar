<?php

date_default_timezone_set('America/Panama');

include ('../includes/funcionesUsuarios.php');
include ('../includes/funciones.php');


$serviciosUsuarios  = new ServiciosUsuarios();
$servicios			= new Servicios();

$fecha = date('Y-m-d');

require('fpdf.php');

$resPeliculas = $servicios->TraerTodasPeliculas();



class PDF extends FPDF
{

	
}







$pdf = new PDF('L');



$pdf->AddPage();

$pdf->Image('../imagenes/CINE-01.jpg','0','0','297','210','JPG');

//para la cartelera de arriba//
$pdf->SetTextColor(255,255,255);
$pdf->SetFont('Arial','',10);
$pdf->SetXY(44,53.2);
$pdf->Cell(30.5,12,'Depredador',0,0,'C',false);

$pdf->SetTextColor(35,31,32);
$pdf->SetFont('Arial','',9);
$pdf->SetXY(44,40);
$pdf->Cell(30.5,4,'Numero de Sala: 1',0,0,'C',false);

$pdf->SetTextColor(35,31,32);
$pdf->SetFont('Arial','',9);
$pdf->SetXY(46,45);
$pdf->Cell(26,4,'Categoria',0,0,'C',false);

$pdf->SetTextColor(255,255,255);
$pdf->SetFont('Arial','',12);
$pdf->SetXY(46,58.2);
$pdf->Cell(26,5,'08:00 am',0,0,'C',false);



// mas 70.5

$pdf->SetFont('Arial','',10);
$pdf->SetXY(114.5,53.2);
$pdf->Cell(30.5,12,'Depredador',0,0,'C',false);

$pdf->SetTextColor(35,31,32);
$pdf->SetFont('Arial','',9);
$pdf->SetXY(114.5,40);
$pdf->Cell(30.5,4,'Numero de Sala: 1',0,0,'C',false);

$pdf->SetTextColor(35,31,32);
$pdf->SetFont('Arial','',9);
$pdf->SetXY(116.5,45);
$pdf->Cell(26,4,'Categoria',0,0,'C',false);






$pdf->SetFont('Arial','',10);
$pdf->SetXY(185,53.2);
$pdf->Cell(30.5,12,'Depredador',0,0,'C',false);

$pdf->SetTextColor(35,31,32);
$pdf->SetFont('Arial','',9);
$pdf->SetXY(185,40);
$pdf->Cell(30.5,4,'Numero de Sala: 1',0,0,'C',false);

$pdf->SetTextColor(35,31,32);
$pdf->SetFont('Arial','',9);
$pdf->SetXY(187,45);
$pdf->Cell(26,4,'Categoria',0,0,'C',false);





$pdf->SetFont('Arial','',10);
$pdf->SetXY(255.5,53.2);
$pdf->Cell(30.5,12,'Depredador',0,0,'C',false);

$pdf->SetTextColor(35,31,32);
$pdf->SetFont('Arial','',9);
$pdf->SetXY(255.5,40);
$pdf->Cell(30.5,4,'Numero de Sala: 1',0,0,'C',false);

$pdf->SetTextColor(35,31,32);
$pdf->SetFont('Arial','',9);
$pdf->SetXY(257.5,45);
$pdf->Cell(26,4,'Categoria',0,0,'C',false);

// fin de l cartelra de arriba //

//para la cartelera de abajo//
$pdf->SetFont('Arial','',10);
$pdf->SetXY(44,117);
$pdf->Cell(30.5,12,'Depredador',0,0,'C',false);







$pdf->SetFont('Arial','',10);
$pdf->SetXY(114.5,117);
$pdf->Cell(30.5,12,'Depredador',0,0,'C',false);







$pdf->SetFont('Arial','',10);
$pdf->SetXY(185,117);
$pdf->Cell(30.5,12,'Depredador',0,0,'C',false);






$pdf->SetFont('Arial','',10);
$pdf->SetXY(255.5,117);
$pdf->Cell(30.5,12,'Depredador',0,0,'C',false);


// fin de l cartelra de abajo //







/*
$pdf->SetFont('Arial','U',15);
$pdf->Cell(180,7,'Reporte: Caja Diaria',0,0,'C',false);
$pdf->Ln();

$pdf->SetFont('Arial','',10);


$pdf->ingresosCanchas($header,$resIngresosCanchas,$TotalIngresos);

$pdf->ingresosVentas($headerVentas,$resIngresosVentas,$TotalIngresos,$TotalEgresos);

$pdf->ingresosFiestas($headerFiestas,$resIngresosFiestas,$TotalIngresos);

$pdf->Ln();

$pdf->SetFont('Arial','',13);

$pdf->Ln();
$pdf->Cell(60,7,'Importe Ingresos:'.number_format($TotalIngresos, 2, '.', ','),0,0,'L',false);
$pdf->Ln();
$pdf->Cell(60,7,'Importe Egresos: $'.number_format($TotalEgresos, 2, '.', ','),0,0,'L',false);
$pdf->Ln();
$pdf->Cell(60,7,'Importe Total:'.number_format(($TotalIngresos + $TotalEgresos), 2, '.', ','),0,0,'L',false);
$pdf->Ln();
$pdf->Cell(60,7,'Caja: $'.number_format(($TotalIngresos - $TotalEgresos), 2, '.', ','),0,0,'L',false);
*/

$nombreTurno = "Caja-".$fecha.".pdf";

$pdf->Output($nombreTurno,'D');


?>

