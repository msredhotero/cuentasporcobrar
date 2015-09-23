<?php

date_default_timezone_set('America/Panama');

include ('../includes/funcionesUsuarios.php');
include ('../includes/funciones.php');


$serviciosUsuarios  = new ServiciosUsuarios();
$servicios			= new Servicios();

$fecha = date('Y-m-d');


$resPeliculas = $servicios->TraerTodasPeliculas();



?>


<!DOCTYPE HTML>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">



<title>Cinema Star</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<link href="../css/estiloPreview.css" rel="stylesheet" type="text/css">
    

    <script type="text/javascript" src="../js/jquery-1.8.3.min.js"></script>

    <link rel="stylesheet" href="../css/jquery-ui.css">

    <script src="../js/jquery-ui.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap-theme.min.css">

    <link rel="stylesheet" href="../css/bootstrap-datetimepicker.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    

    

</head>

<body>

<div style="position:absolute; top:28px; left:700px; font-size:20px; color:#231f20; font-weight:bold;">
   HORARIOS DEL 26 DE FEBRERO AL 4 DE MARZO DEL 2015
</div>


<!-- PARTE DE ARRIBA -->
    <!-- PRIMER CUADRANTE -->
    
    <div style="position:absolute; top:200px; left:290px; padding:3px; font-size:21px; color:#231f20; font-weight:bold;">
        Numero de Sala: 1
    </div>
    
    <div style="position:absolute; top:223px; left:300px; padding:3px; font-size:21px; color:#231f20; font-weight:bold; width:170px; text-align:center;">
        Categoria
    </div>
    
    <div style="position:absolute; top:275px; left:275px; padding:3px; font-size:20px; color:#fff;  width:220px; text-align:center; height:60px; ">
        EL NUEVO EXOTICO HOTEL MARIGOLD
    </div>
    
    <div style="position:absolute; top:349px; left:305px; padding:3px; font-size:28px; color:#fff; font-weight:bold; width:160px; text-align:center;">
        08:00 am
    </div>
    
    <div style="position:absolute; top:386px; left:305px; padding:3px; font-size:28px; color:#fff; font-weight:bold; width:160px; text-align:center;">
        08:00 am
    </div>
    
    <div style="position:absolute; top:423px; left:305px; padding:3px; font-size:28px; color:#fff; font-weight:bold; width:160px; text-align:center;">
        11:30 am
    </div>
    
    <div style="position:absolute; top:459px; left:305px; padding:3px; font-size:28px; color:#fff; font-weight:bold; width:160px; text-align:center;">
        10:00 am
    </div>
    
    <!-- FIN PRIMER CUADRANTE -->
    
    
    
    
    
    
    <!-- SEGUNDO CUADRANTE  + 455 -->
    
    <div style="position:absolute; top:200px; left:745px; padding:3px; font-size:21px; color:#231f20; font-weight:bold;">
        Numero de Sala: 1
    </div>
    
    <div style="position:absolute; top:223px; left:755px; padding:3px; font-size:21px; color:#231f20; font-weight:bold; width:170px; text-align:center;">
        Categoria
    </div>
    
    <div style="position:absolute; top:275px; left:730px; padding:3px; font-size:20px; color:#fff;  width:220px; text-align:center; height:60px; ">
        EL NUEVO EXOTICO HOTEL MARIGOLD
    </div>
    
    <div style="position:absolute; top:349px; left:760px; padding:3px; font-size:28px; color:#fff; font-weight:bold; width:160px; text-align:center;">
        08:00 am
    </div>
    
    <div style="position:absolute; top:386px; left:760px; padding:3px; font-size:28px; color:#fff; font-weight:bold; width:160px; text-align:center;">
        08:00 am
    </div>
    
    <div style="position:absolute; top:423px; left:760px; padding:3px; font-size:28px; color:#fff; font-weight:bold; width:160px; text-align:center;">
        11:30 am
    </div>
    
    <div style="position:absolute; top:459px; left:760px; padding:3px; font-size:28px; color:#fff; font-weight:bold; width:160px; text-align:center;">
        10:00 am
    </div>
    
    <!-- FIN SEGUNDO CUADRANTE -->
    
    
    <!-- SEGUNDO TERCER  + 455 -->
    
    <div style="position:absolute; top:200px; left:1200px; padding:3px; font-size:21px; color:#231f20; font-weight:bold;">
        Numero de Sala: 1
    </div>
    
    <div style="position:absolute; top:223px; left:1210px; padding:3px; font-size:21px; color:#231f20; font-weight:bold; width:170px; text-align:center;">
        Categoria
    </div>
    
    <div style="position:absolute; top:275px; left:1185px; padding:3px; font-size:20px; color:#fff;  width:220px; text-align:center; height:60px; ">
        EL NUEVO EXOTICO HOTEL MARIGOLD
    </div>
    
    <div style="position:absolute; top:349px; left:1215px; padding:3px; font-size:28px; color:#fff; font-weight:bold; width:160px; text-align:center;">
        08:00 am
    </div>
    
    <div style="position:absolute; top:386px; left:1215px; padding:3px; font-size:28px; color:#fff; font-weight:bold; width:160px; text-align:center;">
        08:00 am
    </div>
    
    <div style="position:absolute; top:423px; left:1215px; padding:3px; font-size:28px; color:#fff; font-weight:bold; width:160px; text-align:center;">
        11:30 am
    </div>
    
    <div style="position:absolute; top:459px; left:1215px; padding:3px; font-size:28px; color:#fff; font-weight:bold; width:160px; text-align:center;">
        10:00 am
    </div>
    
    <!-- FIN TERCER CUADRANTE -->
    
    
    <!-- SEGUNDO TERCER  + 455 -->
    
    <div style="position:absolute; top:200px; left:1655px; padding:3px; font-size:21px; color:#231f20; font-weight:bold;">
        Numero de Sala: 1
    </div>
    
    <div style="position:absolute; top:223px; left:1665px; padding:3px; font-size:21px; color:#231f20; font-weight:bold; width:170px; text-align:center;">
        Categoria
    </div>
    
    <div style="position:absolute; top:275px; left:1640px; padding:3px; font-size:20px; color:#fff;  width:220px; text-align:center; height:60px; ">
        EL NUEVO EXOTICO HOTEL MARIGOLD
    </div>
    
    <div style="position:absolute; top:349px; left:1670px; padding:3px; font-size:28px; color:#fff; font-weight:bold; width:160px; text-align:center;">
        08:00 am
    </div>
    
    <div style="position:absolute; top:386px; left:1670px; padding:3px; font-size:28px; color:#fff; font-weight:bold; width:160px; text-align:center;">
        08:00 am
    </div>
    
    <div style="position:absolute; top:423px; left:1670px; padding:3px; font-size:28px; color:#fff; font-weight:bold; width:160px; text-align:center;">
        11:30 am
    </div>
    
    <div style="position:absolute; top:459px; left:1670px; padding:3px; font-size:28px; color:#fff; font-weight:bold; width:160px; text-align:center;">
        10:00 am
    </div>
    
    <!-- FIN TERCER CUADRANTE -->

