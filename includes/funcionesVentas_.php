<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosVentas {

/* logica de negocios para las ventas */

function enviarEmail($destinatario,$asunto,$cuerpo) {
	# Defina el número de e-mails que desea enviar por periodo. Si es 0, el proceso por lotes
	# se deshabilita y los mensajes son enviados tan rápido como sea posible.
	define("MAILQUEUE_BATCH_SIZE",0);

	//para el envío en formato HTML
	//$headers = "MIME-Version: 1.0\r\n";
	
	// Cabecera que especifica que es un HMTL
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	//dirección del remitente
	$headers .= "From: Daniel Eduardo Duranti <info@carnesacasa.com.ar>\r\n";
	
	//ruta del mensaje desde origen a destino
	$headers .= "Return-path: ".$destinatario."\r\n";
	
	//direcciones que recibirán copia oculta
	$headers .= "Bcc: info@carnesacasa.com.ar,msredhotero@msn.com\r\n";
	
	mail($destinatario,$asunto,$cuerpo,$headers); 	
}


function traerVentasActivas($idcliente) {
	$sql = "select idauxdetallefactura,refcliente,refproducto,precioventa,cantidad,temporal,activo 
			from cv_detallefacturasaux 
			where activo = 1 and ip = '".$_SERVER['REMOTE_ADDR']."' and refcliente =".$idcliente;
	//return $sql;
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}


function traerVentasProductosActivas($idcliente) {
	$sql = "select ta.idauxdetallefactura,ta.refcliente,p.idproducto,p.producto,ta.cantidad,concat('archivos/',p.idproducto,'/',f.imagen) as imagen, tp.tipoproducto , ta.precioventa
			from cv_detallefacturasaux ta
			inner join cv_productos p on ta.refproducto = p.idproducto
			inner
			join		cv_tipoproducto tp
			on			p.reftipoproducto = tp.idtipoproducto and tp.activo = 1
			
			left
			join		pifotos f
			on			p.idproducto = f.refproducto
					
			where ta.activo = 1 and ip = '".$_SERVER['REMOTE_ADDR']."' and ta.refcliente =".$idcliente;
	//return $sql;
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}


function borrarCarritoViejo($refcliente) {
	$sql = "delete from cv_detallefacturasaux 
			where refcliente =".$refcliente." and temporal <= ADDDATE(CURRENT_DATE(),-3)";
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al eliminar datos';
	} else {
		return $res;
	}	
}


function borrarCarritoEntero($refcliente) {
	$sql = "delete from cv_detallefacturasaux 
			where refcliente =".$refcliente." and ip = '".$_SERVER['REMOTE_ADDR']."'";
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al eliminar datos';
	} else {
		return $res;
	}	
}


function traerTodosPedidos() {
	$sql = "select 
				f.nrofactura,
				f.domicilio,
				f.fechacreacion,
				es.estado,
				es.icono,
				f.idfactura,
				concat(u.apellido,', ',u.nombre) as nombrecompleto,
				u.email,
				p.idpedido,
				p.fechaentrega
				
			from
				cv_pedidos p
					inner join
				cv_facturas f ON p.reffactura = f.idfactura
					inner join
				cv_estadoenvio es ON es.idestadoenvio = p.refestado
					inner join
				se_usuarios u ON u.idusuario = f.refcliente
			order by  p.idpedido desc";
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}


function traerTodosPedidosPendientes() {
	$sql = "select 
				f.nrofactura,
				f.domicilio,
				f.fechacreacion,
				es.estado,
				es.icono,
				f.idfactura,
				concat(u.apellido,', ',u.nombre) as nombrecompleto,
				u.email,
				p.idpedido,
				p.fechaentrega
				
			from
				cv_pedidos p
					inner join
				cv_facturas f ON p.reffactura = f.idfactura
					inner join
				cv_estadoenvio es ON es.idestadoenvio = p.refestado
					inner join
				se_usuarios u ON u.idusuario = f.refcliente
			where es.estado <> 'Recibido' and es.estado <> 'Cancelado'
			order by  p.idpedido desc";
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}

