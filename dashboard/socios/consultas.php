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


$tipoBusqueda = $_GET['tb'];
$busqueda = $_GET['b'];


switch ($tipoBusqueda) {
	case 1:
		$resResultado = $serviciosSocios->traerSociosPorNombreEmpresa($busqueda);		
		break;
	case 2:
		$resResultado = $serviciosSocios->traerSociosPorNombre($busqueda);
		break;
	default:
		$resResultado = '';
		break;
}



/////////////////////// Opciones para la creacion del view  /////////////////////
$cabeceras 		= "	<th>IFE</th>
				<th>Nombre</th>
				<th>Domicilio</th>
				<th>CURP</th>
				<th>RFC</th>
				<th>Tipo Socio</th>
				<th>Empresa</th>";

//////////////////////////////////////////////  FIN de los opciones //////////////////////////





$lstCargados 	= $serviciosFunciones->camposTablaView($cabeceras,$resResultado,95);


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
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css" media="all"/>
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
        	<p style="color: #fff; font-size:18px; height:16px;">Resultado de la Busqueda</p>
        	
        </div>
    	<div class="cuerpoBox">
        	<form class="form-inline formulario" role="form">

             
            <?php echo $lstCargados; ?>


            </form>
            <div class="row">
                <div class="col-md-12">
                <ul class="list-inline" style="margin-top:15px;">
                   
                    <li>
                        <button type="button" class="btn btn-default volver" style="margin-left:0px;">Volver</button>
                    </li>
                </ul>
                </div>
                
            </div>
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
<script type="text/javascript">
$(document).ready(function(){

	$('.volver').click(function(event){
		 
		url = "index.php";
		$(location).attr('href',url);
	});//fin del boton modificar
	
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
	
	

	$("#example").on("click",'.varborrar', function(){
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

});
</script>

<script type="text/javascript">
function imprSelec(muestra)
{var ficha=document.getElementById(muestra);var ventimp=window.open(' ','popimpr');ventimp.document.write(ficha.innerHTML);ventimp.document.close();ventimp.print();ventimp.close();}

$('.imprimir').click(function(e) {
    imprSelec('muestra');
});

</script>

<?php } ?>
</body>
</html>
