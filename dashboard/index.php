<?php

session_start();

if (!isset($_SESSION['usua_predio']))
{
	header('Location: ../error.php');
} else {


include ('../includes/funcionesUsuarios.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funciones.php');
include ('../includes/funcionesClientes.php');
include ('../includes/funcionesEmpresas.php');
include ('../includes/funcionesEmpresaBancos.php');

$serviciosUsuario		= new ServiciosUsuarios();
$serviciosHTML 			= new ServiciosHTML();
$serviciosFunciones 	= new Servicios();
$serviciosClientes 		= new ServiciosClientes();
$serviciosEmpresas		= new ServiciosEmpresas();
$serviciosEmpresaBancos	= new ServiciosEmpresaBancos();

$fecha = date('Y-m-d');

//$resProductos = $serviciosProductos->traerProductosLimite(6);
$resMenu = $serviciosHTML->menu(utf8_encode($_SESSION['nombre_predio']),"Dashboard",$_SESSION['refroll_predio'],utf8_encode($_SESSION['usua_empresa']));

$resEmpresa		=		$serviciosEmpresas->traerEmpresasPorId($_SESSION['usua_idempresa']);

$resBancos		=		$serviciosEmpresaBancos->traerEmpresaBancosPorEmpresa($_SESSION['usua_idempresa']);

$dashBoar		= 		$serviciosFunciones->dashBoard($_SESSION['usua_idempresa'],$resBancos);	

?>

<!DOCTYPE HTML>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">



<title>Gestión: Facturación - Cuentas Por Cobrar</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<link href="../css/estiloDash.css" rel="stylesheet" type="text/css">
    

    
    <script type="text/javascript" src="../js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" href="../css/jquery-ui.css">

    <script src="../js/jquery-ui.js"></script>
    
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"/>
	<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <!-- Latest compiled and minified JavaScript -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>

	<style type="text/css">
		#vista table {
			border:3px solid #333;
		}
		
		#vista table tbody tr th {
			background-color:#FC3;
			color:#37363A;
			text-shadow:1px 1px 1px #7D7D00;
		}
		
		#vista table tbody tr th, #vista table tbody td {
			border-color:#000;
		}
  
		
	</style>
    
   
   <link href="../css/perfect-scrollbar.css" rel="stylesheet">
      <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
      <script src="../js/jquery.mousewheel.js"></script>
      <script src="../js/perfect-scrollbar.js"></script>
      <script>
      jQuery(document).ready(function ($) {
        "use strict";
        $('#navigation').perfectScrollbar();
      });
    </script>
</head>

<body>

 
<?php echo str_replace('..','../dashboard',$resMenu); ?>

<div id="content">

<h3>Dashboard</h3>

    <div class="boxInfoLargo2" id="vista">
    	
       
        <?php echo $dashBoar; ?>
        
        <!--<div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Información</p>
        	
        </div>
    	<div class="cuerpoBox">
    		<h3>Bienvenidos al sistema Facturación - Cuentas Por Cobrar</h3>
    	</div>-->
    </div>
    
    
    
    
    
   
</div>


</div>




<script type="text/javascript">
$(document).ready(function(){
	
	
	

});
</script>
<?php } ?>
</body>
</html>
