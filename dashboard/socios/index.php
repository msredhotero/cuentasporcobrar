<?php


session_start();

if (!isset($_SESSION['usua_predio']))
{
	header('Location: ../../error.php');
} else {


include ('../../includes/funciones.php');
include ('../../includes/funcionesUsuarios.php');
include ('../../includes/funcionesHTML.php');
include ('../../includes/funcionesEmpresas.php');
include ('../../includes/funcionesEmpresaBancos.php');
include ('../../includes/funcionesTipoSocios.php');
include ('../../includes/funcionesSocios.php');

$serviciosFunciones = new Servicios();
$serviciosUsuario 	= new ServiciosUsuarios();
$serviciosHTML 		= new ServiciosHTML();
$serviciosEmpresas  = new ServiciosEmpresas();
$serviciosEmpresaBancos = new ServiciosEmpresaBancos();
$serviciosTipoSocio		= new ServiciosTipoSocios();
$serviciosSocios		= new ServiciosSocios();

$fecha = date('Y-m-d');

//$resProductos = $serviciosProductos->traerProductosLimite(6);
$resMenu = $serviciosHTML->menu(utf8_encode($_SESSION['nombre_predio']),"Socios",$_SESSION['refroll_predio'],utf8_encode($_SESSION['usua_empresa']));

$resSoc = $serviciosSocios->traerSocios();

/////////////////////// Opciones para la creacion del formulario  /////////////////////
$tabla 			= "dbsocios";

$lblCambio	 	= array("reftiposocio","curp","rfc","ife");
$lblreemplazo	= array("Tipo Socio","CURP","RFC","IFE");


$resVariable1 	= $serviciosTipoSocio->traerTipoSociosActivos();

$cadVariable1 = '';
while ($rowV1 = mysql_fetch_array($resVariable1)) {

	$cadVariable1 = $cadVariable1.'<option value="'.$rowV1[0].'">'.utf8_encode($rowV1[1]).'</option>';	
	
}

$refdescripcion = array(0=>$cadVariable1);
$refCampo 	=  array("reftiposocio");
//////////////////////////////////////////////  FIN de los opciones //////////////////////////



/////////////////////// Opciones para la creacion del view  /////////////////////
$cabeceras 		= "	<th>IFE</th>
				<th>Nombre</th>
				<th>Domicilio</th>
				<th>CURP</th>
				<th>RFC</th>
				<th>Tipo Socio</th>";

//////////////////////////////////////////////  FIN de los opciones //////////////////////////




$formulario 	= $serviciosFunciones->camposTabla("insertarSocios",$tabla,$lblCambio,$lblreemplazo,$refdescripcion,$refCampo);

$lstCargados 	= $serviciosFunciones->camposTablaView($cabeceras,$serviciosSocios->traerSociosPorEmpresa($_SESSION['usua_idempresa']),96);



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
    
    <link rel="stylesheet" href="../../css/chosen.css">
</head>

<body>

 <?php echo $resMenu; ?>

<div id="content">

<h3>Socios</h3>
	
    <div class="panel panel-info">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Socios Cargados</p>
        	
        </div>
    	<div class="panel-body">
        	<form class="form-inline formulario" role="form">
        	<div class="form-group col-md-6">
                	<label class="control-label" style="text-align:left" for="celular1">Socios Existentes</label>
                    <div class="input-group col-md-12">
                    	<select data-placeholder="selecione el socio..." id="refsociocargado" name="refsociocargado" class="chosen-select" style="width:450px;" tabindex="2">
                            <option value=""></option>
                            <?php while ($rowC = mysql_fetch_array($resSoc)) { ?>
                                <option value="<?php echo $rowC[0]; ?>">IFE: <?php echo $rowC[1]; ?> - Nombre: <?php echo $rowC[2]; ?> - Tipo: <?php echo $rowC['tiposocio']; ?></option>
                            <?php } ?>
                            
                        </select>
                    </div>
                </div>
            
            <div class='row' style="margin-left:25px; margin-right:25px; ">
                <div class='alert2'>
                
                </div>
                <div id='load'>
                
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                <ul class="list-inline" style="margin-top:15px;">
                    <li>
                        <button type="button" class="btn btn-primary" id="adjuntar" style="margin-left:0px;">Guardar</button>
                    </li>
                </ul>
                </div>
            </div>
            </form>
    	</div>
    </div>
    
    
    <div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Consultas <span class="glyphicon glyphicon-minus abrir" style="cursor:pointer; float:right; padding-right:12px;">(Cerrar)</span></p>
	        
        </div><!-- fin del headBoxInfo-->
    	<div class="cuerpoBox filt">
            <form class="form-inline formulario" role="form">
            <div class="row">

                
                <div class="form-group col-md-6">
                	<label class="control-label" style="text-align:left" for="tipobusqueda">Tipo Busqueda</label>
                    <div class="input-group col-md-12">
                    	<select id="tipobusqueda" name="tipobusqueda" class="form-control">
                            <option value="0">---- Seleccione ----</option>
                            <option value="1">Nombre Empresa</option>
                            <option value="2">Nombre Socio</option>
                        </select>
                    </div>
                </div>
                
                
                
                <div class="form-group col-md-6">
                    <label class="control-label" style="text-align:left" for="busqueda">Dato</label>
                    <div class="input-group col-md-12">
                    	<input id="busqueda" class="form-control" type="text" required placeholder="Ingrese el dato..." name="busqueda">
                    </div>
                </div>

                
				<input type="hidden" id="accion" name="accion" value="filtros"/>
                
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
                        <button type="button" class="btn btn-success" id="buscar" style="margin-left:0px;"><span class="glyphicon glyphicon-search"></span> Buscar</button>
                    </li>
                </ul>
                </div>
            </div>
            </form>
    </div><!-- fin del cuerpoBox-->

    </div><!-- fin del BoxLargo-->
    
    
    
    <div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Carga de Socios</p>
        	
        </div>
    	<div class="cuerpoBox">
        	<form class="form-inline formulario" role="form">
        	
     
    
            <div class="row">
			<?php echo $formulario; ?>
            <input type="hidden" id="refempresa" name="refempresa" value="<?php echo $_SESSION['usua_idempresa']; ?>" />
            </div>
            
            <div class="row" style="margin-left:25px; margin-right:25px;">
                	<h4>Agregar Imagenes/Archivos</h4>
                        <p style=" color: #999;">4 Imagenes/Archivos disponibles (no más de 1 mb por archivo)</p>
                        <div style="height:auto; 
                    			width:100%; 
                                background-color:#FFF;
                                -webkit-border-radius: 13px; 
                            	-moz-border-radius: 13px;
                            	border-radius: 13px;
                                margin-left:-20px;
                                padding-left:20px;">

                            
			<ul class="list-inline">
                        <li style="margin-top:14px;">
                        <div style=" height:110px; width:140px; border:2px dashed #CCC; text-align:center; overflow: auto;">
                            <div class='custom-input-file'>
                                <input type="file" name="imagen1" id="imagen1">
                                <img src="../../imagenes/clip20.jpg">
                                <div class="files">...</div>
                            </div>
                            
                            <img id="vistaPrevia1" name="vistaPrevia1" width="50" height="50"/>
                        </div>
                        <div style="height:14px;">
                            
                        </div>
                        <div style=" height:110px; width:140px; border:2px dashed #CCC; text-align:center; overflow: auto;">
                            <div class='custom-input-file'>
                                <input type="file" name="imagen2" id="imagen2">
                                <img src="../../imagenes/clip20.jpg">
                                <div class="files">...</div>
                            </div>
                            <img id="vistaPrevia2" name="vistaPrevia2" width="50" height="50"/>
                        </div>
                        
                            
                        </li>
                        <li style="margin-top:14px;">
                        <div style=" height:110px; width:140px; border:2px dashed #CCC; text-align:center; overflow: auto;">
                            <div class='custom-input-file'>
                                <input type="file" name="imagen3" id="imagen3">
                                <img src="../../imagenes/clip20.jpg">
                                <div class="files">...</div>
                            </div>
                            <img id="vistaPrevia3" name="vistaPrevia3" width="50" height="50"/>
                        </div>
                        <div style="height:14px;">
                            
                        </div>
                        <div style=" height:110px; width:140px; border:2px dashed #CCC; text-align:center; overflow: auto;">
                            <div class='custom-input-file'>
                                <input type="file" name="imagen4" id="imagen4">
                                <img src="../../imagenes/clip20.jpg">
                                <div class="files">...</div>
                            </div>
                            <img id="vistaPrevia4" name="vistaPrevia4" width="50" height="50"/>
                        </div>
                        </li>
                        
                        
                        </ul>
                        
                        
                        
                        
                        
                        
                       
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
                        <button type="button" class="btn btn-primary" id="cargar" style="margin-left:0px;">Guardar</button>
                    </li>
                </ul>
                </div>
            </div>
            <input type="hidden" id="accion" name="accion" value="insertarSocios"/>
            </form>
    	</div>
    </div>
    
    <div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Socios Cargados</p>
        	
        </div>
    	<div class="cuerpoBox">
        	<?php echo $lstCargados; ?>
    	</div>
    </div>
    
    

    
    
   
</div>


</div>
<div id="dialog2" title="Eliminar Socios">
    	<p>
        	<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
            ¿Esta seguro que desea eliminar el Socio?.<span id="proveedorEli"></span>
        </p>

        <input type="hidden" value="" id="idEliminar" name="idEliminar">
</div>
<script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
<script src="../../bootstrap/js/dataTables.bootstrap.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	$('#example').dataTable({
		"order": [[ 0, "asc" ]],
		"language": {
			"emptyTable":     "No hay datos cargados",
			"info":           "Mostrar _START_ hasta _END_ del total de _TOTAL_ filas",
			"infoEmpty":      "Mostrar 0 hasta 0 del total de 0 filas",
			"infoFiltered":   "(filtrados del total de _MAX_ filas)",
			"infoPostFix":    "",
			"thousands":      ",",
			"lengthMenu":     "Mostrar _MENU_ filas",
			"loadingRecords": "Cargando...",
			"processing":     "Procesando...",
			"search":         "Buscar:",
			"zeroRecords":    "No se encontraron resultados",
			"paginate": {
				"first":      "Primero",
				"last":       "Ultimo",
				"next":       "Siguiente",
				"previous":   "Anterior"
			},
			"aria": {
				"sortAscending":  ": activate to sort column ascending",
				"sortDescending": ": activate to sort column descending"
			}
		  }
	} );
	
	$('.abrir').click(function() {
		
		if ($('.abrir').text() == '(Abrir)') {
			$('.filt').show( "slow" );
			$('.abrir').text('(Cerrar)');
			$('.abrir').removeClass('glyphicon glyphicon-plus');
			$('.abrir').addClass('glyphicon glyphicon-minus');
		} else {
			$('.filt').slideToggle( "slow" );
			$('.abrir').text('(Abrir)');
			$('.abrir').addClass('glyphicon glyphicon-plus');
			$('.abrir').removeClass('glyphicon glyphicon-minus');

		}
	});
	
	$('.abrir').click();
	
	$('.abrir').click(function() {
		$('.filt').show();
	});
	
	$('#buscar').click(function(e) {
        
		url = "consultas.php?tb=" + $('#tipobusqueda').val() + "&b=" + $('#busqueda').val();
		$(location).attr('href',url);
    });
	
		$('.varborrar').click(function(event){
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			<?php
				if ($_SESSION['refroll_predio'] == 2) {
			
			?>
				alert("Error, no tiene permisos para realizar la acción.");
			<?php
				} else {
			?>
				$("#idEliminar").val(usersid);
				$("#dialog2").dialog("open");
			<?php } ?>  
			

			
			//url = "../clienteseleccionado/index.php?idcliente=" + usersid;
			//$(location).attr('href',url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton eliminar
	
	$("#example").on("click",'.varmodificarsin', function(){
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			<?php
				if ($_SESSION['refroll_predio'] == 2) {
			
			?>
				alert("Error, no tiene permisos para realizar la acción.");
			<?php
				} else {
			?>
				url = "modificar.php?id=" + usersid;
				$(location).attr('href',url);
			<?php } ?>
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton modificar
	
	
	$("#example").on("click",'.varver', function(){
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			
			url = "ver.php?id=" + usersid;
			$(location).attr('href',url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton ver

	 $( "#dialog2" ).dialog({
		 	
			    autoOpen: false,
			 	resizable: false,
				width:600,
				height:240,
				modal: true,
				buttons: {
				    "Eliminar": function() {
	
						$.ajax({
									data:  {id: $('#idEliminar').val(), accion: 'eliminarSocios'},
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
			
	$("#reftiposocio").click(function(event) {
					$("#reftiposocio").removeClass("alert-danger");
					if ($(this).val() == "") {
						$("#reftiposocio").attr("value","");
						$("#reftiposocio").attr("placeholder","Ingrese el Reftiposocio...");
					}
				});
			
				$("#reftiposocio").change(function(event) {
					$("#reftiposocio").removeClass("alert-danger");
					$("#reftiposocio").attr("placeholder","Ingrese el Reftiposocio");
				});
				
				
			
				$("#nombre").click(function(event) {
					$("#nombre").removeClass("alert-danger");
					if ($(this).val() == "") {
						$("#nombre").attr("value","");
						$("#nombre").attr("placeholder","Ingrese el Nombre...");
					}
				});
			
				$("#nombre").change(function(event) {
					$("#nombre").removeClass("alert-danger");
					$("#nombre").attr("placeholder","Ingrese el Nombre");
				});
				
				
			
				$("#curp").click(function(event) {
					$("#curp").removeClass("alert-danger");
					if ($(this).val() == "") {
						$("#curp").attr("value","");
						$("#curp").attr("placeholder","Ingrese el Curp...");
					}
				});
			
				$("#curp").change(function(event) {
					$("#curp").removeClass("alert-danger");
					$("#curp").attr("placeholder","Ingrese el Curp");
				});
				
				
			
				$("#rfc").click(function(event) {
					$("#rfc").removeClass("alert-danger");
					if ($(this).val() == "") {
						$("#rfc").attr("value","");
						$("#rfc").attr("placeholder","Ingrese el Rfc...");
					}
				});
			
				$("#rfc").change(function(event) {
					$("#rfc").removeClass("alert-danger");
					$("#rfc").attr("placeholder","Ingrese el Rfc");
				});
				
				
	function validador(){

			$error = "";
			
			
					if ($("#reftiposocio").val() == "") {
						$error = "Es obligatorio el campo Reftiposocio.";
						$("#reftiposocio").addClass("alert-danger");
						$("#reftiposocio").attr("placeholder",$error);
					}
				
				
			
					if ($("#nombre").val() == "") {
						$error = "Es obligatorio el campo Nombre.";
						$("#nombre").addClass("alert-danger");
						$("#nombre").attr("placeholder",$error);
					}
				
				
			
					if ($("#curp").val() == "") {
						$error = "Es obligatorio el campo Curp.";
						$("#curp").addClass("alert-danger");
						$("#curp").attr("placeholder",$error);
					}
				
				
			
					if ($("#rfc").val() == "") {
						$error = "Es obligatorio el campo Rfc.";
						$("#rfc").addClass("alert-danger");
						$("#rfc").attr("placeholder",$error);
					}
				
				
			return $error;
	}
	
	
	$('#adjuntar').click(function(){
		$.ajax({
				data:  {refclientecargado: $('#refclientecargado').val(), 
						idEmpresa: <?php echo $_SESSION['usua_idempresa']; ?>,
						accion: 'insertarClienteEmpresa'},
				url:   '../../ajax/ajax.php',
				type:  'post',
				beforeSend: function () {
						
				},
				success:  function (response) {
						url = "index.php";
						$(location).attr('href',url);

				}
		});
		
	});
	
	
	//al enviar el formulario
    $('#cargar').click(function(){
		
		if (validador() == "")
        {
			//información del formulario
			var formData = new FormData($(".formulario")[2]);
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
                                            $(".alert").html('<strong>Ok!</strong> Se cargo exitosamente el <strong>Socio</strong> a la Empresa. ');
											$(".alert").delay(3000).queue(function(){
												/*aca lo que quiero hacer 
												  después de los 2 segundos de retraso*/
												$(this).dequeue(); //continúo con el siguiente ítem en la cola
												
											});
											$("#load").html('');
											url = "index.php";
											$(location).attr('href',url);
                                            
											
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
	
	
	$('#imagen1').on('change', function(e) {
  var Lector,
      oFileInput = this;
 
  if (oFileInput.files.length === 0) {
    return;
  };
 
  Lector = new FileReader();
  Lector.onloadend = function(e) {
    $('#vistaPrevia1').attr('src', e.target.result);         
  };
  Lector.readAsDataURL(oFileInput.files[0]);
 
});

$('#imagen2').on('change', function(e) {
  var Lector,
      oFileInput = this;
 
  if (oFileInput.files.length === 0) {
    return;
  };
 
  Lector = new FileReader();
  Lector.onloadend = function(e) {
    $('#vistaPrevia2').attr('src', e.target.result);         
  };
  Lector.readAsDataURL(oFileInput.files[0]);
 
});

$('#imagen3').on('change', function(e) {
  var Lector,
      oFileInput = this;
 
  if (oFileInput.files.length === 0) {
    return;
  };
 
  Lector = new FileReader();
  Lector.onloadend = function(e) {
    $('#vistaPrevia3').attr('src', e.target.result);         
  };
  Lector.readAsDataURL(oFileInput.files[0]);
 
});

$('#imagen4').on('change', function(e) {
  var Lector,
      oFileInput = this;
 
  if (oFileInput.files.length === 0) {
    return;
  };
 
  Lector = new FileReader();
  Lector.onloadend = function(e) {
    $('#vistaPrevia4').attr('src', e.target.result);         
  };
  Lector.readAsDataURL(oFileInput.files[0]);
 
});





});
</script>

<script src="../../js/chosen.jquery.js" type="text/javascript"></script>
<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
<?php } ?>
</body>
</html>
