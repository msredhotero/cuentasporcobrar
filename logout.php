<?php
session_start();
session_destroy();



?>
<!DOCTYPE HTML>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta http-equiv='refresh' content='1000' />


<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">



<title>Facturación - Cuentas Por Cobrar</title>



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




<div style=" background-color:#FFF; border:1px solid #F7F7F7;height: auto; position: relative;margin-bottom:35px; padding:12px;box-shadow: 2px 2px 5px #999;
				-webkit-box-shadow: 2px 2px 5px #999;
  				-moz-box-shadow: 2px 2px 5px #999;">
        
                

	<div class="row" style="height:160px;" align="center">
<br>
<h2>Acaba de salir del sistema. </h2>

<h4>Si quiere volver al Inicio presione <a href="index.php" style="color:#009; font-weight:bold;">AQUI</a></h4>


</div>
</div>

</div><!-- fin del content -->

</body>

</html>