<!-- FIN PARTE DE ARRIBA -->

<!--
------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------
-->

<!-- PARTE DE ABAJO +325 -->
    <!-- PRIMER CUADRANTE -->
    
    <div style="position:absolute; top:525px; left:290px; padding:3px; font-size:21px; color:#231f20; font-weight:bold;">
        Numero de Sala: 1
    </div>
    
    <div style="position:absolute; top:548px; left:300px; padding:3px; font-size:21px; color:#231f20; font-weight:bold; width:170px; text-align:center;">
        Categoria
    </div>
    
    <div style="position:absolute; top:600px; left:275px; padding:3px; font-size:20px; color:#fff;  width:220px; text-align:center; height:60px; ">
        EL NUEVO EXOTICO HOTEL MARIGOLD
    </div>
    
    <div style="position:absolute; top:674px; left:305px; padding:3px; font-size:28px; color:#fff; font-weight:bold; width:160px; text-align:center;">
        08:00 am
    </div>
    
    <div style="position:absolute; top:711px; left:305px; padding:3px; font-size:28px; color:#fff; font-weight:bold; width:160px; text-align:center;">
        08:00 am
    </div>
    
    <div style="position:absolute; top:748px; left:305px; padding:3px; font-size:28px; color:#fff; font-weight:bold; width:160px; text-align:center;">
        11:30 am
    </div>
    
    <div style="position:absolute; top:784px; left:305px; padding:3px; font-size:28px; color:#fff; font-weight:bold; width:160px; text-align:center;">
        10:00 am
    </div>
    
    <!-- FIN PRIMER CUADRANTE -->
    
    
    
    
    
    
    <!-- SEGUNDO CUADRANTE  + 455 -->
    
    <div style="position:absolute; top:525px; left:745px; padding:3px; font-size:21px; color:#231f20; font-weight:bold;">
        Numero de Sala: 1
    </div>
    
    <div style="position:absolute; top:548px; left:755px; padding:3px; font-size:21px; color:#231f20; font-weight:bold; width:170px; text-align:center;">
        Categoria
    </div>
    
    <div style="position:absolute; top:600px; left:730px; padding:3px; font-size:20px; color:#fff;  width:220px; text-align:center; height:60px; ">
        EL NUEVO EXOTICO HOTEL MARIGOLD
    </div>
    
    <div style="position:absolute; top:674px; left:760px; padding:3px; font-size:28px; color:#fff; font-weight:bold; width:160px; text-align:center;">
        08:00 am
    </div>
    
    <div style="position:absolute; top:711px; left:760px; padding:3px; font-size:28px; color:#fff; font-weight:bold; width:160px; text-align:center;">
        08:00 am
    </div>
    
    <div style="position:absolute; top:748px; left:760px; padding:3px; font-size:28px; color:#fff; font-weight:bold; width:160px; text-align:center;">
        11:30 am
    </div>
    
    <div style="position:absolute; top:784px; left:760px; padding:3px; font-size:28px; color:#fff; font-weight:bold; width:160px; text-align:center;">
        10:00 pm
    </div>
    
    <!-- FIN SEGUNDO CUADRANTE -->
    
    
    <!-- SEGUNDO TERCER  + 455 -->
    
    <div style="position:absolute; top:525px; left:1200px; padding:3px; font-size:21px; color:#231f20; font-weight:bold;">
        Numero de Sala: 1
    </div>
    
    <div style="position:absolute; top:548px; left:1210px; padding:3px; font-size:21px; color:#231f20; font-weight:bold; width:170px; text-align:center;">
        Categoria
    </div>
    
    <div style="position:absolute; top:600px; left:1185px; padding:3px; font-size:20px; color:#fff;  width:220px; text-align:center; height:60px; ">
        EL NUEVO EXOTICO HOTEL MARIGOLD
    </div>
    
    <div style="position:absolute; top:674px; left:1215px; padding:3px; font-size:28px; color:#fff; font-weight:bold; width:160px; text-align:center;">
        08:00 am
    </div>
    
    <div style="position:absolute; top:711px; left:1215px; padding:3px; font-size:28px; color:#fff; font-weight:bold; width:160px; text-align:center;">
        08:00 am
    </div>
    
    <div style="position:absolute; top:748px; left:1215px; padding:3px; font-size:28px; color:#fff; font-weight:bold; width:160px; text-align:center;">
        11:30 am
    </div>
    
    <div style="position:absolute; top:784px; left:1215px; padding:3px; font-size:28px; color:#fff; font-weight:bold; width:160px; text-align:center;">
        10:00 pm
    </div>
    
    <!-- FIN TERCER CUADRANTE -->
    
    
    <!-- SEGUNDO TERCER  + 455 -->
    
    <div style="position:absolute; top:525px; left:1655px; padding:3px; font-size:21px; color:#231f20; font-weight:bold;">
        Numero de Sala: 1
    </div>
    
    <div style="position:absolute; top:548px; left:1665px; padding:3px; font-size:21px; color:#231f20; font-weight:bold; width:170px; text-align:center;">
        Categoria
    </div>
    
    <div style="position:absolute; top:600px; left:1640px; padding:3px; font-size:20px; color:#fff;  width:220px; text-align:center; height:60px; ">
        EL NUEVO EXOTICO HOTEL MARIGOLD
    </div>
    
    <div style="position:absolute; top:674px; left:1670px; padding:3px; font-size:28px; color:#fff; font-weight:bold; width:160px; text-align:center;">
        08:00 am
    </div>
    
    <div style="position:absolute; top:711px; left:1670px; padding:3px; font-size:28px; color:#fff; font-weight:bold; width:160px; text-align:center;">
        08:00 am
    </div>
    
    <div style="position:absolute; top:748px; left:1670px; padding:3px; font-size:28px; color:#fff; font-weight:bold; width:160px; text-align:center;">
        11:30 am
    </div>
    
    <div style="position:absolute; top:784px; left:1670px; padding:3px; font-size:28px; color:#fff; font-weight:bold; width:160px; text-align:center;">
        10:00 pm
    </div>
    
    <!-- FIN TERCER CUADRANTE -->

