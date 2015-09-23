<?php

require 'includes/funcionesUsuarios.php';
require 'includes/funcionesProductos.php';
require 'includes/funcionesVentas.php';


session_start();

$serviciosProductos = new ServiciosProductos();
$serviciosVentas = new ServiciosVentas();
$serviciosUsuario = new ServiciosUsuarios();


$ui = $_GET['token'];

$idcliente = $serviciosUsuario->traerActivacion($ui);

if ((integer)$idcliente > 0) {
	$datosLogin = $serviciosUsuario->traerUsuarioId($idcliente);
	$serviciosUsuario->activarUsuario($idcliente);
	
	$email = mysql_result($datosLogin,0,'email');
	$serviciosUsuario->loginUsuario($email,mysql_result($datosLogin,0,'password'));	
}

 
 
?>
<!DOCTYPE HTML>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta http-equiv='refresh' content='1000' />

<meta name='title' content='Carnes de Primera Calidad' />

<meta name='description' content='Carnes A Casa, somos una empresa abocada a la comercialización de productos cárnicos envasados al vació con los mas elevados Standars de calidad higiene y salubridad. Productos derivados de animales criados en los mejores establecimientos ganaderos del país. Nuestros productos llegan a su hogar por intermedio de transportes refrigerados cuidando celosamente la cadena de frió para mantener la máxima calidad del producto. Manipulados por personal habilitado con libreta sanitaria e indumentaria apropiada para la manipulación de alimentos. Nuestros productos están amparados por certificado de salubridad y establecimiento del SENASA (secretaria nacional de salubridad animal) desde el campo al frigorífico y del frigorífico a su mesa.' />

<meta name='keywords' content='Carnes, Envio Gratis, Frigorifico, Novillo, Ternera' />

<meta name='distribution' content='Global' />

<meta name='language' content='es' />

<meta name='identifier-url' content='http://www.carnesacasa.com.ar' />

<meta name='rating' content='General' />

<meta name='reply-to' content='' />

<meta name='author' content='Webmasters' />

<meta http-equiv='Pragma' content='no-cache/cache' />

<link rel="carnesacasa" href="imagenes/carnesacasaicon.ico" />


<meta http-equiv='Cache-Control' content='no-cache' />

<meta name='robots' content='all' />

<meta name='revisit-after' content='7 day' />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">



<title>Carnes A Casa</title>



		<link rel="stylesheet" type="text/css" href="css/estilo.css"/>

<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>

         <link rel="stylesheet" href="css/jquery-ui.css">

    <script src="js/jquery-ui.js"></script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        
      <script type="text/javascript">
		$( document ).ready(function() {
			$('#icoCate').click(function() {
				$('#icoCate').hide();
				$('.todoMenu').show(100, function() {
					$('#menuCate').animate({'margin-left':'0px'}, {
													duration: 800,
													specialEasing: {
													width: "linear",
													height: "easeOutBounce"
													}});
				});
			});
			
			$('.ocultar').click(function(){
				$('#icoCate').show(100, function() {
					$('#menuCate').animate({'margin-left':'-235px'}, {
													duration: 800,
													specialEasing: {
													width: "linear",
													height: "easeOutBounce"
													}});
				});
				$('.todoMenu').hide();
			});
			
			
		

		});
	</script>

<style>

	label {
		padding-top:6px;
		padding-bottom:3px;
	}
	input-group {
		padding:4px;
	}
	

</style>

        
        
</head>



<body>


<div class="content">

<div class="row" style="margin-top:-20px; font-family:Verdana, Geneva, sans-serif;">
	<div class="col-md-6" align="center">
		<a href="index.php" title="Carnes A Casa"><img src="imagenes/logo.png"></a>
    </div>
    <div class="col-md-6" align="right" style="padding-right:100px; padding-top:50px;">
		  <div class="col-md-12" style="height:25px;text-shadow: 1px 1px #fff;">
         	<p><span style="color: #009; font-weight:bold; font-size:16px;">Contáctenos</span></p>
         </div>
         <div class="col-md-12" style="height:25px;text-shadow: 1px 1px #fff;">
         	<p><span style="color: #F00; font-weight:bold; font-size:18px;">(011) 15 3946 - 7546</span></p>
         </div>
         <div class="col-md-12" style="height:25px;text-shadow: 1px 1px #fff;">
         	<p>info@carnesacasa.com.ar - dsagasti@yahoo.com.ar</p>
         </div>
         <div class="col-md-12" style="height:25px;text-shadow: 1px 1px #fff;">
         	<p><span style="color: #333; font-weight:bold; font-size:15px;">Calle 136 n° 1408 La Plata</span></p>
         </div>
         <div class="col-md-12" style="height:25px;text-shadow: 1px 1px #fff;">
         	<p>Horarios de Atención, Lun a Vie de 09:00 a 20:00 Hs</p>
         </div>

    </div>
</div>



<div style=" background-color:#FFF; border:1px solid #F7F7F7;height: auto; position: relative;margin-bottom:35px; padding:12px;box-shadow: 2px 2px 5px #999;
				-webkit-box-shadow: 2px 2px 5px #999;
  				-moz-box-shadow: 2px 2px 5px #999;">
        
                

<div class="row" align="center">
    <div class="row">
    <img src="imagenes/10897120_1602827289939979_2964203372121633332_n.jpg" width="720" height="456" style="border-radius: 10px 10px 10px 10px;
-moz-border-radius: 10px 10px 10px 10px;
-webkit-border-radius: 10px 10px 10px 10px;
border: 1px outset #000000;">
	</div>
	<div class="row" style="margin:10px;">

    <h2>Su cuenta (<?php echo $email; ?>) se activo <strong>Correctamente <img src="imagenes/checkCuentaAct.png" width="50" height="42" >,</strong><i>Carnes a Casa</i> le agredece empezar a ser parte de nuestra empresa.</h2>
<br>
    </div>

<button type="button" class="btn btn-default volver" id="1">
  <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Volver
</button>

</div>
</div>

</div><!-- fin del content -->
<script type="text/javascript">
$( document ).ready(function() {

$('.volver').click(function(event){
			url = "index.php";
			$(location).attr('href',url);
	});//fin del boton volver
});
</script>

</body>

</html>