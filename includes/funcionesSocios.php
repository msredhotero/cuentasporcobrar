<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosSocios {

function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}


/* PARA Socios */

function insertarSocios($reftiposocio,$nombre,$domicilio,$curp,$rfc) { 
$sql = "insert into dbsocios(idsocio,reftiposocio,nombre,domicilio,curp,rfc) 
values ('',".$reftiposocio.",'".utf8_decode($nombre)."','".utf8_decode($domicilio)."','".utf8_decode($curp)."','".utf8_decode($rfc)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarSocios($id,$reftiposocio,$nombre,$domicilio,$curp,$rfc) { 
$sql = "update dbsocios 
set 
reftiposocio = ".$reftiposocio.",nombre = '".utf8_decode($nombre)."',domicilio = '".utf8_decode($domicilio)."',curp = '".utf8_decode($curp)."',rfc = '".utf8_decode($rfc)."' 
where idsocio =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarSocios($id) { 
$sql = "delete from dbsocios where idsocio =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerSocios() { 
$sql = "select s.idsocio, s.nombre, s.domicilio, s.curp, s.rfc, ts.tiposocio ,s.reftiposocio
		from dbsocios s 
		inner join tbtiposocios ts on ts.idtiposocio = s.reftiposocio
		where ts.activo = 1
		order by 3"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerSociosPorId($id) { 
$sql = "select idsocio,reftiposocio,nombre,domicilio,curp,rfc from dbsocios where idsocio =".$id; 
$res = $this->query($sql,0); 
return $res; 
}

function traerSociosPorEmpresa($idempresa) { 
$sql = "select s.idsocio, s.nombre, s.domicilio, s.curp, s.rfc, ts.tiposocio ,s.reftiposocio
		from dbsocios s 
		inner join tbtiposocios ts on ts.idtiposocio = s.reftiposocio
		inner join dbsociosempresas se on se.refsocio = s.idsocio
		inner join dbempresas e on se.refempresa = e.idempresa
		where ts.activo = 1 and e.idempresa = ".$idempresa."
		order by 3"; 
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