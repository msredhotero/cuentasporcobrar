<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosFacturas {

function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

/* PARA Facturas */

function insertarFacturas($nrofactura,$fecha,$refcliente,$concepto,$importebruto,$iva,$total,$refempresa) {
$sql = "insert into dbfacturas(idfactura,nrofactura,fecha,refcliente,concepto,importebruto,iva,total,refempresa)
values ('','".utf8_decode($nrofactura)."','".$fecha."',".$refcliente.",'".utf8_decode($concepto)."',".$importebruto.",".$iva.",".$total.",".$refempresa.")";
//return $sql;
$res = $this->query($sql,1);
return $res;
}


function modificarFacturas($id,$nrofactura,$fecha,$refcliente,$concepto,$importebruto,$iva,$total,$refempresa) {
$sql = "update dbfacturas
set
nrofactura = '".utf8_decode($nrofactura)."',fecha = '".utf8_decode($fecha)."',refcliente = ".$refcliente.",concepto = '".utf8_decode($concepto)."',importebruto = ".$importebruto.",iva = ".$iva.",total = ".$total.",refempresa = ".$refempresa."
where idfactura =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarFacturas($id) {
$sql = "delete from dbfacturas where idfactura =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerFacturas() {
$sql = "select  f.idfactura, f.nrofactura, f.fecha, c.razonsocial, 
				f.concepto, f.importebruto, f.iva, f.total, e.razonsocial,
				f.refcliente, f.refempresa
		from dbfacturas f 
		inner join dbclientes c on f.refcliente = c.idcliente
		inner join dbempresas e on f.refempresa = e.idempresa
		order by f.fecha";
$res = $this->query($sql,0);
return $res;
}

function traerFacturasPorCliente($idCliente) {
$sql = "select  f.idfactura, f.nrofactura, f.fecha, c.razonsocial, 
				f.concepto, f.importebruto, f.iva, f.total, e.razonsocial,
				f.refcliente, f.refempresa
		from dbfacturas f 
		inner join dbclientes c on f.refcliente = c.idcliente
		inner join dbempresas e on f.refempresa = e.idempresa
		where c.idcliente = ".$idCliente." 
		order by f.fecha";
$res = $this->query($sql,0);
return $res;
}

function traerFacturasPorEmpresa($idEmpresa) {
$sql = "select  f.idfactura, f.nrofactura, f.fecha, c.razonsocial, 
				f.concepto, f.importebruto, f.iva, f.total, e.razonsocial,
				f.refcliente, f.refempresa
		from dbfacturas f 
		inner join dbclientes c on f.refcliente = c.idcliente
		inner join dbempresas e on f.refempresa = e.idempresa
		where e.idempresa = ".$idEmpresa." 
		order by f.fecha";
$res = $this->query($sql,0);
return $res;
}


function traerFacturasPorClienteEmpresa($idCliente, $idEmpresa, $fechaDesde, $fechaHasta) {

if (($fechaDesde == '') && ($fechaHasta == '')) {
	$sql = "select tt.idfactura, tt.nrofactura, tt.fecha, tt.razonsocial, 
					tt.concepto, tt.importebruto, tt.iva, tt.total, tt.razonsocialempresa,
					tt.refcliente, tt.refempresa, tt.saldo
			from (
			select  f.idfactura, f.nrofactura, f.fecha, c.razonsocial, 
							f.concepto, f.importebruto, f.iva, f.total, e.razonsocial as razonsocialempresa,
							f.refcliente, f.refempresa, coalesce(saldoFactura( f.idfactura ),f.total) as saldo
					from dbfacturas f 
					inner join dbclientes c on f.refcliente = c.idcliente
					inner join dbempresas e on f.refempresa = e.idempresa
					inner join dbpagosfacturas pf on pf.reffactura = f.idfactura
					where e.idempresa = ".$idEmpresa." and c.idcliente = ".$idCliente." and (pf.refestatu = 2 and coalesce(saldoFactura( f.idfactura ),f.total) > 1)

			union all
			
			select  f.idfactura, f.nrofactura, f.fecha, c.razonsocial, 
							f.concepto, f.importebruto, f.iva, f.total, e.razonsocial as razonsocialempresa,
							f.refcliente, f.refempresa, coalesce(saldoFactura( f.idfactura ),f.total) as saldo
					from dbfacturas f 
					inner join dbclientes c on f.refcliente = c.idcliente
					inner join dbempresas e on f.refempresa = e.idempresa
					left join dbpagosfacturas pf on pf.reffactura = f.idfactura
					where e.idempresa = ".$idEmpresa." and c.idcliente = ".$idCliente." and pf.idpagofactura is null
			) tt
			order by tt.fecha";
} else {
	$sql = "select tt.idfactura, tt.nrofactura, tt.fecha, tt.razonsocial, 
					tt.concepto, tt.importebruto, tt.iva, tt.total, tt.razonsocialempresa,
					tt.refcliente, tt.refempresa, tt.saldo
		from 
				(select  f.idfactura, f.nrofactura, f.fecha, c.razonsocial, 
							f.concepto, f.importebruto, f.iva, f.total, e.razonsocial as razonsocialempresa,
							f.refcliente, f.refempresa, coalesce(saldoFactura( f.idfactura ),f.total) as saldo
					from dbfacturas f 
					inner join dbclientes c on f.refcliente = c.idcliente
					inner join dbempresas e on f.refempresa = e.idempresa
					inner join dbpagosfacturas pf on pf.reffactura = f.idfactura
					where e.idempresa = ".$idEmpresa." and c.idcliente = ".$idCliente." and (f.fecha BETWEEN '".$fechaDesde."' and '".$fechaHasta."') and (pf.refestatu = 2 and coalesce(saldoFactura( f.idfactura ),f.total) > 1)

			union all
			
			select  f.idfactura, f.nrofactura, f.fecha, c.razonsocial, 
							f.concepto, f.importebruto, f.iva, f.total, e.razonsocial as razonsocialempresa,
							f.refcliente, f.refempresa, coalesce(saldoFactura( f.idfactura ),f.total) as saldo
					from dbfacturas f 
					inner join dbclientes c on f.refcliente = c.idcliente
					inner join dbempresas e on f.refempresa = e.idempresa
					left join dbpagosfacturas pf on pf.reffactura = f.idfactura
					where e.idempresa = ".$idEmpresa." and c.idcliente = ".$idCliente." and pf.idpagofactura is null and (f.fecha BETWEEN '".$fechaDesde."' and '".$fechaHasta."')) tt
			order by tt.fecha";
					
}

$res = $this->query($sql,0);
return $res;
}


function traerFacturasPorClienteEmpresaTodas($idCliente, $idEmpresa) {
$sql = "select  f.idfactura, f.nrofactura, f.fecha, c.razonsocial, 
				f.concepto, f.importebruto, f.iva, f.total, e.razonsocial,
				f.refcliente, f.refempresa, coalesce(saldoFactura( f.idfactura ),f.total) as saldo
		from dbfacturas f 
		inner join dbclientes c on f.refcliente = c.idcliente
		inner join dbempresas e on f.refempresa = e.idempresa
		where e.idempresa = ".$idEmpresa." and c.idcliente = ".$idCliente." 
		order by f.fecha";
$res = $this->query($sql,0);
return $res;
}


function traerFacturasPorId($id) {
$sql = "select f.idfactura, f.nrofactura, f.fecha, c.razonsocial as cliente, 
				f.concepto, f.importebruto, f.iva, f.total, e.razonsocial as empresa,
				f.refcliente, f.refempresa , coalesce(saldoFactura( f.idfactura ),f.total) as saldo
			from dbfacturas f 
			inner join dbclientes c on f.refcliente = c.idcliente
			inner join dbempresas e on f.refempresa = e.idempresa
				where f.idfactura =".$id;
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