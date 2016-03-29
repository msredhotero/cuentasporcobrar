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
$resMenu = $serviciosHTML->menu(utf8_encode($_SESSION['nombre_predio']),"Socios",$_SESSION['refroll_predio'],$_SESSION['usua_empresa']);


$id = $_GET['id'];

$resResultado = $serviciosSocios->traerSociosPorId($id);

/////////////////////// Opciones para la creacion del formulario  /////////////////////
$tabla 			= "dbsocios";

$lblCambio	 	= array("reftiposocio","curp","rfc","ife");
$lblreemplazo	= array("Tipo Socio","CURP","RFC","IFE");


$resVariable1 	= $serviciosTipoSocio->traerTipoSociosActivos();

$cadVariable1 = '';
while ($rowV1 = mysql_fetch_array($resVariable1)) {
	if ($rowV1[0] == mysql_result($resResultado,0,'reftiposocio')) {
		$cadVariable1 = $cadVariable1.'<option value="'.$rowV1[0].'" selected>'.utf8_encode($rowV1[1]).'</option>';	
	} else {
		$cadVariable1 = $cadVariable1.'<option value="'.$rowV1[0].'">'.utf8_encode($rowV1[1]).'</option>';	
	}
	
}

$refdescripcion = array(0=>$cadVariable1);
$refCampo 	=  array("reftiposocio");

//////////////////////////////////////////////  FIN de los opciones //////////////////////////



$resNoticiasFotos = $serviciosSocios->TraerFotosNoticias($id);

$cantidadImagenes = 0;
$cantidadImagenes = mysql_num_rows($resNoticiasFotos);

$formulario 	= $serviciosFunciones->camposTablaModificar($id, "idsocio", "modificarSocios",$tabla,$lblCambio,$lblreemplazo,$refdescripcion,$refCampo);


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
        	<p style="color: #fff; font-size:18px; height:16px;">Modificar Socios</p>
        	
        </div>
    	<div class="cuerpoBox">
        	<form class="form-inline formulario" role="form">
        	
			<div class="row">
			<?php echo $formulario; ?>
            </div>
            
            <div class="row" style="margin-left:25px; margin-right:25px;">
                <h3>Imagenes Cargadas</h3>
                    <ul class="list-inline">
                        <?php while ($rowImg = mysql_fetch_array($resNoticiasFotos)) { ?>
                        <li>
                            
                            <div class="col-md-4" align="center">
                            <div id="img<?php echo $rowImg[3]; ?>">
                            	<?php 
									$mystring = $rowImg['type'];
									$findme   = 'image';
									$pos = strpos($mystring, $findme);
									if ($pos !== false) { 
								?>
                                <img src="<?php echo '../../archivos/'.$rowImg[0].'/'.$rowImg[1].'/'.utf8_encode($rowImg[2]) ?>" width="100" height="100">
                                <?php } else { ?>
                                <img src="../../imagenes/pdf_ico2.jpg" width="100" height="100"><?php echo $rowImg['imagen']; ?>
                                <?php } ?>
                            </div>
                            <input type="button" name="eliminar" id="<?php echo $rowImg[3]; ?>" class="btn btn-danger eliminar" value="Eliminar">
                            </div>
                            
                        </li>
                        <?php } ?>
                    </ul>
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
						<?php for($i=1;$i<=4-$cantidadImagenes;$i=$i+2) { ?>
                        <li style="margin-top:14px;">
                        <div style=" height:110px; width:140px; border:2px dashed #CCC; text-align:center; overflow: auto;">
                            <div class='custom-input-file'>
                                <input type="file" name="imagen<?php echo $i; ?>" id="imagen<?php echo $i; ?>">
                                <img src="../../imagenes/clip20.jpg">
                                <div class="files">...</div>
                            </div>
                            
                            <img id="vistaPrevia<?php echo $i; ?>" name="vistaPrevia<?php echo $i; ?>" width="50" height="50"/>
                        </div>
                        <div style="height:14px;">
                            
                        </div>
                        <?php if ($i<4-$cantidadImagenes) { ?>
                        <div style=" height:110px; width:140px; border:2px dashed #CCC; text-align:center; overflow: auto;">
                            <div class='custom-input-file'>
                                <input type="file" name="imagen<?php echo $i+1; ?>" id="imagen<?php echo $i+1; ?>">
                                <img src="../../imagenes/clip20.jpg">
                                <div class="files">...</div>
                            </div>
                            <img id="vistaPrevia<?php echo $i+1; ?>" name="vistaPrevia<?php echo $i+1; ?>" width="50" height="50"/>
                        </div>
                        <?php } ?>
                            
                        </li>
                        <?php } ?>
                       
                        
                        
                        
                        </ul>
                        
                        
                        
                        
                        
                        
                       
            </div>
                
            <input type="hidden" id="cantidadImagenes" name="cantidadImagenes" value="<?php echo $cantidadImagenes; ?>">
            
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

	$('.volver').click(function(event){
		 
		url = "index.php";
		$(location).attr('href',url);
	});//fin del boton modificar
	
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
                                            $(".alert").html('<strong>Ok!</strong> Se modifico exitosamente el <strong>Socio</strong> de la Empresa. ');
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
	
	
	$('.eliminar').click(function(event){
                
			  usersid =  $(this).attr("id");
			  imagenId = 'img'+usersid;
			  
			  if (!isNaN(usersid)) {
				$("#idAgente").val(usersid);
                                //$('#vistaPrevia30').attr('src', e.target.result);
				$("#auxImg").html($('#'+imagenId).html());
				$("#dialog3").dialog("open");
				//url = "../clienteseleccionado/index.php?idcliente=" + usersid;
				//$(location).attr('href',url);
			  } else {
				alert("Error, vuelva a realizar la acción.");	
			  }
			  
			  //post code
	});
	
	$( "#dialog3" ).dialog({
		 	
			    autoOpen: false,
			 	resizable: false,
				width:600,
				height:340,
				modal: true,
				buttons: {
				    "Eliminar": function() {
	
						$.ajax({
									data:  {id: $("#idAgente").val(), accion: 'eliminarFoto'},
									url:   '../../ajax/ajax.php',
									type:  'post',
									beforeSend: function () {
											
									},
									success:  function (response) {
											url = "modificar.php?id=<?php echo $id; ?>";
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

<div id="dialog3" title="Eliminar Imagen">
    	<p>
        	<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
            ¿Esta seguro que desea eliminar la imagen?.
        </p>
        <div id="auxImg">
        
        </div>
        <input type="hidden" value="" id="idAgente" name="idAgente">
</div>
<?php } ?>
</body>
</html>
