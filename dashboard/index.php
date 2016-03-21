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
		#vista table tbody tr th {
			background-color:#FC3;
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
    	<table class="table table-bordered table-responsive table-striped">
        	<tbody>
            	<tr>
                	<th>RAZON SOCIAL</th>
                    <td colspan="5"><?php echo strtoupper(mysql_result($resEmpresa,0,'razonsocial')); ?></td>
                </tr>
            	<tr>
                	<th>RFC</th>
                    <td colspan="5"><?php echo strtoupper(mysql_result($resEmpresa,0,'rfc')); ?></td>
                </tr>
            	<tr>
                	<th>CORREO ELECTRONICO</th>
                    <td colspan="2"><?php echo (mysql_result($resEmpresa,0,'email')); ?></td>
                    <th>CONTRASEÑA</th>
                    <td colspan="2"><?php echo (mysql_result($resEmpresa,0,'contrasenia')); ?></td>
                </tr>
                
                <tr>
            		<th>TELEFONO</th>
            		<td colspan="5"><?php echo strtoupper(mysql_result($resEmpresa,0,'telefono')); ?></td>
            	</tr>
                
                <tr>
            		<th>DOMICILIO</th>
            		<td colspan="5"><?php echo strtoupper(mysql_result($resEmpresa,0,'direccion')); ?></td>
            	</tr>
            
           		<tr>
                	<th>NOTARIA</th>
                    <td colspan="2"><?php echo strtoupper(mysql_result($resEmpresa,0,'notaria')); ?></td>
                    <th>NOTARIO</th>
                    <td colspan="2"><?php echo strtoupper(mysql_result($resEmpresa,0,'notario')); ?></td>
                </tr>
                
                <tr>
            		<th>GIRO</th>
            		<td colspan="5"><?php echo strtoupper(mysql_result($resEmpresa,0,'giro')); ?></td>
            	</tr>
                <tr>
            		<th>OBJETO</th>
            		<td colspan="5"><?php echo strtoupper(mysql_result($resEmpresa,0,'objetoempresa')); ?></td>
            	</tr>

            	<tr>
                	<th>SOCIO A</th>
                    <td><?php echo strtoupper(mysql_result($resEmpresa,0,'socia_a')); ?></td>
                    <td colspan="4"></td>
                </tr>
                
                <tr>
                	<th>SOCIO B</th>
                    <td><?php echo strtoupper(mysql_result($resEmpresa,0,'socio_b')); ?></td>
                    <td colspan="4" align="center">FACTURA</td>
                </tr>
            
           		<tr> 
           			<th>ADMINISTRADOR</th>
                    <td><?php echo strtoupper(mysql_result($resEmpresa,0,'administrador')); ?></td>
                    <th>PLATAFORMA</th>
                    <td colspan="2"><?php echo strtoupper(mysql_result($resEmpresa,0,'plataforma')); ?></td>
                    <th>CONTRASEÑA</th>
            	</tr>
                
                <tr> 
           			<th>COMISARIO</th>
                    <td><?php echo strtoupper(mysql_result($resEmpresa,0,'comisario')); ?></td>
                    <th>USUARIO</th>
                    <td colspan="2"><?php echo (mysql_result($resEmpresa,0,'usuario')); ?></td>
                    <td><?php echo (mysql_result($resEmpresa,0,'contraseniaemail')); ?></td>
            	</tr>
                
                <tr>
            		<th>APODERADO</th>
            		<td colspan="5"><?php echo strtoupper(mysql_result($resEmpresa,0,'apoderado')); ?></td>
            	</tr>
                
                <tr>
            		<th>RPP</th>
            		<td colspan="5"><?php echo strtoupper(mysql_result($resEmpresa,0,'rpp')); ?></td>
            	</tr>
                <tr>
            		<th>CUENTA</th>
            		<td colspan="5"><?php echo (mysql_result($resEmpresa,0,'cuenta')); ?></td>
            	</tr>
            <?php while ($row = mysql_fetch_array($resBancos)) { ?>
            	<tr>
                	<th>BANCO/SUCURSAL</th>
                    <td align="center"><?php echo $row['banco']."/".$row['sucursal']; ?></td>
                    <th>CUENTA</th>
                    <td align="center"><?php echo $row['cuenta']; ?></td>
                    <th>CLABE</th>
                    <td align="center"><?php echo $row['clave']; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        
        </table>
       
        
        
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