function traerPedidos($refcliente) {
	$sql = "select 
				f.nrofactura,
				f.domicilio,
				f.fechacreacion,
				es.estado,
				es.icono,
				f.idfactura,
				p.idpedido,
				concat(u.apellido,', ',u.nombre) as nombrecompleto,
				p.fechaentrega
			from
				cv_pedidos p
					inner join
				cv_facturas f ON p.reffactura = f.idfactura
					inner join
				cv_estadoenvio es ON es.idestadoenvio = p.refestado
					inner join
				se_usuarios u ON u.idusuario = f.refcliente
			where
				u.idusuario = ".$refcliente." 
			order by  p.idpedido desc";
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}

function traerPedidosAbiertos($refcliente) {
	$sql = "select 
				f.nrofactura,
				f.domicilio,
				f.fechacreacion,
				es.estado,
				es.icono,
				f.idfactura,
				p.idpedido,
				concat(u.apellido,', ',u.nombre) as nombrecompleto,
				p.fechaentrega
			from
				cv_pedidos p
					inner join
				cv_facturas f ON p.reffactura = f.idfactura
					inner join
				cv_estadoenvio es ON es.idestadoenvio = p.refestado
					inner join
				se_usuarios u ON u.idusuario = f.refcliente
			where
				es.estado <> 'Recibido' and es.estado <> 'Cancelado' 
				and
				u.idusuario = ".$refcliente;
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}

function traerPedidosCerrados($refcliente) {
	$sql = "select 
				f.nrofactura,
				f.domicilio,
				f.fechacreacion,
				es.estado,
				es.icono,
				f.idfactura,
				p.idpedido,
				concat(u.apellido,', ',u.nombre) as nombrecompleto,
				p.fechaentrega
			from
				cv_pedidos p
					inner join
				cv_facturas f ON p.reffactura = f.idfactura
					inner join
				cv_estadoenvio es ON es.idestadoenvio = p.refestado
					inner join
				se_usuarios u ON u.idusuario = f.refcliente
			where
				es.estado = 'Recibido' or es.estado = 'Cancelado' 
				and
				u.idusuario = ".$refcliente;
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}


function traerPedidosPorId($id) {
	$sql = "select 
				f.nrofactura,
				f.domicilio,
				f.fechacreacion,
				es.estado,
				es.icono,
				f.idfactura,
				concat(u.apellido,', ',u.nombre) as nombrecompleto,
				p.idpedido,
				es.idestadoenvio,
				p.fechaentrega
			from
				cv_pedidos p
					inner join
				cv_facturas f ON p.reffactura = f.idfactura
					inner join
				cv_estadoenvio es ON es.idestadoenvio = p.refestado
					inner join
				se_usuarios u ON u.idusuario = f.refcliente
			where
				p.idpedido = ".$id;
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}


function traerPedidosDetalle($refcliente,$idfactura) {
	$sql = "select 
				concat('archivos/',pr.idproducto,'/',fo.imagen) as imagen, pr.producto, tp.tipoproducto, df.cantidad, df.precioventa
			from
				cv_pedidos p
					inner join
				cv_facturas f ON p.reffactura = f.idfactura
					inner join
				cv_estadoenvio es ON es.idestadoenvio = p.refestado
					inner join
				se_usuarios u ON u.idusuario = f.refcliente
					inner join
				cv_detallefacturas df ON f.idfactura = df.reffactura
					inner join
				cv_productos pr ON pr.idproducto = df.refproducto
					inner join
				cv_tipoproducto tp ON pr.reftipoproducto = tp.idtipoproducto
					and tp.activo = 1
					left join
				pifotos fo ON pr.idproducto = fo.refproducto
			where
				u.idusuario = ".$refcliente." and f.idfactura = ".$idfactura;
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}


