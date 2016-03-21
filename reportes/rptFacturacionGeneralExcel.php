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

require_once '../excelClass/PHPExcel.php';

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


//$header = array("Hora", "Cancha 1", "Cancha 2", "Cancha 3");

$id				=	$_GET['id'];

//////////////////              PARA LAS FECHAS        /////////////////////////////////////////////////////////////////

$fechadesde		=	$_GET['fechadesde'];
$fechahasta		=	$_GET['fechahasta'];


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$resEmpresa		=	$serviciosEmpresas->traerEmpresasPorId($id);

$empresa		=	mysql_result($resEmpresa,0,1);

$datos			=	$serviciosReportes->rptFacturacionGeneralPorEmpresa($id,$fechadesde,$fechahasta);

$TotalIngresos = 0;
$TotalEgresos = 0;
$Totales = 0;
$Caja = 0;

// Crea un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();




$objPHPExcel->getProperties()
->setCreator("Exebin")
->setLastModifiedBy("Exebin")
->setTitle("Documento Excel")
->setSubject("Documento Excel")
->setDescription("Documento Excel Facturacion General.")
->setKeywords("Excel Office 2007 openxml php")
->setCategory("Excel");
 
$tituloReporte = "Reporte General de Facturación";
$tituloReporte2 = "Empresa: ".strtoupper($empresa); 
$tituloReporte3 = "Fecha: ".date('Y-m-d');
$titulosColumnas = array("Factura", "Cliente", "Referencia de Pago","Fecha", "Importe", "Abonos", "Saldo");

$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A1:G1');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A2:G2');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A3:G3');
	
	 
// Se agregan los titulos del reporte
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', htmlspecialchars(utf8_encode($tituloReporte))) // Titulo del reporte
	->setCellValue('A2', utf8_encode($tituloReporte2))
	->setCellValue('A3', utf8_encode($tituloReporte3)) // Titulo del reporte
    ->setCellValue('A4',  utf8_encode($titulosColumnas[0]))  //Titulo de las columnas
    ->setCellValue('B4',  utf8_encode($titulosColumnas[1]))
    ->setCellValue('C4',  utf8_encode($titulosColumnas[2]))
    ->setCellValue('D4',  $titulosColumnas[3])
	->setCellValue('E4',  $titulosColumnas[4])
    ->setCellValue('F4',  $titulosColumnas[5])
    ->setCellValue('G4',  $titulosColumnas[6]);


// Agregar Informacion
/*$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1', 'Valor 1')
->setCellValue('B1', 'Valor 2')
->setCellValue('C1', 'Total')
->setCellValue('A2', '10')
->setCellValue('C2', '=sum(A2:B2)');*/

$i = 5; //Numero de fila donde se va a comenzar a rellenar
 while ($fila = mysql_fetch_array($datos)) {
     $objPHPExcel->setActiveSheetIndex(0)
         ->setCellValue('A'.$i, utf8_encode($fila[0]))
         ->setCellValue('B'.$i, utf8_encode($fila[1]))
         ->setCellValue('C'.$i, utf8_encode($fila[2]))
         ->setCellValue('D'.$i, $fila[3])
		 ->setCellValue('E'.$i, $fila[4])
         ->setCellValue('F'.$i, $fila[5])
         ->setCellValue('G'.$i, $fila[6]);
     $i++;
 }

$estiloTituloReporte = array(
    'font' => array(
        'name'      => 'Verdana',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' =>16,
        'color'     => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
        'type'  => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array(
            'argb' => '0B87A9')
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_MEDIUM
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
);
 
$estiloTituloColumnas = array(
    'font' => array(
        'name'  => 'Arial',
        'bold'  => true,
        'color' => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
        'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
    'rotation'   => 90,
        'startcolor' => array(
            'rgb' => '1ACEFF'
        ),
        'endcolor' => array(
            'argb' => '0AA3CE'
        )
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
            'color' => array(
                'rgb' => '143860'
            )
        ),
        'bottom' => array(
            'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
            'color' => array(
                'rgb' => '143860'
            )
        )
    ),
    'alignment' =>  array(
        'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'wrap'      => TRUE
    )
);
 
$estiloInformacion = new PHPExcel_Style();
$estiloInformacion->applyFromArray( array(
    'font' => array(
        'name'  => 'Arial',
        'color' => array(
            'rgb' => '000000'
        )
    ),
    'fill' => array(
    'type'  => PHPExcel_Style_Fill::FILL_SOLID,
    'color' => array(
            'argb' => 'B8FEFF')
    ),
    'borders' => array(
        'left' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN ,
        'color' => array(
                'rgb' => '2A4348'
            )
        )
    )
));

$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($estiloTituloReporte);
$objPHPExcel->getActiveSheet()->getStyle('A2:G2')->applyFromArray($estiloTituloReporte);
$objPHPExcel->getActiveSheet()->getStyle('A3:G3')->applyFromArray($estiloTituloReporte);
$objPHPExcel->getActiveSheet()->getStyle('A4:G4')->applyFromArray($estiloTituloColumnas);

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Hoja1');
 
// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);
 
// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=utf-8');
header('Content-Disposition: attachment;filename="rptFacturacionGeneral.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;





















 } 

