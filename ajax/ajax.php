<?php

include ('../includes/funcionesUsuarios.php');
include ('../includes/funciones.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funcionesClientes.php');
include ('../includes/funcionesEmpresas.php');
include ('../includes/funcionesEmpresaClientes.php');
include ('../includes/funcionesEmpresaBancos.php');
include ('../includes/funcionesFacturas.php');
include ('../includes/funcionesPagos.php');
include ('../includes/funcionesTipoSocios.php');
include ('../includes/funcionesSocios.php');
include ('../includes/funcionesSociosEmpresas.php');

$serviciosUsuarios  		= new ServiciosUsuarios();
$serviciosFunciones 		= new Servicios();
$serviciosHTML				= new ServiciosHTML();
$serviciosClientes 			= new ServiciosClientes();
$serviciosEmpresas			= new ServiciosEmpresas();
$serviciosEmpresaClientes 	= new ServiciosEmpresaClientes();
$serviciosEmpresaBancos		= new ServiciosEmpresaBancos();
$serviciosFacturas			= new ServiciosFacturas();
$serviciosPagos				= new ServiciosPagos();
$serviciosTipoSocios		= new ServiciosTipoSocios();
$serviciosSocios			= new ServiciosSocios();
$serviciosSociosEmpresas	= new ServiciosSociosEmpresas();

$accion = $_POST['accion'];


switch ($accion) {
    case 'login':
        enviarMail($serviciosUsuarios);
        break;
	case 'entrar':
		entrar($serviciosUsuarios);
		break;
	case 'insertarUsuario':
        insertarUsuario($serviciosUsuarios);
        break;
	case 'modificarUsuario':
        modificarUsuario($serviciosUsuarios);
        break;
	case 'eliminarUsuario':
		eliminarUsuario($serviciosUsuarios);
        break;
	case 'registrar':
		registrar($serviciosUsuarios);
        break;

/* PARA Clientes */
case 'insertarClientes': 
insertarClientes($serviciosClientes, $serviciosEmpresaClientes); 
break; 
case 'modificarClientes': 
modificarClientes($serviciosClientes); 
break; 
case 'eliminarClientes': 
eliminarClientes($serviciosClientes); 
break; 

case 'traerClientesPorEmpresa':
traerClientesPorEmpresa($serviciosClientes);
break;

case 'insertarClienteEmpresa':
	insertarClienteEmpresa($serviciosEmpresaClientes);
	break;
/* Fin */

/* PARA Empresas */
case 'insertarEmpresas': 
insertarEmpresas($serviciosEmpresas); 
break; 
case 'modificarEmpresas': 
modificarEmpresas($serviciosEmpresas); 
break; 
case 'eliminarEmpresas': 
eliminarEmpresas($serviciosEmpresas); 
break; 

case 'cambiarEmpresa':
		cambiarEmpresa($serviciosEmpresas);
		break;
/* Fin */

/* PARA Facturas */
case 'insertarFacturas':
insertarFacturas($serviciosFacturas);
break;
case 'modificarFacturas':
modificarFacturas($serviciosFacturas);
break;
case 'eliminarFacturas':
eliminarFacturas($serviciosFacturas);
break;

case 'traerFacturasPorCliente':
traerFacturasPorCliente($serviciosFacturas);
break;
case 'traerFacturasPorClienteEmpresa':
traerFacturasPorClienteEmpresa($serviciosFacturas);
break;
case 'traerFacturasPorEmpresa':
traerFacturasPorEmpresa($serviciosFacturas);
break;
case 'traerMontoFacturasPorId':
traerMontoFacturasPorId($serviciosFacturas);
break;

/* Fin */

/* PARA Pagos */
case 'insertarPagos': 
insertarPagos($serviciosPagos, $serviciosFacturas); 
break; 
case 'modificarPagos': 
modificarPagos($serviciosPagos); 
break; 
case 'eliminarPagos': 
eliminarPagos($serviciosPagos); 
break; 

case 'insertarPagosFacturas': 
insertarPagosFacturas($serviciosPagos); 
break; 
case 'modificarPagosFacturas': 
modificarPagosFacturas($serviciosPagos); 
break; 
case 'eliminarPagosFacturas': 
eliminarPagosFacturas($serviciosPagos); 
break; 
/* Fin */


/* PARA EmpresaBancos */
case 'insertarEmpresaBancos': 
insertarEmpresaBancos($serviciosEmpresaBancos); 
break; 
case 'modificarEmpresaBancos': 
modificarEmpresaBancos($serviciosEmpresaBancos); 
break; 
case 'eliminarEmpresaBancos': 
eliminarEmpresaBancos($serviciosEmpresaBancos); 
break; 

/* Fin */

/* PARA Socios */
case 'insertarSocios': 
	insertarSocios($serviciosSocios,$serviciosSociosEmpresas); 
	break; 
case 'modificarSocios': 
	modificarSocios($serviciosSocios); 
	break; 
case 'eliminarSocios': 
	eliminarSocios($serviciosSocios); 
	break; 
case 'eliminarFoto':
	eliminarFoto($serviciosSocios);
	break;

/* Fin */

/* PARA TipoSocios */
case 'insertarTipoSocios': 
insertarTipoSocios($serviciosTipoSocios); 
break; 
case 'modificarTipoSocios': 
modificarTipoSocios($serviciosTipoSocios); 
break; 
case 'eliminarTipoSocios': 
eliminarTipoSocios($serviciosTipoSocios); 
break; 

/* Fin */

/* PARA SociosEmpresas */
case 'insertarSociosEmpresas': 
insertarSociosEmpresas($serviciosSociosEmpresas,$serviciosSociosEmpresas); 
break; 
case 'modificarSociosEmpresas': 
modificarSociosEmpresas($serviciosSociosEmpresas); 
break; 
case 'eliminarSociosEmpresas': 
eliminarSociosEmpresas($serviciosSociosEmpresas); 
break; 

/* Fin */
}

