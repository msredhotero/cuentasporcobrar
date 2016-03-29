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
</head>

<body>

 <?php echo $resMenu; ?>

<div id="content">

<h3>Socios</h3>

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
	
	$("#example").on("click",'.varmodificar', function(){
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			
			url = "modificar.php?id=" + usersid;
			$(location).attr('href',url);
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
<?php } ?>
</body>
</html>