<!-- FIN PARTE DE ABAJO -->


<!-- PRECIOS -->

    <div style="position:absolute; top:955px; left:1022px; padding:3px; font-size:19px; color:#fff; font-weight:bold; width:153px; text-align:center;">
        Niños B/. 3.00
    </div>
	
    <div style="position:absolute; top:987px; left:1022px; padding:3px; font-size:19px; color:#fff; font-weight:bold; width:153px; text-align:center;">
        Adultos B/. 5.00
    </div>
    
    
    <div style="position:absolute; top:955px; left:1185px; padding:3px; font-size:19px; color:#fff; font-weight:bold; width:153px; text-align:center;">
        Niños B/. 5.50
    </div>
	
    <div style="position:absolute; top:987px; left:1185px; padding:3px; font-size:19px; color:#fff; font-weight:bold; width:153px; text-align:center;">
        Adultos B/. 7.00
    </div>
    
    
    <div style="position:absolute; top:955px; left:1360px; padding:3px; font-size:19px; color:#fff; font-weight:bold; width:240px; text-align:center; ">
        Sala Regular B/. 2.50
    </div>
	
    <div style="position:absolute; top:987px; left:1360px; padding:3px; font-size:19px; color:#fff; font-weight:bold; width:240px; text-align:center;">
        Sala 3D B/. 3.50
    </div>
<!-- FIN PRECIOS -->

</body>
</html>