//////////////////////////Traer datos */////////////////////////////////////////////////////////////

/* PARA Clientes */
function insertarClientes($serviciosClientes, $serviciosEmpresas) { 
	$razonsocial = $_POST['razonsocial']; 
	$rfc = $_POST['rfc']; 
	$direccion = $_POST['direccion']; 
	$email = $_POST['email']; 
	$telefono = $_POST['telefono']; 
	$celular = $_POST['celular']; 
	
	$res = $serviciosClientes->insertarClientes($razonsocial,$rfc,$direccion,$email,$telefono,$celular); 
	
	if ((integer)$res > 0) {
		session_start();
		
		$serviciosEmpresas->insertarEmpresaClientes($_SESSION['usua_idempresa'],$res);
		echo ''; 
	} else { 
		echo 'Huvo un error al insertar datos';	
	} 
} 
function modificarClientes($serviciosClientes) { 
$id = $_POST['id']; 
$razonsocial = $_POST['razonsocial']; 
$rfc = $_POST['rfc']; 
$direccion = $_POST['direccion']; 
$email = $_POST['email']; 
$telefono = $_POST['telefono']; 
$celular = $_POST['celular']; 
$res = $serviciosClientes->modificarClientes($id,$razonsocial,$rfc,$direccion,$email,$telefono,$celular); 
if ($res == true) { 
echo ''; 
} else { 
echo 'Huvo un error al modificar datos'; 
} 
} 
function eliminarClientes($serviciosClientes) { 
$id = $_POST['id']; 
$res = $serviciosClientes->eliminarClientes($id); 
echo $res; 
} 

function traerClientesPorEmpresa($serviciosClientes) {
	$idEmpresa = $_POST['idEmpresa']; 
	$res = $serviciosClientes->traerClientesPorEmpresa($idEmpresa);
	
	$cad = '';
	while ($row = mysql_fetch_array($res)) {
		$cad .= '<option value="'.$row[0].'">'.$row[1].'</option>';	
	}
	
	echo $cad; 
}

function insertarClienteEmpresa($serviciosEmpresaClientes) {
	$refCliente = $_POST['refclientecargado'];
	$idEmpresa  = $_POST['idEmpresa'];
	
	$res = $serviciosEmpresaClientes->insertarEmpresaClientes($idEmpresa,$refCliente);
	
	if ((integer)$res > 0) {
		echo ''; 
	} else { 
		echo 'Huvo un error al insertar datos';	
	} 
}

/* Fin */


