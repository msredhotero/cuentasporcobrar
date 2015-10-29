<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosPagos {

function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

/* PARA Pagos */

function insertarPagos($fechapago,$montoapagar,$referencia,$comentarios) { 
$sql = "insert into dbpagos(idpago,fechapago,montoapagar,referencia,comentarios) 
values ('','".utf8_decode($fechapago)."',".$montoapagar.",'".utf8_decode($referencia)."','".utf8_decode($comentarios)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarPagos($id,$fechapago,$montoapagar,$referencia,$comentarios) { 
$sql = "update dbpagos 
set 
fechapago = '".utf8_decode($fechapago)."',montoapagar = ".$montoapagar.",referencia = '".utf8_decode($referencia)."',comentarios = '".utf8_decode($comentarios)."' 
where idpago =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarPagos($id) { 
$sql = "delete from dbpagos where idpago =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerPagos() { 
$sql = "select idpago,fechapago,montoapagar,referencia,comentarios from dbpagos order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerPagosPorId($id) { 
$sql = "select idpago,fechapago,montoapagar,referencia,comentarios from dbpagos where idpago =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */


/* PARA PagosFacturas */

function insertarPagosFacturas($refpago,$reffactura,$refestatu) { 
$sql = "insert into dbpagosfacturas(idpagofactura,refpago,reffactura,refestatu) 
values ('',".$refpago.",".$reffactura.",".$refestatu.")"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarPagosFacturas($id,$refpago,$reffactura,$refestatu) { 
$sql = "update dbpagosfacturas 
set 
refpago = ".$refpago.",reffactura = ".$reffactura.",refestatu = ".$refestatu." 
where idpagofactura =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarPagosFacturas($id) { 
$sql = "delete from dbpagosfacturas where idpagofactura =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerPagosFacturas() { 
$sql = "select 
			pf.idpagofactura,
			e.razonsocial as empresa,
			c.razonsocial as cliente,
			f.nrofactura,
			p.fechapago,
			sum(p.montoapagar) as abono,
			p.referencia,
			p.comentarios,
			et.estatus,
			pf.refpago,
			pf.reffactura,
			pf.refestatu,
			c.idcliente,
			e.idempresa
		from
			dbpagosfacturas pf
				inner join
			dbpagos p ON pf.refpago = p.idpago
				inner join
			dbfacturas f ON f.idfactura = pf.reffactura
				inner join
			dbclientes c ON c.idcliente = f.refcliente
				inner join
			tbestatus et ON et.idestatu = pf.refestatu
				inner join
			dbempresas e ON e.idempresa = f.refempresa
		group by pf.idpagofactura , e.razonsocial , c.razonsocial , f.nrofactura , p.fechapago , p.referencia , p.comentarios , et.estatus , pf.refpago , pf.reffactura , pf.refestatu , c.idcliente , e.idempresa
		order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerPagosFacturasPorEmpresa($empresa) { 
$sql = "select 
			pf.idpagofactura,
			e.razonsocial as empresa,
			c.razonsocial as cliente,
			f.nrofactura,
			p.fechapago,
			sum(p.montoapagar) as abono,
			p.referencia,
			p.comentarios,
			et.estatus,
			pf.refpago,
			pf.reffactura,
			pf.refestatu,
			c.idcliente,
			e.idempresa
		from
			dbpagosfacturas pf
				inner join
			dbpagos p ON pf.refpago = p.idpago
				inner join
			dbfacturas f ON f.idfactura = pf.reffactura
				inner join
			dbclientes c ON c.idcliente = f.refcliente
				inner join
			tbestatus et ON et.idestatu = pf.refestatu
				inner join
			dbempresas e ON e.idempresa = f.refempresa
		where e.idempresa = ".$empresa."
		group by pf.idpagofactura , e.razonsocial , c.razonsocial , f.nrofactura , p.fechapago , p.referencia , p.comentarios , et.estatus , pf.refpago , pf.reffactura , pf.refestatu , c.idcliente , e.idempresa
		order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 

function traerPagosFacturasPorId($id) { 
$sql = "select idpagofactura,refpago,reffactura,refestatu from dbpagosfacturas 
		where idpagofactura =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */


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