function traerPedidosDetalleId($idfactura) {
	$sql = "select 
				concat('archivos/',pr.idproducto,'/',fo.imagen) as imagen, pr.producto, tp.tipoproducto, df.cantidad, df.precioventa
			from
				cv_pedidos p
					inner join
				cv_facturas f ON p.reffactura = f.idfactura
					inner join
				cv_estadoenvio es ON es.idestadoenvio = p.refestado
					inner join
				se_usuarios u ON u.idusuario = f.refcliente
					inner join
				cv_detallefacturas df ON f.idfactura = df.reffactura
					inner join
				cv_productos pr ON pr.idproducto = df.refproducto
					inner join
				cv_tipoproducto tp ON pr.reftipoproducto = tp.idtipoproducto
					and tp.activo = 1
					left join
				pifotos fo ON pr.idproducto = fo.refproducto
			where
				f.idfactura = ".$idfactura;
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}


function insertarPedido($refusuario,$reffactura,$fechaentrega) {
	$sql = "insert into cv_pedidos(idpedido,reffactura,refestado,fechacreacion,fechamodificacion,refusuario,fechaentrega)
			VALUES
			('',
			".$reffactura.",
			8,
			'".date('Y-m-d h:m:s')."',
			'".date('Y-m-d h:m:s')."',
			".$refusuario.",
			'".$fechaentrega."')";
	$res = $this->query($sql,1);
	if ($res == false) {
		return 'Error al insertar datos';
	} else {
		return $res;
	}
}

function modificarPedido($id,$refestado,$fechaentrega) {
	$sql = "update cv_pedidos
			SET
				refestado = ".$refestado.",
				fechamodificacion = '".date('Y-m-d h:m:s')."',
				fechaentrega = '".$fechaentrega."'
			where idpedido =".$id;
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al modificar datos';
	} else {
		return '';
	}		
}


function eliminarPedido($id) {
	
	$sql = "update cv_pedidos
			SET
				refestado = 5
			where reffactura =".$id;
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al eliminar datos';
	} else {
		//aviso al cliente de que el pedido fue cancelado
		$sqlEmail = "select email from se_usuarios u
					 inner join cv_facturas f
					 on		u.idusuario = f.refcliente
					 where f.idfactura =".$id;
		$email = mysql_result($this->query($sqlEmail,0),0,0);
		
		$sqlPedido = "select f.nrofactura 
						from cv_pedidos p
						inner join cv_facturas f
						on		p.reffactura = f.idfactura
						where p.idpedido = ".$id;
		$nropedido = mysql_result($this->query($sqlPedido,0),0,0);
		
		// Cuerpo o mensaje
		$mensaje = '
		<html>
		<head>
		  <title>Su pedido fue cancelado.</title>
		</head>
		<body>
		  <h4>Pedido Cancelado: <b>'.$nropedido.'</b>/a</h4>

		  <br>
		  <div style="border: 1px solid;
			margin: 10px 0px;
			padding:15px 10px 15px 50px;
			background-repeat: no-repeat;
			background-position: 10px center;
			font-family:Arial, Helvetica, sans-serif;
			font-size:13px;
			text-align:left;
			width:auto;
			color: #4F8A10;
			background-color: #DFF2BF;">
		  El siguiente link es para ver sus pedidos. Haga click <a href="http://www.carnesacasa.com.ar/dashboard/compras/">Aqui</a>
		</div>
			<br>
			<br>
			<p>Ante cualquier consulta comuniquese con el (011) 15 3946 - 7546. Muchas Gracias - <strong>Carnes a Casa</strong>.</p>
		</body>
		</html>
		';
		
		
		$this->enviarEmail($email,'Pedido Cancelado',$mensaje);
		return '';
	}		
}

function traerEstados() {
	$sql = "select 
				idestadoenvio, estado, icono
			from
				cv_estadoenvio";
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}

function traerEstadosPorId($id) {
	$sql = "select 
				estado, icono
			from
				cv_estadoenvio
			where idestadoenvio =".$id;
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}



