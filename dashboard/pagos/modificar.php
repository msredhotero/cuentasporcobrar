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
$resMenu = $serviciosHTML->menu(utf8_encode($_SESSION['nombre_predio']),"Pagos",$_SESSION['refroll_predio'],utf8_encode($_SESSION['usua_empresa']));

$id				=	$_GET['id'];

$resResultado	=	$serviciosPagos->traerPagosFactPorId($id);

$fecha 		= mysql_result($resResultado,0,'fechapago');
$saldo 		= mysql_result($resResultado,0,'saldo');
$total 		= mysql_result($resResultado,0,'total');
$nroFactura = mysql_result($resResultado,0,'nrofactura');
$idFactura  = mysql_result($resResultado,0,'reffactura');

/////////////////////// Opciones para la creacion del formulario  /////////////////////
$tabla 			= "dbpagos";

$lblCambio	 	= array("fechapago","montoapagar");
$lblreemplazo	= array("Fecha Pago","Abono");

$resCliente 	= $serviciosClientes->traerClientesPorEmpresa($_SESSION['usua_idempresa']);

$cadRef = '';

$refdescripcion = array();
$refCampo 	=  array(); 
//////////////////////////////////////////////  FIN de los opciones //////////////////////////


///////////////// CLIENTES /////////////////////////////////////////////////////////////
$resCliente 	= $serviciosClientes->traerClientesPorEmpresa($_SESSION['usua_idempresa']);

$cadRefC = '';
while ($rowTT = mysql_fetch_array($resCliente)) {
	$cadRefC = $cadRefC.'<option value="'.$rowTT[0].'">'.utf8_encode($rowTT[1]).'</option>';
	
}


////////////////////////////////////////////////////////////////////////////////////////


//$formulario 	= $serviciosFunciones->camposTabla("insertarPagos",$tabla,$lblCambio,$lblreemplazo,$refdescripcion,$refCampo);
$formulario 	= $serviciosFunciones->camposTablaModificar($id, "idpago", "modificarPagos",$tabla,$lblCambio,$lblreemplazo,$refdescripcion,$refCampo);



if ($_SESSION['refroll_predio'] != 1) {

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
    <style type="text/css">
		#example2 tr {
   max-height: 35px !important;
   height: 35px !important;
}
		
	</style>
</head>

<body>

 <?php echo $resMenu; ?>

<div id="content">

<h3>Pagos</h3>

    <div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Carga de Pagos</p>
        	
        </div>
    	<div class="cuerpoBox">
        	<form class="form-inline formulario" role="form">
        	
            <div class="row">
            	<div class="form-group col-md-12">
                	<label class="control-label" style="text-align:left" for="facturas">Factura</label>
                    <div class="input-group col-md-12 lstFacturas">
                    	<p>NºFactura: <?php echo $nroFactura; ?></p>
                    </div>
                </div>
                <div class="form-group col-md-6">
                	<label class="control-label" style="text-align:left" for="facturas">Total a Pagar</label>
                    <div class="input-group col-md-7">
                    	<span class="input-group-addon">$</span>
                        <input class="form-control" type="text" value="<?php echo $total; ?>" name="total" id="total" readonly>
                        <span class="input-group-addon">.00</span>
                    </div>
                </div>
                
                <div class="form-group col-md-6">
                	<label class="control-label" style="text-align:left" for="facturas">Saldo</label>
                    <div class="input-group col-md-7">
                    	<span class="input-group-addon">$</span>
                        <input class="form-control" type="text" value="<?php echo $saldo; ?>" name="saldo" id="saldo" readonly>
                        <span class="input-group-addon">.00</span>
                    </div>
                </div>
            </div>
            
            <hr>
            
            <div class="row">
			<?php echo $formulario; ?>
            <input type="hidden" id="refempresa" name="refempresa" value="<?php echo $_SESSION['usua_idempresa']; ?>" />
            <input type="hidden" id="idfactura" name="idfactura" value="<?php echo $idFactura; ?>" />
            
            
            </div>
            
            <div class='row' style="margin-left:25px; margin-right:25px;">
                <div class='alert'>
                
                </div>
                <div id='load'>
                
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                <ul class="list-inline" style="margin-top:15px;">
                    <li>
                        <button type="button" class="btn btn-warning" id="cargar" style="margin-left:0px;">Modificar</button>
                    </li>
                    <li>
                        <button type="button" class="btn btn-danger varborrar" id="<?php echo $id; ?>" style="margin-left:0px;">Eliminar</button>
                    </li>
                    <li>
                        <button type="button" class="btn btn-default volver" style="margin-left:0px;">Volver</button>
                    </li>
                </ul>
                </div>
            </div>
            </form>
    	</div>
    </div>
    
    
    

    
    
   
</div>


</div>
<?php 
        
