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
	}
	
}

$refdescripcion = array(0=>$cadVariable1);
$refCampo 	=  array("reftiposocio");

//////////////////////////////////////////////  FIN de los opciones //////////////////////////



$resNoticiasFotos = $serviciosSocios->TraerFotosNoticias($id);

$cantidadImagenes = 0;
$cantidadImagenes = mysql_num_rows($resNoticiasFotos);

$formulario 	= $serviciosFunciones->camposTablaVer($id, "idsocio",$tabla,$lblCambio,$lblreemplazo,$refdescripcion,$refCampo);


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
        	<p style="color: #fff; font-size:18px; height:16px;">Ver Socios</p>
        	
        </div>
    	<div class="cuerpoBox">
        	<form class="form-inline formulario" role="form">
        	
			<div class="row" id="muestra">
            <div align="center">
            	<h3>Empresa: <?php echo $_SESSION['usua_empresa']; ?></h3>
            </div>
            <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css" media="all"/>
			<?php echo $formulario; ?>
            </div>
            
            <div class="row" style="margin-left:25px; margin-right:25px;">
                <h3>Imagenes/Archivos Cargados</h3>
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
                                <a href="<?php echo '../../archivos/'.$rowImg[0].'/'.$rowImg[1].'/'.utf8_encode($rowImg[2]) ?>" target="_blank"><img src="<?php echo '../../archivos/'.$rowImg[0].'/'.$rowImg[1].'/'.utf8_encode($rowImg[2]) ?>" width="100" height="100"></a>
                                <?php } else { ?>
                                <a href="<?php echo '../../archivos/'.$rowImg[0].'/'.$rowImg[1].'/'.utf8_encode($rowImg[2]) ?>" target="_blank"><img src="../../imagenes/pdf_ico2.jpg" width="100" height="100"><?php echo $rowImg['imagen']; ?></a>
                                <?php } ?>
                            </div>
                            
                            </div>
                            
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
                        <button type="button" class="btn btn-info imprimir" id="<?php echo $id; ?>" style="margin-left:0px;"><span class="glyphicon glyphicon-print"></span> Imprimir</button>
                    </li>
                    <li>
                        <button type="button" class="btn btn-primary enviaremail" id="<?php echo $id; ?>" style="margin-left:0px;"><span class="glyphicon glyphicon-envelope"></span> Enviar Por Email</button>
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



<script type="text/javascript">
$(document).ready(function(){

	$('.volver').click(function(event){
		 
		url = "index.php";
		$(location).attr('href',url);
	});//fin del boton modificar
	
	


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