function insertarCarrito($refcliente,$refproducto,$precioventa,$cantidad,$temporal,$activo,$ip) {
	
	$sqlProducto = "select precioventa from cv_productos where idproducto =".$refproducto;
	$precioventa = mysql_result($this->query($sqlProducto,0),0,0);
	
	$sql = "INSERT INTO cv_detallefacturasaux
				(idauxdetallefactura,
				refcliente,
				refproducto,
				precioventa,
				cantidad,
				temporal,
				activo,
				ip)
			VALUES
				('',
				".$refcliente.",
				".$refproducto.",
				".$precioventa.",
				".(integer)$cantidad.",
				'".$temporal."',
				".$activo.",
				'".$ip."')";
				
	//return $sql;
	$res = $this->query($sql,1);
	if ($res == false) {
		return 'Error al insertar datos';
	} else {
		return $res;
	}
}

function generarFactura() {
	$sql = "select max(idfactura) from cv_facturas";
	$res = $this->query($sql,0);
	if (mysql_num_rows($res)>0) {
		$fact = "CAC".str_pad(mysql_result($res,0,0)+1, 7, "0", STR_PAD_LEFT); 
	} else {
		$fact = "CAC0000001";
	}
	return $fact;
}

function insertarFactura($refcliente,$domicilio,$fechaentrega) {
	$nrofactura = $this->generarFactura();
	$sql	= "INSERT INTO cv_facturas
					(idfactura,
					nrofactura,
					fechacreacion,
					refcliente,
					domicilio,
					cancelado)
				VALUES
					('',
					'".$nrofactura."',
					'".date('Y-m-d h:m:s')."',
					".$refcliente.",
					'".utf8_decode($domicilio)."',
					0);";
	$res = $this->query($sql,1);
	if ($res == false) {
		return 'Error al insertar datos';
	} else {
		$this->insertarDetalle($res,$refcliente);
		$this->insertarPedido($refcliente,$res,$fechaentrega);
		return $res;
	}
		
}

function modificarFactura($id,$domicilio) {
	$sql = "update cv_facturas
			SET
				domicilio = '".utf8_decode($domicilio)."',
				cancelado = 0
			where idfactura =".$id;
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al modificar datos';
	} else {
		return '';
	}		
}


function eliminarFactura($id) {
	$sql = "update cv_facturas
			SET
				cancelado = 1
			where idfactura =".$id;
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al eliminar datos';
	} else {
		return '';
	}		
}


function insertarDetalle($reffactura,$refcliente) {
	$sql = "INSERT INTO cv_detallefacturas
				(iddetallefactura,
				reffactura,
				refproducto,
				precioventa,
				cantidad)
			select '',".$reffactura.", refproducto, 0, cantidad
				from cv_detallefacturasaux c
				where c.refcliente = ".$refcliente." and activo = 1 and ip = '".$_SERVER['REMOTE_ADDR']."'";
	//return $sql;
	$res = $this->query($sql,1);
	if ($res == false) {
		return 'Error al insertar datos';
	} else {
		$this->borrarCarritoEntero($refcliente);
		return $res;
	}
}

function eliminarCarrito($id) {
	$sql = "delete from cv_detallefacturasaux where idauxdetallefactura =".$id;
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al eliminar datos';
	} else {
		return '';
	}
}

/* fin */

function query($sql,$accion) {
		
		
		
		require_once 'appconfig.php';

		$appconfig	= new appconfig();
		$datos		= $appconfig->conexion();	
		$hostname	= $datos['hostname'];
		$database	= $datos['database'];
		$username	= $datos['username'];
		$password	= $datos['password'];
		
		$conex = mysql_connect($hostname,$username,$password) or die ("no se puede conectar".mysql_error());
		
		mysql_select_db($database);
		
		$error = 0;
		
		mysql_query("BEGIN");
		$result=mysql_query($sql,$conex);
		if ($accion && $result) {
			$result = mysql_insert_id();
		}
		if(!$result){
			$error=1;
		}
		if($error==1){
			mysql_query("ROLLBACK");
			return false;
		}
		 else{
			mysql_query("COMMIT");
			return $result;
		}
		
	}

}

?>