/* PARA Empresas */
function insertarEmpresas($serviciosEmpresas) { 
$razonsocial = $_POST['razonsocial']; 
$rfc = $_POST['rfc']; 
$direccion = $_POST['direccion']; 
$email = $_POST['email']; 
$telefono = $_POST['telefono']; 
$celular = $_POST['celular']; 
$objetoempresa = $_POST['objetoempresa']; 
$notaria = $_POST['notaria']; 
$notario = $_POST['notario']; 
$giro = $_POST['giro']; 
$socia_a = $_POST['socia_a']; 
$socio_b = $_POST['socio_b']; 
$administrador = $_POST['administrador']; 
$comisario = $_POST['comisario']; 
$apoderado = $_POST['apoderado']; 
$rpp = $_POST['rpp']; 
$plataforma = $_POST['plataforma']; 
$usuario = $_POST['usuario']; 
$contrasenia = $_POST['contrasenia']; 
$contraseniaemail = $_POST['contraseniaemail']; 
$cuenta = $_POST['cuenta']; 

$res = $serviciosEmpresas->insertarEmpresas($razonsocial,$rfc,$direccion,$email,$telefono,$celular,$objetoempresa,$notaria,$notario,$giro,$socia_a,$socio_b,$administrador,$comisario,$apoderado,$rpp,$plataforma,$usuario,$contrasenia,$contraseniaemail,$cuenta);
if ((integer)$res > 0) { 
echo ''; 
} else { 
echo 'Huvo un error al insertar datos';	
} 
} 
function modificarEmpresas($serviciosEmpresas) { 
$id = $_POST['id']; 
$razonsocial = $_POST['razonsocial']; 
$rfc = $_POST['rfc']; 
$direccion = $_POST['direccion']; 
$email = $_POST['email']; 
$telefono = $_POST['telefono']; 
$celular = $_POST['celular']; 
$objetoempresa = $_POST['objetoempresa']; 
$notaria = $_POST['notaria']; 
$notario = $_POST['notario']; 
$giro = $_POST['giro']; 
$socia_a = $_POST['socia_a']; 
$socio_b = $_POST['socio_b']; 
$administrador = $_POST['administrador']; 
$comisario = $_POST['comisario']; 
$apoderado = $_POST['apoderado']; 
$rpp = $_POST['rpp']; 
$plataforma = $_POST['plataforma']; 
$usuario = $_POST['usuario']; 
$contrasenia = $_POST['contrasenia']; 
$contraseniaemail = $_POST['contraseniaemail'];
$cuenta = $_POST['cuenta'];

$res = $serviciosEmpresas->modificarEmpresas($id,$razonsocial,$rfc,$direccion,$email,$telefono,$celular,$objetoempresa,$notaria,$notario,$giro,$socia_a,$socio_b,$administrador,$comisario,$apoderado,$rpp,$plataforma,$usuario,$contrasenia,$contraseniaemail,$cuenta);
if ($res == true) { 
echo ''; 
} else { 
echo 'Huvo un error al modificar datos'; 
} 
} 

function eliminarEmpresas($serviciosEmpresas) { 
$id = $_POST['id']; 
$res = $serviciosEmpresas->eliminarEmpresas($id); 
echo $res; 
} 


function cambiarEmpresa($serviciosEmpresas) {
	$idempresa		=	$_POST['idempresa'];
	
	$res = $serviciosEmpresas->cambiarEmpresa($idempresa);
	//echo $res;
	if ($res == true) {
		echo '';
	} else {
		echo 'Huvo un error al cambiar la empresa';
	}
}
/* Fin */