if ($_SESSION['idroll_predio'] == 1) {
?>
<div id="dialog2" title="Eliminar Pago">
    	<p>
        	<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
            ¿Esta seguro que desea eliminar el Pago?.<span id="proveedorEli"></span>
        </p>
        <p><strong>Importante: </strong>Si elimina el equipo se perderan todos los datos de este</p>
        <input type="hidden" value="" id="idEliminar" name="idEliminar">
</div>
<?php
}
?>
<script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
<script src="../../bootstrap/js/dataTables.bootstrap.js"></script>
<script src="../../js/bootstrap-datetimepicker.min.js"></script>
<script src="../../js/bootstrap-datetimepicker.es.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	
	$('.volver').click(function(event){
		 
		url = "index.php";
		$(location).attr('href',url);
	});//fin del boton modificar
	
	<?php 
        
	if ($_SESSION['idroll_predio'] == 1) {
	?>
	$('.varborrar').click(function(event){
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			$("#idEliminar").val(usersid);
			$("#dialog2").dialog("open");

			
			//url = "../clienteseleccionado/index.php?idcliente=" + usersid;
			//$(location).attr('href',url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton eliminar
	
	$( "#dialog2" ).dialog({
		 	
			    autoOpen: false,
			 	resizable: false,
				width:600,
				height:240,
				modal: true,
				buttons: {
				    "Eliminar": function() {
	
						$.ajax({
									data:  {id: $('#idEliminar').val(), accion: 'eliminarPagos'},
									url:   '../../ajax/ajax.php',
									type:  'post',
									beforeSend: function () {
											
									},
									success:  function (response) {
											url = "index.php";
											$(location).attr('href',url);
											
									}
							});
						$( this ).dialog( "close" );
						$( this ).dialog( "close" );
							$('html, body').animate({
	           					scrollTop: '1000px'
	       					},
	       					1500);
				    },
				    Cancelar: function() {
						$( this ).dialog( "close" );
				    }
				}
		 
		 
	 		}); //fin del dialogo para eliminar
	<?php
	} else {
        
        ?>
		$('.varborrar').click(function(event){
		  
			alert("No posee permisos para eliminar un pago.");	

		});//fin del boton eliminar
		
		<?php
        
        }
        
        ?>
	
	
	function traerFacturas() {
		
		$.ajax({
				data:  {refcliente: $('#refcliente').val(),
						refempresa: <?php echo $_SESSION['usua_idempresa']; ?>,
						fechainicio: $('#fechainicio').val(),
						fechafin: $('#fechafin').val(),
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
	});//fin de los check

	$('#buscar').click( function() {
		$('#total').val(0);
		$('#saldo').val(0);
		traerFacturas();
		
	});

	
			
	<?php 
		echo $serviciosHTML->validacion($tabla);
	
	?>
	

	
	
	//al enviar el formulario
    $('#cargar').click(function(){
		
		if (validador() == "")
        {
			//información del formulario
			var formData = new FormData($(".formulario")[0]);
			var message = "";
			//hacemos la petición ajax  
			$.ajax({
				url: '../../ajax/ajax.php',  
				type: 'POST',
				// Form data
				//datos del formulario
				data: formData,
				//necesario para subir archivos via ajax
				cache: false,
				contentType: false,
				processData: false,
				//mientras enviamos el archivo
				beforeSend: function(){
					$("#load").html('<img src="../../imagenes/load13.gif" width="50" height="50" />');       
				},
				//una vez finalizado correctamente
				success: function(data){

					if (data == '') {
                                            $(".alert").removeClass("alert-danger");
											$(".alert").removeClass("alert-info");
                                            $(".alert").addClass("alert-success");
                                            $(".alert").html('<strong>Ok!</strong> Se cargo exitosamente el <strong>Pago</strong>. ');
											$(".alert").delay(3000).queue(function(){
												/*aca lo que quiero hacer 
												  después de los 2 segundos de retraso*/
												$(this).dequeue(); //continúo con el siguiente ítem en la cola
												
											});
											$("#load").html('');
											//url = "index.php";
											//$(location).attr('href',url);
                                            
											
                                        } else {
                                        	$(".alert").removeClass("alert-danger");
                                            $(".alert").addClass("alert-danger");
                                            $(".alert").html('<strong>Error!</strong> '+data);
                                            $("#load").html('');
                                        }
				},
				//si ha ocurrido un error
				error: function(){
					$(".alert").html('<strong>Error!</strong> Actualice la pagina');
                    $("#load").html('');
				}
			});
		}
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
 
    $( "#fechapago" ).datepicker();
    $( "#fechapago" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	$('#fechapago').datepicker('setDate', <?php echo "'".$fecha."'"; ?>);
	

  });
  </script>
<?php } ?>
</body>
</html>
