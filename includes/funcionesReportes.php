<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosReportes {

function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}


function rptFacturacionGeneralPorEmpresa($empresa) { 
$sql = "select
			r.nrofactura,
			r.cliente,
			r.referencia,
			r.fechapago,
			r.total,
			r.abono,
			r.total - r.abono as saldo
		from
		(
		select 
			f.nrofactura,
			c.razonsocial as cliente,
			p.referencia,
			max(p.fechapago) as fechapago,
			f.total,
			coalesce(sum(p.montoapagar),0) as abono
			
			
		from
			dbfacturas f
				left join
			dbpagosfacturas pf ON f.idfactura = pf.reffactura
				left join
			dbpagos p ON pf.refpago = p.idpago
				inner join
			dbclientes c ON c.idcliente = f.refcliente
				left join
			tbestatus et ON et.idestatu = pf.refestatu
				inner join
			dbempresas e ON e.idempresa = f.refempresa
		where	e.idempresa = ".$empresa."
		group by f.nrofactura,
			c.razonsocial,
			p.referencia,
			f.total
		) as r
		order by 2"; 
$res = $this->query($sql,0); 
return $res; 
}


function rptSaldoCliente($empresa) { 
$sql = "select
			r.cliente,
			r.total,
			r.abono,
			r.total - r.abono as saldo
		from
		(
		select 
			c.razonsocial as cliente,
			sum(f.total) as total,
			coalesce(sum(p.montoapagar),0) as abono
			
			
		from
			dbfacturas f
				left join
			dbpagosfacturas pf ON f.idfactura = pf.reffactura
				left join
			dbpagos p ON pf.refpago = p.idpago
				inner join
			dbclientes c ON c.idcliente = f.refcliente
				left join
			tbestatus et ON et.idestatu = pf.refestatu
				inner join
			dbempresas e ON e.idempresa = f.refempresa
		where	e.idempresa = ".$empresa."
		group by c.razonsocial
		) as r
		order by 2"; 
$res = $this->query($sql,0); 
return $res; 
} 


function rptSaldoPorCliente($empresa,$idcliente) { 
	$sql = "select
			r.nrofactura,
			r.referencia,
			r.fechapago,
			r.total,
			r.abono,
			r.comentarios
		from
		(
		select 
			f.nrofactura,
			p.referencia,
			max(p.fechapago) as fechapago,
			f.total,
			coalesce(sum(p.montoapagar),0) as abono,
			p.comentarios
			
			
		from
			dbfacturas f
				left join
			dbpagosfacturas pf ON f.idfactura = pf.reffactura
				left join
			dbpagos p ON pf.refpago = p.idpago
				inner join
			dbclientes c ON c.idcliente = f.refcliente
				left join
			tbestatus et ON et.idestatu = pf.refestatu
				inner join
			dbempresas e ON e.idempresa = f.refempresa
		where	e.idempresa = ".$empresa." and c.idcliente = ".$idcliente."
		group by f.nrofactura,
			p.comentarios,
			p.referencia,
			f.total
		) as r
		order by 2"; 
$res = $this->query($sql,0); 
return $res; 
} 


function rptSaldoEmpresa($empresa) { 
$sql = "select
			r.cliente,
			r.total,
			r.abono,
			r.total - r.abono as saldo
		from
		(
		select 
			e.razonsocial as cliente,
			sum(f.total) as total,
			coalesce(sum(p.montoapagar),0) as abono
			
			
		from
			dbfacturas f
				left join
			dbpagosfacturas pf ON f.idfactura = pf.reffactura
				left join
			dbpagos p ON pf.refpago = p.idpago
				inner join
			dbclientes c ON c.idcliente = f.refcliente
				left join
			tbestatus et ON et.idestatu = pf.refestatu
				inner join
			dbempresas e ON e.idempresa = f.refempresa
		
		group by e.razonsocial
		) as r
		order by 2"; 
$res = $this->query($sql,0); 
return $res; 
} 



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