/* PARA Facturas */
function insertarFacturas($serviciosFacturas) {

session_start();

$nrofactura = $_POST['nrofactura'];
$fecha = $_POST['fecha'];
$refcliente = $_POST['refcliente'];
$concepto = $_POST['concepto'];
$importebruto = $_POST['importebruto'];
$iva = $_POST['iva'];
$total = $_POST['total'];
$refempresa = $_SESSION['usua_idempresa'];

$res = $serviciosFacturas->insertarFacturas($nrofactura,$fecha,$refcliente,$concepto,$importebruto,$iva,$total,$refempresa);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos ';
}
}
function modificarFacturas($serviciosFacturas) {

session_start();
	
$id = $_POST['id'];
$nrofactura = $_POST['nrofactura'];
$fecha = $_POST['fecha'];
$refcliente = $_POST['refcliente'];
$concepto = $_POST['concepto'];
$importebruto = $_POST['importebruto'];
$iva = $_POST['iva'];
$total = $_POST['total'];
$refempresa = $_SESSION['usua_idempresa'];

$res = $serviciosFacturas->modificarFacturas($id,$nrofactura,$fecha,$refcliente,$concepto,$importebruto,$iva,$total,$refempresa);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarFacturas($serviciosFacturas) {
$id = $_POST['id'];
$res = $serviciosFacturas->eliminarFacturas($id);
echo $res;
}


function traerFacturasPorCliente($serviciosFacturas) {
	$refCliente		= $_POST['refcliente'];
	$forma			= $_POST['forma'];
	
	$resFacturas = $serviciosFacturas->traerFacturasPorCliente($refCliente);

	switch ($forma) {
		case 'check':
			$cadFacturasS = '<ul class="list-inline">';
			while ($rowFS = mysql_fetch_array($resFacturas)) {
				$cadFacturasS = $cadFacturasS."<li>".'<input id="fecha'.$rowFS[0].'" class="form-control lstcheck" type="checkbox" required="" style="width:330px;" name="factura'.$rowFS[0].'"><p>'.$rowFS[1]." - Fecha: ".$rowFS['fecha']." - Importe: $".number_format($rowFS['total'],2,'.',',').'</p>'."</li>";
			}
			$cadFacturasS = $cadFacturasS."</ul>";
			break;
		
	}
	
	echo $cadFacturasS;
}


function traerFacturasPorClienteEmpresa($serviciosFacturas) {
	$refCliente		= $_POST['refcliente'];
	$refEmpresa		= $_POST['refempresa'];
	
	$fechaDesde		= $_POST['fechainicio'];
	$fechaHasta		= $_POST['fechafin'];
	
	$forma			= $_POST['forma'];
	
	$resFacturas = $serviciosFacturas->traerFacturasPorClienteEmpresa($refCliente, $refEmpresa, $fechaDesde, $fechaHasta);
	//echo $resFacturas;
	switch ($forma) {
		case 'check':
			/*
			$cadFacturasS = '<ul class="list-inline">';
			while ($rowFS = mysql_fetch_array($resFacturas)) {
				if ($rowFS['saldo'] == 0) {
					$cadFacturasS = $cadFacturasS."<li>".'<input id="factura'.$rowFS[0].'" class="form-control lstcheck" type="checkbox" required="" style="width:430px;" name="factura'.$rowFS[0].'">'."<p><span style='color:#2DE404;' class='glyphicon glyphicon-ok'></span> Nro: <strong>".$rowFS[1]."</strong> - Fecha: ".$rowFS['fecha']." - Importe: <strong>$".number_format($rowFS['total'],2,'.',',')."</strong></p></li>";
				} else {
					$cadFacturasS = $cadFacturasS."<li>".'<input id="factura'.$rowFS[0].'" class="form-control lstcheck" type="checkbox" required="" style="width:430px;" name="factura'.$rowFS[0].'">'."<p><span style='color:#E40404;' class='glyphicon glyphicon-remove'></span> Nro: <strong>".$rowFS[1]."</strong> - Fecha: ".$rowFS['fecha']." - Importe: <strong>$".number_format($rowFS['total'],2,'.',',')."</strong></p></li>";
				}
			}
			$cadFacturasS = $cadFacturasS."</ul>";
			*/
			
			
			$cadRows = '';
			while ($rowFS = mysql_fetch_array($resFacturas)) {
				
				if ($rowFS['saldo'] == 0) {
					$cadRows .= '<tr>';
						$cadRows .= '<td><span style="color:#2DE404;" class="glyphicon glyphicon-ok"></span></td>'.
									'<td>'.$rowFS[1].'</td>'.
									'<td>'.$rowFS['fecha'].'</td>'.
									'<td>'.number_format($rowFS['total'],2,'.',',').'</td>'.
									'<td>'.number_format($rowFS['total']-$rowFS['saldo'],2,'.',',').'</td>'.
									'<td>'.number_format($rowFS['saldo'],2,'.',',').'</td>'.
									'<td style="text-align:center;">'.'<input id="factura'.$rowFS[0].'" class="form-control lstcheck" type="checkbox" required="" name="factura'.$rowFS[0].'" style="height:15px;">'.'</td>';
					$cadRows .= '</tr>';	
				} else {
					$cadRows .= '<tr>';
						$cadRows .= '<td><span style="color:#E40404;" class="glyphicon glyphicon-remove"></span></td>'.
									'<td>'.$rowFS[1].'</td>'.
									'<td>'.$rowFS['fecha'].'</td>'.
									'<td>'.number_format($rowFS['total'],2,'.',',').'</td>'.
									'<td>'.number_format($rowFS['total']-$rowFS['saldo'],2,'.',',').'</td>'.
									'<td>'.number_format($rowFS['saldo'],2,'.',',').'</td>'.
									'<td style="text-align:center;">'.'<input id="factura'.$rowFS[0].'" class="form-control lstcheck" type="checkbox" required="" name="factura'.$rowFS[0].'" style="height:15px;">'.'</td>';
					$cadRows .= '</tr>';
				}
			}
			
			$cadFacturasS = '<table class="table table-striped table-responsive table-bordered" id="example2">
            	<thead>
                	<tr>
                    	<th></th>
						<th>Nro</th>
						<th>Fecha</th>
						<th>Importe</th>
						<th>Abono</th>
						<th>Saldo</th>
                        <th style="text-align:center;">Seleccionar</th>
                    </tr>
                </thead>
                <tbody id="lstFacturasCliente">';
			
			$cadFacturasS .= utf8_encode($cadRows).'
                </tbody>
            </table>
			
		
		';	
			break;
		
	}
	
	echo $cadFacturasS;
	//echo $resFacturas;
}

function traerMontoFacturasPorId($serviciosFacturas) {
	$idFactura		= $_POST['idfactura'];
//	$refEmpresa		= $_POST['refempresa'];

	$resFacturas = $serviciosFacturas->traerFacturasPorId($idFactura);
	
	if (mysql_num_rows($resFacturas)>0) {
		echo mysql_result($resFacturas,0,'total')."|".mysql_result($resFacturas,0,'saldo');
	} else {
		echo 0;	
	}
	
}


function traerFacturasPorEmpresa($serviciosFacturas) {
	$refEmpresa		= $_POST['refempresa'];
}

/* Fin */ 



/* PARA Pagos */
function insertarPagos($serviciosPagos, $serviciosFacturas) {
	session_start();
	
	$fechapago 		= $_POST['fechapago']; 
	$montoapagar 	= $_POST['montoapagar'];
	
	$referencia 	= $_POST['referencia']; 
	$comentarios 	= $_POST['comentarios']; 
	
	$idcliente		= $_POST['refcliente']; 
	$idempresa		= $_SESSION['usua_idempresa']; 
	
	$resFacturas = $serviciosFacturas->traerFacturasPorClienteEmpresa($idcliente, $idempresa, '', '');
	
	$lstFacturas = array();
	
	$cadPost = 'factura';
	while ($rowFS = mysql_fetch_array($resFacturas)) {
		$cadPost   .=	$rowFS[0];
		
		if (isset($_POST[$cadPost])) {
			$montoapagar 		= $montoapagar - $rowFS['saldo'];
			if ($montoapagar > 0) {
				$lstFacturas[] 	= array("idFact" => $rowFS[0], "monto" => $rowFS['saldo'], "estatus" => 3);
			} else {
				if ($montoapagar == 0) {
					$lstFacturas[] 	= array("idFact" => $rowFS[0], "monto" => $rowFS['saldo'], "estatus" => 3);
					break 1;
				} else {
					$lstFacturas[] 	= array("idFact" => $rowFS[0], "monto" => ($rowFS['saldo'] + $montoapagar), "estatus" => 2);
					break 1;
				}
			}
		}
		$cadPost = 'factura';
	}
	
	
	

	foreach ($lstFacturas as $valor) {
		$res = $serviciosPagos->insertarPagos($fechapago, $valor['monto'], $referencia, $comentarios); 
		$serviciosPagos->insertarPagosFacturas($res, $valor['idFact'], $valor['estatus']);
	}
	echo ''; 

	
} 
function modificarPagos($serviciosPagos) { 
	$id = $_POST['id']; 
	$idFactura = $_POST['idfactura']; 
	$fechapago = $_POST['fechapago']; 
	$montoapagar = $_POST['montoapagar']; 
	$referencia = $_POST['referencia']; 
	$comentarios = $_POST['comentarios']; 
	
	$res = $serviciosPagos->modificarPagos($id,$fechapago,$montoapagar,$referencia,$comentarios); 
	
	if ($res == true) { 
		$idestatus = $serviciosPagos->calcularPagado($idFactura);
		
		$serviciosPagos->modificarPagosFacturasEstado($id,$idFactura,$idestatus);
		echo '';
		 
	} else { 
		echo 'Huvo un error al modificar datos'; 
	} 
} 
function eliminarPagos($serviciosPagos) { 
$id = $_POST['id']; 
$res = $serviciosPagos->eliminarPagos($id); 
$serviciosPagos->eliminarPagosFacturasPorPago($id);
echo $res; 
} 

function insertarPagosFacturas($serviciosPagosFacturas) { 
$refpago = $_POST['refpago']; 
$reffactura = $_POST['reffactura']; 
$refestatu = $_POST['refestatu']; 
$res = $serviciosPagosFacturas->insertarPagosFacturas($refpago,$reffactura,$refestatu); 
if ((integer)$res > 0) { 
echo ''; 
} else { 
echo 'Huvo un error al insertar datos';	
} 
} 

function modificarPagosFacturas($serviciosPagosFacturas) { 
$id = $_POST['id']; 
$refpago = $_POST['refpago']; 
$reffactura = $_POST['reffactura']; 
$refestatu = $_POST['refestatu']; 
$res = $serviciosPagosFacturas->modificarPagosFacturas($id,$refpago,$reffactura,$refestatu); 
if ($res == true) { 
echo ''; 
} else { 
echo 'Huvo un error al modificar datos'; 
} 
}
 
function eliminarPagosFacturas($serviciosPagosFacturas) { 
$id = $_POST['id']; 
$res = $serviciosPagosFacturas->eliminarPagosFacturas($id); 
echo $res; 
} 

/* Fin */


/* PARA EmpresaBancos */
function insertarEmpresaBancos($serviciosEmpresaBancos) {
$refempresa = $_POST['refempresa'];
$banco = $_POST['banco'];
$sucursal = $_POST['sucursal'];
$cuenta = $_POST['cuenta'];
$clave = $_POST['clave'];
if (isset($_POST['activo'])) {
$activo = 1;
} else {
$activo = 0;
}
$res = $serviciosEmpresaBancos->insertarEmpresaBancos($refempresa,$banco,$sucursal,$cuenta,$clave,$activo);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}

function modificarEmpresaBancos($serviciosEmpresaBancos) {
$id = $_POST['id'];
$refempresa = $_POST['refempresa'];
$banco = $_POST['banco'];
$sucursal = $_POST['sucursal'];
$cuenta = $_POST['cuenta'];
$clave = $_POST['clave'];
if (isset($_POST['activo'])) {
$activo = 1;
} else {
$activo = 0;
}
$res = $serviciosEmpresaBancos->modificarEmpresaBancos($id,$refempresa,$banco,$sucursal,$cuenta,$clave,$activo);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
} 

function eliminarEmpresaBancos($serviciosEmpresaBancos) { 
$id = $_POST['id']; 
$res = $serviciosEmpresaBancos->eliminarEmpresaBancos($id); 
echo $res; 
} 

/* Fin */



/* PARA Socios */
function insertarSocios($serviciosSocios, $serviciosSociosEmpresas) { 
	$reftiposocio 	= $_POST['reftiposocio'];
	$ife 			= $_POST['ife']; 
	$nombre 		= $_POST['nombre']; 
	$domicilio 		= $_POST['domicilio']; 
	$curp 			= $_POST['curp']; 
	$rfc 			= $_POST['rfc']; 
	$refempresa 	= $_POST['refempresa']; 
	
	$res = $serviciosSocios->insertarSocios($reftiposocio,$ife,$nombre,$domicilio,$curp,$rfc); 
	
	if ((integer)$res > 0) { 
		$serviciosSociosEmpresas->insertarSociosEmpresas($res,$refempresa);
		$imagenes = array("imagen1" => 'imagen1',
						  "imagen2" => 'imagen2',
						  "imagen3" => 'imagen3',
						  "imagen4" => 'imagen4');
	
		foreach ($imagenes as $valor) {
			$serviciosSocios->subirArchivo($valor,'galeria',$res);
		}
		echo ''; 
	} else { 
		echo 'Huvo un error al insertar datos';	
	} 
} 


function modificarSocios($serviciosSocios) { 
	$id = $_POST['id']; 
	$reftiposocio = $_POST['reftiposocio']; 
	$nombre = $_POST['nombre']; 
	$domicilio = $_POST['domicilio']; 
	$ife = $_POST['ife'];
	$curp = $_POST['curp']; 
	$rfc = $_POST['rfc']; 
	
	$cantImagenes		=	$_POST['cantidadImagenes'];
	
	$cantImagenes		= 4 - (integer)$cantImagenes;
	
	$res = $serviciosSocios->modificarSocios($id,$reftiposocio,$ife,$nombre,$domicilio,$curp,$rfc); 
	
	if ($res == true) { 
		$imagenes = array("imagen1" => 'imagen1',
						  "imagen2" => 'imagen2',
						  "imagen3" => 'imagen3',
						  "imagen4" => 'imagen4');
	
		for ($i=1;$i<=$cantImagenes;$i++) {
			$valor = "imagen".$i;
			$serviciosSocios->subirArchivo($valor,'galeria',$id);
		}
		echo ''; 
	} else { 
		echo 'Huvo un error al modificar datos'; 
	} 
} 


function eliminarSocios($serviciosSocios) { 
$id = $_POST['id']; 

$resT = $serviciosSocios->TraerFotosNoticias($id);
	
	while ($resT = mysql_fetch_array($resT)) {
		$serviciosSocios->eliminarFoto($resT['idfoto']);	
	}
	
$res = $serviciosSocios->eliminarSocios($id); 
echo $res; 
} 

function eliminarFoto($serviciosSocios) {
	$id			=	$_POST['id'];
	echo $serviciosSocios->eliminarFoto($id);
}

/* Fin */



/* PARA TipoSocios */
function insertarTipoSocios($serviciosTipoSocios) { 
$tiposocio = $_POST['tiposocio']; 
if (isset($_POST['activo'])) { 
$activo	= 1; 
} else { 
$activo = 0; 
} 
$res = $serviciosTipoSocios->insertarTipoSocios($tiposocio,$activo); 
if ((integer)$res > 0) { 
echo ''; 
} else { 
echo 'Huvo un error al insertar datos';	
} 
} 
function modificarTipoSocios($serviciosTipoSocios) { 
$id = $_POST['id']; 
$tiposocio = $_POST['tiposocio']; 
if (isset($_POST['activo'])) { 
$activo	= 1; 
} else { 
$activo = 0; 
} 
$res = $serviciosTipoSocios->modificarTipoSocios($id,$tiposocio,$activo); 
if ($res == true) { 
echo ''; 
} else { 
echo 'Huvo un error al modificar datos'; 
} 
} 
function eliminarTipoSocios($serviciosTipoSocios) { 
$id = $_POST['id']; 
$res = $serviciosTipoSocios->eliminarTipoSocios($id); 
echo $res; 
} 

/* Fin */


////////////////////////// FIN DE TRAER DATOS ////////////////////////////////////////////////////////////

//////////////////////////  BASICO  /////////////////////////////////////////////////////////////////////////

function toArray($query)
{
    $res = array();
    while ($row = @mysql_fetch_array($query)) {
        $res[] = $row;
    }
    return $res;
}


function entrar($serviciosUsuarios) {
	$email		=	$_POST['email'];
	$pass		=	$_POST['pass'];
	echo $serviciosUsuarios->loginUsuario($email,$pass);
}


function registrar($serviciosUsuarios) {
	$usuario			=	$_POST['usuario'];
	$password			=	$_POST['password'];
	$refroll			=	$_POST['refroll'];
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombrecompleto'];
	
	$res = $serviciosUsuarios->insertarUsuario($usuario,$password,$refroll,$email,$nombre);
	if ((integer)$res > 0) {
		echo '';	
	} else {
		echo $res;	
	}
}


function insertarUsuario($serviciosUsuarios) {
	$usuario			=	$_POST['usuario'];
	$password			=	$_POST['password'];
	$refroll			=	$_POST['refroll'];
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombrecompleto'];
	
	$res = $serviciosUsuarios->insertarUsuario($usuario,$password,$refroll,$email,$nombre);
	if ((integer)$res > 0) {
		echo '';	
	} else {
		echo $res;	
	}
}


function modificarUsuario($serviciosUsuarios) {
	$id					=	$_POST['id'];
	$usuario			=	$_POST['usuario'];
	$password			=	$_POST['password'];
	$refroll			=	$_POST['refroll'];
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombrecompleto'];
	
	$res = $serviciosUsuarios->modificarUsuario($id,$apellido,$password,$refroll,$email,$nombre);
	
	if ($res == true) { 
		echo ''; 
	} else { 
		echo 'Huvo un error al modificar datos'; 
	} 
}

function eliminarUsuario($serviciosUsuarios) {
	$id					=	$_POST['id'];
	
	$res = $serviciosUsuarios->eliminarUsuario($id);
	
	echo $res;
}


function enviarMail($serviciosUsuarios) {
	$email		=	$_POST['email'];
	$pass		=	$_POST['pass'];
	$idempresa  =	$_POST['idempresa'];
	
	echo $serviciosUsuarios->login($email,$pass,$idempresa);
}


function devolverImagen($nroInput) {
	
	if( $_FILES['archivo'.$nroInput]['name'] != null && $_FILES['archivo'.$nroInput]['size'] > 0 ){
	// Nivel de errores
	  error_reporting(E_ALL);
	  $altura = 100;
	  // Constantes
	  # Altura de el thumbnail en píxeles
	  //define("ALTURA", 100);
	  # Nombre del archivo temporal del thumbnail
	  //define("NAMETHUMB", "/tmp/thumbtemp"); //Esto en servidores Linux, en Windows podría ser:
	  //define("NAMETHUMB", "c:/windows/temp/thumbtemp"); //y te olvidas de los problemas de permisos
	  $NAMETHUMB = "c:/windows/temp/thumbtemp";
	  # Servidor de base de datos
	  //define("DBHOST", "localhost");
	  # nombre de la base de datos
	  //define("DBNAME", "portalinmobiliario");
	  # Usuario de base de datos
	  //define("DBUSER", "root");
	  # Password de base de datos
	  //define("DBPASSWORD", "");
	  // Mime types permitidos
	  $mimetypes = array("image/jpeg", "image/pjpeg", "image/gif", "image/png");
	  // Variables de la foto
	  $name = $_FILES["archivo".$nroInput]["name"];
	  $type = $_FILES["archivo".$nroInput]["type"];
	  $tmp_name = $_FILES["archivo".$nroInput]["tmp_name"];
	  $size = $_FILES["archivo".$nroInput]["size"];
	  // Verificamos si el archivo es una imagen válida
	  if(!in_array($type, $mimetypes))
		die("El archivo que subiste no es una imagen válida");
	  // Creando el thumbnail
	  switch($type) {
		case $mimetypes[0]:
		case $mimetypes[1]:
		  $img = imagecreatefromjpeg($tmp_name);
		  break;
		case $mimetypes[2]:
		  $img = imagecreatefromgif($tmp_name);
		  break;
		case $mimetypes[3]:
		  $img = imagecreatefrompng($tmp_name);
		  break;
	  }
	  
	  $datos = getimagesize($tmp_name);
	  
	  $ratio = ($datos[1]/$altura);
	  $ancho = round($datos[0]/$ratio);
	  $thumb = imagecreatetruecolor($ancho, $altura);
	  imagecopyresized($thumb, $img, 0, 0, 0, 0, $ancho, $altura, $datos[0], $datos[1]);
	  switch($type) {
		case $mimetypes[0]:
		case $mimetypes[1]:
		  imagejpeg($thumb, $NAMETHUMB);
			  break;
		case $mimetypes[2]:
		  imagegif($thumb, $NAMETHUMB);
		  break;
		case $mimetypes[3]:
		  imagepng($thumb, $NAMETHUMB);
		  break;
	  }
	  // Extrae los contenidos de las fotos
	  # contenido de la foto original
	  $fp = fopen($tmp_name, "rb");
	  $tfoto = fread($fp, filesize($tmp_name));
	  $tfoto = addslashes($tfoto);
	  fclose($fp);
	  # contenido del thumbnail
	  $fp = fopen($NAMETHUMB, "rb");
	  $tthumb = fread($fp, filesize($NAMETHUMB));
	  $tthumb = addslashes($tthumb);
	  fclose($fp);
	  // Borra archivos temporales si es que existen
	  //@unlink($tmp_name);
	  //@unlink(NAMETHUMB);
	} else {
		$tfoto = '';
		$type = '';
	}
	$tfoto = utf8_decode($tfoto);
	return array('tfoto' => $tfoto, 'type' => $type);	
}


?>