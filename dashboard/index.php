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

$serviciosUsuario	= new ServiciosUsuarios();
$serviciosHTML 		= new ServiciosHTML();
$serviciosFunciones = new Servicios();
$serviciosClientes 	= new ServiciosClientes();
$serviciosEmpresas	= new ServiciosEmpresas();

$fecha = date('Y-m-d');

//$resProductos = $serviciosProductos->traerProductosLimite(6);
$resMenu = $serviciosHTML->menu(utf8_encode($_SESSION['nombre_predio']),"Dashboard",$_SESSION['refroll_predio'],utf8_encode($_SESSION['usua_empresa']));





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

    <div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Algo</p>
        	
        </div>
    	<div class="cuerpoBox">
    		
    	</div>
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
