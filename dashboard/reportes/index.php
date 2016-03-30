<?php


session_start();

if (!isset($_SESSION['usua_predio']))
{
	header('Location: ../../error.php');
} else {


include ('../../includes/funcionesUsuarios.php');
include ('../../includes/funciones.php');
include ('../../includes/funcionesHTML.php');
include ('../../includes/funcionesClientes.php');
include ('../../includes/funcionesEmpresas.php');
include ('../../includes/funcionesFacturas.php');
include ('../../includes/funcionesPagos.php');

$serviciosUsuarios  = new ServiciosUsuarios();
$serviciosFunciones = new Servicios();
$serviciosHTML		= new ServiciosHTML();
$serviciosClientes 	= new ServiciosClientes();
$serviciosEmpresas	= new ServiciosEmpresas();
$serviciosFacturas	= new ServiciosFacturas();
$serviciosPagos		= new ServiciosPagos();

$fecha = date('Y-m-d');

//$resProductos = $serviciosProductos->traerProductosLimite(6);
$resMenu = $serviciosHTML->menu(utf8_encode($_SESSION['nombre_predio']),"Reportes",$_SESSION['refroll_predio'],utf8_encode($_SESSION['usua_empresa']));


$resEmpresas		=	$serviciosEmpresas->traerEmpresas();

$resClientes		=	$serviciosClientes->traerClientes();

$cadRef = '';
while ($rowTT = mysql_fetch_array($resClientes)) {
	$cadRef = $cadRef.'<option value="'.$rowTT[0].'">'.utf8_encode($rowTT[1]).'</option>';
	
}

$cadRefE = '';
while ($rowTTE = mysql_fetch_array($resEmpresas)) {
	$cadRefE = $cadRefE.'<option value="'.$rowTTE[0].'">'.utf8_encode($rowTTE[1]).'</option>';
	
}


if ($_SESSION['idroll_predio'] == 2) {
	header('Location: ../index.php');
} else {

	
}


?>

<!DOCTYPE HTML>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">



<title>Gestión: Facturación - Cuentas Por Cobrar</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<link href="../../css/estiloDash.css" rel="stylesheet" type="text/css">
    

    
    <script type="text/javascript" src="../../js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" href="../../css/jquery-ui.css">

    <script src="../../js/jquery-ui.js"></script>
    
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../../css/bootstrap-datetimepicker.min.css">
	<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <!-- Latest compiled and minified JavaScript -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>

	<style type="text/css">

		
	</style>
    
   
   <link href="../../css/perfect-scrollbar.css" rel="stylesheet">
      <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
      <script src="../../js/jquery.mousewheel.js"></script>
      <script src="../../js/perfect-scrollbar.js"></script>
      <script>
      jQuery(document).ready(function ($) {
        "use strict";
        $('#navigation').perfectScrollbar();
      });
    </script>
</head>

<body>

 <?php echo $resMenu; ?>

<div id="content">

<h3>Reportes</h3>

    <div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Reporte General de Facturación</p>
        	
        </div>
    	<div class="cuerpoBox">
        	<form class="form-inline formulario" role="form">
        	<div class="row">
            	<div class="form-group col-md-6">
                    <label class="control-label" style="text-align:left" for="refcliente">Seleccione la Empresa</label>
                    <div class="input-group col-md-12">
                    	<select id="refempresa1" class="form-control" name="refempresa1">
							<?php echo $cadRefE; ?>
                    	</select>
                    </div>
                </div>
                
                <div class="form-group col-md-3">
                    <label for="'.$campo.'" class="control-label" style="text-align:left">Fecha Desde</label>
                    <div class="input-group col-md-12">
                        <input class="form-control" type="text" name="fechadesde1" id="fechadesde1" value="Date"/>
                    </div>
                </div>
                
                <div class="form-group col-md-3">
                    <label for="'.$campo.'" class="control-label" style="text-align:left">Fecha Hasta</label>
                    <div class="input-group col-md-12">
                        <input class="form-control" type="text" name="fechahasta1" id="fechahasta1" value="Date"/>
                    </div>
                </div>
                
                <div class="form-group col-md-6">
                    <label class="control-label" style="text-align:left" for="refcliente">Acción</label>

                    	<ul class="list-inline">
                        	<li>
                    			<button type="button" class="btn btn-success" id="rptgf" style="margin-left:0px;">Generar</button>
                            </li>
                            <li>
                        		<button type="button" class="btn btn-default" id="rptgfExcel" style="margin-left:0px;">Generar Excel</button>
                            </li>
                        </ul>

                </div>
                

            </div>
            
            
            <div class='row' style="margin-left:25px; margin-right:25px;">
                <div class='alert'>
                
                </div>
                <div id='load'>
                
                </div>
            </div>

            </form>
    	</div>
    </div>
    
    <div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Reporte de Saldos de Clientes</p>
        	
        </div>
    	<div class="cuerpoBox">
        	<form class="form-inline formulario" role="form">
        	<div class="row">
            	<div class="form-group col-md-6">
                    <label class="control-label" style="text-align:left" for="refcliente">Seleccione la Empresa</label>
                    <div class="input-group col-md-12">
                    	<select id="refempresa2" class="form-control" name="refempresa2">
							<option value="0">-------Seleccione-------</option>
							<?php echo $cadRefE; ?>
                    	</select>
                    </div>
                </div>
                
                <div class="form-group col-md-3">
                    <label for="'.$campo.'" class="control-label" style="text-align:left">Fecha Desde</label>
                    <div class="input-group col-md-12">
                        <input class="form-control" type="text" name="fechadesde2" id="fechadesde2" value="Date"/>
                    </div>
                </div>
                
                <div class="form-group col-md-3">
                    <label for="'.$campo.'" class="control-label" style="text-align:left">Fecha Hasta</label>
                    <div class="input-group col-md-12">
                        <input class="form-control" type="text" name="fechahasta2" id="fechahasta2" value="Date"/>
                    </div>
                </div>
                
                <div class="form-group col-md-6">
                    <label class="control-label" style="text-align:left" for="refcliente">Acción</label>

                    <ul class="list-inline">
                        <li>
                            <button type="button" class="btn btn-success" id="rptsc" style="margin-left:0px;">Generar</button>
                        </li>
                        <li>
                            <button type="button" class="btn btn-default" id="rptscExcel" style="margin-left:0px;">Generar Excel</button>
                        </li>
                    </ul>
                </div>
            </div>
            
            
            <div class='row' style="margin-left:25px; margin-right:25px;">
                <div class='alert'>
                
                </div>
                <div id='load'>
                
                </div>
            </div>

            </form>
    	</div>
    </div>
    
    
    <div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Reporte de Estado de Cuenta de Clientes</p>
        	
        </div>
    	<div class="cuerpoBox">
        	<form class="form-inline formulario" role="form">
        	<div class="row">
            	<div class="form-group col-md-6">
                    <label class="control-label" style="text-align:left" for="refcliente">Seleccione la Empresa</label>
                    <div class="input-group col-md-12">
                    	<select id="refempresa4" class="form-control" name="refempresa4">
							<option value="0">-------Seleccione-------</option>
							<?php echo $cadRefE; ?>
                    	</select>
                    </div>
                </div>
                
            	<div class="form-group col-md-6">
                    <label class="control-label" style="text-align:left" for="refcliente">Seleccione el Cliente</label>
                    <div class="input-group col-md-12">
                    	<select id="refcliente1" class="form-control" name="refcliente1">
							
                    	</select>
                    </div>
                </div>
                
                <div class="form-group col-md-3">
                    <label for="'.$campo.'" class="control-label" style="text-align:left">Fecha Desde</label>
                    <div class="input-group col-md-12">
                        <input class="form-control" type="text" name="fechadesde3" id="fechadesde3" value="Date"/>
                    </div>
                </div>
                
                <div class="form-group col-md-3">
                    <label for="'.$campo.'" class="control-label" style="text-align:left">Fecha Hasta</label>
                    <div class="input-group col-md-12">
                        <input class="form-control" type="text" name="fechahasta3" id="fechahasta3" value="Date"/>
                    </div>
                </div>
                
                <div class="form-group col-md-6">
                    <label class="control-label" style="text-align:left" for="refcliente">Acción</label>
                    <ul class="list-inline">
                        <li>
                            <button type="button" class="btn btn-success" id="rptscc" style="margin-left:0px;">Generar</button>
                        </li>
                        <li>
                            <button type="button" class="btn btn-default" id="rptsccExcel" style="margin-left:0px;">Generar Excel</button>
                        </li>
                    </ul>
                </div>
                
                

            </div>
            
            
            <div class='row' style="margin-left:25px; margin-right:25px;">
                <div class='alert'>
                
                </div>
                <div id='load'>
                
                </div>
            </div>

            </form>
    	</div>
    </div>
    
    
    <div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Reporte por Empresa</p>
        	
        </div>
    	<div class="cuerpoBox">
        	<form class="form-inline formulario" role="form">
        	<div class="row">
            	<!--<div class="form-group col-md-6">
                    <label class="control-label" style="text-align:left" for="refcliente">Seleccione la Empresa</label>
                    <div class="input-group col-md-12">
                    	<select id="refempresa3" class="form-control" name="refempresa3">
							<option value="0">-------Seleccione-------</option>
							<?php //echo $cadRefE; ?>
                    	</select>
                    </div>
                </div>-->
                
                <div class="form-group col-md-3">
                    <label for="'.$campo.'" class="control-label" style="text-align:left">Fecha Desde</label>
                    <div class="input-group col-md-12">
                        <input class="form-control" type="text" name="fechadesde4" id="fechadesde4" value="Date"/>
                    </div>
                </div>
                
                <div class="form-group col-md-3">
                    <label for="'.$campo.'" class="control-label" style="text-align:left">Fecha Hasta</label>
                    <div class="input-group col-md-12">
                        <input class="form-control" type="text" name="fechahasta4" id="fechahasta4" value="Date"/>
                    </div>
                </div>
                
                <div class="form-group col-md-6">
                    <label class="control-label" style="text-align:left" for="refcliente">Acción</label>
                    <ul class="list-inline">
                        <li>
                            <button type="button" class="btn btn-success" id="rptcc" style="margin-left:0px;">Generar</button>
                        </li>
                        <li>
                            <button type="button" class="btn btn-default" id="rptccExcel" style="margin-left:0px;">Generar Excel</button>
                        </li>
                    </ul>

                </div>
            </div>
            
            
            <div class='row' style="margin-left:25px; margin-right:25px;">
                <div class='alert'>
                
                </div>
                <div id='load'>
                
                </div>
            </div>

            </form>
    	</div>
    </div>
    
    
    
    <div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Reporte de Estado de Cuenta de Cliente a las Empresas</p>
        	
        </div>
    	<div class="cuerpoBox">
        	<form class="form-inline formulario" role="form">
        	<div class="row">

                
            	<div class="form-group col-md-6">
                    <label class="control-label" style="text-align:left" for="refcliente">Seleccione el Cliente</label>
                    <div class="input-group col-md-12">
                    	<select id="refcliente5" class="form-control" name="refcliente5">
							<?php echo $cadRef; ?>
                    	</select>
                    </div>
                </div>
                
                <div class="form-group col-md-3">
                    <label for="'.$campo.'" class="control-label" style="text-align:left">Fecha Desde</label>
                    <div class="input-group col-md-12">
                        <input class="form-control" type="text" name="fechadesde5" id="fechadesde5" value="Date"/>
                    </div>
                </div>
                
                <div class="form-group col-md-3">
                    <label for="'.$campo.'" class="control-label" style="text-align:left">Fecha Hasta</label>
                    <div class="input-group col-md-12">
                        <input class="form-control" type="text" name="fechahasta5" id="fechahasta5" value="Date"/>
                    </div>
                </div>
                
                <div class="form-group col-md-6">
                    <label class="control-label" style="text-align:left" for="refcliente">Acción</label>
                    <ul class="list-inline">
                        <li>
                            <button type="button" class="btn btn-success" id="rpt5" style="margin-left:0px;">Generar</button>
                        </li>
                        <li>
                            <button type="button" class="btn btn-default" id="rpt5Excel" style="margin-left:0px;">Generar Excel</button>
                        </li>
                    </ul>
                </div>
                
                

            </div>
            
            
            <div class='row' style="margin-left:25px; margin-right:25px;">
                <div class='alert'>
                
                </div>
                <div id='load'>
                
                </div>
            </div>

            </form>
    	</div>
    </div>
    
    
    <div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Reporte Listado de Socios y Empresas</p>
        	
        </div>
    	<div class="cuerpoBox">
        	<form class="form-inline formulario" role="form">
        	<div class="row">

                
            	<div class="form-group col-md-6">
                    <label class="control-label" style="text-align:left" for="refcliente">Seleccione el Cliente</label>
                    <div class="input-group col-md-12">
                    	<select id="refcliente5" class="form-control" name="refcliente5">
							<?php echo $cadRef; ?>
                    	</select>
                    </div>
                </div>
                

                
                <div class="form-group col-md-6">
                    <label class="control-label" style="text-align:left" for="refcliente">Acción</label>
                    <ul class="list-inline">
                        <li>
                            <button type="button" class="btn btn-success" id="rpt5" style="margin-left:0px;">Generar</button>
                        </li>
                        <li>
                            <button type="button" class="btn btn-default" id="rpt5Excel" style="margin-left:0px;">Generar Excel</button>
                        </li>
                    </ul>
                </div>
                
                

            </div>
            
            
            <div class='row' style="margin-left:25px; margin-right:25px;">
                <div class='alert6'>
                
                </div>
                <div id='load6'>
                
                </div>
            </div>

            </form>
    	</div>
    </div>
    

    
    
   
</div>


</div>

<script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
<script src="../../bootstrap/js/dataTables.bootstrap.js"></script>
<script src="../../js/bootstrap-datetimepicker.min.js"></script>
<script src="../../js/bootstrap-datetimepicker.es.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	
	function traerClientesPorEmpresa(idEmpresa) {
		$.ajax({
				data:  {idEmpresa: idEmpresa,
						accion: 'traerClientesPorEmpresa'},
				url:   '../../ajax/ajax.php',
				type:  'post',
				beforeSend: function () {
						
				},
				success:  function (response) {
						$('#refcliente1').html(response);
						
				}
		});
	}
	
	$('#refempresa4').change(function(e) {
		traerClientesPorEmpresa($(this).val());	
	});
	
/*
	function traerFacturas() {
		
		$.ajax({
				data:  {refcliente: $('#refcliente').val(),
						refempresa: <?php echo $_SESSION['usua_idempresa']; ?>,
						forma: 'check',
						accion: 'traerFacturasPorClienteEmpresa'},
				url:   '../../ajax/ajax.php',
				type:  'post',
				beforeSend: function () {
						
				},
				success:  function (response) {
						$('.lstFacturas').html(response);
						
				}
		});
	}
	
	function traerFacturasPorId(id, operacion) {
		
		$.ajax({
				data:  {idfactura: id.replace('factura',''), 
						accion: 'traerMontoFacturasPorId'},
				url:   '../../ajax/ajax.php',
				type:  'post',
				beforeSend: function () {
						
				},
				success:  function (response) {
					
					datos = response.split("|");
					
					if (operacion == 0) {
						$('#total').val(parseFloat($('#total').val()) + parseFloat(datos[0]));
						$('#saldo').val(parseFloat($('#saldo').val()) +  parseFloat(datos[1]));
					} else {
						$('#total').val(parseFloat($('#total').val() - parseFloat(datos[0])));
						$('#saldo').val(parseFloat($('#saldo').val() - parseFloat(datos[1])));
					}
					
					
						
				}
		});
	}
	
	$(".lstFacturas").on("click",'.lstcheck', function(){
		usersid =  $(this).attr("id");
		if ($(this).is(':checked')) {
			traerFacturasPorId(usersid,0);
		} else {
			traerFacturasPorId(usersid,1);
		}
	});  */
	//fin de los check
/*
	$('#refcliente').change( function() {
		$('#total').val(0);
		traerFacturas();
		
	});*/
	
	$("#rptgf").click(function(event) {
        window.open("../../reportes/rptFacturacionGeneral.php?id=" + $("#refempresa1").val() + "&fechadesde=" + $("#fechadesde1").val()+ "&fechahasta=" + $("#fechahasta1").val(),'_blank');	
						
    });
	
	
	$("#rptsc").click(function(event) {
        window.open("../../reportes/rptSaldosClientes.php?idEmp=" + $("#refempresa2").val() + "&fechadesde=" + $("#fechadesde2").val()+ "&fechahasta=" + $("#fechahasta2").val(),'_blank');	
						
    });
	
	$("#rptscc").click(function(event) {
        window.open("../../reportes/rptSaldosPorClientes.php?idEmp=" + $("#refempresa4").val() + "&idClie=" + $("#refcliente1").val() + "&fechadesde=" + $("#fechadesde3").val()+ "&fechahasta=" + $("#fechahasta3").val(),'_blank');	
						
    });
	
	$('#rptcc').click(function(e) {
        window.open("../../reportes/rptSaldosEmpresa.php?fechadesde=" + $("#fechadesde4").val()+ "&fechahasta=" + $("#fechahasta4").val(),'_blank');
    });
	
	$("#rpt5").click(function(event) {
        window.open("../../reportes/rptSaldosClientesEmpresas.php?idClie=" + $("#refcliente5").val() + "&fechadesde=" + $("#fechadesde5").val()+ "&fechahasta=" + $("#fechahasta5").val(),'_blank');	
						
    });

	
	
	
	
	$("#rptgfExcel").click(function(event) {
        window.open("../../reportes/rptFacturacionGeneralExcel.php?id=" + $("#refempresa1").val() + "&fechadesde=" + $("#fechadesde1").val()+ "&fechahasta=" + $("#fechahasta1").val(),'_blank');	
						
    });
	
	$("#rptscExcel").click(function(event) {
        window.open("../../reportes/rptSaldosClientesExcel.php?idEmp=" + $("#refempresa2").val() + "&fechadesde=" + $("#fechadesde2").val()+ "&fechahasta=" + $("#fechahasta2").val(),'_blank');	
						
    });
	
	$("#rptsccExcel").click(function(event) {
        window.open("../../reportes/rptSaldosPorClientesExcel.php?idEmp=" + $("#refempresa4").val() + "&idClie=" + $("#refcliente1").val() + "&fechadesde=" + $("#fechadesde3").val()+ "&fechahasta=" + $("#fechahasta3").val(),'_blank');	
						
    });
	
	$('#rptccExcel').click(function(e) {
        window.open("../../reportes/rptSaldosEmpresaExcel.php?fechadesde=" + $("#fechadesde4").val()+ "&fechahasta=" + $("#fechahasta4").val(),'_blank');
    });
	
	$("#rpt5Excel").click(function(event) {
        window.open("../../reportes/rptSaldosClientesEmpresasExcel.php?idClie=" + $("#refcliente5").val() + "&fechadesde=" + $("#fechadesde5").val()+ "&fechahasta=" + $("#fechahasta5").val(),'_blank');	
						
    });

});
</script>
<script type="text/javascript">
/*
$('.form_date').datetimepicker({
	language:  'es',
	weekStart: 1,
	todayBtn:  1,
	autoclose: 1,
	todayHighlight: 1,
	startView: 2,
	minView: 2,
	forceParse: 0,
	format: 'dd/mm/yyyy'
});
*/
</script>

<script>
  $(function() {
	  $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '<Ant',
 nextText: 'Sig>',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
 
    $( "#fechadesde1" ).datepicker();
    $( "#fechadesde1" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fechadesde2" ).datepicker();
    $( "#fechadesde2" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fechadesde3" ).datepicker();
    $( "#fechadesde3" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fechadesde4" ).datepicker();
    $( "#fechadesde4" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fechadesde5" ).datepicker();
    $( "#fechadesde5" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	
	$( "#fechahasta1" ).datepicker();
    $( "#fechahasta1" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fechahasta2" ).datepicker();
    $( "#fechahasta2" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fechahasta3" ).datepicker();
    $( "#fechahasta3" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fechahasta4" ).datepicker();
    $( "#fechahasta4" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fechahasta5" ).datepicker();
    $( "#fechahasta5" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
  });
  </script>
<?php } ?>
</body>
</html>
