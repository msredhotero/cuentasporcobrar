<?php



function Factura($nrofactura,$url,$Aconceptos,$Acantidad,$Aimporte,$iva,$comentario,$proveedor) {



//PRIMER RECIBO

//Fin del primer recibo
$pdf->setTextColor(0,0,0);

if ($repite == 0) {
	//Fijos
	
		
		
		//cabecera del recibo
		
		//mes
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY($x1,$y1);
		$pdf->cell(8,4,$Mes,0,0,'C');
		
		//año
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY($x3,$y1);
		$pdf->cell(8,4,$Anio,0,0,'C');
		
		//legajo
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY($x4,$y1);
		$pdf->cell(14,4,$legajo,0,0,'C');
		
		//nro documento
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY($x6,$y1);
		$pdf->cell(8,4,substr($Cuil,2,8),0,0,'C');
		
		//apellido y nombre
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY($x7,$y1);
		$pdf->cell(100,4,$APEYNOM,0,0,'C');
		
		//fecha ingreso
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY($x17,$y1);
		$pdf->cell(12,4,$fechaingreso,0,0,'C');
		
		//segundo reglon
		
		//antiguedad
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY($x1,$y2);
		$pdf->cell(8,4,$Antiguedad,0,0,'C');
		
		//cuil
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY($x2,$y2);
		$pdf->cell(24,4,$Cuil,0,0,'C');
		
		//dependencia
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY($x5,$y2);
		$pdf->cell(80,4,$Dependencia,0,0,'C');
		
		//PROGRAMA
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY($x13,$y2);
		$pdf->cell(40,4,$programa,0,0,'C');
		
		//Grupo
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY($x15,$y2);
		$pdf->cell(8,4,$agrupamiento,0,0,'C');
		
		//Categoria
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY($x19,$y2);
		$pdf->cell(8,4,$categoria,0,0,'C');
		
		//FIN CABECERA
	
	
		//pie del recibo
		
		//RH
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY($x8 + 1,$y4);
		$pdf->cell(6,4,$RegHorario,0,0,'C');
		
		//sucrusal
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY($x10,$y4);
		$pdf->cell(8,4,$Sucursal,0,0,'C');
		
		//cta
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY($x12,$y4);
		$pdf->cell(20,4,$nrocuenta,0,0,'C');
		
		//liquido
		$pdf->SetFont('Arial','B',11);
		$pdf->SetXY($x14,$y4);
		$pdf->cell(30,4,$liquido,0,0,'C');
		
		
		//Numeración
		$pdf->SetFont('Arial','B',16);
		$pdf->SetXY($x3+15,$y4 - 4);
		$pdf->cell(25,4,"Nº ".str_pad((int) $numeracion,10 ,"0",STR_PAD_LEFT),0,0,'R');
		//$pdf->cell(25,4,"Nº 0000000000",0,0,'R');
		
		//Nota
		$pdf->SetFont('Arial','B',6);
		$pdf->SetXY($x3,$y4 - 11);
		$pdf->cell(160,4,"***El año 1996 no se computa para el pago de antiguedad.",0,0,'L');
		/*$pdf->cell(160,4,"***S. VIDA: Cód 286 y291 A PARTIR 01/01/2014 CAPITAL:190.000. COSTO MAX. $129,20 Cód 273 y 270 a 9. y 4. respectivamente. CONSULTAS TEL:0810-555-7348",0,0,'R');*/
		
		
		//FIN PIE
	
	//fin de fijos
	}
	
	//CONCEPTOS DEL RECIBO
		
		
		//ICONCEPTO
		$pdf->SetFont('Arial','',8);
		$pdf->SetXY($x1,$y3);
		$pdf->cell(68,3,substr($IConcepto,0,49),0,0,'L');
		
		//icantidad
		$pdf->SetFont('Arial','',8);
		$pdf->SetXY($x8 + 5,$y3);
		$pdf->cell(4,3,$ICantidad,0,0,'C');
		
		
		//iImporte
		$pdf->SetFont('Arial','',8);
		$pdf->SetXY($x9,$y3);
		$pdf->cell(15,3,$IImporte,0,0,'R');
		
		
		
		//DCONCEPTO
		$pdf->SetFont('Arial','',8);
		$pdf->SetXY($x11,$y3);
		$pdf->cell(68,3,substr($DConcepto,0,49),0,0,'L');
		
		//Dcantidad
		$pdf->SetFont('Arial','',8);
		$pdf->SetXY($x16 + 5,$y3);
		$pdf->cell(4,3,$DCantidad,0,0,'C');
		
		
		//DImporte
		$pdf->SetFont('Arial','',8);
		$pdf->SetXY($x18,$y3);
		$pdf->cell(15,3,$DImporte,0,0,'R');
		
		//FIN CONCEPTOS
	
	
	
}







?>